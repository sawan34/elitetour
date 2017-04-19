( 
  function($){
  $(document).ready(function() {

    $('#myCarousel').carousel({
        interval: 5000
    });

     /*  run scroll to section only
         if body has class page-scroller */
     var pageScroller = $( 'body' ).hasClass( 'page-scroller' );
     if ( pageScroller ) {

       // begin homepage scroll to section
       var $scrollSection = $('.scroll-here');
       var $scrollTrigger = $('.trigger-scroll');
       var nextSection = 1;

       $scrollTrigger.on( 'click', function() {
         $(this).removeClass('go-to-top');

         // If at last section, scroll back to top on next click:
         if (nextSection >= $scrollSection.length) {
           $('html, body').animate({ scrollTop: 0 }, 1000);
           nextSection = 1;
           return;
         }

         // If already scrolled down
         // to find next section position so you don't go backwards:
         while ( $('body').scrollTop() > $($scrollSection[nextSection]).offset().top ) {
           nextSection++;
         }

         // If next section is the last, add class to rotate arrow:
         if (nextSection === ($scrollSection.length - 1)) {
           $(this).addClass('go-to-top');
         }

         // Move to next section and increment counter check:
         $( 'html, body' ).animate({ scrollTop: $($scrollSection[nextSection]).offset().top }, 1000);
         nextSection++;
       });
       // end homepage scroll to section
     }else{
       console.log('page-scroller class was not found in body tag');
     }//end if else



    //grabs the hash tag from the url
    var hash = window.location.hash;
    //checks whether or not the hash tag is set
    if (hash != "") {
      //removes all active classes from tabs
      $('#tabs li').each(function() {
        $(this).removeClass('active');
      });
      $('#my-tab-content .tab-pane').each(function() {
        $(this).removeClass('active');
      });
      //this will add the active class on the hashtagged value
      var link = "";
      $('#tabs li').each(function() {
        link = $(this).find('a').attr('href');
        if (link == hash) {
          $(this).addClass('active');
        }
      });
      $('#my-tab-content .tab-pane').each(function() {
        link = $(this).attr('id');
        if ('#'+link == hash) {
          $(this).addClass('active');
           // $('html, body').animate({scrollTop: .offset().top});
        }
      });
    }


    // -----------form-open-----------

    $(".enqbutton").click(function() {
      $(".form-section").fadeIn();
    });
    $(".tourbutton").click(function() {
      $(".form-section2").fadeIn();
    });
    $(".form-close a").click(function() {
      $(".form-section, .form-section2").fadeOut();
    });


    // ----------page-scroll----------

    $(".blinkbutton a").click(function() {
      $('html, body').animate({
            scrollTop: $( $(this).attr('href') ).offset().top
        }, 800);
        return false;
    });

    $(".tour-tab .tab-content div:first-child").addClass('active2');
      $(".tour-tab .nav-tabs li a").click(function() {
        $(".tour-tab .tab-content div:first-child").removeClass('active2');
      });




      // ------------carousel------------------
      // var img2 = $('.img2');
      // var overlay = $('.overlay');


      // overlay.mousemove(function(e){
      //    var amountMovedX = (e.pageX * -1 / 40);
      //    var amountMovedY = (e.pageY * -1 / 40);
      //        img2.css({
      //  '-webkit-transform' : 'translate3d(' + amountMovedX + 'px,' + amountMovedY + 'px, 0)',
      //  '-moz-transform'    : 'translate3d(' + amountMovedX + 'px,' + amountMovedY + 'px, 0)',
      //  '-ms-transform'     : 'translate3d(' + amountMovedX + 'px,' + amountMovedY + 'px, 0)',
      //  '-o-transform'      : 'translate3d(' + amountMovedX + 'px,' + amountMovedY + 'px, 0)',
      //  'transform'         : 'translate3d(' + amountMovedX + 'px,' + amountMovedY + 'px, 0)'
      //        });

      // });


});
 })(jQuery); 



