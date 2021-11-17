@extends('front.includes.front_design')

@section('front_title')
    {{ $news->news_title }} - {{ $theme->site_subtitle }}
@endsection


@section('content')
    <section class="news-detail">
        <div class="container">
            <div id="fb-root"></div>
            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v11.0" nonce="9NwJrZRV"></script>
            <div class="row">
                <div class="col-lg-8">
                    <div class="white-card">
                        <div class="list-wrapper">
                            @if(!empty($news->author))
                            <div class="post-user">
                                <div class="user-image">
                                    <img src="{{ asset('public/uploads/admin/'.$news->author->image) }}" alt="{{ $news->author->name }}">
                                </div>
                                <div class="user-content">
                                    <ul class="unstyled">
                                        <li class="username"><a href="javascript:">{{ $news->author->name }} </a></li>
                                        <li><a href="javascript:">{{ toFormattedNepaliDate($news->created_at) }} </a></li>
                                    </ul>
                                </div>

                            </div>
                            @endif
                            <div class="latest-title">
                                <h3><a href="javascript:">
                                        {{ $news->news_title }}
                                    </a></h3>
                            </div>
                            <!-- AddThis BEGIN -->
                            <div class="addthis_inline_share_toolbox_ljm7"></div>
                            <!-- AddThis ENDS -->
                            <div class="image-wrapper">
                                <div class="owl-carousel owl-theme">
                                    @if(!empty($news->thumbnail_image))
                                    <div class="item">
                                        <img src="{{ asset('public/uploads/news/'.$news->thumbnail_image) }}" class="img-fluid" alt="News Photo">
                                    </div>
                                    @endif
                                    @foreach($gallery_images as $images)
                                    <div class="item">
                                        <img src="{{ asset('public/uploads/news/gallery/'.$images->image) }}" class="img-fluid" alt="News Photo">
                                    </div>
                                        @endforeach


                                </div>
                            </div>

                            <div class="count-view">
                                <ul>
                                    <li><i class="far fa-eye"></i>{{ $news->view_count }} Views</li>
                                    <li id="{{ $news->id }}"><i class="far fa-thumbs-up"></i><span id="like-count{{$news->id}}">{{$news->likes['likes']}}</span> Likes</li>
                                    <li id="{{ $news->id }}"><i class="far fa-thumbs-down"></i><span id="dislike-count{{$news->id}}">{{$news->likes['dislikes']}}</span> Dislikes</li>
                                </ul>
                            </div>
                            <div class="buttons-wrapper">
                                <ul>
                                    <!-- {{$liked = $news->isLiked(Auth::user())}} -->
                                    <a href="javascript:" class="far fa-thumbs-up like" id="{{ $news->id }}"></a>
                                    <a href="javascript:" class="far fa-thumbs-down like" id="{{ $news->id }}"></a>
                                    <!-- <li><button><i class="far fa-comment"></i></button></li> -->
                                </ul>
                            </div>

                            {!! $news->news_content !!}

                            <div class="fb-comments" data-href="https://www.facebook.com/JanatakoOnlinecom-103862514732250" data-width="100%" data-numposts=""></div>
                        </div>
                    </div>
                </div>
                @include('front.includes.sidebar')

            </div>
            <div class="related-category-news mt-5">
                <div class="container">
                    <h5>Related News</h5>
                    <div class="row">
                        @foreach($related_news as $news)
                        <div class="col-lg-4 col-md-12">
                            <div class="featured-detail mt-4">
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
                                    <h4 class="title mt-3"><a href="{{ route('newsSingle', $news->slug) }}">{{ $news->news_title }}</a></h4>
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
        </div>
    </section>
@endsection
