@extends('front.includes.front_design')

@section('content')
    <section class="samachar">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="white-card">
                        <div class="page-title seven">
                            <h4>{{ $pradesh->title }}</h4>
                        </div>

                        @foreach($pradesh_news as $news)
                        <div class="list-wrapper">
                            <div class="post-user">
                                <div class="user-image">
                                    <img src="{{ asset('public/uploads/admin/'.$news->author->image) }}" alt="{{ $news->author->name }}">
                                </div>
                                <div class="user-content">
                                    <ul class="unstyled">
                                        <li class="username"><a href="#">{{ $news->author->name }} </a></li>
                                        <li><a href="javascript:">{{ $news->created_at->diffForHumans() }} </a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="latest-title">
                                <h3><a href="news-detail.php">{{ $news->news_title }}</a></h3>
                            </div>
                            <div class="image-wrapper">
                                <a href="news-detail.php">
                                    @if(!empty($news->thumbnail_image))
                                    <img src="{{ asset('public/uploads/news/'.$news->thumbnail_image) }}" class="img-fluid" alt="{{ $news->post_title }}">
                                    @else
                                        <img src="{{ asset('public/default/noimage.png') }}"  class="img-fluid" alt="{{ $news->post_title }}">
                                    @endif
                                </a>
                            </div>
                            <div class="count-view">
                                <ul>
                                    <li>212 Views</li>
                                    <li><i class="far fa-thumbs-up"></i>{{$news->likes['likes']}} Likes</li>
                                    <li><i class="far fa-thumbs-down"></i>{{$news->likes['dislikes']}} Dislikes</li>
                                </ul>
                            </div>
                            <div class="buttons-wrapper">
                                <ul>
                                    {{$liked = $news->isLiked(Auth::user())}}
                                    <a href="javascript:" class="far fa-thumbs-up like" id="{{ $news->id }}" @if ($liked==1) style="color: blue;" @else style="color: black;" @endif></a>
                                    <a href="javascript:" class="far fa-thumbs-down like" id="{{ $news->id }}" @if ($liked==0) style="color: blue;" @else style="color: black;" @endif></a>
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
                               {{ $pradesh_news->links('pagination') }}
                            </ul>
                        </div>
                    </div>
                </div>
                @include('front.includes.sidebar')

            </div>
        </div>
    </section>

@endsection
