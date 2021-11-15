<!-- Footer -->
<footer>
    <div class="container">
        <div class="main-footer">
            <div class="row">
                <div class="col-lg-4 col-md-6 white">
                    <div class="footer-logo">
                        <img src="{{ asset('public/frontend/assets\images\janatakoonline_com\janatakoonline-1601880565832360d1eca69c8d1cea7c09713b3313654New Project (1).png') }}" alt="">
                    </div>
                    <div class="site-detail">
                        <ul>
                            <li> <img src="{{ asset('public/frontend/assets/images/meeting-point.png') }}" class="img-fluid" alt=""> <span class="site-info">{{$companyinfo->address}}</span></li>
                            <li> <img src="{{ asset('public/frontend/assets/images/customer-service.png') }}" class="img-fluid" alt=""> <span class="site-info">{{ $companyinfo->phone }}</span></li>
                            <li> <img src="{{ asset('public/frontend/assets/images/email.png') }}" class="img-fluid" alt=""> <span class="site-info"> {{ $companyinfo->email }}</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3">
                    <h5 class="cat-title">CATEGORIES</h5>
                    <ul class="cat-list">
                        @php $categories = \App\Models\Category::where('parent_id', 0)->take(4)->get(); @endphp
                        @foreach($categories as $cat_foot)
                        <li><a href="{{ route('categoryNews', $cat_foot->slug) }}">{{ $cat_foot->category_name_np }}</a></li>
                            @endforeach
                    </ul>
                </div>
                <div class="col-lg-2 col-md-3">
                    <h5 class="cat-title">SOCIAL MEDIA</h5>
                    <ul class="social">
                        <div class="row">
                            <li class="icons">
                                <div class="col-2">
                                    <a href="{{ $social->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                </div>
                                <div class="col-10">
                                    <a href="{{ $social->facebook }}" target="_blank">Facebook</a>
                                </div>
                            </li>
                            <li class="icons">
                                <div class="col-2">
                                    <a href="{{ $social->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
                                </div>
                                <div class="col-10">
                                    <a href="{{ $social->instagram }}" target="_blank">Instagram</a>
                                </div>
                            </li>
                            <li class="icons">
                                <div class="col-2">
                                    <a href="{{ $social->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a>
                                </div>
                                <div class="col-10">
                                    <a href="{{ $social->twitter }}" target="_blank">Twitter</a>
                                </div>
                            </li>
                            <li class="icons">
                                <div class="col-2">
                                    <a href="{{ $social->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a>
                                </div>
                                <div class="col-10">
                                    <a href="{{ $social->youtube }}" target="_blank">Youtube</a>
                                </div>
                            </li>

                        </div>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-12 newsletter-list">
                    <h5 class="cat-title">NEWSLETTER</h5>
                    <form action="javascript:" type="post">
                        <input onfocus="enableSubscriber()" onfocusout="checkSubscriber()" type="email" name="subscriber_email" id="subscriber_email" placeholder="Subscribe Our Newsletter" class="newsletter-box">
                        <button class="news-submit" onclick="checkSubscriber(); addSubscriber();">Join</button>
                        <div  id="statusSuscribe" style=" padding-top: 10px;"></div>
                    </form>
                    <ul>
                        <li><a href="javscript:"><img src="{{ asset('public/frontend/assets/images/appstore.png') }}" alt="download"></a></li>
                        <li><a href="javscript:"><img src="{{ asset('public/frontend/assets/images/playstore.png') }}" alt="download"></a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <div class="copyright-wrapper">
        <div class="container">
            <p class="text-center copyright">Janatako online @ 2021, All Rights Reserved</p>
        </div>
    </div>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-605c698f11014dd4"></script>
<!-- <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=611921ce24e1d800128eae30&product=inline-share-buttons' async='async'></script> -->
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js"></script>
<!-- <script src="assets/js/jquery.unveil.js"></script> -->
<script src="{{ asset('public/frontend/assets/js/custom.js') }}"></script>

<script>
    function checkSubscriber(){
        var subscriber_email = $("#subscriber_email").val();
        $.ajax({
            type: 'post',
            url: '{{ route('checkSubscriber') }}',
            data: {subscriber_email:subscriber_email},
            success: function(resp){
                if(resp == "exists"){
                    $("#statusSuscribe").show();
                    $("#news-submit").hide();
                    $("#statusSuscribe").html("<span style='color: red'> <br> Subscribe Email already exists</span>");
                }
            }, error: function(){
            }

        })
    }

    function addSubscriber(){
        var subscriber_email = $("#subscriber_email").val();
        $.ajax({
            type: 'post',
            url: '{{ route('addSubscriber') }}',
            data: {subscriber_email:subscriber_email},
            success: function(resp){
                if(resp === "exists"){
                    $("#statusSuscribe").show();
                    $("#btnSubmit").hide();
                    $("#statusSuscribe").html("<span style='color: red'> <br> Subscribe Email already exists</span>");
                } else if(resp === "saved"){
                    $("#statusSuscribe").show();
                    $("#statusSuscribe").html("<span> <br> <font color='green'> Subscribed Successfully </font> </span>");
                }
            }, error: function(){
            }

        })
    }

    function enableSubscriber() {
        $("#btnSubmit").show();
        $("#statusSuscribe").hide();

    }


    //like and dislike through ajax call news
    $(document).ready(function () {
      $('.like').on('click', function(event) {
        event.preventDefault();
        var isLike = event.target.previousElementSibling == null ? true : false;
        var postId = event.target.id;
        // console.log(isLike);
        // console.log(event.target.id);
        $.ajax({
            method: 'post',
            url: '{{ route('like') }}', 
            data: {
                isLike: isLike,
                postId: postId,
                _token: "{{ csrf_token() }}"
            }
        })
          .done(function(data) {
            console.log(data.message);
            if (data.user_logedin == false) {
                var r = confirm('Like this video? \n Sign in to make your opinion count');
                if (r == true) {
                    window.location = '{{ route('userLogin') }}';
                } 
            }
            else{
                $('#like-count' + event.target.id).html(data.likes);
                $('#dislike-count' + event.target.id).html(data.dislikes);

            //     if(isLike == true){

            //         if (event.target.style.color ='blue') {
            //             event.target.style.color='black';
            //         } 
            //         else {
            //             event.target.style.color='blue';
            //             // event.target.nextElementSibling.style.color='black';
            //         }
            //     }
            //     else if(isLike == false) {
            //         if (event.target.style.color ='blue') {
            //             event.target.style.color='black';
            //         } 
            //         else if(event.target.style.color ='black'){
            //             event.target.style.color='blue';
            //             console.log(event.target.previousElementSibling)
            //             event.target.previousElementSibling.style.color='black';
            //         }
            //     }
            }

           
          });
      });
    });


    
     //like and dislike through ajax call janatanews
    $(document).ready(function () {
      $('.likejanata').on('click', function(event) {
        event.preventDefault();
        var isLike = event.target.previousElementSibling == null ? true : false;
        var postId = event.target.id;
        // console.log(isLike);
        // console.log(event.target.id);
        $.ajax({
            method: 'post',
            url: '{{ route('likeJanata') }}', 
            data: {
                isLike: isLike,
                postId: postId,
                _token: "{{ csrf_token() }}"
            }
        })
          .done(function(data) {
            console.log(data.message);
            if (data.user_logedin == false) {
                var r = confirm('Like this video? \n Sign in to make your opinion count');
                if (r == true) {
                    window.location = '{{ route('userLogin') }}';
                } 
            }
            else{
                $('#like-count' + event.target.id).html(data.likes);
                $('#dislike-count' + event.target.id).html(data.dislikes);

                // if(isLike == true){

                // if (event.target.style.color ='blue') {
                //     event.target.style.color='black';
                // } 
                // else {
                //     event.target.style.color='blue';
                //     // event.target.nextElementSibling.style.color='black';
                // }}
                // else if(isLike == false) {
                //     if (event.target.style.color ='blue') {
                //         event.target.style.color='black';
                //     } 
                //     else if(event.target.style.color ='black'){
                //         event.target.style.color='blue';
                //         console.log(event.target.previousElementSibling)
                //         event.target.previousElementSibling.style.color='black';
                //     }
                // }
            }

           
          });
      });
    });
</script>

@yield('front_js')
</body>

</html>
