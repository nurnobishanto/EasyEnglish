@extends('layouts.master')

@section('content')
    <!-- Start Page Banner Area -->
    <div class="page-banner-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">

                <div class="page-banner-content" data-aos="fade-right" data-aos-delay="50" data-aos-duration="500"
                    data-aos-once="true">
                    <h2>Free Notes</h2>

                    <ul>
                        <li>
                            <a href="#">Home</a>
                        </li>
                        <li>Free Notes</li>
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
                <table id="table" class="table table-striped table-border">
                    <thead class="table">
                        <tr>
                            <th>SL</th>
                            
                            <th>Book Name</th>
                            <th>Details</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notes as $ebook)
                            <tr>
                                <td>{{ $ebook->id }}</td>
                            
                                <td>{{ $ebook->name }}</td>
                                <td>{{ $ebook->Details }}</td>
                                <td>
                                    <form action="{{ route('download') }}" method="post" name="questionPaper">
                                    @csrf
                                    <input type="text" name="url" value="{{ Storage::url(json_decode($ebook->file)[0]->download_link) }}" hidden>
                                    <input type="text" name="type" value="note" hidden>
                                    <input type="number" name="id" value="{{ $ebook->id }}" hidden>
                                     <input class="btn btn-primary m-1" type="submit" value="Download ( {{$ebook->count}} )">
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>



            </div>

            {{-- {{ $notes->links('vendor.pagination.custom') }} --}}
        </div>
    </div>
    <!-- End Blog Area -->
@endsection
