@extends('front.includes.front_design')

@section('front_title')
{{ $theme->site_title }} - {{ $theme->site_subtitle }}
@endsection

@section('content')

    <section class="breaking-news">
        <div class="container">
            <div class="news-outline">
                <div class="breaking-title">
                    <h4>Featured News</h4>
                    <button class="see-button">
                        <a href="{{ route('featuredNews') }}" class="see-button"><span>SEE ALL </span></a>
                    </button>
                </div>
                <div class="heading-main-news">
                    @foreach($featured_news_top as $news)
                    <h2 style="
                            margin-bottom: 15px;
                            border-radius: 0.5rem;
                            padding: 20px;
                            box-shadow: 0 0 5px 5px rgba(0,0,0,0.1);
                        "><a href="{{ route('newsSingle', $news->slug) }}">{{ $news->news_title }}</a></h2>
                    <a href="{{ route('newsSingle', $news->slug) }}" >

                        @if(!empty($news->thumbnail_image))
                            <img src="{{ asset('public/uploads/news/'.$news->thumbnail_image) }}" class="img-fluid" width="100%" alt="{{ $news->news_title }}">
                        @else
                            <img src="{{ asset('public/default/noimage.png') }}"  class="img-fluid" width="100%" alt="{{ $news->news_title }}">
                        @endif
                    </a>

                    @endforeach


                </div>

                <div class="row" style="margin-top: 15px;">
                    @foreach($featured_news as $news)
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="news-photo">
                                <a href="{{ route('newsSingle', $news->slug) }}">
                                    @if(!empty($news->thumbnail_image))
                                        <img src="{{ asset('public/uploads/news/'.$news->thumbnail_image) }}" class="img-fluid" alt="{{ $news->news_title }}">
                                    @else
                                        <img src="{{ asset('public/default/noimage.png') }}"  class="img-fluid" alt="{{ $news->news_title }}">
                                    @endif
                                </a>
                            </div>
                            <div class="content">
                                <h5 class="title"><a href="{{ route('newsSingle', $news->slug) }}">{{ $news->news_title }}</a></h5>
                                <div class="details">
                                    <ul class="list-unstyled">
                                        <li class="username"><a href="#">
                                                <img src="{{ asset('public/uploads/admin/'.$news->author->image) }}" alt="{{ $news->author->name }}"> </a>
                                        </li>
                                        <li class="time-interval"><a href="javascript:">|
                                            {{ toFormattedNepaliDate($news->created_at) }}
                                            </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>



    @foreach($index_banner_poster as $fullwidth)
        <section class="poster">
            <div class="container">
                <div class="poster-space">
                    <img src="{{ asset('public/uploads/posters/'. $fullwidth->image) }}" class="img-fluid" alt="{{$fullwidth->title}}">
                </div>
            </div>
        </section>
    @endforeach

    <!-- <section class="poster">
        <div class="container">
            <div class="poster-space">
                <img src="public/frontend/assets/images/poster/ncell.gif" class="img-fluid" alt="">
            </div>
        </div>
    </section> -->
    <section class="latest-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="white-card">
                        <div class="page-title">
                            <h4>Latest News</h4>
                        </div>

                        @foreach($latest_news as $news)
                        <div class="list-wrapper">
                            <div class="post-user">
                                <div class="user-image">
                                    <img src="{{ asset('public/uploads/admin/'.$news->author->image) }}" alt="">
                                </div>
                                <div class="user-content">
                                    <ul class="unstyled">
                                        <li class="username"><a href="#">{{ $news->author->name }} </a></li>
                                        <li><a href="javascript:">
                                                {{ toFormattedNepaliDate($news->created_at) }}
                                            </a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="latest-title">
                                <h3><a href="{{ route('newsSingle', $news->slug) }}">{{ $news->news_title }}</a></h3>
                            </div>
                            <div class="image-wrapper">
                                <a href="{{ route('newsSingle', $news->slug) }}">
                                    @if(!empty($news->thumbnail_image))
                                        <img src="{{ asset('public/uploads/news/'.$news->thumbnail_image) }}" class="img-fluid" alt="{{ $news->post_title }}">
                                    @else
                                        <img src="{{ asset('public/default/noimage.png') }}"  class="img-fluid" alt="{{ $news->post_title }}">
                                    @endif
                                </a>
                            </div>
                            <div class="count-view">
                                <ul>
                                    <li><i class="far fa-eye"></i>{{$news->view_count}} Views</li>
                                    <li id="{{ $news->id }}"><i class="far fa-thumbs-up"></i><span id="like-count{{$news->id}}">{{$news->likes['likes']}}</span> Likes</li>
                                    <li id="{{ $news->id }}"><i class="far fa-thumbs-down"></i><span id="dislike-count{{$news->id}}">{{$news->likes['dislikes']}}</span> Dislikes</li>
                                </ul>
                            </div>
                            <div class="buttons-wrapper">
                                <ul>
                                    <!-- {{$liked = $news->isLiked(Auth::user())}} -->
                                    <a href="javascript:" class="far fa-thumbs-up like" id="{{ $news->id }}" @if ($news->isLiked(Auth::user())==1) style="color:blue;" @endif></a>
                                    <a href="javascript:" class="far fa-thumbs-down like" id="{{ $news->id }}" ></a>
                                    <!-- <li><button><i class="far fa-comment"></i></button></li> -->
                                </ul>
                            </div>
                        </div>
                        @endforeach

                        <div class="poster-one">
                            <h6>Advertisment</h6>
                            <div class="row">
                                @foreach($index_square_poster as $square_poster)
                                
                                    <div class="col-md-6 sub-one">
                                        <img src="{{ asset('public/uploads/posters/'. $square_poster->image) }}" class="img-fluid" alt="">
                                    </div>
                                @endforeach
                                <!-- <div class="col-md-6 sub-two">
                                    <img src="public/frontend/assets/images/poster/neema.gif" class="img-fluid" alt="">
                                </div> -->
                            </div>
                        </div>
                        <!--Active and Hoverable Pagination-->
                        <div class="pagination-wrapper">
                            <ul id="pagination">
                                {{ $latest_news->links('pagination') }}

                            </ul>
                        </div>
                    </div>
                </div>
                @include('front.includes.sidebar')

            </div>
        </div>
    </section>
    @endsection