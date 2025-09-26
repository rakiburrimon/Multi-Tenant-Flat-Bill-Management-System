<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset - {{ config('app.name') }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 300;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
            color: #2c3e50;
        }
        .message {
            font-size: 16px;
            margin-bottom: 30px;
            color: #555;
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .reset-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            padding: 15px 30px;
            border-radius: 25px;
            font-weight: bold;
            font-size: 16px;
            transition: transform 0.2s ease;
        }
        .reset-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 5px;
            padding: 15px;
            margin: 20px 0;
            color: #856404;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px 30px;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
        }
        .footer p {
            margin: 5px 0;
        }
        .divider {
            height: 1px;
            background-color: #e9ecef;
            margin: 20px 0;
        }
        .security-tips {
            background-color: #e8f4fd;
            border-left: 4px solid #007bff;
            padding: 15px;
            margin: 20px 0;
        }
        .security-tips h4 {
            margin-top: 0;
            color: #007bff;
        }
        .security-tips ul {
            margin: 10px 0;
            padding-left: 20px;
        }
        .security-tips li {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>{{ config('app.name') }}</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">Password Reset Request</p>
        </div>
        
        <div class="content">
            <div class="greeting">
                Hello {{ $user->name ?? 'User' }}!
            </div>
            
            <div class="message">
                We received a request to reset your password for your account. If you made this request, click the button below to reset your password:
            </div>
            
            <div class="button-container">
                <a href="{{ $actionUrl }}" class="reset-button">Reset My Password</a>
            </div>
            
            <div class="warning">
                <strong>⚠️ Important:</strong> This password reset link will expire in {{ config('auth.passwords.' . config('auth.defaults.passwords') . '.expire', 60) }} minutes for security reasons.
            </div>
            
            <div class="security-tips">
                <h4>🔒 Security Tips:</h4>
                <ul>
                    <li>Never share your password with anyone</li>
                    <li>Use a strong, unique password</li>
                    <li>Log out from shared devices</li>
                    <li>Contact support if you didn't request this reset</li>
                </ul>
            </div>
            
            <div class="divider"></div>
            
            <div class="message">
                If you didn't request a password reset, you can safely ignore this email. Your password will remain unchanged.
            </div>
            
            <div class="message">
                <strong>Having trouble with the button?</strong><br>
                Copy and paste this link into your browser:<br>
                <a href="{{ $actionUrl }}" style="color: #667eea; word-break: break-all;">{{ $actionUrl }}</a>
            </div>
        </div>
        
        <div class="footer">
            <p><strong>{{ config('app.name') }}</strong></p>
            <p>Multi-Tenant Flat Bill Management System</p>
            <p>This is an automated message, please do not reply to this email.</p>
            <p style="font-size: 12px; margin-top: 15px;">
                © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
