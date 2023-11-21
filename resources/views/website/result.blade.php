@extends('layouts.master')

@section('content')


    <div class="blog-area ptb-100">
        <div class="container">
            <a class="btn btn-info" href="{{route('rank', ['id' => $data->exam_paper->id ])}}">See Rank for this Exam</a>
            <a class="btn btn-warning" href="{{route('question', ['id' => $data->exam_paper->id ])}}">Download Anwaresheet</a>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1 class="text-center">{{ $data->exam_paper->name }}</h1>
                    <p>{!! $data->exam_paper->description !!}</p>
                </div>
                <div class="col-md-4">

                        <div class="col-md-12">

                            <div class="card m-1">
                                <div class="card-body">
                                    <strong>Name : {{ $data->user->name }}</strong>
                                    <div class="m-2 text-center">
                                        <span class="bg-info p-1">Full Mark :
                                            {{ $data->exam_paper->questions->count() * $data->exam_paper->pmark }}
                                        </span>

                                        <span class="bg-success text-light p-1"><strong> Mark : {{ $data->total_mark }} /
                                                {{ $data->exam_paper->questions->count() * $data->exam_paper->pmark }}
                                            </strong></span>
                                    </div>


                                    <div class="m-2 text-center">
                                        <span style="padding: 5px;" class="bg-success text-light">Correct :
                                            {{ $data->ca }}</span><span style="padding: 5px;"
                                            class="bg-dark  text-light">Attempt :
                                            {{ $data->ca + $data->wa }}</span>
                                    </div>
                                    <div class="m-2 text-center">
                                        <span style="padding: 5px;" class="bg-warning">Avoid : {{ $data->na }}
                                        </span>
                                        <span style="padding: 5px;" class="bg-danger text-light">Wrong :
                                            {{ $data->wa }}</span>
                                    </div>


                                    <div style="font-size: 14px;">Submitted : {{ $data->created_at }}</div>
                                    <div style="font-size: 14px;">Duration : {{ floor($data->duration / 60) }} Minutes
                                        {{ $data->duration % 60 }} Seconds</div>


                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar"
                                            style="width:{{ ($data->ca * 100) / $data->exam_paper->questions->count() }}%">
                                            Correct ({{ ($data->ca * 100) / $data->exam_paper->questions->count() }}%)
                                        </div>
                                        <div class="progress-bar bg-warning" role="progressbar"
                                            style="width:{{ ($data->na * 100) / $data->exam_paper->questions->count() }}%">
                                            Avoid ({{ ($data->na * 100) / $data->exam_paper->questions->count() }}%)
                                        </div>
                                        <div class="progress-bar bg-danger " role="progressbar"
                                            style="width:{{ ($data->wa * 100) / $data->exam_paper->questions->count() }}%">
                                            Wrong ({{ ($data->wa * 100) / $data->exam_paper->questions->count() }}%)
                                        </div>
                                    </div>

{{--                                    <a class="btn btn-info m-1" href="{{ route('resultCardPdf', ['id' => $data->id]) }}"--}}
{{--                                        target="_blank" rel="noopener noreferrer"><i class="ri-download-2-line"></i>--}}
{{--                                        Download Result Card</a>--}}
                                </div>
                            </div>


                        </div>


                </div>
                <div class="col-md-8">

                    <?php
                    $count = 1;
                    $total = $data->exam_paper->questions->count();
                    $timeMin = $data->exam_paper->duration;
                    $timeSec = $timeMin * 60;

                    ?>
                    <input type="number" name="total" value="{{ $data->exam_paper->questions->count() }}" hidden>
                    <span class="text-dark">Time : {{ $timeMin }} Minutes.</span><br>
                    <span class="text-primary">Total Questions : {{ $total }} </span><br>
                    <span class="text-success">Postive Mark For Every Question : {{ $data->exam_paper->pmark }}</span><br>
                    <span class="text-danger">Negative Mark For Every Question : {{ $data->exam_paper->nmark }}</span><br>
                    <span class="text-success "><strong> Total Mark : {{ $total }} X {{ $data->exam_paper->pmark }} =
                            {{ $total * $data->exam_paper->pmark }} </strong></span><br>
                    <?php $g = [];?>
                    @foreach($data->exam_paper->questions as $q)
                            <?php
                            if (!in_array($q->subject_id, $g)) {
                                array_push($g, $q->subject_id);
                            }

                            ?>
                    @endforeach
                    @foreach($g as $k)
                        <div class="border mt-2 mb-2 p-2">
                            <h4>{{\App\Models\Question::getSubName($k)}}</h4>
                        </div>
                        @foreach ($data->exam_paper->questions->where('subject_id',$k) as $question)
                                @php

                                $cans = $question->ca;
                                $activity = \App\Models\ResultActivity::where('result_id',$data->id)->where('question_id',$question->id)->first();
                                $sans = $activity->attempt;
                                $rowClass = $cans === $sans ? 'border-5 border border-success' : ($sans === 'none' ? ' border-5 border border-warning ' : 'border-5 border border-danger');
                                @endphp
                                <div class="row border m-1 {{ $rowClass }}">
                                    <div>
                                        @if ($question->image)
                                            <div>
                                                <img style="max-height:250px;" src="{{ asset('uploads/'.$question->image) }}"
                                                     alt="{{ $question->name }}">
                                            </div>
                                        @endif
                                        <div>{!! $question->description !!}</div>
                                        <strong>{{$count}}) {{ $question->name }} </strong>
                                    </div>
                                <div class="col-md-6">
                                    <div class="@if($question->$cans == $question->op1) border border-2 border-success @endif @if(($question->$sans == $question->op1) && ($question->$cans == $question->op1) ) bg-success text-light @elseif(($question->$sans == $question->op1) && ($question->$cans != $question->op1)) bg-danger text-light @else bg-light text-dark @endif  rounded p-2 ">
                                        <strong>i) {{ $question->op1 }} </strong>
                                    </div>
                                    <div class="@if($question->$cans == $question->op2) border border-2 border-success @endif  mt-2 @if(($question->$sans == $question->op2) && ($question->$cans == $question->op2)) bg-success text-light @elseif(($question->$sans == $question->op2) && ($question->$cans != $question->op2)) bg-danger text-light @else bg-light text-dark  @endif  rounded p-2 ">
                                        <strong>i) {{ $question->op2 }} </strong>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="@if($question->$cans == $question->op3) border border-2 border-success @endif @if(($question->$sans == $question->op3) && ($question->$cans == $question->op3)) bg-success text-light @elseif(($question->$sans == $question->op3) && ($question->$cans != $question->op3)) bg-danger text-light @else bg-light text-dark  @endif  rounded p-2 ">
                                        <strong>i) {{ $question->op3 }} </strong>
                                    </div>
                                    <div class="@if($question->$cans == $question->op4) border border-2 border-success @endif  mt-2 @if(($question->$sans == $question->op4) && ($question->$cans == $question->op4)) bg-success text-light @elseif(($question->$sans == $question->op4) && ($question->$cans != $question->op4)) bg-danger text-light @else bg-light text-dark  @endif  rounded p-2 ">
                                        <strong>i) {{ $question->op4 }} </strong>
                                    </div>

                                </div>
                                <strong>
                                    <span>Your Answer: {{ $question->$sans }}</span><br>
                                    <span>Correct Answer: {{ $question->$cans }}</span>
                                </strong>
                                <br>
                                <div>Explain : {{$question->explain}}</div>
                                    @if($question->explain_img)
                                <img src="{{asset('uploads/'.$question->explain_img)}}" style="max-height:250px;">
                                    @endif

                            </div>


                                <?php $count = $count + 1; ?>
                        @endforeach
                    @endforeach



                </div>
            </div>
        </div>
    </div>
@endsection
