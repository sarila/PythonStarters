@extends('front.includes.front_design')

@section('content')
    <section class="videos">
        <div class="container">
            <div class="video-heading">
                <h4>Video Gallery</h4>
                <h5>
                    <button><i class="fa fa-search video-search" aria-hidden="true"></i></button>
                </h5>
            </div>
            <div class="video-div mt-3">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="wrapper-search-bar">
                                <span class="prefix">From:</span> <span class="date-input"><input type="date"></span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="wrapper-search-bar">
                                <span class="prefix">To:</span> <span class="date-input"><input type="date"></span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                        <span class="search-bar-field">
                            <input type="search" placeholder="Video Title">
                        </span>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <span><button type="submit" class="search-bar-btn"><i class="fa fa-search"></i> SEARCH</button></span><span><button class="close-video-search"><i class="fas fa-times"></i></button></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                @foreach($videos as $video)
                    <div class="col-lg-4 col-md-4">
                        <div class="vid">
                            @if($video->youtube_url != null)
                                <iframe src="{{$video->youtube_url}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            @endif
                            @if($video->video != null)
                                <a href="{{asset( 'public/uploads/videos/'.$video->video)}}">
                                    <video>
                                        <source src="{{asset( 'public/uploads/videos/'.$video->video)}}" type="">
                                    </video>
                                </a>
                            @endif
                            <h3 class="sub-title">{{ $video->title }}</h3>
                            {!! $video->description !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
