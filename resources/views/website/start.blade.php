@extends('layouts.master')

@section('content')
    <!-- Start Page Banner Area -->
    <div class="page-banner-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">

                <div class="page-banner-content" data-aos="fade-right" data-aos-delay="50" data-aos-duration="500"
                    data-aos-once="true">
                    <h2>{{ $paper->name }}</h2>

                    <ul>
                        <li>
                            <a href="{{ route('website') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('exam') }}">Exam</a>
                        </li>
                        <li>{{ $paper->name }}</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <!-- End Page Banner Area -->
    <div class="blog-area ptb-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 card p-5">
                    <?php

                    $total = $paper->questions->count();


                    ?>
                    <h2 class="text-center">{{ $paper->name }}</h2>
                    <p>{!! $paper->description !!}</p>
                    <p> <strong>Duration : {{ $paper->duration }} Minutes</strong><br>
                    <span class="text-primary">Total Questions : {{ $total }} </span><br>
                    <span class="text-success">Postive Mark : {{ $paper->pmark }}</span><br>
                    <span class="text-danger">Negative Mark : {{ $paper->nmark }}</span><br>
                    <span class="text-success "><strong> Total Mark : {{ $total }} X {{ $paper->pmark }} =
                            {{ $total * $paper->pmark }} </strong></span></p>
                    @if(session("exam_paper_password_{$paper->id}"))
                    <strong class="text-danger">{{session("exam_paper_password_{$paper->id}")}}</strong><br>
                    @endif
                    @if (date('Y-m-d H:i:s') >= $paper->startdate . ' ' . $paper->starttime)

                    @if (strlen($paper->password)>0)
                     <form action="{{route('test_pass')}}" method="POST">
                        @csrf
                         <div class="row">
                             <div class="col-sm-8 col-12">
                                 <div class="form-group">
                                     <input required class="form-control" type="password" placeholder="Password" name="pass">
                                     <input  type="text" hidden name="id" value="{{$paper->id}}">
                                 </div>
                             </div>
                             <div class="col-sm-4 col-12 mt-sm-0 mt-2">
                                 <div class="form-group">
                                     <input type="submit" value="Start" class="form-control btn btn-danger">
                                 </div>
                             </div>
                         </div>


                    </form>
                    @else
                       <a class="btn btn-danger m-2 p-2" href="{{ Route('test', ['id' => $paper->id]) }}"><i
                                class="ri-play-circle-fill"></i> Start</a><br>
                    @endif


                    @else
                    <h6 class="text-danger">The test has not started yet. <br> This test will start at <?php
                        $date=date_create($paper->startdate . ' ' . $paper->starttime);
                        echo date_format($date,"l, d M Y h:i a");
                        ?></h6>

                    @endif

                    <?php
                    // Program to display URL of current page.
                    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
                        $link = "https";
                    else $link = "http";

                    // Here append the common URL characters.
                    $link .= "://";

                    // Append the host(domain name, ip) to the URL.
                    $link .= $_SERVER['HTTP_HOST'];

                    // Append the requested resource location to the URL
                    $link .= $_SERVER['REQUEST_URI'];

                    // Print the link
                    echo $link;
                    ?>

                </div>

            </div>
        </div>
    </div>
@endsection
