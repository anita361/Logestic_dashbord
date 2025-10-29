<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .logo {
            width: 100px;
            margin-bottom: 20px;
        }
        .social-btn i {
            margin-right: 8px;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-body text-center">

               <h4 class="mb-4">Login to Your Account</h4>

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger text-start">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('login.post') }}" class="text-start">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="email"
                               value="{{ old('email') }}" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>

                <!-- Divider -->
                <div class="my-3">
                    <span class="text-muted">or</span>
                </div>

                <!-- Google Login -->
                <a href="{{ route('auth.google.redirect') }}" class="btn btn-danger w-100 mb-2 social-btn">
                    <i class="bi bi-google"></i> Login with Google
                </a>

                <!-- Apple Login -->
                <a href="" class="btn btn-dark w-100 social-btn">
                    <i class="bi bi-apple"></i> Login with Apple
                </a>

                <!-- Register Link -->
                <div class="text-center mt-3">
                    <a href="{{ route('signup') }}">Don't have an account? Register here</a>
                </div>

            </div>
        </div>
    </div>
</div>

</body>
</html>
