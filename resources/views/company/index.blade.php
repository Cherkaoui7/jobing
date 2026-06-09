@extends('layouts.post')

@section('content')
<section class="companies-section" style="padding-top: 100px; padding-bottom: 50px;">
    <div class="container">
        <div class="section-title d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2>🏢 Browse Companies</h2>
                <p>Discover top employers offering great opportunities</p>
            </div>
        </div>

        <div class="row g-4">
            @foreach ($companies as $company)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm border-0 h-100 modern-job-card" style="transition: transform 0.2s, box-shadow 0.2s; border-radius: 15px; overflow: hidden;">
                    <img src="{{ asset($company->cover_img === 'nocover' ? 'images/companies/nocover.jpg' : $company->cover_img) }}" 
                         class="card-img-top" 
                         style="height: 140px; object-fit: cover;" 
                         alt="{{ $company->title }}">
                    
                    <div class="card-body position-relative text-center pt-5">
                        <div class="position-absolute" style="top: -40px; left: 50%; transform: translateX(-50%);">
                            <img src="{{ asset($company->logo) }}" 
                                 class="rounded-circle bg-white p-1 shadow-sm" 
                                 style="width: 80px; height: 80px; object-fit: cover;" 
                                 alt="{{ $company->title }}">
                        </div>

                        <h4 class="card-title font-weight-bold mb-1">{{ $company->title }}</h4>
                        <p class="text-muted small mb-3">
                            <i class="fas fa-layer-group"></i> 
                            {{ $company->getCategory->category_name ?? 'General' }}
                        </p>

                        <p class="card-text text-muted" style="font-size: 0.9rem; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ $company->description }}
                        </p>

                    </div>
                    
                    <div class="card-footer bg-white border-0 text-center pb-4">
                        <a href="{{ route('account.employer', ['employer' => $company->id]) }}" class="btn btn-outline-primary rounded-pill px-4" style="border-width: 2px;">
                            View Profile
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-5 custom-pagination">
            {{ $companies->links() }}
        </div>

    </div>
</section>

<style>
.modern-job-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}
.custom-pagination nav {
    display: flex;
    justify-content: center;
}
</style>
@endsection
