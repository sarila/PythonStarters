@extends('front.includes.front_design')

@section('front_title')
{{ $theme->site_title }} - {{ $theme->site_subtitle }}
@endsection

@section('content')

<!-- for search query result -->
@if(!$search_news->isEmpty())
<section class="breaking-news">
    <div class="container">
        <div class="news-outline">
            <div class="row" style="margin-top: 15px;">
                @foreach($search_news as $news)
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
                            
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@else
<section class="breaking-news">
    <div class="container">
        <div class="news-outline">
            <div class="row" style="margin-top: 15px;">
                <div class="content">
                    <h1 class="title">Search result not found</h1>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

    @endsection