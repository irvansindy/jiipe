



(function($) {

  'use strict';

  

  //===== Main Menu

  function mainMenu() {

    // Variables

    var var_window = $(window),

        navContainer = $('.header-navigation'),

        navbarToggler = $('.navbar-toggler'),

        navMenu = $('.nav-menu'),

        navMenuLi = $('.nav-menu ul li ul li'),

        closeIcon = $('.navbar-close');

    // navbar toggler

    navbarToggler.on('click', function() {

        navbarToggler.toggleClass('active');

        navMenu.toggleClass('menu-on');

    });

    // close icon

    closeIcon.on('click', function() {

        navMenu.removeClass('menu-on');

        navbarToggler.removeClass('active');

    });

    // adds toggle button to li items that have children

    navMenu.find('li a').each(function() {

        

        if ($(this).next().length > 0) {

            //$(this).parent('li').append('<span class="dd-trigger"><i class="far fa-angle-down"></i></span>');

            $(this).addClass('dd-trigger');

        }

    });

    // expands the dropdown menu on each click

    navMenu.find('a.dd-trigger').on('click', function(e) {

        e.preventDefault();

        //console.log('expands the dropdown menu on each click');

        $(this).parent('li').children('ul').stop(true, true).slideToggle(350);

        $(this).parent('li').toggleClass('active');

    });

    // check browser width in real-time

    function breakpointCheck() {

        var windoWidth = window.innerWidth;

        if (windoWidth <= 1199) {

            navContainer.addClass('breakpoint-on');

        } else {

            navContainer.removeClass('breakpoint-on');

        }

    }

    breakpointCheck();

    var_window.on('resize', function() {

        breakpointCheck();

    });

  };

  

   

  // Document Ready

  $(document).ready(function() {

    mainMenu();





    jQuery.validator.addMethod('noemail', function (value) {

        //return /^([\w-.]+@(?!gmail\.com)(?!yahoo\.com)(?!hotmail\.com)(?!mail\.ru)(?!yandex\.ru)(?!mail\.com)([\w-]+.)+[\w-]{2,4})?$/.test(value);
    	return /^([\w-.]+@(?!gmail\.com)(?!yahoo\.com)(?!yahoo\.co.id)(?!hotmail\.com)(?!mail\.ru)(?!yandex\.ru)(?!mail\.com)(?!live.com)(?!outlook.com)(?!outlook.co.id)([\w-]+.)+[\w-]{2,4})?$/.test(value);
    
    }, 'Please enter your company email address.');





    $("#contactForm").validate({

        highlight: function (input) {

            $(input).parents('.form-line').addClass('error');

        },

        unhighlight: function (input) {

            $(input).parents('.form-line').removeClass('error');

        },

        errorPlacement: function (error, element) {

            $(element).parents('.form-group').append(error);

        },

		rules: {

            username: {

                noemail: true

            }

        },

    });

    $("#CareerNewForm").validate({

        highlight: function (input) {

            $(input).parents('.form-line').addClass('error');

        },

        unhighlight: function (input) {

            $(input).parents('.form-line').removeClass('error');

        },

        errorPlacement: function (error, element) {

            $(element).parents('.form-group').append(error);

        },

    });

  });



  $('.navigasi-box').find('li.has-children a[href^="#"]').on('click', function(e) {

        e.preventDefault();

        return false;

    });



  $(window).on('scroll', function(event) {

      var scroll = $(window).scrollTop();

      if (scroll < 10) {

          $(".header-navigation").removeClass("sticky");

      } else {

          $(".header-navigation").addClass("sticky");

      }

  });

    //===== Sticky

    $(window).on('scroll', function(event) {

        var scroll = $(window).scrollTop();

        if (scroll < 10) {

            $(".header-navigation").removeClass("sticky");

        } else {

            $(".header-navigation").addClass("sticky");

        }

    });

  //===== Back to top

    $(window).on('scroll', function(event) {

        if ($(this).scrollTop() > 600) {

            $('.back-to-top').fadeIn(200)

        } else {

            $('.back-to-top').fadeOut(200)

        }

    });

    $('.back-to-top').on('click', function(event) {

        event.preventDefault();

        $('html, body').animate({

            scrollTop: 0,

        }, 1500);

    });



    /*$(document).on('click', 'a[href^="#"]', function (event) {

        event.preventDefault();

    

        $('html, body').animate({

            scrollTop: $($.attr(this, 'href')).offset().top

        }, 500);

    });*/
    //===== Slick slider js



    $('.patner-slider').slick({

        dots: false,

		arrows: true,

        infinite: true,

        centerPadding: "0px",

		autoplaySpeed: 3800,

        autoplay: true,

		slidesToShow: 5,

        slidesToScroll: 1,

        draggable: true,

        accessibility: false,

        centerMode: true,

        variableWidth: true,

        swipeToSlide: true,

        responsive: [

            {

                breakpoint: 767,

                settings: {

                    slidesToShow: 1,

                    dots: false,

		            arrows: false,

                }

            },

            {

                breakpoint: 991,

                settings: {

                    slidesToShow: 1,

                    dots: false,

		            arrows: false,

                }

            }

        ]

    });





    $('#kawasan_wrapper_one').bind('slid.bs.carousel', function (event) {

        //var currentIndex = $('div.carousel-item .active').index();

        //var totalItems = $(this).find('.carousel-item').length;

        var active = $(event.target).find('.carousel-inner > .carousel-item.active');

        var from = active.index();

        var next = $(event.relatedTarget);

        var to = next.index();

        var direction = event.direction;

        

        $('ol.carousel-indicators li.active').removeClass('active');

        $('ol.carousel-indicators li.data_'+ from).addClass('active');

    });



    $('ol.carousel-indicators li.data_0').addClass('active');

                            

    $('ol.carousel-indicators li').on('click', function(){

        var sactiven = parseInt($(this).attr('data-attr'));

        console.log('sactiven '+sactiven);



        $('ol.carousel-indicators li.active').removeClass('active');

        $(this).addClass('active');

        $('#carouselKawasan').carousel(sactiven);

    });





    //Slick Carousel Controllers

    $(".testimonial").slick({

        centerMode: true,

        centerPadding: "0px",

        //dots: true,

        slidesToShow: 3,

        infinite: true,

        arrows: true,

        lazyLoad: "ondemand",

		autoplaySpeed: 2000,

        autoplay: true,

        responsive: [

            {

                breakpoint: 767,

                settings: {

                    slidesToShow: 1,

                    dots:true,

                    arrows:false

                }

            },

            {

                breakpoint: 991,

                settings: {

                    slidesToShow: 1,

                    dots:true,

                    arrows:false

                }

            }

        ]

    });



    

    $(".home-box").on('initialized.owl.carousel', function(property){

        var current = property.item.index;

        $(property.target).find(".owl-item").eq(current).find("video").each(function () {

            this.play();

        });

    });

    var owl = $(".home-box").owlCarousel({

        items: 1,

        loop: true,

        margin: 15,      

        mouseDrag: false,

        touchDrag: false,

        autoplay: true,

        autoplayTimeout: 10000,

        //autoplayHoverPause:true,

        lazyLoad: true,

        dots: false,

        onTranslate: function () {

            //$('.owl-item.active').find('video').each(function () {

            //    this.pause();

            //});

        }

    }).on('changed.owl.carousel',function(property){

        var current = property.item.index;

        var before = property.item.index - 1;

        $(property.target).find(".owl-item").eq(before).find("video").each(function () {

            this.pause();

            this.currentTime = 0;

        });



        $(property.target).find(".owl-item").eq(current).find("video").each(function () {

            this.play();

        });



        

    });



    $(document).ready(function() {

        $('input[type=radio][name="QuickAppointment[reason]"]').change(function() {

            if($(this).val().toLowerCase() === 'other'){

                $('#reason_other_row').removeClass('d-none');

                $('#reason_other').attr("required","required");

            }else{

                $('#reason_other_row').addClass('d-none');

                $('#reason_other').removeAttr("required");

            }

        });



        $('select[name="QuickAppointment[classification]"]').on('change', function() {

            if(this.value.toLowerCase() === 'other'){

                $('#classification_other_row').removeClass('d-none');

                $('#classification_other').attr("required","required");

            }else{

                $('#classification_other_row').addClass('d-none');

                $('#classification_other').removeAttr("required");

            }

        });

    });





    $('.testimonial-list').owlCarousel({

        margin: 60,

        lazyLoad: true,

        autoplay: true,

        autoplayTimeout: 8500,

        autoplayHoverPause:true,

        smartSpeed: 450,

        loop: true,

        center: true,

        items: 3,

        nav: true,

        dots: false,

        mouseDrag: true,

        responsiveClass: true,

        navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],

        responsive:{

            0:{

                items:1,

                nav:false,

                dots:true,

            },

            600:{

                items:1,

                nav:false,

                dots:true,

            },

            800:{

                items:1,

                nav:false,

                dots:true,

            },

            1000:{

                items: 3,

                nav:true,

                dots:false,

            },

            1200:{

                items: 3,

                nav:true,

                dots:false,

            }

        }

   

    });





    $('.videotour-list').owlCarousel({

        margin: 60,

        lazyLoad: true,

        autoplay: false,

        autoplayTimeout: 8500,

        autoplayHoverPause:true,

        smartSpeed: 450,

        loop: true,

        center: true,

        items: 3,

        nav: true,

        dots: false,

        mouseDrag: true,

        responsiveClass: true,

        navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],

        responsive:{

            0:{

                items:1,

                nav:false,

                dots:true,

            },

            600:{

                items:1,

                nav:false,

                dots:true,

            },

            800:{

                items:1,

                nav:false,

                dots:true,

            },

            1000:{

                items: 3,

                nav:true,

                dots:false,

            },

            1200:{

                items: 3,

                nav:true,

                dots:false,

            }

        },

        onTranslate: function(event) {



            

        }

   

    });





    

})(window.jQuery);