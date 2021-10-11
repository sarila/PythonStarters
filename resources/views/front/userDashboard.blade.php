@extends('front.includes.front_design')

@section('front_title')
  User Dashboard -   {{ $theme->site_title }}
@endsection

@section('content')
    <section class="user-dashboard">
        <div class="container">
            <div class="row">
                @include('front.partials._dashboardlinks')
                <div class="col-lg-9 col-md-12">
                    <div class="dashboard-detail">
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="card text-center">
                                    <h4>Total News</h4>
                                    <div class="news-count">
                                        <strong>{{ \App\Models\JanataNews::where('user_id', auth()->user()->id)->count() }}</strong>
                                    </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="card text-center">
                                    <h4>Published News</h4>
                                    <div class="news-count">
                                        <strong>{{ \App\Models\JanataNews::where('user_id', auth()->user()->id)->where('status', 1)->count() }}</strong>
                                    </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="card text-center">
                                    <h4>Pending News</h4>
                                    <div class="news-count">
                                        <strong>{{ \App\Models\JanataNews::where('user_id', auth()->user()->id)->where('status', 0)->count() }}</strong>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="mostly-visited">
                            <h2>Recently Approved News</h2>
                            <div class="row">
                                @foreach($published_news as $news)
                                <div class="col-md-12">
                                    <div class="col-3 mb-3">
                                        <div class="recent-photos">
                                            <a href="news-detail.php">
                                                @if(!empty($news->thumbnail_image))
                                                    <img src="{{ asset('public/uploads/news/janata/'.$news->thumbnail_image) }}" class="img-fluid" alt=""></a>
                                        @else
                                                <img src="{{ asset('public/default/noimage.png') }}" class="img-fluid">
                                                    @endif
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <a href="news-detail.php">
                                            <h3>
                                                {{ $news->news_title }}
                                            </h3>
                                            <li class="time-interval"><a href="javascript:">
                                                Published On:     {{ toFormattedNepaliDate($news->updated_at) }}
                                                </a></li>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
