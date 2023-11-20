@extends('layouts.master')

@section('content')
    <!-- Start Page Banner Area -->
    <div class="page-banner-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">

                <div class="page-banner-content" data-aos="fade-right" data-aos-delay="50" data-aos-duration="500"
                    data-aos-once="true">
                    <h2>{{ $ecat->name }}</h2>

                    <ul>
                        <li>
                            <a href="{{ route('website') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('exam') }}">Exam</a>
                        </li>
                        <li>{{ $ecat->name }}</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <!-- End Page Banner Area -->
    <div class="blog-area ptb-100">
        <div class="container">
            <div class="row justify-content-center">
                <span class="bg-danger p-1 text-light"><?php echo 'Today : ' . date('l, d M Y , h:i A'); ?></span>
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

                        <h2 class="mt-5">Runnng Exam List </h2>

                        <table id="table" class="table table-striped table-bordered table-sm mt-5" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <td>#ID</td>
                                    <td>Title</td>
                                    <td>Start Date Time</td>
                                    <td>End Date Time</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($examLists as $item)
                                    @if (date('Y-m-d H:i:s') >= $item->startdate . ' ' . $item->starttime && date('Y-m-d H:i:s') <= $item->enddate . ' ' . $item->endtime)
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
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade show active" id="today" role="tabpanel" aria-labelledby="today-tab">
                        <h2 class="mt-5">Today Exam List</h2>
                        <table id="table1" class="table table-striped table-bordered table-sm mt-5" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <td>#ID</td>
                                    <td>Title</td>
                                    <td>Start</td>
                                    <td>End</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($examLists as $item)
                                    @if (date('Y-m-d') === $item->startdate || (date('Y-m-d') === $item->enddate) || (date('Y-m-d H:i:s') >= $item->startdate . ' ' . $item->starttime && date('Y-m-d H:i:s') <= $item->enddate . ' ' . $item->endtime))
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->startdate . ' ' . $item->starttime }}</td>
                                            <td>{{ $item->enddate }}, {{ $item->endtime }} </td>
                                            <td>
                                                @if (date('Y-m-d H:i:s') >= $item->startdate . ' ' . $item->starttime && date('Y-m-d H:i:s') <= $item->enddate . ' ' . $item->endtime)
                                                    <a class="btn btn-danger"
                                                        href="{{ Route('start', ['id' => $item->id]) }}"><i class="ri-play-circle-fill"></i> Start</a>
                                                     <!--<a class="btn btn-danger"-->
                                                     <!--       href="{{ Route('result', ['id' => $item->id]) }}"><i class="ri-file-list-3-fill"></i> Result</a>    -->
                                                @else
                                                    @if (date('Y-m-d H:i:s') >= $item->startdate . ' ' . $item->starttime)
                                                        <a class="btn btn-danger"
                                                            href="{{ Route('start', ['id' => $item->id]) }}"><i class="ri-play-circle-fill"></i> Start</a>
                                                        <!--<a class="btn btn-danger"-->
                                                        <!--    href="{{ Route('result', ['id' => $item->id]) }}"><i class="ri-file-list-3-fill"></i> Result</a>-->
                                                    @else

                                                    <span>Not Started Yet</span>
                                                    @endif
                                                @endif

                                            </td>
                                        </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
                        <h2 class="mt-5">Upcoming Exam List</h2>
                        <table id="table2" class="table table-striped table-bordered table-sm mt-5" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <td>#ID</td>
                                    <td>Title</td>
                                    <td>Date</td>
                                    <td>Time</td>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($examLists as $item)
                                    @if (date('Y-m-d H:i:s') < $item->startdate . ' ' . $item->starttime)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->startdate }}</td>
                                            <td>{{ $item->starttime }}</td>

                                        </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="previous" role="tabpanel" aria-labelledby="previous-tab">
                        <h2 class="mt-5">Previous Exam List</h2>
                        <table id="table3" class="table table-striped table-bordered table-sm mt-5"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <td>#ID</td>
                                    <td>Title</td>
                                    <td>Start</td>
                                    <td>End</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($examLists as $item)
                                    @if (date('Y-m-d H:i:s') > $item->enddate . ' ' . $item->endtime )
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
                                    @endif
                                @endforeach

                            </tbody>
                        </table>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
