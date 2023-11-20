@extends('layouts.master')

@section('content')
    <!-- Start Page Banner Area -->
    <div class="page-banner-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">

                <div class="page-banner-content" data-aos="fade-right" data-aos-delay="50" data-aos-duration="500"
                    data-aos-once="true">
                    <h2>{{ $sub->name }}</h2>

                    <ul>
                        <li>
                            <a href="{{ route('website') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('exam') }}">Exam</a>
                        </li>
                        <li>{{ $sub->name }}</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <!-- End Page Banner Area -->

    <!-- Start Blog Area -->
    <div class="blog-area ptb-100">
        <div class="container">
            <div class="row justify-content-center">
                @foreach ($ecats as $sub)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog-card">


                                @if ($sub->image)
                                <div class="blog-image">
                                    <a href="{{ route('exam_category', ['slug' => $sub->slug]) }}"><img
                                            src="{{ asset('uploads/'.$sub->image) }}" alt="{{ $sub->name }}"></a>
                                    <div class="blog-content with-padding">
                                        <b>{{ $sub->name }}</b>
                                    </div>
                                   </div>
                                @else
                                    <a class="d-block" href="{{ route('exam_category', ['slug' => $sub->slug]) }}">
                                        <h2 class="text-light text-center align-middle pt-5 pb-5 p-2"
                                            style="background-color: #342986;">
                                            {{ $sub->name }}
                                        </h2>
                                    </a>
                                @endif

                        </div>
                    </div>
                @endforeach


            </div>

            {{-- {{ $ecats->links('vendor.pagination.custom') }} --}}
        </div>
    </div>
    <!-- End Blog Area -->
@endsection
