@extends('layouts.master')

@section('content')
    <!-- Start Main Hero Area -->
    <div class="main-hero-area" style="background-image: url('{{ asset('uploads/'.getSetting('home_page_background')) }}');">
        <div class="container">
            <div class="main-hero-content col-md-6" data-speed="0.05" data-revert="true"
                style="padding: 5%;background-color:#312784;border-radius:20px">
                @if(getSetting('site_tagline'))
                 <span data-aos="fade-right" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">{{getSetting('site_tagline')}}</span>
                @endif
                <h1 class="text-light font-weight-bold" data-aos="fade-right" data-aos-delay="70" data-aos-duration="700"
                    data-aos-once="true">
                    {{ getSetting('home_page_title') }}
                </h1>
                <h2 data-aos="fade-right" data-aos-delay="80" data-aos-duration="800" data-aos-once="true">
                    {{ getSetting('home_page_description') }}
                </h2>

                <ul class="hero-btn" data-aos="fade-right" data-aos-delay="90" data-aos-duration="900" data-aos-once="true">
                    <li><a href="{{ Route('exam') }}" class="btn btn-light">START LEARING</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Main Hero Area -->
    <!-- Start About US Area -->
    <div class="expertise-area-with-white-color ptb-100">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 col-md-12">
                    <div class="expertise-image-wrap" data-aos="fade-left" data-aos-delay="50" data-aos-duration="500"
                        data-aos-once="true">
                        <img src="{{ asset('uploads/'.getSetting('about_page_image')) }}" alt="image">
                    </div>
                    <div class="expertise-content black-color" data-aos="fade-right" data-aos-delay="50"
                        data-aos-duration="500" data-aos-once="true">

                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-sm-6">
                                <div class="expertise-inner-box">
                                    <div class="icon">
                                        <i class="ri-thumb-up-fill"></i>
                                    </div>
                                    <h2> {!! getSetting('about_page_experience') !!}</h2>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="expertise-inner-box">
                                    <div class="icon">
                                        <i class="fa fa-users"></i>
                                    </div>
                                    <h2>{!! getSetting('about_page_students') !!}</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="expertise-content black-color" data-aos="fade-right" data-aos-delay="50"
                        data-aos-duration="500" data-aos-once="true">
                        <span>{{ getSetting('about_page_title') }}</span>
                        <h3>{{ getSetting('about_page_heading') }}</h3>
                        <p>{{ getSetting('about_page_description') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End About Us Area -->


    <div class="testimonials-area ptb-100">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-4 text-center">
                    <div class="team-box-content black-color" data-aos="fade-right" data-aos-delay="50"
                        data-aos-duration="500" data-aos-once="true">
                        <span>{{ getSetting('home-page.servicetitle') }}</span>
                        <h2>{{ getSetting('home-page.serviceheading') }}</h2>
                        <p style="font-weight:bold;">{{ getSetting('home-page.servicedescription') }}</p>
                        <div class="team-btn">
                            <a href="{{ route('exam') }}" class="default-btn">View More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">

                    <div class="single-services-card">

                        <div class="icon color-two">
                            <i class="ri-hand-coin-fill"></i>
                        </div>
                        <h3>
                            <a href="{{ route('exam') }}">
                                @if (getSetting('home-page.hsc'))
                                    {{ getSetting('home-page.hsc') }}
                                @else
                                    HSC BATCH
                                @endif

                            </a>
                        </h3>
                        <p>{{ getSetting('home-page.hscdetails') }}</p>


                    </div>

                    <div class="single-services-card">
                        <div class="icon">
                            <i class="ri-shield-user-fill"></i>
                        </div>
                        <h3>
                            <a href="{{ route('exam') }}">
                                @if (getSetting('home-page.accountingbatch'))
                                    {{ getSetting('home-page.accountingbatch') }}
                                @else
                                    ACCOUNTING BATCH
                                @endif
                            </a>
                        </h3>
                        <p>{{ getSetting('home-page.accountingbatchdetails') }}</p>

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="single-services-card">
                        <div class="icon">
                            <i class="ri-file-list-3-fill"></i>
                        </div>
                        <h3>
                            <a href="{{ route('exam') }}">
                                @if (getSetting('home-page.onlineexam'))
                                    {{ getSetting('home-page.onlineexam') }}
                                @else
                                    ONLINE EXAM
                                @endif

                            </a>
                        </h3>
                        <p>{{ getSetting('home-page.onlineexamdetails') }}</p>

                    </div>
                    <div class="single-services-card">
                        <div class="icon color-two">
                            <i class="ri-line-chart-fill"></i>
                        </div>
                        <h3>
                            <a href="{{ route('exam') }}">
                                @if (getSetting('home-page.course'))
                                    {{ getSetting('home-page.course') }}
                                @else
                                    Cources
                                @endif
                            </a>
                        </h3>
                        <p>{{ getSetting('home-page.coursedetails') }}.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Why Choose Us Area -->
    <div class="why-choose-us-area ptb-100">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 col-md-12">
                    <div class="why-choose-us-content" data-aos="fade-right" data-aos-delay="50" data-aos-duration="500"
                        data-aos-once="true">
                        <span>{{ getSetting('home-page.featuretitle') }}</span>
                        <h3>{{ getSetting('home-page.featureheading') }}</h3>
                        <p>{{ getSetting('home-page.featuredetails') }}</p>

                        @if (getSetting('home-page.feature1'))
                            <div class="choose-us-inner-box">
                                <div class="icon">
                                    <i class="ri-check-fill"></i>
                                </div>
                                <h4> {{ getSetting('home-page.feature1') }}</h4>
                            </div>
                        @endif
                        @if (getSetting('home-page.feature2'))
                            <div class="choose-us-inner-box">
                                <div class="icon">
                                    <i class="ri-check-fill"></i>
                                </div>
                                <h4> {{ getSetting('home-page.feature2') }}</h4>
                            </div>
                        @endif
                        @if (getSetting('home-page.feature3'))
                            <div class="choose-us-inner-box">
                                <div class="icon">
                                    <i class="ri-check-fill"></i>
                                </div>
                                <h4> {{ getSetting('home-page.feature3') }}</h4>
                            </div>
                        @endif
                        @if (getSetting('home-page.feature4'))
                            <div class="choose-us-inner-box">
                                <div class="icon">
                                    <i class="ri-check-fill"></i>
                                </div>
                                <h4> {{ getSetting('home-page.feature4') }}</h4>
                            </div>
                        @endif

                        <div class="team-btn">
                            <a href="{{ route('exam') }}" class="default-btn">View More</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="why-choose-us-image" data-aos="fade-left" data-aos-delay="50" data-aos-duration="500"
                        data-aos-once="true">
                        <img src="{{ asset(getSetting('home-page.featureimage')) }}" alt="Featire Image">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Why Choose Us Area -->
@endsection
