@extends('layouts.master')

@section('content')
    <!-- Start Main Hero Area -->
    <style>
        .marquee-container {
            display: inline-block;
            overflow: hidden;
        }

        .marquee-text {
            white-space: nowrap;
            line-height: 20px;
            font-size: 18px
        }
    </style>
    <div class="main-banner-wrap-area">
        <div class="container">
            @if(getSetting('update_headline'))
            <div class="mb-2">
                <h5 class="p-2 m-0 d-inline rounded bg-danger text-light" >Headline</h5>
                <div class="marquee-container">
                    <span class="marquee-text">
                        <marquee>{!! getSetting('update_headline') !!}</marquee>
                    </span>
                </div>
            </div>
            @endif
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 col-md-12">
                    <div class="main-banner-wrap-content" data-speed="0.05" data-revert="true">
                        @if(getSetting('site_tagline'))
                            <span data-aos="fade-right" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">{{getSetting('site_tagline')}}</span>
                        @endif
                        <h1 data-aos="fade-right" data-aos-delay="70" data-aos-duration="700" data-aos-once="true">{{ getSetting('home_page_title') }}</h1>
                        <p data-aos="fade-right" data-aos-delay="580" data-aos-duration="800" data-aos-once="true">{{ getSetting('home_page_description') }}</p>

                        <div class="banner-btn" data-aos="fade-right" data-aos-delay="90" data-aos-duration="900" data-aos-once="true">
                            <a href="{{ route('exam') }}" class="default-btn">Take Exam</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12" data-aos="fade-left" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">
                    <div class="main-banner-wrap-image" data-speed="0.05" data-revert="true">
                        <img src="{{asset('uploads/'.getSetting('home_page_background'))}}">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Hero Area -->

    <!-- Start Funfact Area -->
    <div class="fun-fact-area bg-three pt-100 pb-75" style="background-color: #004400">
        <div class="container">
            <div class="section-title">
                <span>Our Funfact</span>
                <h2>Our Resource History</h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-3 col-sm-6">
                    <div class="single-funfact-box">
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <h3>
                            <span class="odometer" data-count="{{\App\Models\User::count()}}">00</span>
                            <span class="small-text">+</span>
                        </h3>
                        <p>Happy Students</p>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="single-funfact-box">
                        <div class="icon">
                            <i class="ri-stack-line"></i>
                        </div>
                        <h3>
                            <span class="odometer" data-count="{{\App\Models\Subject::count()}}">00</span>
                            <span class="small-text">+</span>
                        </h3>
                        <p>Total Subject</p>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="single-funfact-box">
                        <div class="icon">
                            <i class="fa fa-newspaper"></i>
                        </div>
                        <h3>
                            <span class="odometer" data-count="{{\App\Models\ExamPaper::count()}}">00</span>
                            <span class="small-text">+</span>
                        </h3>
                        <p>Total Exam Paper</p>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="single-funfact-box">
                        <div class="icon">
                            <i class="fa fa-question-circle"></i>
                        </div>
                        <h3>
                            <span class="odometer" data-count="{{\App\Models\Question::count()}}">00</span>
                            <span class="small-text">+</span>
                        </h3>
                        <p>Total Questions</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Funfact Area -->

    <!-- Start Services Area -->
    <div class="services-area bg-F9F5F4 pt-100 pb-75">
        <div class="container">
            <div class="section-title">
                <span>Our Services</span>
                <h2>What We Offer</h2>
                <p>with our capabilities, we provide several options so that you can choose which one will be suitable for use in your company</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="single-services-box">
                        <div class="icon">
                            <i class="fab fa-skyatlas"></i>
                        </div>
                        <h3>
                            <a href="">HSC BATCH</a>
                        </h3>
                        <p>Lorem ipsum dolor sit amet consec tetur adip iscing elit non in pretium blandit loremm ipdum pronibh ultrna some.</p>
{{--                        <a href="" class="services-btn">Learn More</a>--}}
                        <div class="back-icon">
                            <i class="fab fa-skyatlas"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single-services-box">
                        <div class="icon">
                            <i class="fas fa-diagnoses"></i>
                        </div>
                        <h3>
                            <a href="">ONLINE EXAM</a>
                        </h3>
                        <p>Lorem ipsum dolor sit amet consec tetur adip iscing elit non in pretium blandit loremm ipdum pronibh ultrna some.</p>
{{--                        <a href="" class="services-btn">Learn More</a>--}}
                        <div class="back-icon">
                            <i class="fas fa-diagnoses"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single-services-box">
                        <div class="icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <h3>
                            <a href="">HSC Special Batch</a>
                        </h3>
                        <p>Lorem ipsum dolor sit amet consec tetur adip iscing elit non in pretium blandit loremm ipdum pronibh ultrna some.</p>
{{--                        <a href="" class="services-btn">Learn More</a>--}}
                        <div class="back-icon">
                            <i class="fas fa-award"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single-services-box">
                        <div class="icon">
                            <i class="fab fa-wpforms"></i>
                        </div>
                        <h3>
                            <a href="">Admission Batch</a>
                        </h3>
                        <p>Lorem ipsum dolor sit amet consec tetur adip iscing elit non in pretium blandit loremm ipdum pronibh ultrna some.</p>
{{--                        <a href="" class="services-btn">Learn More</a>--}}
                        <div class="back-icon">
                            <i class="fab fa-wpforms"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single-services-box">
                        <div class="icon">
                            <i class="ri-code-line"></i>
                        </div>
                        <h3>
                            <a href="">SSC Batch</a>
                        </h3>
                        <p>Lorem ipsum dolor sit amet consec tetur adip iscing elit non in pretium blandit loremm ipdum pronibh ultrna some.</p>
{{--                        <a href="" class="services-btn">Learn More</a>--}}
                        <div class="back-icon">
                            <i class="ri-code-line"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single-services-box">
                        <div class="icon">
                            <i class="fab fa-hive"></i>
                        </div>
                        <h3>
                            <a href="">Special English Batch</a>
                        </h3>
                        <p>Lorem ipsum dolor sit amet consec tetur adip iscing elit non in pretium blandit loremm ipdum pronibh ultrna some.</p>
{{--                        <a href="" class="services-btn">Learn More</a>--}}
                        <div class="back-icon">
                            <i class="fab fa-hive"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Services Area -->

    <!-- Start Why Choose Us Area -->
    <div class="why-choose-us-area-with-video ptb-100">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 col-md-12">
                    <div class="why-choose-us-video-view" data-speed="0.09" data-revert="true">
                        <a href="https://www.youtube.com/watch?v=Bi3-cftfb9s" class="video-btn popup-youtube">
                            <i class="flaticon-play-button"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="why-choose-us-content wrap-color" data-aos="fade-left" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">
                        <span>Why Choose Us</span>
                        <h3>We're your partners in learning</h3>
                        <div class="choose-us-inner-box">
                            <div class="icon">
                                <i class="flaticon-ad-campaign"></i>
                            </div>
                            <h4>Comprehensive Learning</h4>
                            <p>Our History resource goes beyond language mechanics, providing a holistic approach to English education</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Why Choose Us Area -->
@endsection
