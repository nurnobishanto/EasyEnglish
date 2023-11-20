@extends('layouts.master')

@section('content')
    <!-- Start Page Banner Area -->
    <div class="page-banner-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">

                <div class="page-banner-content" data-aos="fade-right" data-aos-delay="50" data-aos-duration="500"
                    data-aos-once="true">
                    <h2>E Books</h2>

                    <ul>
                        <li>
                            <a href="#">Home</a>
                        </li>
                        <li>ebook</li>
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
                @foreach ($ebooks as $ebook)
                    <div class="col-lg-3 col-md-4">
                        <div class="single-blog-card">
                            <div class="blog-image">
                                @if (Voyager::image($ebook->image))
                                    <a href="{{ Storage::url(json_decode($ebook->file)[0]->download_link) }}"> <img
                                            src="{{ Voyager::image($ebook->image) }}" alt="{{ $ebook->name }}">

                                    </a>
                                @endif
                            </div>
                            <div class="blog-content with-padding">


                                <div>
                                    <b>{{ $ebook->name }}</b>
                                    <br>
                                    {{ $ebook->details }}
                                </div>

                                <form action="{{ route('download') }}" method="post" name="questionPaper">
                                    @csrf
                                    <input type="text" name="url" value="{{ Storage::url(json_decode($ebook->file)[0]->download_link) }}" hidden>
                                    <input type="text" name="type" value="ebook" hidden>
                                    <input type="number" name="id" value="{{ $ebook->id }}" hidden>
                                     <input class="btn btn-primary m-1" type="submit" value="Download ( {{$ebook->count}} )">
                                    </form>
                                {{-- <a  href="{{ Route('download', ['url' => Storage::url(json_decode($ebook->file)[0]->download_link)]) }}"
                                        target="_blank" rel="noopener noreferrer"><i class="fas  fa-cloud-download-alt">
                                        </i> Download ({{ $ebook->count }})</a>
                                    <a href="{{ Storage::url(json_decode($ebook->file)[0]->download_link) }}"> <i
                                            class="fas  fa-cloud-download-alt"> </i> {{ $ebook->name }}</a> --}}


                            </div>
                        </div>
                    </div>
                @endforeach


            </div>

            {{ $ebooks->links('vendor.pagination.custom') }}
        </div>
    </div>
    <!-- End Blog Area -->
@endsection
