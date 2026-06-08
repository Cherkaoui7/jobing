@extends('layouts.account')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-10">

            <div class="card shadow border-0 rounded-lg">

                <div class="card-body p-5">

                    <h1 class="mb-5 text-center">
                        Resume Analysis Result
                    </h1>

                    <div class="text-center mb-5">

                        <h2 class="text-success">
                            ATS Score: {{$score}}%
                        </h2>

                    </div>

                    <div class="mb-4">

                        <h4>Detected Skills</h4>

                        @foreach($detectedSkills as $skill)

                            <span class="badge badge-success p-2 m-1">
                                {{$skill}}
                            </span>

                        @endforeach

                    </div>

                    <div class="mb-4">

                        <h4>Missing Skills</h4>

                        @foreach($missingSkills as $skill)

                            <span class="badge badge-danger p-2 m-1">
                                {{$skill}}
                            </span>

                        @endforeach

                    </div>

                    <div class="mb-4">

                        <h4>Recommendations</h4>

                        <ul>

                            @foreach($recommendations as $recommendation)

                                <li>{{$recommendation}}</li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection