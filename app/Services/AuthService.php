<?php

namespace App\Services;

use App\Http\Resources\Auth\LoginResource;
use App\Http\Resources\Auth\RegisterResource;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Helpers\ServiceResponse;
use App\Helpers\LogService;
use Illuminate\Support\Facades\Mail;
use App\Helpers\Service;
use App\Http\Resources\Auth\UserResource;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use PhpParser\Node\Expr;
use Symfony\Component\HttpKernel\DependencyInjection\ServicesResetterInterface;

class AuthService
{
    public function register($data)
    {
        try {
            $user = new User();
            $user->name = $data['name'];
            $user->uuid = Str::uuid();
            $user->email = $data['email'];
            $user->phone_number = $data['phone_number'];
            $user->password = $data['password'];
            $user->save();
            $otp = $this->generateAndSendOtp($user, type: 'verify');
            return ServiceResponse::created(
                data: [
                    'user' => new RegisterResource($user),
                ],
                message: __('auth.register_success_otp', [
                    'data' =>  __('auth.user'),
                    'action' => __('auth.register')
                ])
            );
        } catch (\Exception $e) {
            return ServiceResponse::serverError(message: $e);
        }
    }

    public function login($data)
    {
        try {
            $user = User::where('email', $data['email'])->first();
            if (!$user->exists())
                return ServiceResponse::notFound(message: __('auth.not_found', ['data' =>  __('auth.user')]));
            if (!Hash::check($data['password'], $user->password))
                return ServiceResponse::error(message: __('auth.invalid_credential'), statusCode: 401);
            if (!$user->isVerified()) {
                $this->generateAndSendOtp($user, type: 'verify');
                return ServiceResponse::success(
                    data: [
                        'is_verified' => false,
                    ],
                    message: __('auth.login_success_not_verify')
                );
            }
            $token = $user->createToken('auth_token')->plainTextToken;
            return ServiceResponse::success(
                data: ['user' => new LoginResource($user), 'token' => $token],
                message: __('auth.login_success', [
                    'data'   => __('auth.user'),
                    'action' => __('auth.login'),
                ])
            );
        } catch (Exception $e) {
            return ServiceResponse::serverError($e->getMessage());
        }
    }
    public function generateAndSendOtp(User $user, string $type = 'verify')
    {
        try {
            // Generate 6-digit OTP
            $otp = Service::generateOtp(6);
            // Save OTP with 10 minutes expiry
            $user->otp = Hash::make($otp);
            $user->otp_expired_at = now()->addMinutes(10);
            $user->save();
            Mail::to($user->email)->send(new OtpMail($otp, $user, type: $type));
            return  $otp;
        } catch (\Exception $e) {
            LogService::error(__('auth.otp_fail'), [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);
            return $e->getMessage();
        }
    }

    public function verifyOtp(string $email, string $otp): ServiceResponse
    {
        try {
            $user = User::where('email', $email)->first();
            if (!$user) {
                return ServiceResponse::error(message: __('auth.not_found', ['data' => __('auth.email')]));
            }
            // Check if user already verified
            if ($user->isVerified()) {
                return ServiceResponse::error(
                    message: __('auth.already_verified', ['data' => __('auth.otp')]),
                    statusCode: 400
                );
            }

            // Check if OTP exists
            if (!$user->otp) {
                return ServiceResponse::error(
                    message: __('auth.not_found', ['data' => __('auth.otp')]),
                    statusCode: 404
                );
            }

            // Check if OTP is expired
            if ($user->otp_expired_at->isPast()) {
                return ServiceResponse::error(
                    message: __('auth.otp_expired'),
                );
            }

            // Verify OTP
            if (!$user->isOtpValid($otp)) {
                return ServiceResponse::error(
                    message: __('auth.invalid_otp'),
                    statusCode: 400
                );
            }

            // Mark as verified
            $user->markAsVerified();
            $token = $user->createToken('auth_token')->plainTextToken;
            return ServiceResponse::success(
                message: __('auth.otp_verify_success'),
                data: [
                    'token' => $token,
                    'user' => new UserResource($user),
                ],

            );
        } catch (\Exception $e) {
            LogService::error(__('otp_verification_fail'), [
                'error' => $e->getMessage()
            ]);

            return ServiceResponse::serverError(
                message: __('auth.otp_verification_fail')
            );
        }
    }

    public function resendOtp(string $email, string $type): ServiceResponse
    {
        try {
            $user = User::where('email', $email)->first();
            if (!$user) {
                return ServiceResponse::notFound(message: __('auth.not_found', ['data' => __('auth.user')]));
            }
            // Check if user already verified
            // if ($user->isVerified()) {
            //     return ServiceResponse::error(
            //         message: __('auth.already_verified', ['data' => __('auth.user')]),
            //     );
            // }

            // Check rate limiting (optional)
            if ($user->otp_expired_at && $user->otp_expired_at->isFuture()) {
                $remainingTime = now()->diffInSeconds($user->otp_expired_at);
                if ($remainingTime > 540) { // 9 minutes (allow resend in last minute)
                    return ServiceResponse::error(
                        message: __('auth.otp_not_expired'),
                        statusCode: 429
                    );
                }
            }
            $otp =  $this->generateAndSendOtp($user, type: $type);
            return ServiceResponse::success(message: __('auth.otp_sent', ['contact' => $user->email]));
        } catch (\Exception $e) {
            LogService::error('OTP resend failed', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);

            return ServiceResponse::serverError(
                message: __('auth.otp_resend_failed')
            );
        }
    }
    public function requestResetOtp(string $email)
    {
        try {
            $user = User::where('email', $email)->first();
            if (!$user) {
                return ServiceResponse::notFound(__('auth.not_found', ['data' => __('auth.user')]));
            }
            $this->generateAndSendOtp($user, type: 'reset');
            return ServiceResponse::success(message: __('auth.otp_sent', ['contact' => $email]));
        } catch (Exception $e) {
            return ServiceResponse::serverError($e->getMessage());
        }
    }
    public function verifyResetPassword(string $email, string $otp)
    {
        try {
            $user = User::where('email', $email)->first();
            if (!$user) {
                return ServiceResponse::notFound(__('auth.not_found', ['data' => __('auth.user')]));
            }
            if (!$user->isOtpValid($otp)) {
                return ServiceResponse::error(__('auth.invalid_otp'));
            }
            return ServiceResponse::success(message: __('auth.otp_verified'));
        } catch (Exception $e) {
            return ServiceResponse::serverError($e->getMessage());
        }
    }

    public function resetPassword(string $email, string $password, string $otp)
    {
        try {
            $user = User::where('email', $email)->first();
            if (!$user) {
                return ServiceResponse::notFound(__('auth.not_found', ['data' => __('auth.user')]));
            }
            if (!$user->isOtpValid($otp)) {
                return ServiceResponse::error(__('auth.invalid_otp'));
            }
            $user->password = Hash::make($password);
            $user->remember_token = null;
            $user->otp = null;
            $user->otp_expired_at = null;
            $user->password_reset_at = now()->toDateTimeString();
            $user->save();

            return ServiceResponse::success(message: __('auth.password_reset_success'), data: ['password_reset_at' => $user->password_reset_at]);
        } catch (Exception $e) {
            return ServiceResponse::serverError($e->getMessage());
        }
    }
}
