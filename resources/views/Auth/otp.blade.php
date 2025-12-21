<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .container {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
        }

        .otp-code {
            font-size: 32px;
            font-weight: bold;
            color: #4F46E5;
            letter-spacing: 8px;
            margin: 20px 0;
            padding: 15px;
            background-color: #fff;
            border-radius: 8px;
            display: inline-block;
        }

        .warning {
            color: #666;
            font-size: 14px;
            margin-top: 20px;
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Hello, {{ $user->name }}!</h1>
        <p>{{ $type === 'verify' ? 'Verify your account' : 'Reset your password' }} using this code:</p>
        <div class="otp-code">{{ $otp }}</div>

        <p class="warning">
            ⏰ This code will expire in 10 minutes.<br>
            🔒 Do not share this code with anyone.
        </p>

        <p>If you didn't request this code, please ignore this email.</p>

        <div class="footer">
            <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
