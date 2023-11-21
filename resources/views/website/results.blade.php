@extends('layouts.master')

@section('content')

    <div class="blog-area ptb-100">
        <div class="container">
            <a class="btn btn-info" href="{{route('rank', ['id' => $id ])}}">See Rank for this Exam</a>
            <a class="btn btn-warning" href="{{route('question', ['id' => $id ])}}">Download Anwaresheet</a>


            <div class="row justify-content-center">
                @foreach ($result as $r)
                @if($r->user)
                    <div class="col-md-6">

                        <div class="card m-1">
                            <div class="card-body">
                                <h3>Name : {{ $r->user->name }}</h3>
                                <p>Exam Name: {{ $r->exam_paper->name }}</p>
                                <div class="m-2 text-center">
                                    <span class="bg-info p-1">Full Mark :
                                        {{ $r->exam_paper->questions->count() * $r->exam_paper->pmark }}
                                    </span>

                                    <span class="bg-success text-light p-1"><strong> Mark : {{ $r->total_mark }} /
                                            {{ $r->exam_paper->questions->count() * $r->exam_paper->pmark }}
                                        </strong></span>
                                </div>


                                <div class="m-2 text-center">
                                    <span style="padding: 5px;" class="bg-success text-light">Correct :
                                        {{ $r->ca }}</span><span style="padding: 5px;"
                                        class="bg-dark  text-light">Attempt :
                                        {{ $r->ca + $r->wa }}</span>
                                </div>
                                <div class="m-2 text-center">
                                    <span style="padding: 5px;" class="bg-warning">Avoid : {{ $r->na }} </span>
                                    <span style="padding: 5px;" class="bg-danger text-light">Wrong :
                                        {{ $r->wa }}</span>
                                </div>


                                <div style="font-size: 14px;">Submitted : {{ $r->created_at }}</div>
                                <div style="font-size: 14px;">Duration : {{ floor($r->duration / 60) }} Minutes
                                    {{ $r->duration % 60 }} Seconds</div>


                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width:{{ ($r->ca * 100) / $r->exam_paper->questions->count() }}%">
                                        Correct ({{ ($r->ca * 100) / $r->exam_paper->questions->count() }}%)
                                    </div>
                                    <div class="progress-bar bg-warning" role="progressbar"
                                        style="width:{{ ($r->na * 100) / $r->exam_paper->questions->count() }}%">
                                        Avoid ({{ ($r->na * 100) / $r->exam_paper->questions->count() }}%)
                                    </div>
                                    <div class="progress-bar bg-danger " role="progressbar"
                                        style="width:{{ ($r->wa * 100) / $r->exam_paper->questions->count() }}%">
                                        Wrong ({{ ($r->wa * 100) / $r->exam_paper->questions->count() }}%)
                                    </div>
                                </div>
                                <span class="font-weight-300 text-success" style="font-size: 14px;"><i> (
                                        {{ $r->exam_paper->pmark }}
                                        Mark for Per Correct Answer )</i></span>
                                <span class="font-weight-300 text-danger" style="font-size: 14px;"><i> (
                                        {{ $r->exam_paper->nmark }}
                                        Mark for Per Negative Answer )</i></span>
                                        <a class="btn btn-info m-1" href="{{route('resultCardPdf', ['id' => $r->id ])}}" target="_blank" rel="noopener noreferrer"><i class="ri-download-2-line"></i> Download Result Card</a>
                            </div>
                        </div>


                    </div>
                @endif
                @endforeach




            </div>
        </div>
    </div>
@endsection
