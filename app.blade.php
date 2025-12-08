<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JIC Course Catalog - Jubail Industrial College</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="{{asset('custom.css')}}" rel="stylesheet">
    @stack('css')
</head>
<body>
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{asset('logo.png')}}" height="90" alt="JIC Logo">
            JIC <span>Catalog</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                       href="{{ route('home') }}">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('courses.index') || request()->routeIs('courses.show') ? 'active' : '' }}"
                       href="{{ route('courses.index') }}">
                        Courses
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#FeaturedMajors">Majors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#Departments">Departments</a>
                </li>

            </ul>
            <div class="d-flex ms-lg-3 mt-3 mt-lg-0">
                @auth


                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle d-flex align-items-center"
                                type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-2"></i>
                            <div class="text-start">
                                <div class="small fw-bold">   @if(Auth::user()->isAdmin()) Admin @else Student @endif
                                    : {{ Auth::user()->Username }}</div>

                            </div>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">

                            @if(Auth::user()->isStudent())
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('student.profile') ? 'active' : '' }}"
                                       href="{{route('student.profile')}}">
                                        <i class="bi bi-speedometer2 me-2"></i>My Profile
                                    </a>
                                </li>
                            @elseif(Auth::user()->isAdmin())
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('admin.*') ? 'active' : '' }}"
                                       href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-shield-check me-2"></i>Admin Panel
                                    </a>
                                </li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                       class="btn btn-outline-dark me-2 {{ request()->routeIs('login') ? 'active' : '' }}">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                       class="btn btn-primary {{ request()->routeIs('register') ? 'active' : '' }}">
                        Sign Up
                    </a>

                @endauth
            </div>
        </div>
    </div>
</nav>

@yield('content')

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <h5><i class="bi bi-journal-bookmark-fill me-2"></i> JIC Course Catalog</h5>
                <p class="mt-3">Helping Jubail Industrial College students make informed academic decisions through comprehensive course information and peer ratings. Excellence in education starts with informed planning.</p>
                <div class="social-icons mt-4">
                    <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" aria-label="Twitter"><i class="bi bi-twitter"></i></a>
                    <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <h5>Quick Links</h5>
                <div class="footer-links">
                    <a href="#">Home</a>
                    <a href="#">Courses</a>
                    <a href="#">Majors</a>
                    <a href="#">Departments</a>
                    <a href="#">About</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <h5>Contact Info</h5>
                <ul class="list-unstyled footer-contact">
                    <li><i class="bi bi-envelope me-2"></i> info@jic.edu.sa</li>
                    <li><i class="bi bi-telephone me-2"></i> +966 13 340 XXXX</li>
                    <li><i class="bi bi-geo-alt me-2"></i> Jubail Industrial College, SA</li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; <script>document.write(new Date().getFullYear())</script> Jubail Industrial College - Course Catalog System. All rights reserved.</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@stack('js')
</body>
</html>
