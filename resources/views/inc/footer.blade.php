<footer class="modern-footer">

    <div class="container">

        <div class="row gy-5">

            <div class="col-lg-4">

                <div class="footer-brand">

                    <h2>
                        <i class="fas fa-briefcase"></i>
                        JobLister
                    </h2>

                    <p>
                        AI powered recruitment platform helping talents
                        discover the best opportunities faster.
                    </p>

                    <div class="footer-socials">

                        <a href="#">
                            <i class="fab fa-facebook-f"></i>
                        </a>

                        <a href="#">
                            <i class="fab fa-twitter"></i>
                        </a>

                        <a href="#">
                            <i class="fab fa-linkedin-in"></i>
                        </a>

                        <a href="#">
                            <i class="fab fa-instagram"></i>
                        </a>

                    </div>

                </div>

            </div>


            <div class="col-lg-2 col-md-4">

                <div class="footer-links">

                    <h5>For Candidates</h5>

                    <a href="{{route('register')}}">Create Account</a>

                    <a href="{{route('login')}}">Login</a>

                    <a href="{{route('job.index')}}">Browse Jobs</a>

                    <a href="#">AI Resume Builder</a>

                </div>

            </div>


            <div class="col-lg-2 col-md-4">

                <div class="footer-links">

                    <h5>For Employers</h5>

                    <a href="{{route('register')}}">Register</a>

                    <a href="{{route('post.create')}}">Post Jobs</a>

                    <a href="#">Find Talents</a>

                    <a href="#">Dashboard</a>

                </div>

            </div>


            <div class="col-lg-2 col-md-4">

                <div class="footer-links">

                    <h5>Company</h5>

                    <a href="#">About</a>

                    <a href="#">Contact</a>

                    <a href="#">Privacy Policy</a>

                    <a href="#">Terms</a>

                </div>

            </div>


            <div class="col-lg-2">

                <div class="footer-contact">

                    <h5>Contact</h5>

                    <p>
                        <i class="fas fa-map-marker-alt"></i>
                        Casablanca, Morocco
                    </p>

                    <p>
                        <i class="fas fa-phone"></i>
                        +212 600000000
                    </p>

                    <p>
                        <i class="fas fa-envelope"></i>
                        support@joblister.com
                    </p>

                </div>

            </div>

        </div>

        <div class="footer-bottom">

            <p>
                © 2026 JobLister. All rights reserved.
            </p>

        </div>

    </div>

</footer>


@push('css')

<style>

.modern-footer{
    background:#0f172a;
    padding:80px 0 30px;
    color:#cbd5e1;
    margin-top:100px;
}

.footer-brand h2{
    color:white;
    font-weight:800;
    margin-bottom:20px;
}

.footer-brand h2 i{
    color:#3b82f6;
    margin-right:10px;
}

.footer-brand p{
    line-height:1.8;
    color:#94a3b8;
    margin-bottom:25px;
}

.footer-socials{
    display:flex;
    gap:15px;
}

.footer-socials a{
    width:42px;
    height:42px;
    background:rgba(255,255,255,.08);
    border-radius:12px;
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    transition:.3s;
}

.footer-socials a:hover{
    background:#2563eb;
    transform:translateY(-5px);
}

.footer-links h5,
.footer-contact h5{
    color:white;
    margin-bottom:25px;
    font-weight:700;
}

.footer-links a{
    display:block;
    color:#94a3b8;
    margin-bottom:14px;
    transition:.3s;
}

.footer-links a:hover{
    color:white;
    padding-left:5px;
}

.footer-contact p{
    margin-bottom:15px;
    color:#94a3b8;
}

.footer-contact i{
    color:#3b82f6;
    margin-right:10px;
}

.footer-bottom{
    border-top:1px solid rgba(255,255,255,.08);
    margin-top:60px;
    padding-top:25px;
    text-align:center;
}

.footer-bottom p{
    color:#64748b;
    margin:0;
}

</style>

@endpush