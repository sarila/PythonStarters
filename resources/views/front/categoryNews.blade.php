@extends('front.includes.front_design')


@section('front_title')
    {{ $category->category_name_np }} - {{ $theme->site_subtitle }}
@endsection

@section('content')
    <section class="samachar">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="white-card">
                        <div class="page-title seven">
                            <h4>{{ $category->category_name_np }}</h4>
                        </div>

                        @foreach($category_news as $news)
                        <div class="list-wrapper">
                            <div class="post-user">
                                <div class="user-image">
                                    <img src="{{ asset('public/uploads/admin/'.$news->author->image) }}" alt="{{ $news->author->name }}">
                                </div>
                                <div class="user-content">
                                    <ul class="unstyled">
                                        <li class="username"><a href="#">{{ $news->author->name }} </a></li>
                                        <li><a href="javascript:">{{ toFormattedNepaliDate($news->created_at) }}</a></li>
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
                                    <li>{{ $news->view_count }} Views</li>
                                    <li id="{{ $news->id }}"><i class="far fa-thumbs-up"></i><span id="like-count{{$news->id}}">{{$news->likes['likes']}}</span> Likes</li>
                                    <li id="{{ $news->id }}"><i class="far fa-thumbs-down"></i><span id="dislike-count{{$news->id}}">{{$news->likes['dislikes']}}</span> Dislikes</li>
                                </ul>
                            </div>
                            <div class="buttons-wrapper">
                                <ul>
                                    {{$liked = $news->isLiked(Auth::user())}}
                                    <a href="javascript:" class="far fa-thumbs-up like" id="{{ $news->id }}" @if ($liked==1) style="color: blue;" @endif></a>
                                    <a href="javascript:" class="far fa-thumbs-down like" id="{{ $news->id }}" @if ($liked==0) style="color: blue;" @endif></a>
                                    <li><button><i class="far fa-comment"></i></button></li>
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
                            </div>
                        </div>
                        <!--Active and Hoverable Pagination-->
                        <div class="pagination-wrapper">
                            <ul id="pagination">
                               {{ $category_news->links('pagination') }}
                            </ul>
                        </div>
                    </div>
                </div>
                @include('front.includes.sidebar')

            </div>
        </div>
    </section>

@endsection
