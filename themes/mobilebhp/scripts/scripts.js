'use strict';

// Main
(function (window, document, $) {
  'use strict';

  window.mod = {};

  // $(function() {
  //   // Carregando os modulos
  //   window.mod.common = new window.mod.common();
  //
  //   var bodyClasses = $('body').attr('class').split(' ');
  //   $.each(bodyClasses, function(key, val) {
  //     val = val.replace(/[-]/g, '');
  //     if (window.mod[val] !== undefined) {
  //       // console.log(key + ' => ' + val);
  //       window.mod[val] = new window.mod[val]();
  //     }
  //   });
  // });

  //initiate slick slider
  $('.home-slider').slick({
    dots: true,
    arrows: false,
    autoplay: false,
    speed: 1000,
    initialSlide: 0,
    autoplaySpeed: 3000
  });

  //home slider image animation
  $('.home-slider .slick-current').addClass('slick-animate');
  $('.home-slider').slick('slickPlay');
  $('.home-slider').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
    $(slick.$slides[nextSlide]).removeClass('slick-animate');
  });
  $('.home-slider').on('afterChange', function (event, slick, currentSlide, nextSlide) {
    //$(slick.$slides[currentSlide+1]).removeClass('slick-animate');
    $(slick.$slides[currentSlide]).addClass('slick-animate');
  });

  $('.car-slider').slick({
    centerMode: true,
    //centerPadding: '10px',
    slidesToShow: 1,
    variableWidth: true,
    dots: false,
    arrows: false,
    slidesToScroll: 1,
    draggable: true
  });

  $('.other-bhpianslider').slick({
    centerMode: false,
    //centerPadding: '10px',
    slidesToShow: 2,
    variableWidth: true,
    dots: false,
    arrows: false,
    slidesToScroll: 2,
    draggable: true,
    infinite: false
  });

  //search
  $(document).on('click', '.sub-nav .slick-slide', function (e) {
    $(this).siblings().removeClass('selected');
    $(this).addClass('selected');
  });

  //search close
  $(document).on("click", ".search-icon", function(e) {
    e.preventDefault();
    if ($(this).hasClass("gsst_a")) {
      console.log("has class");
      $('.search-wrapper').removeClass('open');
      $('body').removeClass('no-scroll');
      document.getElementById('gsc-i-id1').blur();
    } else {
      window.history.back();
    }
  });

  //submenu sliding links
  $('.slide-content').slick({
    dots: false,
    infinite: false,
    arrows: false,
    variableWidth: true,
    centerMode: false,
    //infinite:true,
    //speed: 300,
    slidesToShow: 3,
    slidesToScroll: 3

  });

  //menu-toggle
  $(document).on('click', '.menu-toggle', function () {
    $('.menu-mobile').toggleClass('open');
    $('body').toggleClass('no-scroll');
  });

  //search page
  $(document).on('click', '.search', function () {
    if ($(this).attr("id") == "clear-close-search") {
      return;
    }

    $('.search-wrapper').toggleClass('open');
    $('body').toggleClass('no-scroll');

      document.getElementById('gsc-i-id1').focus();


    //google search button with text
    //$('td.gsc-search-button').empty().html('<input type="submit" title="search" value="Search" placeholder="Search">');

  });



  //brand-list news
  $('.news-brands').hide();
  $(document).on('click', '.btn-brand', function () {
    // $('#newsListings').removeClass('active');
    $('.news-brands').slideToggle();
    $('.news-category').hide();
    $(this).toggleClass('selectedd');
    $(this).siblings().removeClass('selectedd');

    if ($(this).hasClass('selectedd')) {
      $('#newsListings').addClass('active');
    } else {
      $('#newsListings').removeClass('active');
    }
  });

  $('.news-category').hide();
  $(document).on('click', '.btn-category', function () {
    // $('#newsListings').removeClass('active');
    $('.news-brands').hide();
    $('.news-category').slideToggle();
    $(this).toggleClass('selectedd');
    $(this).siblings().removeClass('selectedd');
    // $('#newsListings').addClass('active');

    if ($(this).hasClass('selectedd')) {
      $('#newsListings').addClass('active');
    } else {
      $('#newsListings').removeClass('active');
    }
  });

  //close brand / category list on clicking listing part
  $(document).on('click', '#newsListings.active', function () {
    $('.news-category, .news-brands').hide();
    $('.btn-category, .btn-brand').removeClass('selectedd');
    $(this).removeClass('active');

    //scroll to top
    $('html, body').animate({ scrollTop: 100 }, 'slow');
    return false;
  });

  //news dropdown get and set value
  $(document).on('click', '.brand-lists a', function () {
    $('.news-brands').hide();
    $('.news-category').hide();

    $('.all-news').removeClass('selectedd');
    $('#newsListings').removeClass('active');

    if ($('.brand-lists').parent().hasClass('news-brands')) {
      // alert($(this).attr('data-brandname'));
      console.log($(this).attr('data-brandname'));
    }

    if ($('.brand-lists').parent().hasClass('news-category')) {
      // alert($(this).attr('data-catname'));
      console.log($(this).attr('data-catname'));
    }

    var selectedBrand = $(this).attr('data-brandname');
    var selectedCategory = $(this).attr('data-catname');

    $('.btn-brand span').text(selectedBrand);
    $('.btn-category span').text(selectedCategory);

    //scroll to top
    $('html, body').animate({ scrollTop: 100 }, 'slow');
    return false;
  });

  //suscribe-popup
  $(document).on('click', '.subscribe, .btn-subscribe, .subscribe-wrapper', function () {
    $('.subscribe-popup').modal('show');
  });

  //confirm-popup
  $(document).on('click', '.btn-subscribelist', function () {
    $('.confirm-popup').modal('show');
    $('.subscribe-popup').modal('hide');
  });

  //contact us
  $('.contact-expanded').hide();
  $(document).on('click', '.btn-contact', function () {
    //$('.contact-expanded').hide();
    $(this).parent().children('.contact-expanded').slideToggle();
    $(this).hide();
  });

  //rtech memorial
  $('.memorial-slider').slick({
    dots: false,
    infinite: true,
    arrows: false,
    variableWidth: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true
  });

  // Home page load more hot thread
  $(document).on('click', '#btn-loademore', function () {
    var taretElm = $(this).attr('data-target');
    $(taretElm).find('.hide').removeClass('hide');
    $(this).hide();
    $(this).next().removeClass('hide');
  });

  //go to top btn in about us
  var gtpOffset = 600;
  var gtpDuration = 300;

  $(window).scroll(function () {
    if ($(this).scrollTop() > gtpOffset) {
      $('.go-to-top').fadeIn(gtpDuration);
    } else {
      $('.go-to-top').fadeOut(gtpDuration);
    }
  });

  //scroll to top
  $(document).on('click', '.go-to-top', function () {
    $('html, body').animate({ scrollTop: 0 }, 'slow');
  });

  //      disable zoom functionality of images
  $(document).find('img.zoomLt').each(function () {

    console.log($(this).attr('rel'));
    console.log($(this).attr('src'));

    //        get rel path of big image
    var imgrelpath = $(this).attr('rel');

    //        replace src with rel path
    $(this).attr('src', imgrelpath).removeAttr('height width');

    //        remove zoom classes
    $('.singlePhoto').removeClass('zoomSingleImg fleft').css('pointer-events', 'none');

    $(document).on('click', '.singlePhoto', function () {

      $(this).removeAttr('style');
    });
  });
})(window, document, jQuery);
'use strict';

// Common
window.mod.common = function () {

  // Scope
  var that = this;

  var init = function init() {
    console.log('[brz] begin common.js');
  };

  init();
};