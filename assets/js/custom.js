/*------------------------------------- Onboarding Screen -------------------------------------*/
$(".skip_btn_1").click(function(){
  $("#first").removeClass("active");
  $(".first_slide").removeClass("active");  
  $("#second").addClass("active");
  $(".second_slide").addClass("active");
});
$(".skip_btn_2").click(function(){
 $("#second").removeClass("active");
 $(".second_slide").removeClass("active");
 $("#third").addClass("active");
 $(".third_slide").addClass("active");
});

/*------------------------------------- Show Hide Password -------------------------------------*/
$("#eye ,#eye1").click(function() {
  $(this).toggleClass("fa-eye fa-eye-slash");
  input = $(this).parent().find("input");
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

/*-------------------------------------Faq Section-------------------------------------*/
$('.nested-accordion').find('.comment').slideUp();
$('.nested-accordion').find('h3').click(function(){
  $(this).next('.comment').slideToggle(100);
  $(this).toggleClass('selected');
});

/*-------------------------------------  Currency AND language Checkbox-------------------------------------*/
var $radioButtons = $('#language-screen input[type="radio"],#currency-page input[type="radio"] ,.select-goal input[type="radio"], .change-courses-sec input[type="radio"]');
$radioButtons.click(function() {
  $radioButtons.each(function() {
    $(this).parent().toggleClass('language-sel', this.checked);
  });
});

/*-------------- Slider ------------------*/
$(".seventh-decs-sec-wrap-slider").slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  autoplay: true,
  swipeToSlide: true,
  infinite:true,
  variableWidth: true,
  autoplaySpeed: 2000,
  dots: false,
  arrows:false
});

$(".categories-slider").slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  autoplay: true,
  swipeToSlide: true,
  infinite:true,
  variableWidth: true,
  autoplaySpeed: 2000,
  dots: false,
  arrows:false
});

$(".home-release-bottom-sec").slick({
  slidesToShow: 2,
  slidesToScroll: 1,
  autoplay: true,
  swipeToSlide: true,
  infinite:true,
  autoplaySpeed: 2000,
  dots: false,
  arrows:false
});

$(".home-mentor-bottom").slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  autoplay: true,
  swipeToSlide: true,
  infinite:true,
  variableWidth: true,
  autoplaySpeed: 2000,
  dots: false,
  arrows:false
});

$(".trending-course-bottom-wrap").slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  autoplay: true,
  swipeToSlide: true,
  infinite:true,
  variableWidth: true,
  autoplaySpeed: 2000,
  dots: false,
  arrows:false
});

$('.payment-method-checkoutpage-full, .insta_type_wrap').slick({
  slidesToShow: 4.5,
  slidesToScroll: 1,
  swipeToSlide: true,
  infinite: false,
  autoplay: false,
  variableWidth: true,
  autoplaySpeed: 2000,
  speed: 300,
  dots: false,
  arrows:false
});

/*------------------------------------- Bookmark-------------------------------------*/
$('.item-bookmark').on('click',function(){
  $(this).toggleClass('active');
}); 

/*------------------------------------- Mentor follow -------------------------------------*/
$(document).ready(function() {
  $(".mentor-select input").click(function() {
    var content = $(this);
    if (content.is(":checked")) {
      $(this).parent().addClass("active");
      $(this).parent().siblings().children(".custom-radio-sel-friend").addClass("active");
    }
    else {
      $(this).parent().siblings().children(".custom-radio-sel-friend").removeClass("active");
      $(this).parent().removeClass("active");
    }
    if ($(this).parent().hasClass('active')) { 

      $(this).parent().children(".custom-radio-sel-friend").text("Follow");
    } else {
      $(this).parent().children(".custom-radio-sel-friend").text("Following")
    }
  });
});

/*------------------------------------- Payment Tabbar -------------------------------------*/
$(".payment-mode .check-select-mode input[type='radio']").change(function(){
  var item=$(this);    
  if(item.is(":checked"))
  {
    window.location.href= item.data("target")
  }    
});

$('.insta_type_wrap div:first').addClass('active');
$('.hero-heading div:first').siblings("div").hide();
$('.hero-heading div:first').show();

$('.insta_type_wrap a').click(function(){

  $('.insta_type_wrap a').removeClass('active');
  $(this).addClass('active');
  $('.hero-heading div:first').hide();
  $('.hero-heading div:first').siblings("div").hide();

  var activeTab = $(this).attr('href');
  $(activeTab).show();
  return false;
}); 

/*-------------------------------------  Sticky Header-------------------------------------*/
$(window).scroll(function(){
  if ($(window).scrollTop() >= 20) {
    $('#top-header ,#top-navbar').addClass('fixed');
  }
  else {
    $('#top-header ,#top-navbar').removeClass('fixed');
  }
});

/*------------------------------------- Progress bar -------------------------------------*/
$(".circle_percent").each(function() {
  var $this = $(this),
  $dataV = $this.data("percent"),
  $dataDeg = $dataV * 3.6,
  $round = $this.find(".round_per");
  $round.css("transform", "rotate(" + parseInt($dataDeg + 180) + "deg)"); 
  $this.append('<div class="circle_inbox"><span class="percent_text"></span></div>');
  $this.prop('Counter', 0).animate({Counter: $dataV},
  {
    duration: 2000, 
    easing: 'swing', 
    step: function (now) {
      $this.find(".percent_text").text(Math.ceil(now)+"%");
    }
  });
  if($dataV >= 51){
    $round.css("transform", "rotate(" + 360 + "deg)");
    setTimeout(function(){
      $this.addClass("percent_more");
    },1000);
    setTimeout(function(){
      $round.css("transform", "rotate(" + parseInt($dataDeg + 180) + "deg)");
    },1000);
  } 
});

/*-------------------------------------OTP Section-------------------------------------*/
if(jQuery('#otp').length > 0)
  $('.digit-group').find('input').each(function() {
    $(this).attr('maxlength', 1);
    $(this).on('keyup', function(e) {
      var thisVal = $(this).val();
      var parent = $($(this).parent());

      if(e.keyCode === 8 || e.keyCode === 37) {
        var prev = parent.find('input#' + $(this).data('previous'));

        if(prev.length) {
          $(prev).select();
        }
      } else {
        var next = parent.find('input#' + $(this).data('next'));

        if(!$.isNumeric(thisVal))
        {
          $(this).val('');
          return false;
        }

        if(next.length) {
          $(next).select();
        } else {
          if(parent.data('autosubmit')) {
            parent.submit();
          }
        }
      }
    });
  });

/*------------------------------------- Redirect link -------------------------------------*/
$(".redirect-mentor").wrap('<a href="single-mentor.html"></a>');
$(".single-course").wrap('<a href="single-course-description-screen.html"></a>');
$(".chat-screen-redirect").wrap('<a href="single-chat-screen.html"></a>');
$(".category-redirect").wrap('<a href="single-course-ongoing.html"></a>');
$(".complete-course").wrap('<a href="single-course-complete.html"></a>');
$(".business-course").wrap('<a href="business.html"></a>');

/*------------------------------------- Preloader -------------------------------------*/
$(window).on("load" , function () {
  $('.circle').fadeOut();
  $('.loader-mask').delay(350).fadeOut('slow');
});

$(window).on("load" , function () {
  $('.loader-mask1').delay(2000).fadeOut(3000);
});

/*------------------------------------- Light Dark Mode -------------------------------------*/
jQuery('.theme-change').on('click',function(){
  jQuery('.site-content').toggleClass('theme-dark'); 
  if(jQuery('.site-content').hasClass('theme-dark')){ 
   
    location.replace("../dark-mode/onboarding-screen.html")
  }else{ 
      location.replace("../light-mode/onboarding-screen.html")
  }
});