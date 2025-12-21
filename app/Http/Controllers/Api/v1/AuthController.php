<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\LogService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\loginRequest;
use App\Http\Requests\Auth\OtpRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use App\Services\OtpService;
use Exception;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Symfony\Component\Mime\Message;

class AuthController extends Controller
{
    public function __construct(private readonly AuthService $authService,) {}

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        try {
            $response = $this->authService->register($data);
            return $this->respond($response);
        } catch (Exception $e) {
            LogService::error($e->getMessage());
            $this->serverError($e->getMessage());
        }
    }

    public function login(loginRequest $request)
    {
        try {
            $data = $request->validated();
            $response = $this->authService->login($data);
            return $this->respond($response);
        } catch (Exception $e) {
            LogService::error($e->getMessage());
            return $this->serverError($e->getMessage());
        }
    }

    public function verify(OtpRequest $request)
    {
        try {
            $data = $request->validated();
            $response = $this->authService->verifyOtp(email: $data['email'], otp: $data['otp']);
            return  $this->respond($response);
        } catch (\Exception $e) {
            LogService::error($e->getMessage());
            return $this->serverError(message: $e->getMessage());
        }
    }
    public function resend(Request $request)
    {
        try {
            $data = $request->validate([
                'email' => ['required', 'email', 'exists:users,email'],
                'type' => ['required', 'string', 'in:verify,reset']
            ],);
            $response = $this->authService->resendOtp($data['email'], $data['type']);
            return $this->respond($response);
        } catch (Exception $e) {
            LogService::error($e->getMessage());
            $this->serverError($e->getMessage());
        }
    }
    public function logout(Request $request)
    {
        try {
            $request->user()?->currentAccessToken()?->delete();
            return $this->success(data: null, message: __('auth.user_logout'));
        } catch (Exception $e) {
            LogService::error($e->getMessage());
            $this->serverError($e->getMessage());
        }
    }

    public function requestResetPassword(Request $request)
    {
        try {
            $data = $request->validate([
                'email' => ['required', 'email', 'exists:users,email',]
            ]);
            $response = $this->authService->requestResetOtp($data['email']);
            return $this->respond($response);
        } catch (Exception $e) {
            LogService::error($e->getMessage());
            return $this->serverError($e->getMessage());
        }
    }

    public function verifyResetPassword(Request $request)
    {
        try {
            $data = $request->validate([
                'email' => ['required', 'email', 'exists:users,email'],
                'otp' => ['required', 'size:6']
            ]);
            $response = $this->authService->verifyResetPassword($data['email'], $data['otp']);
            return $this->respond($response);
        } catch (Exception $e) {
            LogService::error($e->getMessage());
            return $this->serverError($e->getMessage());
        }
    }
    public function resetPassword(Request $request)
    {
        try {
            $data = $request->validate([
                'email' => ['required', 'email', 'exists:users,email'],
                'otp' => ['required', 'size:6'],
                'password' => ['required', 'string', 'min:6', 'max:8', 'confirmed']

            ]);
            $response = $this->authService->resetPassword($data['email'], $data['password'], $data['otp']);
            return $this->respond($response);
        } catch (Exception $e) {
            LogService::error($e->getMessage());
            return $this->serverError($e->getMessage());
        }
    }
}
