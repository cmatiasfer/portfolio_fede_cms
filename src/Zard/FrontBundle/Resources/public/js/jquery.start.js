var timeAbout;

$(window).resize(function(){
  if($(window).width() < 767){
    $('#about').height('auto')
  }else{
    $('#about').height('100vh')
  }
});

$(document).ready(function () {

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
          console.log("fire opacity")
          about.css('opacity', 0);
        }, 800);
        setTimeout(() => {
          about.removeAttr('style');
          about.removeClass('show');
          animation = true;
        }, 1300);
        $('.btn-header').css('justify-content','flex-end');
        $('.languages').hide();
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
    console.log("a");
    console.log(event);
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