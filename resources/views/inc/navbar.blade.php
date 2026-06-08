<nav class="navbar navbar-expand-lg modern-navbar fixed-top">

    <div class="container">

        <a href="{{URL('/')}}" class="navbar-brand modern-logo">
            <i class="fas fa-briefcase"></i>
            JobLister
        </a>

        <button 
            class="navbar-toggler border-0 shadow-none"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
        >
            <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mx-auto">

                <li class="nav-item">
                    <a href="{{URL('/')}}" class="nav-link">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('job.index')}}" class="nav-link">
                        Jobs
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        Companies
                    </a>
                </li>

            <li class="nav-item dropdown">

    <a 
        href="#"
        class="nav-link dropdown-toggle"
        id="aiDropdown"
        role="button"
        data-toggle="dropdown"
    >
        AI Tools
    </a>

    <div class="dropdown-menu modern-dropdown">

        <a 
            class="dropdown-item"
            href="{{ route('account.cvBuilder') }}"
        >
            <i class="fas fa-file-alt"></i>
            AI CV Builder
        </a>

        <a 
            class="dropdown-item"
            href="{{ route('account.resumeAnalyzer') }}"
        >
            <i class="fas fa-robot"></i>
            Resume Analyzer
        </a>

    </div>

</li>

            </ul>

            <ul class="navbar-nav align-items-center">

                @auth

                <li class="nav-item dropdown">

                    <a 
                        class="nav-link dropdown-toggle user-dropdown"
                        href="#"
                        id="userDropdown"
                        role="button"
                        data-toggle="dropdown"
                    >

                        <span class="user-name">
                            {{auth()->user()->name}}
                        </span>

                        <img 
                            class="user-avatar"
                            src="{{asset('images/user-profile.png')}}"
                        >

                    </a>

                    <div class="dropdown-menu dropdown-menu-right modern-dropdown">

                        @role('admin')
                        <a class="dropdown-item" href="{{route('account.dashboard')}}">
                            <i class="fas fa-chart-line"></i>
                            Dashboard
                        </a>
                        @endrole

                        @role('author')
                        <a class="dropdown-item" href="{{route('account.authorSection')}}">
                            <i class="fas fa-briefcase"></i>
                            Employer Panel
                        </a>
                        @endrole

                        <a class="dropdown-item" href="{{route('account.index')}}">
                            <i class="fas fa-user"></i>
                            My Profile
                        </a>

                        <a class="dropdown-item" href="{{route('account.changePassword')}}">
                            <i class="fas fa-lock"></i>
                            Change Password
                        </a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item text-danger" href="{{route('account.logout')}}">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </a>

                    </div>

                </li>

                @endauth


                @guest

                <li class="nav-item">

                    <a href="/login" class="modern-login-btn">
                        Sign In
                    </a>

                </li>

                @endguest

            </ul>

        </div>

    </div>

</nav>