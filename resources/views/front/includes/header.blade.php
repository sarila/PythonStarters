<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('front_title') </title>
    <link rel="icon" sizes="16x12 24x24 32x32 48x48 64x44"
          href="{{ asset('public/uploads/'.$theme->favicon) }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mukta&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- SIummerNote Editor -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <!-- Owl CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--Custom CSS-->
    <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/header.css') }} ">
    <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/footer.css') }} ">
    <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/style.css') }} ">
    <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/sub-category.css') }} ">
    <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/janata-upload.css') }} ">
    <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/news-detail.css') }} ">
    <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/janata-news.css') }} ">
    <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/mobile.css') }} ">
    <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/videos.css') }} ">
    <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/login.css') }} ">
    <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/sign-up.css') }} ">
    <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/forgot-password.css') }} ">
    <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/featured-news.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/user-dashboard.css') }} ">

    <!-- Sweet Alert CSS -->
    <link rel="stylesheet" href="{{ asset('public/backend/assets/css/sweetalert.css') }}">

    <link rel="stylesheet" href="{{ asset('public/backend/assets/css/dropzone.css') }}">



    @yield('front_css')

    <style>
        .pagination li.active{
            border: 1px solid red;
            width: 38px;
            background-color: red;
            color: white;
        }
        .pagination li.disabled{
            border: 1px solid red;
            width: 38px;
            color: red;
        }
    </style>
</head>

<body>
<div class="scrollTop float-right">
    <i class="fas fa-angle-up" onclick="topFunction()" id="myBtn"></i>
</div>

<section class="top-header">
    <div class="main-header">
        <div class="container">
            <div class="row datentime">
                <div class="col-lg-5 col-md-5 d-flex dateNepali">
                    <iframe scrolling="no" border="0" frameborder="0" marginwidth="0" marginheight="0" allowtransparency="true" src="https://www.ashesh.com.np/linknepali-time.php?time_only=no&font_color=FFFFFF&aj_time=yes&font_size=14&line_brake=0&bikram_sambat=0&api=912176l243" width="100%" height="22"></iframe>
                </div>
                <div class="col-lg-4 col-md-3">
                    <h5 class="info">हामी परीक्षणको आवधीमा छौं</h3>
                </div>
                <div class=" col-lg-3 col-md-4 searchbar d-flex">
                    <i class="fa fa-search sicon" aria-hidden="true"></i>
                    <div id="google_translate_element"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="test-div">
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
                            <input type="search" placeholder="News Title">
                        </span>
                </div>
                <div class="col-lg-3 col-md-6">
                    <span><button type="submit" class="search-bar-btn"> SEARCH</button></span><span><button class="gone"><i class="fas fa-times"></i></button></span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="logo-header">
    <div class="container">
        <div class="row">
            <div class=" col-lg-3  col-md-3 logo">
                @if(Auth::guard('web')->check())
                <a href="{{ route('userDashboard') }}">
                    @else
                        <a href="{{ route('index') }}">
                        @endif
                    @if(!empty($theme->logo))
                    <img src="{{ asset('public/uploads/'.$theme->logo) }}" class="img-fluid" alt="{{ $theme->site_title }}">
                    @else
                        <span>{{ $theme->site_title }}</span>
                    @endif
                </a>
            </div>
            <div class="col-lg-5 col-md-5">
                <div class="poster-space">

                    <img src="{{asset( 'public/uploads/posters/'.$header_poster->image)}}" class="img-fluid" alt="photo">
                </div>
            </div>
            <div class="col-lg-4 col-md-4  add-features">
                <ul>
                    <li class="nav-item">
                        @if(Auth::check())
                        <a href="{{ route('addNews') }}">
                            <i class="fas fa-plus"> समाचार लेख्नुहोस</i>
                        </a>
                        @else
                            <a href="{{ route('writeNews') }}">
                                <i class="fas fa-plus"> समाचार लेख्नुहोस</i>
                            </a>
                        @endif
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('janataNews') }}">
                            <i class="fas fa-book-open"> जनताको समाचार</i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- NAVBAR -->
<div class="header-wrapper" id="topheader">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index') }}">गृहपृष्ठ</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            जनताको समाचार
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                            <a class="dropdown-item" href="{{ route('janataNews') }}"> पढ्नुहोस्</a>
                            @if(Auth::check())
                            <a class="dropdown-item" href="{{ route('addNews') }}"> लेख्नुहोस्</a>
                            @else
                            <a class="dropdown-item" href="{{ route('writeNews') }}"> लेख्नुहोस्</a>
                                @endif
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:" id="navbarDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            प्रदेश
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown3">
                            @php $states = \App\Models\NewsType::all(); @endphp
                            @foreach($states as $state)
                            <a class="dropdown-item" href="{{ route('pradeshNews', $state->slug) }}"> {{ $state->title }}</a>
                            @endforeach
                        </div>
                    </li>
                    @php $main_categories = \App\Models\Category::where('parent_id', 0)->take(7)->get(); @endphp
                    @foreach($main_categories as $cat)
                    <li class="nav-item dropdown">
                        @php $sub_categories = \App\Models\Category::where('parent_id', $cat->id)->get(); @endphp
                        <a class="nav-link @if($sub_categories->count() > 0) dropdown-toggle @endif" href="{{ route('categoryNews', $cat->slug) }}">
                           {{ $cat->category_name_np }}
                        </a>

                        @if($sub_categories->count() > 0)

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown3">
                            @foreach($sub_categories as $sub_cat)
                            <a class="dropdown-item" href="{{ route('categoryNews', $sub_cat->slug) }}">{{ $sub_cat->category_name_np }} </a>
                            @endforeach
                        </div>
                            @endif
                    </li>
                    @endforeach

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            अन्य
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                            @php $categories = \App\Models\Category::take(90)->skip(7)->get(); @endphp
                          @foreach($categories as $category)
                            <a class="dropdown-item" href="{{ route('categoryNews', $category->slug) }}"> {{ $category->category_name_np }}</a>
                              @endforeach
                        </div>
                    </li>



                </ul>
            </div>





            <div class="second-bg">
                <div class="container">
                    <div id="mySidenav" class="sidenav">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                        <ul>
                            <li><a href="index.php"><i class="fas fa-home mr-3"></i>गृहपृष्ठ</a></li>
                            <li>
                                <a class="feat-btn">जनताको समाचार
                                    <span class="fas fa-caret-down first"></span>
                                </a>
                                <ul class="feat-show">
                                    <li><a href="{{ route('janataNews') }}">पढ्नुहोस्</a></li>
                                    <li><a href="{{ route('writeNews') }}">लेख्नुहोस्</a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="samachar-btn">समाचार
                                    <span class="fas fa-caret-down second"></span>
                                </a>
                                <ul class="samachar-show">
                                    <li><a href="rastriya.php">राष्ट्रिय</a></li>
                                    <li><a href="antarastriya.php">अन्तर्राष्ट्रिय</a></li>
                                    <li><a href="sthaniya.php">स्थानीय</a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="jeewan-btn">जीवनशैली
                                    <span class="fas fa-caret-down third"></span>
                                </a>
                                <ul class="jeewan-show">
                                    <li><a href="health.php">स्वास्थ्य</a></li>
                                    <li><a href="khanpin.php">खानपिन</a></li>
                                    <li><a href="fashion.php">फेसन</a></li>
                                    <li><a href="decoration.php">सजावट</a></li>
                                    <li><a href="anivani.php">आनिवानी</a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="artha-btn">अर्थ बजार
                                    <span class="fas fa-caret-down fourth"></span>
                                </a>
                                <ul class="artha-show">
                                    <li><a href="share-bazar.php">शेयर बजार</a></li>
                                    <li><a href="udhyog.php">उद्योग</a></li>
                                    <li><a href="byapaar.php">व्यापार</a></li>
                                    <li><a href="business.php">व्यवसाय</a></li>
                                    <li><a href="economy.php">अर्थतन्त्र</a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="suchana-btn">सूचना प्रविध
                                    <span class="fas fa-caret-down fifth"></span>
                                </a>
                                <ul class="suchana-show">
                                    <li><a href="technology.php">टेक्नोलोज</a></li>
                                    <li><a href="gadgets.php">ग्याजेट्स</a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="khelkud-btn">खेलकुद
                                    <span class="fas fa-caret-down sixth"></span>
                                </a>
                                <ul class="khelkud-show">
                                    <li><a href="cricket.php">क्रिकेट</a></li>
                                    <li><a href="football.php">फुटबल</a></li>
                                    <li><a href="martial-arts.php">मार्सल आर्ट</a></li>
                                    <li><a href="other-sports.php">अन्य</a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="kala-btn">कला साहित्य
                                    <span class="fas fa-caret-down seventh"></span>
                                </a>
                                <ul class="kala-show">
                                    <li><a href="culture.php">संस्कृति</a></li>
                                    <li><a href="filmy.php">फिल्मी</a></li>
                                    <li><a href="entertainment.php">मनोरञ्जन</a></li>
                                    <li><a href="relationship.php">सम्बन्ध</a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="bichar-btn">विचार /दृष्टिकोण
                                    <span class="fas fa-caret-down eight"></span>
                                </a>
                                <ul class="bichar-show">
                                    <li><a href="article.php">लेख</a></li>
                                    <li><a href="interview.php">अन्तर्वार्ता</a></li>
                                </ul>
                            </li>
                            <li><a href="other-news.php">अन्य</a></li>
                        </ul>
                    </div>
                    <span class="openNav" onclick="openNav()">&#9776; </span>
                </div>
            </div>
        </div>
    </nav>
</div>
<!--mobile nav-->
<div class="mobile-nav">
    <div class="row no-gutters">
        <div class="col-3">
            <div class="mobile-nav-list">
                <a href="index.php">
                    <img src="{{ asset('public/frontend/assets\images\mobilenav\home.png') }}" alt="">
                    <br>
                    Home
                </a>
            </div>
        </div>
        <div class="col-3">
            <div class="mobile-nav-list">
                <a href="janata-news.php">
                    <img src="public/frontend/assets\images\mobilenav\document.png" alt="">
                    <br>
                    Janata News
                </a>
            </div>
        </div>
        <div class="col-3">
            <div class="mobile-nav-list">
                <a href="janata-upload.php">
                    <img src="public/frontend/assets\images\mobilenav\upload.png" alt="">
                    <br>
                    Upload News
                </a>
            </div>
        </div>
        <div class="col-3">
            <div class="mobile-nav-list last-mnl">
                <a href="videos.php">
                    <img src="public/frontend/assets\images\mobilenav\tv.png" alt="">
                    <br>
                    Videos/TV
                </a>
            </div>
        </div>
    </div>
</div>
<!--mobile nav ends-->
