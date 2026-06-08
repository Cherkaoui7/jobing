@extends('layouts.post')

@section('content')

<section class="modern-home">

    <div class="container">

        <div class="hero-section">

            <div class="row align-items-center">

                <div class="col-lg-6">

                    <div class="hero-content">

                        <span class="hero-badge">
                            🚀 AI Powered Recruitment Platform
                        </span>

                        <h1 class="hero-title">
                            Find Your Dream Job With Smart Matching
                        </h1>

                        <p class="hero-text">
                            Discover thousands of opportunities, build ATS-ready CVs,
                            analyze resumes and get hired faster.
                        </p>

                        <form action="{{route('job.index')}}" method="GET">

                            <div class="hero-search">

                                <input 
                                    type="text"
                                    name="q"
                                    class="form-control"
                                    placeholder="Search jobs, companies, skills..."
                                >

                                <button type="submit">
                                    <i class="fas fa-search"></i>
                                </button>

                            </div>

                        </form>

                        <div class="hero-stats">

                            <div class="stat-box">
                                <h3>10K+</h3>
                                <p>Jobs</p>
                            </div>

                            <div class="stat-box">
                                <h3>5K+</h3>
                                <p>Companies</p>
                            </div>

                            <div class="stat-box">
                                <h3>20K+</h3>
                                <p>Candidates</p>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-lg-6">

                    <div class="hero-image">

                        <img 
                            src="{{asset('images/user-profile.jpg')}}"
                            class="img-fluid"
                            alt=""
                        >

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<section class="jobs-section">

    <div class="container">

        <div class="section-title d-flex justify-content-between align-items-center mb-5">

            <div>
                <h2>🔥 Featured Jobs</h2>
                <p>Latest AI matched opportunities</p>
            </div>

            <a href="{{route('job.index')}}" class="view-all-btn">
                View All Jobs
            </a>

        </div>

        <div class="row g-4">

            @foreach ($posts as $post)

                @if ($post->company)

                <div class="col-lg-4 col-md-6">

                    <a href="{{route('post.show',['job'=>$post->id])}}" class="job-card-link">

                        <div class="modern-job-card">

                            <div class="job-top">

                                <img 
                                    src="{{asset($post->company->logo)}}"
                                    class="company-logo"
                                    alt=""
                                >

                                <span class="job-badge">
                                    New
                                </span>

                            </div>

                            <h3 class="job-title">
                                {{$post->job_title}}
                            </h3>

                            <p class="company-name">
                                {{$post->company->title}}
                            </p>

                            <div class="job-tags">

                                <span>{{$post->employment_type}}</span>

                                <span>{{$post->job_level}}</span>

                            </div>

                            <div class="job-footer">

                                <span>
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{$post->job_location}}
                                </span>

                                <span class="salary">
                                    {{$post->salary}}
                                </span>

                            </div>

                        </div>

                    </a>

                </div>

                @endif

            @endforeach

        </div>

    </div>

</section>


<section class="categories-section">

    <div class="container">

        <div class="text-center mb-5">

            <h2>Browse Categories</h2>

            <p>Explore jobs by industries</p>

        </div>

        <div class="row">

            @foreach ($categories as $category)

            <div class="col-lg-3 col-md-4 col-6 mb-4">

                <a 
                    href="{{URL::to('search?category_id='.$category->id)}}"
                    class="category-card"
                >

                    <div class="category-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>

                    <h5>{{$category->category_name}}</h5>

                </a>

            </div>

            @endforeach

        </div>

    </div>

</section>

@endsection