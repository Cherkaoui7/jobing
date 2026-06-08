@extends('layouts.auth')

@section('content')

<div class="modern-auth">

    <div class="container">

        <div class="row align-items-center min-vh-100">

            {{-- LEFT SIDE --}}
            <div class="col-lg-6 d-none d-lg-flex">

                <div class="auth-left">

                    <span class="auth-badge">
                        🚀 AI Recruitment Platform
                    </span>

                    <h1>
                        Build Your Career With Smart Opportunities
                    </h1>

                    <p>
                        Create your professional profile, build ATS-ready CVs,
                        analyze resumes and get matched with top companies.
                    </p>

                    <div class="auth-features">

                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            AI Resume Analyzer
                        </div>

                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            Smart Job Matching
                        </div>

                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            One Click Apply
                        </div>

                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            ATS Friendly CV Builder
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

                        <h2>Create Account</h2>

                        <p>
                            Start your professional journey today
                        </p>

                    </div>

                    <form action="{{route('register')}}" method="POST">

                        @csrf

                        <div class="form-group">

                            <label>Full Name</label>

                            <div class="modern-input">

                                <i class="fas fa-user"></i>

                                <input 
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    placeholder="Enter your full name"
                                    required
                                >

                            </div>

                        </div>

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

                        </div>

                        <div class="form-group">

                            <label>Password</label>

                            <div class="modern-input">

                                <i class="fas fa-lock"></i>

                                <input 
                                    type="password"
                                    name="password"
                                    placeholder="Create strong password"
                                    required
                                >

                            </div>

                        </div>

                        <div class="form-group">

                            <label>Confirm Password</label>

                            <div class="modern-input">

                                <i class="fas fa-shield-alt"></i>

                                <input 
                                    type="password"
                                    name="password_confirmation"
                                    placeholder="Confirm your password"
                                    required
                                >

                            </div>

                        </div>

                        <button type="submit" class="modern-auth-btn">

                            Create Account

                        </button>

                    </form>

                    <div class="auth-bottom">

                        Already have an account?

                        <a href="{{route('login')}}">
                            Sign In
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
    border:1px solid rgba(255,255,255,.1);

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
    font-size:4.4rem;
    font-weight:800;
    line-height:1.05;
    margin-bottom:25px;
}

.auth-left p{
    color:#cbd5e1;
    font-size:1.1rem;
    line-height:1.9;
    margin-bottom:45px;
    max-width:540px;
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
    font-size:1.1rem;
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
    font-size:1rem;
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

    font-size:1rem;
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

    transform:translateY(-1px);
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

    margin-top:12px;

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

    font-size:.96rem;
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

    .auth-logo h2{
        font-size:2rem;
    }

}

</style>

@endpush