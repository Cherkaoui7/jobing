@extends('layouts.auth')

@section('content')

<div class="modern-auth">

    <div class="container">

        <div class="row align-items-center min-vh-100">

            {{-- LEFT SIDE --}}
            <div class="col-lg-6 d-none d-lg-flex">

                <div class="auth-left">

                    <span class="auth-badge">
                        🔐 Secure Login Platform
                    </span>

                    <h1>
                        Welcome Back To Your Career Journey
                    </h1>

                    <p>
                        Login to access your dashboard, AI resume tools,
                        smart job matching and professional opportunities.
                    </p>

                    <div class="auth-features">

                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            AI Resume Builder
                        </div>

                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            Smart Job Recommendations
                        </div>

                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            ATS CV Optimization
                        </div>

                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            Secure Candidate Dashboard
                        </div>

                    </div>

                </div>

            </div>

            {{-- RIGHT SIDE --}}
            <div class="col-lg-6">

                <div class="modern-auth-card">

                    <div class="auth-logo text-center">

                        <img 
                            src="{{asset('images/logo/joblister.png')}}"
                            width="75"
                            alt=""
                        >

                        <h2>Welcome Back</h2>

                        <p>
                            Login to continue your journey
                        </p>

                    </div>

                    <form action="{{route('login')}}" method="POST">

                        @csrf

                        <div class="form-group">

                            <label>Email Address</label>

                            <div class="modern-input">

                                <i class="fas fa-envelope"></i>

                                <input 
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="Enter your email address"
                                    required
                                >

                            </div>

                            @error('email')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                        <div class="form-group">

                            <label>Password</label>

                            <div class="modern-input">

                                <i class="fas fa-lock"></i>

                                <input 
                                    type="password"
                                    name="password"
                                    placeholder="Enter your password"
                                    required
                                >

                            </div>

                            @error('password')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                        <div class="remember-box">

                            <div>
                                <input 
                                    type="checkbox"
                                    id="rememberMe"
                                    name="remember"
                                    {{ old('remember') ? 'checked' : '' }}
                                >

                                <label for="rememberMe">
                                    Remember me
                                </label>
                            </div>

                            <a href="#" class="forgot-link">
                                Forgot password?
                            </a>

                        </div>

                        <button type="submit" class="modern-auth-btn">

                            Sign In

                        </button>

                    </form>

                    <div class="auth-bottom">

                        Don’t have an account?

                        <a href="{{route('register')}}">
                            Create Account
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection


@push('css')

<style>

.modern-auth{
    background:
    linear-gradient(rgba(15,23,42,.88),rgba(15,23,42,.88)),
    url('{{asset("images/login-background.png")}}');

    background-size:cover;
    background-position:center;

    min-height:100vh;

    display:flex;
    align-items:center;

    padding:80px 0;
}

.auth-left{
    color:white;
    padding-right:70px;
}

.auth-badge{
    background:rgba(255,255,255,.1);

    border:1px solid rgba(255,255,255,.08);

    padding:12px 20px;

    border-radius:50px;

    display:inline-flex;
    align-items:center;

    font-size:.95rem;
    font-weight:600;

    margin-bottom:30px;

    backdrop-filter:blur(10px);
}

.auth-left h1{
    font-size:4.2rem;
    font-weight:800;
    line-height:1.05;
    margin-bottom:25px;
}

.auth-left p{
    color:#cbd5e1;
    font-size:1.1rem;
    line-height:1.9;
    margin-bottom:45px;
}

.auth-features{
    display:flex;
    flex-direction:column;
    gap:20px;
}

.feature-item{
    display:flex;
    align-items:center;

    font-size:1.05rem;
    font-weight:500;

    color:#f1f5f9;
}

.feature-item i{
    color:#22c55e;
    margin-right:14px;
}

.modern-auth-card{
    background:rgba(255,255,255,.98);

    border-radius:32px;

    padding:55px;

    box-shadow:
    0 25px 70px rgba(0,0,0,.25);

    backdrop-filter:blur(12px);
}

.auth-logo{
    margin-bottom:35px;
}

.auth-logo h2{
    font-size:2.3rem;
    font-weight:800;

    color:#0f172a;

    margin-top:20px;
}

.auth-logo p{
    color:#64748b;
    margin-top:10px;
}

.form-group{
    margin-bottom:24px;
}

.form-group label{
    display:block;

    font-weight:700;

    color:#1e293b;

    margin-bottom:12px;
}

.modern-input{
    position:relative;
}

.modern-input i{
    position:absolute;

    left:20px;
    top:50%;

    transform:translateY(-50%);

    color:#94a3b8;
}

.modern-input input{
    width:100%;
    height:62px;

    border:1px solid #e2e8f0;

    border-radius:18px;

    padding:0 22px 0 55px;

    background:#fff;

    font-size:1rem;

    transition:all .3s ease;
}

.modern-input input:focus{
    outline:none;

    border-color:#2563eb;

    box-shadow:
    0 0 0 5px rgba(37,99,235,.10);
}

.remember-box{
    display:flex;
    align-items:center;
    justify-content:space-between;

    margin-bottom:25px;

    font-size:.95rem;
}

.remember-box label{
    margin-left:6px;
    color:#475569;
}

.forgot-link{
    color:#2563eb;
    font-weight:600;
}

.modern-auth-btn{
    width:100%;
    height:62px;

    border:none;

    border-radius:18px;

    background:linear-gradient(to right,#2563eb,#1d4ed8);

    color:white;

    font-weight:700;
    font-size:1rem;

    transition:all .3s ease;
}

.modern-auth-btn:hover{
    transform:translateY(-3px);

    box-shadow:
    0 18px 35px rgba(37,99,235,.28);
}

.auth-bottom{
    text-align:center;

    margin-top:28px;

    color:#64748b;
}

.auth-bottom a{
    color:#2563eb;
    font-weight:700;
}

@media(max-width:991px){

    .modern-auth{
        padding:120px 0 60px;
    }

    .modern-auth-card{
        padding:35px 25px;
    }

    .auth-left h1{
        font-size:3rem;
    }

}

</style>

@endpush