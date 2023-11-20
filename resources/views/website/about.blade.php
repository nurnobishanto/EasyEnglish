@extends('layouts.master')

@section('content')
    <!-- Start Page Banner Area -->
    <div class="page-banner-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">

                <div class="page-banner-content" data-aos="fade-right" data-aos-delay="50" data-aos-duration="500"
                    data-aos-once="true">
                    <h2>About Us</h2>

                    <ul>
                        <li>
                            <a href="#">Home</a>
                        </li>
                        <li>About Us</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <!-- End Page Banner Area -->
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


    <!-- Start Team Area -->
    <div class="team-area-without-color pt-100 pb-75">
        <div class="container">
            <div class="section-title">
                <span>{{ getSetting('team.title') }}</span>
                <h2>{{ getSetting('team.heading') }}</h2>
                <p>{{ getSetting('team.description') }}</p>
            </div>

            <div class="row justify-content-center">
                @if (getSetting('team.mname1'))
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-team-item">
                            <div class="team-image">
                                 @if (getSetting('team.ming1'))
                                 <img src="{{ Voyager::image(getSetting('team.ming1')) }}" alt="Member Image">
                                 @endif


                            </div>
                            <div class="team-content">
                                <h3>{{ getSetting('team.mname1') }}</h3>
                                <span>{{ getSetting('team.mtitle1') }}</span>
                            </div>
                        </div>
                    </div>
                @endif
                @if (getSetting('team.mname2'))
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-team-item">
                            <div class="team-image">
                                @if (getSetting('team.ming2'))
                                 <img src="{{ Voyager::image(getSetting('team.ming2')) }}" alt="Member Image">
                                @endif

                            </div>
                            <div class="team-content">
                                <h3>{{ getSetting('team.mname2') }}</h3>
                                <span>{{ getSetting('team.mtitle2') }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                @if (getSetting('team.mname3'))
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-team-item">
                            <div class="team-image">
                                @if (getSetting('team.ming3'))
                                 <img src="{{ Voyager::image(getSetting('team.ming3')) }}" alt="Member Image">
                                @endif

                            </div>
                            <div class="team-content">
                                <h3>{{ getSetting('team.mname3') }}</h3>
                                <span>{{ getSetting('team.mtitle3') }}</span>
                            </div>
                        </div>
                    </div>
                @endif


            </div>
        </div>

        <div class="team-shape-1" data-speed="0.08" data-revert="true">
            <img src="assets/images/team/shape-1.png" alt="Oleev">
        </div>
    </div>
    <!-- End Team Area -->
@endsection
