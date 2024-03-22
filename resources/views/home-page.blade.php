<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>TechHatch</title>
    <link rel="icon" type="image/x-icon" href="{{asset('/favicon.ico')}}"/>
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/animate.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/fontawesome.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/toastify.min.css')}}" rel="stylesheet"/>
    <script src="{{asset('assets/js/toastify-js.js')}}"></script>
    <script src="{{asset('assets/js/axios.min.js')}}"></script>
    <script src="{{asset('assets/js/config.js')}}"></script>
</head>

<body class="@yield('background','bg-light')">

<div id="loader" class="LoadingOverlay d-none">
    <div class="Line-Progress">
        <div class="indeterminate"></div>
    </div>
</div>

<div>
    {{--Navigation--}}
    <nav class="navbar fixed-top shadow-sm navbar-expand-lg navbar-light  py-2">
        <div class="container">
            <a class="navbar-brand" href="{{url('/')}}">
{{--                <img class="img-fluid" src="{{asset('assets/images/capture3.png')}}" alt="" width="120px">--}}
                <span class="fw-bold">Note App</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#header01" aria-controls="header01" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon fw-bold">| | |</span>
            </button>
            <div class="collapse navbar-collapse" id="header01">
                <ul class="navbar-nav ms-auto mt-3 mt-lg-0 mb-3 mb-lg-0 me-4">
{{--                    <li class="nav-item me-4"><a class="nav-link" href="{{url('/')}}">Home</a></li>--}}

                </ul>
                @if (Route::has('login'))
                    <nav class="-mx-3 flex flex-1 justify-end">
                        @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Dashboard
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                >
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </div>
    </nav>

    {{--Hero--}}
    <section class="py-2 bg-gradient-faded-dark ">
        <div class="container ">
            <div class="row align-items-center justify-content-evenly vh-100 mt-6">
                <div class="col-12 col-md-10 col-lg-5 mb-5 mb-lg-0">
                    {{--                    <h2 class="fw-bold"></h2>--}}
                    <h2 class=" fw-bold mb-3 text-light">Note App</h2>
                    <p class="lead text-muted mb-4 text-light">our Note-taking application provides users with a
                        seamless platform to organize their thoughts, ideas, and reminders. With an intuitive interface
                        and robust functionality, users can effortlessly create, edit, and manage their notes to stay
                        organized and productive.</p>
                    <div class="d-flex flex-wrap">@auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="btn btn-lg btn-secondary rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Dashboard
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="btn btn-lg btn-primary rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="mx-3 btn btn-lg btn-danger rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                >
                                    Register
                                </a>
                            @endif
                        @endauth</div>
                </div>
                <div class="col-12 col-lg-6 offset-lg-1">
                    <img class="img-fluid rounded" src="{{asset('https://images.unsplash.com/photo-1517842645767-c639042777db?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')}}" alt="">
                </div>


            </div>
        </div>
    </section>

</div>

{{--<script src="{{asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>--}}
<script src="{{asset('assets/js/bootstrap.bundle.js')}}"></script>

</body>
</html>
