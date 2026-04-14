<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Darshan Super Market - Login</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-sans);
        }

        .wrap {
            display: flex;
            min-height: 100vh;
        }

        .left {
            flex: 1.1;
            background: #1a6b35;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 48px 40px;
            position: relative;
            overflow: hidden;
        }

        .left::before {
            content: '';
            position: absolute;
            width: 320px;
            height: 320px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            top: -80px;
            left: -80px;
        }

        .left::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.04);
            bottom: 40px;
            right: -60px;
        }

        .logo-circle {
            width: 88px;
            height: 88px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 28px;
            position: relative;
            z-index: 1;
        }

        .logo-icon {
            font-size: 36px;
            line-height: 1;
        }

        .brand-name {
            font-size: 24px;
            font-weight: 500;
            color: #fff;
            text-align: center;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
            letter-spacing: 0.3px;
        }

        .brand-sub {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.65);
            text-align: center;
            max-width: 240px;
            line-height: 1.7;
            position: relative;
            z-index: 1;
        }

        .divider-line {
            width: 40px;
            height: 2px;
            background: rgba(255, 255, 255, 0.25);
            border-radius: 2px;
            margin: 24px auto;
            position: relative;
            z-index: 1;
        }

        .features {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            gap: 14px;
            width: 100%;
            max-width: 260px;
        }

        .feat {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .feat-dot {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }

        .feat-text {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.75);
            line-height: 1.4;
        }

        .right {
            flex: 1;
            background: var(--color-background-tertiary, #f5f5f3);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 24px;
        }

        .card {
            background: var(--color-background-primary, #fff);
            border: 0.5px solid var(--color-border-tertiary, rgba(0, 0, 0, 0.12));
            border-radius: 16px;
            padding: 40px 36px;
            width: 100%;
            max-width: 380px;
        }

        .card-header {
            margin-bottom: 32px;
        }

        .welcome-tag {
            display: inline-block;
            font-size: 11px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #1a6b35;
            background: #eaf5ee;
            padding: 4px 10px;
            border-radius: 20px;
            margin-bottom: 12px;
        }

        .card-title {
            font-size: 22px;
            font-weight: 500;
            color: var(--color-text-primary, #1a1a1a);
            margin-bottom: 6px;
        }

        .card-desc {
            font-size: 13px;
            color: var(--color-text-secondary, #666);
            line-height: 1.6;
        }

        .field-label {
            display: block;
            font-size: 12px;
            font-weight: 500;
            color: var(--color-text-secondary, #555);
            margin-bottom: 6px;
            letter-spacing: 0.2px;
        }

        .field-wrap {
            position: relative;
            margin-bottom: 18px;
        }

        .field-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            font-size: 14px;
            pointer-events: none;
        }

        .field-input {
            width: 100%;
            padding: 11px 12px 11px 38px;
            font-size: 14px;
            border: 1.5px solid var(--color-border-tertiary, #ddd);
            border-radius: 10px;
            background: var(--color-background-secondary, #fafafa);
            color: var(--color-text-primary, #1a1a1a);
            transition: border-color 0.15s;
            outline: none;
            font-family: var(--font-sans);
        }

        .field-input:focus {
            border-color: #1a6b35;
            background: var(--color-background-primary, #fff);
        }

        .field-input::placeholder {
            color: var(--color-text-tertiary, #aaa);
            font-size: 13px;
        }

        .forgot {
            text-align: right;
            margin-top: -10px;
            margin-bottom: 22px;
        }

        .forgot a {
            font-size: 12px;
            color: #1a6b35;
            text-decoration: none;
        }

        .forgot a:hover {
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: #1a6b35;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            letter-spacing: 0.3px;
            font-family: var(--font-sans);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.15s;
        }

        .btn-login:hover {
            background: #145529;
        }

        .btn-login:active {
            transform: scale(0.98);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 22px 0;
        }

        .divider hr {
            flex: 1;
            border: none;
            border-top: 0.5px solid var(--color-border-tertiary, #e5e5e5);
        }

        .divider span {
            font-size: 12px;
            color: var(--color-text-tertiary, #aaa);
        }

        .btn-google {
            width: 100%;
            padding: 11px;
            background: transparent;
            border: 1.5px solid var(--color-border-tertiary, #ddd);
            border-radius: 10px;
            font-size: 13px;
            color: var(--color-text-secondary, #555);
            cursor: pointer;
            font-family: var(--font-sans);
            transition: border-color 0.15s, background 0.15s, color 0.15s;

            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-google:hover {
            border-color: #1a6b35;
            color: #1a6b35;
            background: #f0faf3;
        }

        .google-icon {
            width: 16px;
            height: 16px;
        }

        .footer-note {
            text-align: center;
            font-size: 12.5px;
            color: var(--color-text-secondary, #777);
            margin-top: 22px;
        }

        .footer-note a {
            color: #1a6b35;
            font-weight: 500;
            text-decoration: none;
        }

        .footer-note a:hover {
            text-decoration: underline;
        }

        @media (max-width: 680px) {
            .wrap {
                flex-direction: column;
            }

            .left {
                padding: 32px 24px;
                flex: none;
            }

            .features {
                display: none;
            }

            .divider-line {
                display: none;
            }

            .brand-name {
                font-size: 20px;
            }

            .right {
                padding: 28px 16px;
            }

            .card {
                padding: 28px 22px;
            }
        }
    </style>
</head>

<body>

    <div class="wrap">
        <div class="left">
            <div class="logo-circle">
                <span class="logo-icon">🛒</span>
            </div>
            <div class="brand-name">Darshan Super Market</div>
            <div class="brand-sub">Amreli's trusted grocery destination for fresh produce and daily essentials.</div>
            <div class="divider-line"></div>
            <div class="features">
                <div class="feat">
                    <div class="feat-dot">🥦</div>
                    <div class="feat-text">Fresh produce sourced daily</div>
                </div>
                <div class="feat">
                    <div class="feat-dot">🏷️</div>
                    <div class="feat-text">Best prices, guaranteed</div>
                </div>
                <div class="feat">
                    <div class="feat-dot">⚡</div>
                    <div class="feat-text">Quick billing & checkout</div>
                </div>
            </div>
        </div>

        <div class="right">
            <div class="card">
                <div class="card-header">
                    <div class="welcome-tag">Welcome back</div>
                    <div class="card-title">Sign in to your account</div>
                    <div class="card-desc">Enter your credentials to access your account and orders.</div>
                </div>

                <div>
                    <label class="field-label">Email address</label>
                    <div class="field-wrap">
                        <span class="field-icon">✉</span>
                        <input type="email" class="field-input" placeholder="you@example.com">
                    </div>

                    <label class="field-label">Password</label>
                    <div class="field-wrap">
                        <span class="field-icon">🔒</span>
                        <input type="password" class="field-input" placeholder="Enter your password">
                    </div>

                    <div class="forgot"><a href="#">Forgot password?</a></div>

                    <button class="btn-login">
                        <span>Sign in</span>
                        <span style="font-size:14px;">→</span>
                    </button>

                    <div class="divider">
                        <hr><span>or</span>
                        <hr>
                    </div>

                    <a href="" class="btn-google">
                        <img src="https://developers.google.com/identity/images/g-logo.png" width="20">
                        Login with Google
                    </a>

                    <div class="footer-note">
                        New customer? <a href="{{ route('Auth.register') }}">Create an account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
