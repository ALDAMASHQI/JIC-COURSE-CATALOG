@extends('auth.app')

@section('content')
    <div style="    max-width: 520px;" class="login-container">
        <div class="login-card">
            <div class="brand-header">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('logo.png') }}" height="100" alt="JIC Logo">
                </a>
                <h1>JIC <span>Catalog</span> Register</h1>
                <p class="text-muted">Create your student account to rate courses.</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p class="mb-0">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('register') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="Student_Name" class="form-label fw-bold">Full Name</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        <input type="text" class="form-control @error('Student_Name') is-invalid @enderror"
                               id="Student_Name" name="Student_Name" value="{{ old('Student_Name') }}"
                               placeholder="Enter your full name" required>
                    </div>
                    @error('Student_Name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="Email" class="form-label fw-bold">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                        <input type="email" class="form-control @error('Email') is-invalid @enderror"
                               id="Email" name="Email" value="{{ old('Email') }}"
                               placeholder="Enter your JIC email address" required>
                    </div>
                    @error('Email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">
                        This will be used for both login and student records.
                    </small>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               id="password" name="password" placeholder="Create a password" required>
                    </div>
                    @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label fw-bold">Confirm Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control"
                               id="password_confirmation" name="password_confirmation"
                               placeholder="Re-enter password" required>
                    </div>
                </div>

                <button style="background-color: var(--primary-dark); border-color: var(--primary-dark);" type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                    Register Account
                </button>

                <div class="text-center">
                    <p class="text-muted mb-0">Already have an account?
                        <a href="{{ route('login') }}" class="text-decoration-none text-primary fw-semibold">Log In Here</a>
                    </p>
                </div>
            </form>
        </div>
        <p class="text-center text-muted mt-4">&copy; {{ date('Y') }} JIC Course Catalog</p>
    </div>
@endsection
