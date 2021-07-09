
jQuery(function($) {

  jQuery(".yellow-btn a, [data-animate]").off("click").on("click", function(e) {
    var href = jQuery(this).attr("href");

    var gap = 0;
    if (jQuery("#primary-menu").length) {
      gap += jQuery("#primary-menu").height();
    }

    // if (jQuery("#top_header").length) {
    //   gap += jQuery("#top_header").height() + 100;
    // }

    if (href.indexOf("#") == 0) {
      jQuery("html, body").stop().animate({scrollTop: parseInt(jQuery(href).offset().top) - gap}, 300);
    }

    return false;
  });


  function sticky() {
    if ($(window).scrollTop() > 1) {
      $('.site-header').addClass("sticky-header");            
    } else {
        $('.site-header').removeClass("sticky-header");            
    }
  }

  jQuery(window).on('scroll', function() {
    sticky();
  });
  sticky();
  
    if (jQuery('.banner-slider').length) {
      jQuery('.banner-slider').slick({
        draggable: true,        
        centerMode: true,        
        centerPadding: 0,
        slidesToShow: 1,
        arrows: false,
        dots: false,
        swipeToSlide: true,
        infinite: true,
        fade: true
      });
  
    }
      
    if (jQuery(".image_carousel").length) {
      jQuery('.image_carousel').slick({
        draggable: true,        
        centerMode: true,        
        centerPadding: 0,
        slidesToShow: 1,
        arrows: true,
        dots: true,
        swipeToSlide: true,
        infinite: true,
        asNavFor: ".image_carousel"
      });
    }
  
    if (jQuery(".section3-carousel").length) {
      jQuery('.section3-carousel').slick({
        draggable: true,        
        centerMode: true,        
        centerPadding: 0,
        slidesToShow: 1,
        arrows: true,
        dots: true,
        swipeToSlide: true,
        infinite: true
      });
    }
    
    jQuery("[data-section]").onScreen({
        container: window,
        direction: 'vertical',
        doIn: function() {
            
            var type = jQuery(this).attr("data-type");
            if (type == "counter") {
              jQuery(this).find(".counter-elment").each(function() {
                var upto = jQuery(this).attr('data-upto');
                console.log(upto);
                if (upto) {
                  var count = new CountUp(jQuery(this)[0], parseInt(upto));
                  count.start();
                }        
              });
            }
        },
        doOut: function(e) {
          // Do something to the matched elements as they get off scren
        },
        tolerance: 0,
        throttle: 50,
        toggleClass: 'onScreen',       
        debug: false
     });

     jQuery("a[data-popup]").magnificPopup({
      type: 'image',
      closeOnContentClick: true,
      mainClass: 'mfp-img-mobile',
      image: {
        verticalFit: true
      },
      gallery:{
        enabled:true
      },
    });
    

    var accodions = jQuery(".collapse-wrapper .col-content").hide();
    var heads = jQuery(".collapse-wrapper .col-header");

    jQuery(heads).on("click", function() {
      var item = jQuery(this);
      var target = jQuery(this).next();

      if (!jQuery(this).hasClass("selected")) {
        // heads.removeClass("selected");
        jQuery(this).addClass("selected");

        // accodions.slideUp();
        target.slideDown();      
      } else {
        
        target.slideUp(function() {
          jQuery(item).removeClass("selected");
        });  
      }
    });

    var lazyContent = new LazyLoad({});
    lazyContent.update();
  });
  
  
  window.lazyLoadOptions = {
    
  };
  
  window.addEventListener(
    "LazyLoad::Initialized",
    function (event) {
      window.lazyLoadInstance = event.detail.instance;
    },
    false
  );
  