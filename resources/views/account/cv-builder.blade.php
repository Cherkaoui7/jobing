@extends('layouts.account')

@section('content')

<div class="cv-builder-page py-5">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-10">

                <div class="cv-card">

                    <div class="cv-header">

                        <h1>Create Professional CV</h1>

                        <p>
                            Fill your information and generate a modern PDF CV instantly.
                        </p>

                    </div>

                    <form action="{{route('account.generateCV')}}" method="POST">

                        @csrf

                        <div class="row">

                            {{-- LEFT --}}
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Full Name</label>

                                    <input
                                        type="text"
                                        name="name"
                                        class="form-control custom-input"
                                        value="{{auth()->user()->name}}"
                                        placeholder="John Doe"
                                    >

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Email Address</label>

                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control custom-input"
                                        value="{{auth()->user()->email}}"
                                        placeholder="john@example.com"
                                    >

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Phone Number</label>

                                    <input
                                        type="text"
                                        name="phone"
                                        class="form-control custom-input"
                                        placeholder="+212 600000000"
                                    >

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>City</label>

                                    <input
                                        type="text"
                                        name="city"
                                        class="form-control custom-input"
                                        placeholder="Casablanca"
                                    >

                                </div>

                            </div>

                            <div class="col-md-12">

                                <div class="form-group">

                                    <label>Skills</label>

                                    <input
                                        type="text"
                                        name="skills"
                                        class="form-control custom-input"
                                        placeholder="Laravel, PHP, MySQL, React..."
                                    >

                                    <small class="text-muted">
                                        Separate skills with commas
                                    </small>

                                </div>

                            </div>

                            <div class="col-md-12">

                                <div class="form-group">

                                    <label>Professional Experience</label>

                                    <textarea
                                        name="experience"
                                        rows="5"
                                        class="form-control custom-input"
                                        placeholder="Describe your work experience..."
                                    ></textarea>

                                </div>

                            </div>

                            <div class="col-md-12">

                                <div class="form-group">

                                    <label>Education</label>

                                    <textarea
                                        name="education"
                                        rows="4"
                                        class="form-control custom-input"
                                        placeholder="Bachelor degree, certifications..."
                                    ></textarea>

                                </div>

                            </div>

                            <div class="col-md-12">

                                <div class="form-group">

                                    <label>About Me</label>

                                    <textarea
                                        name="bio"
                                        rows="4"
                                        class="form-control custom-input"
                                        placeholder="Write short professional summary..."
                                    ></textarea>

                                </div>

                            </div>

                            <div class="col-md-12 text-center mt-4">

                                <button class="generate-btn">

                                    <i class="fas fa-file-pdf"></i>

                                    Generate Professional CV

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection


@push('css')

<style>

.cv-builder-page{
    background:#f1f5f9;
    min-height:100vh;
}

.cv-card{
    background:white;
    border-radius:25px;
    padding:50px;
    box-shadow:0 15px 50px rgba(0,0,0,.08);
}

.cv-header{
    text-align:center;
    margin-bottom:40px;
}

.cv-header h1{
    font-weight:800;
    color:#0f172a;
    margin-bottom:10px;
}

.cv-header p{
    color:#64748b;
    font-size:16px;
}

.form-group{
    margin-bottom:25px;
}

.form-group label{
    font-weight:700;
    margin-bottom:10px;
    color:#1e293b;
}

.custom-input{
    border-radius:14px;
    border:1px solid #dbeafe;
    padding:14px 18px;
    min-height:55px;
    box-shadow:none !important;
    transition:.3s;
}

textarea.custom-input{
    min-height:auto;
}

.custom-input:focus{
    border-color:#2563eb;
    box-shadow:0 0 0 4px rgba(37,99,235,.1) !important;
}

.generate-btn{
    background:linear-gradient(to right,#2563eb,#1d4ed8);
    color:white;
    border:none;
    padding:16px 35px;
    border-radius:14px;
    font-weight:700;
    font-size:16px;
    transition:.3s;
}

.generate-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 25px rgba(37,99,235,.3);
}

</style>

@endpush