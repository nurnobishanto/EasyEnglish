@extends('layouts.master')

@section('content')

    <div class="blog-area ptb-100">
        <div class="container">
            <strong class="d-inline btn btn-success" ><?php echo 'Today : ' . date('l, d M Y , h:i A'); ?></strong>
            <div class="row justify-content-center mt-5">
                <ul class="nav nav-tabs nav-pills nav-justified" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="running-tab" data-bs-toggle="tab" data-bs-target="#running"
                            type="button" role="tab" aria-controls="running" aria-selected="false">Running
                            Exam</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="today-tab" data-bs-toggle="tab" data-bs-target="#today"
                            type="button" role="tab" aria-controls="today" aria-selected="true">Today Exam
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="upcoming-tab" data-bs-toggle="tab" data-bs-target="#upcoming"
                            type="button" role="tab" aria-controls="upcoming" aria-selected="true">Upcoming Exam
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="previous-tab" data-bs-toggle="tab" data-bs-target="#previous"
                            type="button" role="tab" aria-controls="previous" aria-selected="false">Previous
                            Exam</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade" id="running" role="tabpanel" aria-labelledby="running-tab">

                        <h2 class="mt-5">Running Exam List </h2>
                        <div class="row justify-content-center">
                            @foreach (getRunningExamPapers() as $item)
                                <div class="col-md-3 col-sm-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title"><td>{{ $item->name }}</h5>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-striped table-bordered">
                                                <tr>
                                                    <th>Time</th>
                                                    <td>{{ $item->duration }} Minute</td>
                                                </tr>
                                                <tr>
                                                    <th>Start</th>
                                                    <td>{{ $item->startdate }} {{ $item->starttime }}</td>
                                                </tr>
                                                <tr>
                                                    <th>End</th>
                                                    <td>{{ $item->enddate }} {{ $item->endtime }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="card-footer">
                                            <a class="btn btn-danger"
                                               href="{{ Route('start', ['id' => $item->id]) }}"><i class="ri-play-circle-fill"></i> Start</a>
                                           <a class="btn btn-info"
                                               href="{{ Route('result', ['id' => $item->id]) }}"><i class="ri-file-list-3-fill"></i> Result</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade show active" id="today" role="tabpanel" aria-labelledby="today-tab">
                        <h2 class="mt-5">Today Exam List</h2>
                        <div class="row justify-content-center">
                            @foreach (getTodayExamPapers() as $item)
                                <div class="col-md-3 col-sm-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title"><td>{{ $item->name }}</h5>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-striped table-bordered">
                                                <tr>
                                                    <th>Time</th>
                                                    <td>{{ $item->duration }} Minute</td>
                                                </tr>
                                                <tr>
                                                    <th>Start</th>
                                                    <td>{{ $item->startdate }} {{ $item->starttime }}</td>
                                                </tr>
                                                <tr>
                                                    <th>End</th>
                                                    <td>{{ $item->enddate }} {{ $item->endtime }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="card-footer">
                                            @if (isExamRunning($item))
                                                <a class="btn btn-danger" href="{{ Route('start', ['id' => $item->id]) }}">
                                                    <i class="ri-play-circle-fill"></i> Start
                                                </a>

                                                <a class="btn btn-info" href="{{ Route('result', ['id' => $item->id]) }}">
                                                    <i class="ri-file-list-3-fill"></i> Result
                                                </a>
                                            @else
                                                @if (isExamStarted($item))
                                                    <a class="btn btn-danger" href="{{ Route('start', ['id' => $item->id]) }}">
                                                        <i class="ri-play-circle-fill"></i> Start
                                                    </a>
                                                    <!-- Uncomment the line below if you have a 'result' route -->
                                                    <a class="btn btn-info" href="{{ Route('result', ['id' => $item->id]) }}">
                                                        <i class="ri-file-list-3-fill"></i> Result
                                                    </a>
                                                @else
                                                    <span>Not Started Yet</span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
                        <h2 class="mt-5">Upcoming Exam List</h2>
                        <div class="row justify-content-center">
                            @foreach (getUpcomingExamPapers() as $item)
                            <div class="col-md-3 col-sm-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title"><td>{{ $item->name }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="table-bordered table table-striped">
                                            <tr>
                                                <th>Start</th>
                                                <td>{{ $item->startdate }} {{ $item->starttime }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>
                    <div class="tab-pane fade" id="previous" role="tabpanel" aria-labelledby="previous-tab">
                        <h2 class="mt-5">Previous Exam List</h2>
                        <div class="table-responsive">
                            <table id="table3" class="table table-striped table-bordered table-sm mt-5"
                                   cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Title</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ( getPreviousExamPapers() as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->startdate . ' ' . $item->starttime }}</td>
                                        <td>{{ $item->enddate }}, {{ $item->endtime }} </td>
                                        <td>
                                            <a class="btn btn-danger"
                                               href="{{ Route('start', ['id' => $item->id]) }}"><i class="ri-play-circle-fill"></i> Start</a>
                                            <!--<a class="btn btn-info"-->
                                            <!--    href="{{ Route('result', ['id' => $item->id]) }}"><i class="ri-file-list-3-fill"></i> Result</a>-->
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
