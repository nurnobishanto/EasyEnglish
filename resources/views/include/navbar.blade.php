<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">

        <a class="navbar-brand" href="{{ url('/') }}">
            @if (getSetting('site_logo'))
                <img width="120" src="{{ asset('uploads/'.getSetting('site_logo')) }}" alt="{{ getSetting('site_title') }}">
            @else
                {{ getSetting('site_title') }}
            @endif
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

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
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                {{ __('Profile') }}
                            </a>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
