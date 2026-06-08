@extends('layouts.account')

@section('content')

<div class="account-layout border">

    <div class="account-hdr bg-primary text-white border">
        User Account
    </div>

    <div class="account-bdy border py-4">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-xl-10 col-md-12">

                    <div class="card user-card-full">

                        <div class="row m-0">

                            {{-- LEFT SIDE --}}
                            <div class="col-md-4 bg-c-lite-green user-profile">

                                <div class="card-block text-center text-white">

                                    <div class="m-b-25">

                                        <img
                                            src="{{ auth()->user()->image ? asset(auth()->user()->image) : asset('images/user-profile.png') }}"
                                            class="img-radius profile-image"
                                            alt="User-Profile-Image"
                                        >

                                    </div>

                                    <h4 class="f-w-600 text-capitalize">
                                        {{auth()->user()->name}}
                                    </h4>

                                    @role('user')
                                        <p>User</p>
                                    @endrole

                                    @role('author')
                                        <p>Employer</p>
                                    @endrole

                                    @role('admin')
                                        <p>Administrator</p>
                                    @endrole

                                    <hr class="bg-white">

                                    <div class="text-left mt-4">

                                        <p>
                                            <strong>Email:</strong><br>
                                            {{auth()->user()->email}}
                                        </p>

                                        <p>
                                            <strong>Phone:</strong><br>
                                            {{auth()->user()->phone ?? 'Not set'}}
                                        </p>

                                        <p>
                                            <strong>City:</strong><br>
                                            {{auth()->user()->city ?? 'Not set'}}
                                        </p>

                                    </div>

                                    @if(auth()->user()->cv)

                                        <a
                                            href="{{asset(auth()->user()->cv)}}"
                                            target="_blank"
                                            class="btn btn-light btn-block mt-4"
                                        >
                                            Download CV
                                        </a>

                                    @endif

                                </div>

                            </div>


                            {{-- RIGHT SIDE --}}
                            <div class="col-md-8">

                                <div class="card-block p-4">

                                    <h4 class="m-b-20 p-b-5 b-b-default f-w-600">
                                        Edit Profile
                                    </h4>

                                    <form
                                        action="{{route('account.updateProfile')}}"
                                        method="POST"
                                        enctype="multipart/form-data"
                                    >

                                        @csrf
                                        @method('PUT')

                                        <div class="row">

                                            <div class="col-md-6 mb-3">

                                                <label>Full Name</label>

                                                <input
                                                    type="text"
                                                    name="name"
                                                    class="form-control"
                                                    value="{{auth()->user()->name}}"
                                                >

                                            </div>

                                            <div class="col-md-6 mb-3">

                                                <label>Phone</label>

                                                <input
                                                    type="text"
                                                    name="phone"
                                                    class="form-control"
                                                    value="{{auth()->user()->phone}}"
                                                >

                                            </div>

                                            <div class="col-md-6 mb-3">

                                                <label>City</label>

                                                <input
                                                    type="text"
                                                    name="city"
                                                    class="form-control"
                                                    value="{{auth()->user()->city}}"
                                                >

                                            </div>

                                            <div class="col-md-6 mb-3">

                                                <label>Skills</label>

                                                <input
                                                    type="text"
                                                    name="skills"
                                                    class="form-control"
                                                    value="{{auth()->user()->skills}}"
                                                >

                                            </div>

                                            <div class="col-md-6 mb-3">

                                                <label>LinkedIn</label>

                                                <input
                                                    type="text"
                                                    name="linkedin"
                                                    class="form-control"
                                                    value="{{auth()->user()->linkedin}}"
                                                >

                                            </div>

                                            <div class="col-md-6 mb-3">

                                                <label>Github</label>

                                                <input
                                                    type="text"
                                                    name="github"
                                                    class="form-control"
                                                    value="{{auth()->user()->github}}"
                                                >

                                            </div>

                                            <div class="col-md-12 mb-3">

                                                <label>About Me</label>

                                                <textarea
                                                    name="bio"
                                                    rows="4"
                                                    class="form-control"
                                                >{{auth()->user()->bio}}</textarea>

                                            </div>

                                            <div class="col-md-6 mb-3">

                                                <label>Profile Image</label>

                                                <input
                                                    type="file"
                                                    name="image"
                                                    class="form-control"
                                                >

                                            </div>

                                            <div class="col-md-6 mb-3">

                                                <label>Upload CV</label>

                                                <input
                                                    type="file"
                                                    name="cv"
                                                    class="form-control"
                                                >

                                            </div>

                                            <div class="col-md-12 mt-3">

                                                <button
                                                    type="submit"
                                                    class="btn btn-primary px-4"
                                                >
                                                    Update Profile
                                                </button>

                                                <a
                                                    href="{{route('account.changePassword')}}"
                                                    class="btn btn-outline-dark"
                                                >
                                                    Change Password
                                                </a>

                                            </div>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection


@push('css')

<style>

.user-card-full{
    overflow:hidden;
    border:none;
    border-radius:20px;
    box-shadow:0 10px 40px rgba(0,0,0,.08);
}

.bg-c-lite-green{
    background:linear-gradient(to bottom right,#2563eb,#0f172a);
}

.user-profile{
    padding:40px 20px;
}

.profile-image{
    width:120px;
    height:120px;
    object-fit:cover;
    border-radius:50%;
    border:4px solid rgba(255,255,255,.2);
}

.card-block{
    padding:30px;
}

.form-control{
    border-radius:12px;
    padding:12px;
    border:1px solid #e2e8f0;
    box-shadow:none;
}

.form-control:focus{
    border-color:#2563eb;
    box-shadow:0 0 0 3px rgba(37,99,235,.1);
}

.btn-primary{
    background:#2563eb;
    border:none;
    border-radius:12px;
    padding:10px 20px;
}

.btn-primary:hover{
    background:#1d4ed8;
}

.btn-outline-dark{
    border-radius:12px;
}

label{
    font-weight:600;
    margin-bottom:8px;
}

</style>

@endpush