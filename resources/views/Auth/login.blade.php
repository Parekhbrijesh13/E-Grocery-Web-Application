<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Darshan Super Market - Login</title>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; background: #f5f5f3; }
        .wrap { display: flex; min-height: 100vh; }
        .left { flex: 1.1; background: #1a6b35; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 48px 40px; position: relative; overflow: hidden; color: #fff; }
        .left::before { content: ''; position: absolute; width: 320px; height: 320px; border-radius: 50%; background: rgba(255, 255, 255, 0.05); top: -80px; left: -80px; }
        .logo-circle { width: 88px; height: 88px; border-radius: 50%; background: rgba(255, 255, 255, 0.15); border: 2px solid rgba(255, 255, 255, 0.3); display: flex; align-items: center; justify-content: center; margin-bottom: 28px; font-size: 36px; }
        .brand-name { font-size: 24px; font-weight: 500; margin-bottom: 10px; }
        .brand-sub { font-size: 13px; color: rgba(255, 255, 255, 0.65); text-align: center; max-width: 240px; line-height: 1.7; }
        .right { flex: 1; display: flex; align-items: center; justify-content: center; padding: 40px 24px; }
        .card { background: #fff; border: 0.5px solid rgba(0, 0, 0, 0.12); border-radius: 16px; padding: 40px 36px; width: 100%; max-width: 380px; }
        .welcome-tag { display: inline-block; font-size: 11px; font-weight: 500; text-transform: uppercase; letter-spacing: 1.2px; color: #1a6b35; background: #eaf5ee; padding: 4px 10px; border-radius: 20px; margin-bottom: 12px; }
        .card-title { font-size: 22px; font-weight: 500; color: #1a1a1a; margin-bottom: 6px; }
        .card-desc { font-size: 13px; color: #666; line-height: 1.6; margin-bottom: 32px; }
        .field-label { display: block; font-size: 12px; font-weight: 500; color: #555; margin-bottom: 6px; }
        .field-wrap { position: relative; margin-bottom: 18px; }
        .field-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #aaa; font-size: 14px; }
        .field-input { width: 100%; padding: 11px 12px 11px 38px; font-size: 14px; border: 1.5px solid #ddd; border-radius: 10px; background: #fafafa; outline: none; transition: border-color 0.15s; }
        .field-input:focus { border-color: #1a6b35; background: #fff; }
        .btn-login { width: 100%; padding: 12px; background: #1a6b35; color: #fff; border: none; border-radius: 10px; font-size: 14px; font-weight: 500; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; transition: background 0.15s; }
        .btn-login:hover { background: #145529; }
        .btn-login:disabled { opacity: 0.7; cursor: not-allowed; }
        .footer-note { text-align: center; font-size: 12.5px; color: #777; margin-top: 22px; }
        .footer-note a { color: #1a6b35; font-weight: 500; text-decoration: none; }
        @media (max-width: 680px) { .wrap { flex-direction: column; } .left { padding: 32px 24px; flex: none; } .right { padding: 28px 16px; } }
    </style>
</head>

<body>
    <div class="wrap">
        <div class="left">
            <div class="logo-circle">🛒</div>
            <div class="brand-name">Darshan Super Market</div>
            <div class="brand-sub">Amreli's trusted grocery destination for fresh produce and daily essentials.</div>
        </div>

        <div class="right">
            <div class="card">
                <div class="welcome-tag">Welcome back</div>
                <h1 class="card-title">Sign in to your account</h1>
                <p class="card-desc">Enter your credentials to access your account.</p>

                <form id="login-form">
                    @csrf
                    <label class="field-label">Email address</label>
                    <div class="field-wrap">
                        <span class="field-icon">✉</span>
                        <input type="email" name="email" class="field-input" placeholder="you@example.com" required>
                    </div>

                    <label class="field-label">Password</label>
                    <div class="field-wrap">
                        <span class="field-icon">🔒</span>
                        <input type="password" name="password" class="field-input" placeholder="Enter your password" required>
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 22px; margin-top: -10px;">
                        <label style="display: flex; align-items: center; gap: 6px; font-size: 12.5px; color: #666; cursor: pointer;">
                            <input type="checkbox" name="remember" style="accent-color: #1a6b35;"> Remember me
                        </label>
                        <a href="#" style="font-size: 12px; color: #1a6b35; text-decoration: none;">Forgot password?</a>
                    </div>

                    <button type="submit" class="btn-login">
                        <span>Sign in</span>
                        <span style="font-size:14px;">→</span>
                    </button>
                </form>

                <div class="footer-note">
                    New customer? <a href="{{ route('register') }}">Create an account</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            $('#login-form').on('submit', function(e) {
                e.preventDefault();
                let btn = $('.btn-login');
                btn.prop('disabled', true).text('Signing in...');
                
                $.ajax({
                    url: "{{ route('login.authenticate') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        window.location.href = "{{ route('admin.dashboard') }}";
                    },
                    error: function(xhr) {
                        btn.prop('disabled', false).html('<span>Sign in</span> <span style="font-size:14px;">→</span>');
                        if (xhr.status === 422) {
                            alert(xhr.responseJSON.message);
                        } else {
                            alert('Something went wrong. Please try again.');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
