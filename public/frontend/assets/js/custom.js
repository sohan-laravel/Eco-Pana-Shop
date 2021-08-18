// Init AOS
function aos_init() {
  AOS.init({
    duration: 1000,
    easing: "ease-in-out",
    once: true
  });
}
$(window).on('load', function () {
  aos_init();
});

(jQuery);


$(document).ready(function () {
  // executes when HTML-Document is loaded and DOM is ready

  // breakpoint and up  
  $(window).resize(function () {
    if ($(window).width() >= 980) {

      // when you hover a toggle show its dropdown menu
      $(".navbar .dropdown-toggle").hover(function () {
        $(this).parent().toggleClass("show");
        $(this).parent().find(".dropdown-menu").toggleClass("show");
      });

      // hide the menu when the mouse leaves the dropdown
      $(".navbar .dropdown-menu").mouseleave(function () {
        $(this).removeClass("show");
      });

      // do something here
    }
  });



  // document ready  
});

/* SLIDE ON CLICK */

$('.carousel-indicators > li > a').click(function () {

  // grab href, remove pound sign, convert to number
  var item = Number($(this).attr('href').substring(1));

  // slide to number -1 (account for zero indexing)
  $('#myCarousel').carousel(item - 1);

  // remove current active class
  $('.carousel-indicators .active').removeClass('active');

  // add active class to just clicked on item
  $(this).parent().addClass('active');

  // don't follow the link
  return false;
});

/* AUTOPLAY NAV HIGHLIGHT */

// bind 'slid' function
$('#myCarousel').bind('slid', function () {

  // remove active class
  $('.carousel-indicators .active').removeClass('active');

  // get index of currently active item
  var idx = $('#myCarousel .item.active').index();

  // select currently active item and add active class
  $('.carousel-indicators li:eq(' + idx + ')').addClass('active');

});




$('.owl-carousel').owlCarousel({
  loop: true,
  margin: 10,
  nav: false,
  navText: [
    "<i class='fa fa-caret-left'></i>",
    "<i class='fa fa-caret-right'></i>"
  ],
  autoplay: true,
  autoplayTimeout: 9000,
  dots: false,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 2
    },
    1000: {
      items: 3
    }
  }
})


// Smooth scroll for the navigation menu and links with .scrollto classes
var scrolltoOffset = $('#header').outerHeight() - 1;
$(document).on('click', '.nav-menu a, .mobile-nav a, .scrollto', function(e) {
  if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
    var target = $(this.hash);
    if (target.length) {
      e.preventDefault();

      var scrollto = target.offset().top - scrolltoOffset;

      if ($(this).attr("href") == '#header') {
        scrollto = 0;
      }

      $('html, body').animate({
        scrollTop: scrollto
      }, 1500, 'easeInOutExpo');

      if ($(this).parents('.nav-menu, .mobile-nav').length) {
        $('.nav-menu .active, .mobile-nav .active').removeClass('active');
        $(this).closest('li').addClass('active');
      }

      if ($('body').hasClass('mobile-nav-active')) {
        $('body').removeClass('mobile-nav-active');
        $('.mobile-nav-toggle i').toggleClass('icofont-navigation-menu icofont-close');
        $('.mobile-nav-overly').fadeOut();
      }
      return false;
    }
  }
});

// Activate smooth scroll on page load with hash links in the url
$(document).ready(function() {
  if (window.location.hash) {
    var initial_nav = window.location.hash;
    if ($(initial_nav).length) {
      var scrollto = $(initial_nav).offset().top - scrolltoOffset;
      $('html, body').animate({
        scrollTop: scrollto
      }, 1500, 'easeInOutExpo');
    }
  }
});

// Navigation active state on scroll
var nav_sections = $('section');
var main_nav = $('.nav-menu, .mobile-nav');

$(window).on('scroll', function() {
  var cur_pos = $(this).scrollTop() + 200;

  nav_sections.each(function() {
    var top = $(this).offset().top,
      bottom = top + $(this).outerHeight();

    if (cur_pos >= top && cur_pos <= bottom) {
      if (cur_pos <= bottom) {
        main_nav.find('li').removeClass('active');
      }
      main_nav.find('a[href="#' + $(this).attr('id') + '"]').parent('li').addClass('active');
    }
    if (cur_pos < 300) {
      $(".nav-menu ul:first li:first, .mobile-menu ul:first li:first").addClass('active');
    }
  });
});

// Mobile Navigation
if ($('.nav-menu').length) {
  var $mobile_nav = $('.nav-menu').clone().prop({
    class: 'mobile-nav d-lg-none'
  });
  $('body').append($mobile_nav);
  $('body').prepend('<button type="button" class="mobile-nav-toggle d-lg-none"><i class="icofont-navigation-menu"></i></button>');
  $('body').append('<div class="mobile-nav-overly"></div>');

  $(document).on('click', '.mobile-nav-toggle', function(e) {
    $('body').toggleClass('mobile-nav-active');
    $('.mobile-nav-toggle i').toggleClass('icofont-navigation-menu icofont-close');
    $('.mobile-nav-overly').toggle();
  });

  $(document).on('click', '.mobile-nav .drop-down > a', function(e) {
    e.preventDefault();
    $(this).next().slideToggle(300);
    $(this).parent().toggleClass('active');
  });

  $(document).click(function(e) {
    var container = $(".mobile-nav, .mobile-nav-toggle");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
      if ($('body').hasClass('mobile-nav-active')) {
        $('body').removeClass('mobile-nav-active');
        $('.mobile-nav-toggle i').toggleClass('icofont-navigation-menu icofont-close');
        $('.mobile-nav-overly').fadeOut();
      }
    }
  });
} else if ($(".mobile-nav, .mobile-nav-toggle").length) {
  $(".mobile-nav, .mobile-nav-toggle").hide();
}

// Toggle .header-scrolled class to #header when page is scrolled
$(window).scroll(function() {
  if ($(this).scrollTop() > 100) {
    $('#header').addClass('header-scrolled');
    $('#topbar').addClass('topbar-scrolled');
  } else {
    $('#header').removeClass('header-scrolled');
    $('#topbar').removeClass('topbar-scrolled');
  }
});

if ($(window).scrollTop() > 100) {
  $('#header').addClass('header-scrolled');
  $('#topbar').addClass('topbar-scrolled');
}
