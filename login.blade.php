@extends('auth.app')

@section('content')
    <div class="login-container">
        <div class="login-card">
            <div class="brand-header">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('logo.png') }}" height="100" alt="JIC Logo">
                </a>
                <h1>JIC <span>Catalog</span> Login</h1>
                <p class="text-muted">Sign in to access course details and ratings.</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p class="mb-0">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('login') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email') }}"
                               placeholder="Enter your email address" required>
                    </div>
                    @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fw-bold">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>

                <button style="background-color: var(--primary-dark); border-color: var(--primary-dark);" type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                    Log In
                </button>

                <div class="d-flex justify-content-between">
                    <a href="#" class="text-decoration-none text-primary">Forgot Password?</a>
                    <a href="{{ route('register') }}" class="text-decoration-none text-primary">Create an Account</a>
                </div>
            </form>
        </div>
        <p class="text-center text-muted mt-4">&copy; {{ date('Y') }} JIC Course Catalog</p>
    </div>
@endsection
