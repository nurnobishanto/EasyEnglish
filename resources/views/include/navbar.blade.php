<div class="top-bar" style="background-color: #004400">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-6">
                <div class="single-footer-widget text-sm-start text-center mb-2">
                    <ul class="widget-social mt-2">
                        <li><a href="tel:{{getSetting('site_phone')}}"><i class="fa fa-phone-alt"> </i> {{getSetting('site_phone')}}</a></li>
                        <li><a href="mailto:{{getSetting('site_email')}}"><i class="fa fa-envelope"> </i> {{getSetting('site_email')}}</a></li>
                    </ul>


                </div>

            </div>
            <div class="col-md-4 col-sm-6">
                <div class="single-footer-widget text-sm-end text-center  mb-2">
                    <ul class="widget-social mt-2">
                        @if (getSetting('site_facebook'))
                            <li>
                                <a href="{{ getSetting('site_facebook') }}" target="_blank">
                                    <i class="ri-facebook-fill"></i>
                                </a>
                            </li>
                        @endif
                        @if (getSetting('site_twitter'))
                            <li>
                                <a href="{{ getSetting('site_twitter') }}" target="_blank">
                                    <i class="ri-twitter-fill"></i>
                                </a>
                            </li>
                        @endif
                        @if (getSetting('site_instagram'))
                            <li>
                                <a href="{{ getSetting('site_instagram') }}" target="_blank">
                                    <i class="ri-instagram-line"></i>
                                </a>
                            </li>
                        @endif
                        @if (getSetting('site_linkedin'))
                            <li>
                                <a href="{{ getSetting('site_linkedin') }}" target="_blank">
                                    <i class="ri-linkedin-line"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container ">

        <a class="navbar-brand" href="{{ url('/') }}">
            @if (getSetting('site_logo'))
                <img style="max-height: 80px;max-width: 130px" src="{{ asset('uploads/'.getSetting('site_logo')) }}" alt="{{ getSetting('site_title') }}">
            @else
                {{ getSetting('site_title') }}
            @endif
        </a>

        <div class="text-end  d-flex">
            <div class="mx-2 d-md-none d-sm-block">
                @guest
                    <a class="nav-link btn btn-success text-light" href="{{ route('login') }}"><i class="fa fa-sign-in-alt"></i></a>
                @else
                    <a class="nav-link btn btn-danger text-light" href="{{ route('profile') }}"><i class="fa fa-user"></i></a>
                @endguest
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->

            {{ menu('header', 'menu.headermenu') }}


            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                @guest
                        <li class="nav-item m-1">
                            <a class="nav-link btn btn-success text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>

                        <li class="nav-item m-1">
                            <a class="nav-link btn btn-danger text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                @else
                    <li class="nav-item m-1">
                        <a class="nav-link btn btn-danger text-light" href="{{ route('profile') }}"><i class="fa fa-user"> </i> {{ __('Profile') }}</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
