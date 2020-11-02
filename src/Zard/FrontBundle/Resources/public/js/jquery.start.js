var timeAbout;

$(window).resize(function(){
  if($(window).width() < 767){
    $('#about').height('auto')
  }else{
    $('#about').height('100vh')
  }
});

$(document).ready(function () {

  localStorage = window.localStorage;
  
  var object = JSON.parse(localStorage.getItem("menu"));
  var dateString = object.timestamp;
  var now = new Date().getTime().toString();
  var diff = timeDiff(dateString , now);

  

  localStorage = window.localStorage;
  var menuStatus = localStorage.getItem('menu');
  
  if(diff == 'seconds'){
    setTimeout(function(){
      $('#btn-menu').click();
      localStorage.removeItem('menu');
    },80);
  }

  var animation = true;
  $(document).on('click', '#btn-menu', function () {
    const about = $('#about');

    if (animation) {
      $(this).toggleClass('close');
      $('#about > div').toggleClass('show-f');
    }

    if (animation) {
      if (about.hasClass('show')) {
        animation = false;
        about.css('opacity', 1);
        about.css('display', 'initial');
        setTimeout(() => {
          about.css('opacity', 0);
        }, 800);
        setTimeout(() => {
          about.removeAttr('style');
          about.removeClass('show');
          animation = true;
        }, 1300);
        $('.btn-header').css('justify-content','flex-end');
        $('.languages').hide();
        var dataMenu = {menu: "close", timestamp: new Date().getTime()}
        localStorage.setItem("menu", JSON.stringify(dataMenu));
      } else {
        $('.btn-header').css('justify-content','space-between');
        $('.languages').show();
        about.toggleClass('show');
        setTimeout(function () {
          if (about.height() <= $(window).height()) {
            about.css('height', '100vh');
          } else {
            about.css('height', 'auto');
          }
        }, 20);
        var dataMenu = {menu: "open", timestamp: new Date().getTime()}
        localStorage.setItem("menu", JSON.stringify(dataMenu));
      }
    }
  });

  var time;
  var inBtnSlider = false;
  $('.owl-carousel').mousemove(function () {
    clearTimeout(time);
    $('.btn-left').addClass('show-btn');
    $('.btn-right').addClass('show-btn');
    if (!inBtnSlider) {
      time = setTimeout(() => {
        $('.btn-left').toggleClass('show-btn');
        $('.btn-right').toggleClass('show-btn');
      }, 2000);
    }
  });
  setTimeout(() => {
    $(".btn-left, .btn-right").on("mouseover", function () {
      $('.btn-left').addClass('show-btn');
      $('.btn-right').addClass('show-btn');
      inBtnSlider = true
    });
    $(".btn-left, .btn-right").on("mouseleave", function () {
      inBtnSlider = false;
    });
  }, 500);

  $(".owl-carousel").on('initialized.owl.carousel', function (event) {
    var current = event.item.index;
    var idProject = $(event.target).find(".owl-item").eq(current).find('.item').attr("data-project");
    $(".project-desc").removeClass("active");
    $(".projects").find(".project-desc[data-project='" + idProject + "']").addClass('active');
  });

  var owl = $(".owl-carousel").owlCarousel({
    animateIn: 'fadeIn',
    animateOut: 'fadeOut',
    autoplay: true,
    autoplayHoverPause: false,
    dots: false,
    items: 1,
    autoplayTimeout:7000,
    lazyLoad: true,
    loop: true,
    nav: true,
    navText: ["<div class='btn-left'></div>", "<div class='btn-right'></div>"],
  });

  owl.on('translate.owl.carousel', function (event) {
    var current = event.item.index;
    var idProject = $(event.target).find(".owl-item").eq(current).find('.item').attr("data-project");
    $(".project-desc").removeClass("active");
    $(".projects").find(".project-desc[data-project='" + idProject + "']").addClass('active');
  });

  $('.languages .lang').click(function(){
    var lang = $(this).attr('data-lang');
  });
});

function timeDiff(curr, prev) { 
  var ms_Min = 60 * 1000; // milliseconds in Minute 
  var ms_Hour = ms_Min * 60; // milliseconds in Hour 
  var ms_Day = ms_Hour * 24; // milliseconds in day 
  var ms_Mon = ms_Day * 30; // milliseconds in Month 
  var ms_Yr = ms_Day * 365; // milliseconds in Year 
  var diff = curr - prev; //difference between dates. 
  // If the diff is less then milliseconds in a minute 
  if (diff < ms_Min) { 
      return 'seconds';
      // If the diff is less then milliseconds in a Hour 
  } else if (diff < ms_Hour) { 
      return 'minutes';
      // If the diff is less then milliseconds in a day 
  } else if (diff < ms_Day) { 
      return 'horas';
      // If the diff is less then milliseconds in a Month 
  } else if (diff < ms_Mon) { 
      return 'Month';
      // If the diff is less then milliseconds in a year 
  } else if (diff < ms_Yr) { 
      return 'years';
  } 
} 