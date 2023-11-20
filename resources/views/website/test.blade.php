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
                <div class="col-md-12">
                    <h1 class="text-center">{{ $paper->name }}</h1>
                    <p>{!! $paper->description !!}</p>
                </div>
                <div class="col-md-4">
                    <div class="coming-soon-content">
                        <h2 class="text-center">Time Remaing</h2>
                        <div id="timer" class="flex-wrap d-flex justify-content-center">

                            <div id="countdownMin" class="align-items-center flex-column d-flex justify-content-center">
                            </div>
                            <div id="countdownSec" class="align-items-center flex-column d-flex justify-content-center">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">

                    <form action="{{ route('checking') }}" method="post" name="questionPaper">
                        @csrf
                        <?php
                        $count = 1;
                        $total = $paper->questions->count();
                        $timeMin = $paper->duration;
                        $timeSec = $timeMin * 60;
                        $remtime = $timeSec - $attmDuration;
                        $timeMlSec = $remtime * 1000;

                        ?>
                        <script type="text/javascript">
                            var timeleft = <?php echo $remtime; ?>;
                            var downloadTimer = setInterval(function() {
                                if (timeleft <= 0) {
                                    clearInterval(downloadTimer);
                                    document.getElementById("countdown").innerHTML = "Finished";
                                } else {
                                    var min = Math.floor(timeleft / 60);
                                    var sec = timeleft % 60;
                                    document.getElementById("countdownMin").innerHTML = min + "<span>Min</span>";
                                    document.getElementById("countdownSec").innerHTML = sec + "<span>Sec</span>";
                                }
                                timeleft -= 1;
                            }, 1000);
                        </script>

                        <input type="number" name="paperid" value="{{ $paper->id }}" hidden>
                        <input type="number" name="pmark" value="{{ $paper->pmark }}" hidden>
                        <input type="number" name="nmark" value="{{ $paper->nmark }}" hidden>
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
                                @foreach ($paper->questions->where('subject_id',$k) as $question)
                                    <div class="row  border m-1">
                                        <input type="text" name="q{{ $count }}" value="{{ $question->id }}" hidden>
                                        <input type="text" name="ca{{ $count }}" value="{{ $question->ca }}" hidden>
                                        {!! $question->description !!}
                                        <div> <strong>{{ $question->name }} </strong></div>

                                        <input hidden value="none" type="radio" name="op{{ $count }}" checked>

                                        @if($question->image)
                                            <div>
                                                <img style="width: 360px;" src="{{ Voyager::image($question->image) }}"
                                                     alt="{{ $question->name }}">
                                            </div>
                                        @endif

                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="op{{ $count }}"
                                                       id="op{{ $count }}" value="op1">

                                                <label class="form-check-label" for="op{{ $count }}">
                                                    {{ $question->op1 }}
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="op{{ $count }}"
                                                       id="op{{ $count }}" value="op2">
                                                <label class="form-check-label" for="op{{ $count }}">
                                                    {{ $question->op2 }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="op{{ $count }}"
                                                       id="op{{ $count }}" value="op3">
                                                <label class="form-check-label" for="op{{ $count }}">
                                                    {{ $question->op3 }}
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="op{{ $count }}"
                                                       id="op{{ $count }}" value="op4">
                                                <label class="form-check-label" for="op{{ $count }}">
                                                    {{ $question->op4 }}
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                        <?php $count = $count + 1; ?>
                                @endforeach
                            </div>

                        @endforeach


                        <input class="btn btn-primary m-1" type="submit" value="Submit">


                        <script type="text/javascript">
                            window.onload = function() {
                                window.setTimeout(function() {
                                    document.questionPaper.submit();
                                }, <?php echo $timeMlSec; ?>);
                            };
                        </script>
                    </form>


                </div>


            </div>
        </div>
    </div>
@endsection
