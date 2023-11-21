@extends('layouts.master')

@section('content')


    <div class="blog-area ptb-100">
        <div class="container">
            <a class="btn btn-info" href="{{route('rank', ['id' => $id ])}}">See Rank for this Exam</a>
            <a class="btn btn-warning" href="{{route('question', ['id' => $id ])}}">Download Anwaresheet</a>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1 class="text-center">{{ $paper->name }}</h1>
                    <p>{!! $paper->description !!}</p>
                </div>
                <div class="col-md-4">
                    @foreach ($result as $r)
                        <div class="col-md-12">

                            <div class="card m-1">
                                <div class="card-body">
                                    <strong>Name : {{ $r->user->name }}</strong>
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
                                        <span style="padding: 5px;" class="bg-warning">Avoid : {{ $r->na }}
                                        </span>
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

                                    <a class="btn btn-info m-1" href="{{ route('resultCardPdf', ['id' => $r->id]) }}"
                                        target="_blank" rel="noopener noreferrer"><i class="ri-download-2-line"></i>
                                        Download Result Card</a>
                                </div>
                            </div>


                        </div>
                    @endforeach

                </div>
                <div class="col-md-8">

                    <?php
                    $count = 1;
                    $total = $paper->questions->count();
                    $timeMin = $paper->duration;
                    $timeSec = $timeMin * 60;

                    ?>
                    <input type="number" name="total" value="{{ $paper->questions->count() }}" hidden>
                    <span class="text-dark">Time : {{ $timeMin }} Minutes.</span><br>
                    <span class="text-primary">Total Questions : {{ $total }} </span><br>
                    <span class="text-success">Postive Mark For Every Question : {{ $paper->pmark }}</span><br>
                    <span class="text-danger">Negative Mark For Every Question : {{ $paper->nmark }}</span><br>
                    <span class="text-success "><strong> Total Mark : {{ $total }} X {{ $paper->pmark }} =
                            {{ $total * $paper->pmark }} </strong></span><br>
                    <?php $g = [];?>
                    @foreach($paper->questions as $q)
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
                        @foreach ($paper->questions->where('subject_id',$k) as $question)
                                <?php
                                $ca = 'ca' . $count;
                                $sop = 'op' . $count;
                                $cans = $request->$ca;
                                $sans = $request->$sop;
                                $rowClass = $cans === $sans ? 'bg-success text-light' : ($sans === 'none' ? 'bg-warning text-dark' : 'bg-danger text-light');
                                ?>
                                <div class="row border m-1 {{ $rowClass }}">

                                <div><strong><?php echo $count; ?>) {{ $question->name }} </strong></div>


                                {!! $question->description !!}
                                @if ($question->image)
                                    <div>
                                        <img style="max-height:250px;" src="{{ asset('uploads/'.$question->image) }}"
                                             alt="{{ $question->name }}">
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="op{{ $count }}"
                                               id="op{{ $count }}" value="op1" <?php if ($question->$sans == $question->op1) {
                                                                                   ?> checked <?php
                                                                                              } ?>>
                                        <label class="form-check-label" for="op{{ $count }}">
                                            {{ $question->op1}}
                                        </label>

                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="op{{ $count }}"
                                               id="op{{ $count }}" value="op2" <?php if ($question->$sans == $question->op2) {
                                                                                   ?> checked <?php
                                                                                              } ?>>
                                        <label class="form-check-label" for="op{{ $count }}">
                                            {{ $question->op2 }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="op{{ $count }}"
                                               id="op{{ $count }}" value="op3" <?php if ($question->$sans == $question->op3) {
                                                                                   ?> checked <?php
                                                                                              } ?>>
                                        <label class="form-check-label" for="op{{ $count }}">
                                            {{ $question->op3 }}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="op{{ $count }}"
                                               id="op{{ $count }}" value="op4" <?php if ($question->$sans == $question->op4) {
                                                                                   ?> checked <?php
                                                                                              } ?>>
                                        <label class="form-check-label" for="op{{ $count }}">
                                            {{ $question->op4 }}
                                        </label>
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
