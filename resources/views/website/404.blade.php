@extends('layouts.master')
@section('content')
    <!-- Start Page Banner Area -->
    <div class="page-banner-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col">
                    <div class="page-banner-content" data-aos="fade-right" data-aos-delay="50" data-aos-duration="500"
                        data-aos-once="true">
                        <h2>404 Error</h2>

                        <ul>
                            <li>
                                <a href="{{route('website')}}">Home</a>
                            </li>
                            <li>404 Error</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Page Banner Area -->

    <!-- Start 404 Error Area -->
    <div class="error-area ptb-100">
        <div class="container">
            <div class="error-content">
                <img src="{{asset('website')}}/assets/images/error.png" alt="{{setting('site.title')}}">
                <h3>{{("Error 404 : Page Not Found")}}</h3>
                <p>{{("The page you are looking for might have been removed had its name changed or is temporarily unavailable.")}}</p>
                <a href="{{route('website')}}" class="default-btn">{{("Back to Homepage")}}</a>
            </div>
        </div>
    </div>
    <!-- End 404 Error Area -->
@endsection
