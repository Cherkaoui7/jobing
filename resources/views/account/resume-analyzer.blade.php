@extends('layouts.account')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card shadow border-0 rounded-lg">

                <div class="card-body p-5 text-center">

                    <h1 class="mb-3">
                        Resume Analyzer
                    </h1>

                    <p class="text-muted mb-4">
                        Upload your CV and get AI-powered analysis.
                    </p>

                    <form 
                        action="{{route('account.analyzeResume')}}" 
                        method="POST"
                        enctype="multipart/form-data"
                    >

                        @csrf

                        <div class="mb-4">

                            <input 
                                type="file"
                                name="cv"
                                class="form-control"
                                required
                            >

                        </div>

                        <button class="btn btn-primary btn-lg px-5">

                            Analyze Resume

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection