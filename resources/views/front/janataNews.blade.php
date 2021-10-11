@extends('front.includes.front_design')

@section('content')
    <section class="janata-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="white-card">
                        <div class="janata-title">
                            <h4>Janata News</h4>
                        </div>

                        @foreach($janata_news as $news)
                            <div class="list-wrapper">
                                <div class="post-user">
                                    <div class="user-image">
                                        @if(!empty($news->user->image))
                                        <img src="{{ asset('public/uploads/profile/'.$news->user->image) }}" alt="">
                                        @else
                                            <img src="{{ asset('public/default/image.png') }}" alt="">
                                        @endif
                                    </div>
                                    <div class="user-content">
                                        <ul class="unstyled">
                                            <li class="username"><a href="#">{{ $news->user->name }} </a></li>
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
                                            <img src="{{ asset('public/uploads/news/janata/'.$news->thumbnail_image) }}" class="img-fluid" alt="{{ $news->post_title }}">
                                        @else
                                            <img src="{{ asset('public/default/noimage.png') }}"  class="img-fluid" alt="{{ $news->post_title }}">
                                        @endif
                                    </a>
                                </div>
                                <div class="count-view">
                                    <ul>
                                        <li>{{ $news->view_count }} Views</li>
                                        <li><i class="far fa-eye"></i>{{$news->view_count}} Views</li>
                                        <li id="{{ $news->id }}"><i class="far fa-thumbs-up"></i><span id="like-count{{$news->id}}">{{$news->likes['likes']}}</span> Likes</li>
                                        <li id="{{ $news->id }}"><i class="far fa-thumbs-down"></i><span id="dislike-count{{$news->id}}">{{$news->likes['dislikes']}}</span> Dislikes</li>
                                        <!-- <li>2 Likes</li>
                                        <li>0 Dislikes</li> -->
                                    </ul>
                                </div>
                                <div class="buttons-wrapper">
                                    <ul>
                                        <a href="javascript:" class="far fa-thumbs-up likejanata" id="{{ $news->id }}" @if ($news->isLiked(Auth::user())==1) style="color:blue;" @endif></a>
                                        <a href="javascript:" class="far fa-thumbs-down likejanata" id="{{ $news->id }}" ></a>
                                        <!-- <li><button><i class="far fa-thumbs-up"></i></button></li>
                                        <li><button><i class="far fa-thumbs-down"></i></button></li> -->
                                        <li><button><i class="far fa-comment"></i></button></li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach

                        <div class="poster-one">
                            <h6>Advertisment</h6>
                            <div class="row">
                                <div class="col-md-6 sub-one">
                                    <img src="{{ asset('public/frontend/assets/images/poster/ambe.gif') }}" class="img-fluid" alt="">
                                </div>
                                <div class="col-md-6 sub-two">
                                    <img src="{{ asset('public/frontend/assets/images/poster/neema.gif') }}" class="img-fluid" alt="">
                                </div>
                            </div>
                        </div>
                        <!--Active and Hoverable Pagination-->
                        <div class="pagination-wrapper">
                            <ul id="pagination">
                                {{ $janata_news->links('pagination') }}

                            </ul>
                        </div>
                    </div>
                </div>
                @include('front.includes.sidebar_v2')

            </div>
        </div>
    </section>

@endsection
