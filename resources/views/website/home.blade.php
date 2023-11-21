@extends('layouts.master')

@section('content')
    <!-- Start Main Hero Area -->
    <div class="main-hero-area" style="background-image: url('{{ asset('uploads/'.getSetting('home_page_background')) }}');">
        <div class="container">
            <div class="main-hero-content col-md-6" data-speed="0.05" data-revert="true"
                style="padding: 5%;background-color:#004400;border-radius:20px">
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
                        <a href="https://www.youtube.com/watch?v=ODfy2YIKS1M" class="video-btn popup-youtube">
                            <i class="flaticon-play-button"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="why-choose-us-content wrap-color" data-aos="fade-left" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">
                        <span>Why Choose Us</span>
                        <h3>Our Working Process To Help Your Boost Your Business</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit et fames maecenas amet est scelerisque lectus tortor sit lorem ipsum dolor sit amet consectetur adipiscing elit et fames maecenas amet.</p>

                        <div class="choose-us-inner-box">
                            <div class="icon">
                                <i class="flaticon-ad-campaign"></i>
                            </div>
                            <h4>Advertising & Branding</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipiscing elit velit sagittis eu viverra pellentesque condimentum.</p>
                        </div>

                        <div class="choose-us-inner-box">
                            <div class="icon">
                                <i class="flaticon-public-relations"></i>
                            </div>
                            <h4>Public Relation</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipiscing elit velit sagittis eu viverra pellentesque condimentum.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Why Choose Us Area -->
@endsection
