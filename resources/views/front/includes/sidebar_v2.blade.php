<div class="col-lg-4">
    <div class="right-sidebar">
        <div class="white-card">
            <a href="{{ route('videos') }}">
                <i class="fas fa-video"> <span class="content">Videos/ TV / Youtube</span></i>
            </a>
        </div>
        <div class="sidebar-title">
            <h5>POPULAR JANATA NEWS</h5>
        </div>
        <div class="sub-category">
            @php $recent_news = \App\Models\JanataNews::where('status', 1)->latest()->take(5)->get(); @endphp

            @foreach($recent_news as $news)
            <div class="sub-detail">
                <div class="row">
                    <div class="col-4">
                        <div class="post-image">
                            <a href="{{ route('newsSingle', $news->slug) }}">
                                @if(!empty($news->thumbnail_image))
                                <img src="{{ asset('public/uploads/news/janata/'.$news->thumbnail_image) }}" alt="{{ $news->news_title }}">
                                @else
                                    <img src="{{ asset('public/default/noimage.png') }}">
                                    @endif
                            </a>
                        </div>
                    </div>
                    <div class="col-8 post-detail">
                        <div class="post-title">
                            <p><a href="{{ route('newsSingle', $news->slug) }}">
                                    {{ $news->news_title }}</a>
                        </div>
                        <div class="post-details">
                            <div class="col-6">
                                <div class="username"><a href="#"><i class="fas fa-user mr-1"></i>{{ $news->user->name }} </a></div>
                            </div>
                            <div class="col-6">
                                <div class="time"><a href="#"><i class="fas fa-clock"> </i>
                                        {{ toFormattedNepaliDate($news->created_at) }}
                                    </a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                @endforeach

        </div>
        <div class="sidebar-poster">
            <img src="{{asset( 'public/uploads/posters/'.$sidebar_poster->image)}}" class="img-fluid" alt="Side poster">
        </div>
    </div>
</div>
