@extends('layouts.master')

@section('content')
    <!-- Start Page Banner Area -->
    <div class="page-banner-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">

                <div class="page-banner-content" data-aos="fade-right" data-aos-delay="50" data-aos-duration="500"
                    data-aos-once="true">
                    <h2>Ranking</h2>

                    <ul>
                        <li>
                            <a href="{{ route('website') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('exam') }}">Exam</a>
                        </li>
                        <li>Ranking</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <!-- End Page Banner Area -->
    <div class="blog-area ptb-100">
        <div class="container">
            <div class="row justify-content-center">
                <?php
                
                $count = 1;
                
                ?>
                <h3>Exam Name: {{ $paper->name }}</h3>
                <p>Full Mark :
                    {{ $paper->questions->count() * $paper->pmark }} <br>
                    Total Questions : {{ $paper->questions->count() }}
                </p>

                <table id="table" class="table table-striped table-bordered table-sm mt-5" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <td>SL</td>
                            <td>Name</td>
                            <td>Correct</td>
                            <td>Not ans</td>
                            <td>Wrong </td>
                            <td>Attempt</td>
                            <td>Mark</td>
                            <td>Duration</td>
                            <td>Submitted</td>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($result as $r)
                        @if($r->user)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ $r->user->name }}</td>
                                <td>{{ $r->ca }}</td>
                                <td>{{ $r->na }}</td>
                                <td>{{ $r->wa }}</td>
                                <td>{{ $r->ca + $r->wa }}</td>
                                <td>{{ $r->total_mark }}</td>
                                <td>{{ floor($r->duration / 60) }} Min
                                    {{ $r->duration % 60 }} Sec</td>
                                <td>{{ date_format($r->created_at,"d M, Y H:i a") }}</td>
                            </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
                <a class="btn btn-warning" href="{{route('rankpdf', ['id' => $id ])}}">PDF Download</a>

                <span class="font-weight-300 text-success" style="font-size: 12px;"><i> (
                        {{ $paper->pmark }}
                        Mark for Per Correct Answer )</i></span>
                <span class="font-weight-300 text-danger" style="font-size: 12px;"><i> (
                        {{ $paper->nmark }}
                        Mark for Per Negative Answer )</i></span>
            </div>
        </div>
    </div>
@endsection
