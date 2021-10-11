


//SCROLL TO TOP
var mybutton = document.getElementById("myBtn");
window.onscroll = function () {
  scrollFunction()
};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

// FIXED NAVBAR
$(window).scroll(function () {
  if ($(this).scrollTop() > 120) {
    $(".header-wrapper").addClass("fixed");
  } else {
    $(".header-wrapper").removeClass("fixed");
  }
});

const $dropdown = $(".dropdown");
const $dropdownToggle = $(".dropdown-toggle");
const $dropdownMenu = $(".dropdown-menu");
const showClass = "show";

$(window).on("load resize", function () {
  if (this.matchMedia("(min-width: 768px)").matches) {
    $dropdown.hover(
      function () {
        const $this = $(this);
        $this.addClass(showClass);
        $this.find($dropdownToggle).attr("aria-expanded", "true");
        $this.find($dropdownMenu).addClass(showClass);
      },
      function () {
        const $this = $(this);
        $this.removeClass(showClass);
        $this.find($dropdownToggle).attr("aria-expanded", "false");
        $this.find($dropdownMenu).removeClass(showClass);
      }
    );
  } else {
    $dropdown.off("mouseenter mouseleave");
  }
});
// HEADER SEARCH
$(document).ready(function () {
  $(".fa-search").click(function () {
    $(".togglesearch").toggle();
    $("input[type='text']").focus();
  });

});


//NEWS SEARCH BAR IN HEADER
$(document).ready(function () {
  $('.test-div').hide();

  $(".sicon").click(function () {
    $(".test-div").slideToggle();
  });

  $(".gone").click(function () {
    $(".test-div").slideToggle();
  });
});


//VIDEO SEARCH BAR
$(document).ready(function () {
  $('.video-div').hide();

  $(".video-search").click(function () {
    $(".video-div").slideToggle();
  });

  $(".close-video-search").click(function () {
    $(".video-div").slideToggle();
  });
});


// FIXED NAVBAR
$(window).scroll(function () {
  if ($(this).scrollTop() > 140) {
    $('.site-header .blue').addClass('fixed');
  } else {
    $('.site-header .blue').removeClass('fixed');
  }
});

// GOOGLE TRANSLATE
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'en'
  }, 'google_translate_element');
}


// SIDE NAV
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}



//FOR SIDENAV DROPDOWN
$(".feat-btn").click(function () {
  $("nav ul .feat-show").toggleClass("show");
  $("nav ul .first").toggleClass("rotate");
});
$(".samachar-btn").click(function () {
  $("nav ul .samachar-show").toggleClass("show1");
  $("nav ul .second").toggleClass("rotate");
});
$(".jeewan-btn").click(function () {
  $("nav ul .jeewan-show").toggleClass("show2");
  $("nav ul .third").toggleClass("rotate");
});
$(".artha-btn").click(function () {
  $("nav ul .artha-show").toggleClass("show3");
  $("nav ul .fourth").toggleClass("rotate");
});
$(".suchana-btn").click(function () {
  $("nav ul .suchana-show").toggleClass("show4");
  $("nav ul .fifth").toggleClass("rotate");
});
$(".khelkud-btn").click(function () {
  $("nav ul .khelkud-show").toggleClass("show5");
  $("nav ul .sixth").toggleClass("rotate");
});
$(".kala-btn").click(function () {
  $("nav ul .kala-show").toggleClass("show6");
  $("nav ul .seventh").toggleClass("rotate");
});
$(".bichar-btn").click(function () {
  $("nav ul .bichar-show").toggleClass("show7");
  $("nav ul .eight").toggleClass("rotate");
});

// IMAGE DRAG AND DROP
function dragNdrop(event) {
  var fileName = URL.createObjectURL(event.target.files[0]);
  var preview = document.getElementById("preview");
  var previewImg = document.createElement("img");
  previewImg.setAttribute("src", fileName);
  preview.innerHTML = "";
  preview.appendChild(previewImg);
}

function drag() {
  document.getElementById('uploadFile').parentNode.className = 'draging dragBox';
}

function drop() {
  document.getElementById('uploadFile').parentNode.className = 'dragBox';
}
// SUMMERNOTE EDITOR
$(document).ready(function () {
  $('textarea#body').summernote({
    height: '300px'
  });
});


// carousel
$('.image-wrapper .owl-carousel').owlCarousel({
  loop: true,
  margin: 10,
  nav: true,
  video: true,
  videoHeight: 300,
  videoWidth: 700,
  merge: true,
  lazyLoad: true,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 1
    },
    1000: {
      items: 1
    }
  }
});

function tooltip (btn, tool) {
  var btn = document.getElementById(btn);  // El The button.
  var tool = document.getElementById(tool);  // El tooltip.
  var open = false;

  //I prevent the tooltip from closing if I click on the tooltip.
   tool.addEventListener('click', function(event){
        event.stopPropagation();
   });

  btn.addEventListener('click', function(event){
     event.stopPropagation();
     // If it was Closed.
     if(!open){
        tool.classList.add('opened');
        open = true;
        // When I click anywhere on the page.
        document.addEventListener('click', hide);
     // If it was opened.
     }else{
        // 
        tool.classList.remove('opened');
        open = false;
        // 
// I remove the event that causes the tooltip to close when clicking on any part of the document.
        document.removeEventListener('click', hide);
     }
  });
  //Function to hide the tooltip if I click anywhere in the document.
  function hide () {
     // I hide the tooltip.
     tool.classList.remove('opened');
     open = false;
     // I remove the event so that it does not spend so many computer resources.
     document.removeEventListener('click', hide);
     
     console.log('Click anywhere and hide the Tooltip');
  }

}


  // $(document).ready(function() {
    
  // })

tooltip('tooltip-open', 'tooltipid');
tooltip('tooltip-open2', 'tooltipid2');
tooltip('tooltip-open3', 'tooltipid3');



// $('.dislike').on('click', function(event) {
   // event.preventDefault();
   //  var isLike = event.target.previousElementSibling == null ? true : false;
   //  console.log(isLike);
  
// });

