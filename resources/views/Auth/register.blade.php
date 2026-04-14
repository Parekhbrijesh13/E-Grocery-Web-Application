<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Darshan Super market - signup</title>
    <!-- ADD THIS IN <head> -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .wrap {
            display: flex;
            min-height: 100vh;
            font-family: var(--font-sans);
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
            font-size: 36px;
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
            padding: 38px 36px;
            width: 100%;
            max-width: 400px;
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
            margin-bottom: 28px;
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
            margin-bottom: 16px;
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
            outline: none;
            font-family: var(--font-sans);
            transition: border-color 0.15s, background 0.15s;
        }

        .field-input:focus {
            border-color: #1a6b35;
            background: var(--color-background-primary, #fff);
        }

        .field-input::placeholder {
            color: var(--color-text-tertiary, #aaa);
            font-size: 13px;
        }

        .field-input.error {
            border-color: #d84040;
        }

        .field-input.success {
            border-color: #1a6b35;
        }

        .hint {
            font-size: 11.5px;
            margin-top: -10px;
            margin-bottom: 14px;
            padding-left: 2px;
        }

        .hint.err {
            color: #d84040;
        }

        .hint.ok {
            color: #1a6b35;
        }

        .status-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 13px;
        }

        .btn-signup {
            width: 100%;
            padding: 12px;
            background: #1a6b35;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            font-family: var(--font-sans);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 6px;
            transition: background 0.15s;
        }

        .btn-signup:hover {
            background: #145529;
        }

        .btn-signup:active {
            transform: scale(0.98);
        }

        .footer-note {
            text-align: center;
            font-size: 12.5px;
            color: var(--color-text-secondary, #777);
            margin-top: 20px;
        }

        .footer-note a {
            color: #1a6b35;
            font-weight: 500;
            text-decoration: none;
        }

        .footer-note a:hover {
            text-decoration: underline;
        }

        .terms {
            font-size: 11.5px;
            color: var(--color-text-tertiary, #999);
            text-align: center;
            margin-top: 14px;
            line-height: 1.6;
        }

        .terms a {
            color: #1a6b35;
            text-decoration: none;
        }

        .terms a:hover {
            text-decoration: underline;
        }

        @media (max-width: 680px) {
            .wrap {
                flex-direction: column;
            }

            .left {
                padding: 28px 24px;
                flex: none;
            }

            .features,
            .divider-line {
                display: none;
            }

            .right {
                padding: 24px 16px;
            }

            .card {
                padding: 26px 20px;
            }
        }
    </style>

</head>

<body>

    <div class="wrap">
        <div class="left">
            <div class="logo-circle">🛒</div>
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
                <div class="welcome-tag">Get started</div>
                <div class="card-title">Create your account</div>
                <div class="card-desc">Join Darshan Super Market and enjoy a seamless shopping experience.</div>

                <form method="" action="" id="signup-form">
                    @csrf

                    <label class="field-label">Full name</label>
                    <div class="field-wrap">
                        <span class="field-icon">👤</span>
                        <input type="text" class="field-input" id="inp-name" name="name"
                            placeholder="e.g. Rahul Sharma">
                        <span class="status-icon" id="icon-name"></span>
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="hint" id="hint-name"></div>

                    <label class="field-label">Email address</label>
                    <div class="field-wrap">
                        <span class="field-icon">✉</span>
                        <input type="email" class="field-input" id="inp-email" name="email"
                            placeholder="you@example.com">
                        <span class="status-icon" id="icon-email"></span>
                        <span class="text-danger error-text email_error"></span>
                    </div>
                    <div class="hint" id="hint-email"></div>

                    <label class="field-label">Password</label>
                    <div class="field-wrap">
                        <span class="field-icon">🔒</span>
                        <input type="password" class="field-input" id="inp-pass" name="password"
                            placeholder="Min. 8 characters">
                        <span class="status-icon" id="icon-pass"></span>
                        <span class="text-danger error-text password_error"></span>
                    </div>
                    <div class="hint" id="hint-pass"></div>

                    <label class="field-label">Confirm password</label>
                    <div class="field-wrap">
                        <span class="field-icon">🔒</span>
                        <input type="password" class="field-input" id="inp-confirm" name="password_confirmation"
                            placeholder="Re-enter your password">
                        <span class="status-icon" id="icon-confirm"></span>
                        <span class="text-danger error-text password_confirmation_error"></span>
                    </div>
                    <div class="hint" id="hint-confirm"></div>

                    <button type="submit" class="btn-signup">
                        <span>Create account</span>
                        <span style="font-size:14px;">→</span>
                    </button>

                </form>

                <div class="footer-note">
                    Already have an account? <a href="{{ route('Auth.login') }}">Sign in</a>
                </div>
                <div class="terms">
                    By registering, you agree to our <a href="#">Terms of Service</a> and <a
                        href="#">Privacy Policy</a>.
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery-1.11.0.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            // CSRF setup (IMPORTANT)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('submit', '#signup-form', function(e) {
                e.preventDefault();

                let formdata = $(this).serialize();

                // Clear old errors
                $('.error-text').text('');
                $('.field-input').removeClass('error');

                $.ajax({
                    url: "{{ route('register.store') }}",
                    method: "POST",
                    data: formdata,

                    success: function(response) {
                        window.location.href = "{{ route('Auth.login') }}";
                    },

                    error: function(xhr) {

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;

                            $.each(errors, function(key, value) {
                                $('.' + key + '_error').text(value[0]);
                                $('[name="' + key + '"]').addClass('error');
                            });

                        } else {
                            alert('Something went wrong. Try again!');
                        }
                    }
                });

            });

        });
    </script>

</body>

</html>
