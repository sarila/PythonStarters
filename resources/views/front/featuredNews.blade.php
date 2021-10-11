@extends('front.includes.front_design')

@section('content')
    <section class="news-detail">
        <div class="container">
            <div class="news-heading">
                <h4>Featured News</h4>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="feat-list">
                        <div class="row">

                            @foreach($featured_news as $news)
                            <div class="col-lg-4 col-md-6">
                                <div class="featured-news-list">
                                    <a href="news-detail.php">
                                        @if(!empty($news->thumbnail_image))
                                            <img src="{{ asset('public/uploads/news/'.$news->thumbnail_image) }}"  alt="{{ $news->news_title }}">
                                        @else
                                            <img src="{{ asset('public/default/noimage.png') }}"   alt="{{ $news->news_title }}">
                                        @endif
                                    </a>
                                    <h5 class="mt-3"><a href="news-detail.php">भीभो भी २१ ई : क्यामेरा ६४, र्‍याम ८ जीबी, सेल्फी फोरके ; मूल्य कति ?</a></h5>
                                </div>
                            </div>
                            @endforeach

                        </div>
                        <div class="pagination-wrapper">
                            <ul id="pagination">
                                {{ $featured_news->links('pagination') }}
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
