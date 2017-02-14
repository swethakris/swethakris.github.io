jQuery('#owl-portfolio').owlCarousel({
    loop:true,
    margin:30,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
})

jQuery('#owl-testimonial').owlCarousel({
    loop:false,
    margin:30,
    nav:false,
    dots:true,
    items:1,
})
// jQuery(document).ready(function() {
//       jQuery("#owl-portfolio").owlCarousel({
//         autoPlay: 3000,
//         items : 4,
//         itemsDesktop : [1199,3],
//         itemsDesktopSmall : [979,3]
//       });

//     });

// jQuery(document).ready(function() {
//  jQuery("#owl-slider").owlCarousel({
//       navigation : true, // Show next and prev buttons
//       slideSpeed : 300,
//       paginationSpeed : 400,
//       singleItem:true
 
//       // "singleItem:true" is a shortcut for:
//       // items : 1, 
//       // itemsDesktop : false,
//       // itemsDesktopSmall : false,
//       // itemsTablet: false,
//       // itemsMobile : false
 
//   });
 
// });

  

 jQuery(function($) { // DOM is now read and ready to be manipulated
  

 
var wow = new WOW(
  {
    boxClass:     'wowload',      // animated element css class (default is wow)
    animateClass: 'animated', // animation css class (default is animated)
    offset:       0,          // distance to the element when triggering the animation (default is 0)
    mobile:       true,       // trigger animations on mobile devices (default is true)
    live:         true        // act on asynchronously loaded content (default is true)
  }
);
wow.init();



    //Tab to top
    $(window).scroll(function() {
    if ($(this).scrollTop() > 1){  
        $('.scroll-top-wrapper').addClass("show");
    }
    else{
        $('.scroll-top-wrapper').removeClass("show");
    }
});
    $(".scroll-top-wrapper").on("click", function() {
     $("html, body").animate({ scrollTop: 0 }, 600);
    return false;
});


 $('.navbar .dropdown').hover(function() {
      $(this).find('.dropdown-menu').first().stop(true, true).slideDown(150);
    }, function() {
      $(this).find('.dropdown-menu').first().stop(true, true).slideUp(105)
    });








equalheight = function(container){

var currentTallest = 0,
     currentRowStart = 0,
     rowDivs = new Array(),
     $el,
     topPosition = 0;
 $(container).each(function() {

   $el = $(this);
   $($el).height('auto')
   topPostion = $el.position().top;

   if (currentRowStart != topPostion) {
     for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
       rowDivs[currentDiv].height(currentTallest);
     }
     rowDivs.length = 0; // empty the array
     currentRowStart = topPostion;
     currentTallest = $el.height();
     rowDivs.push($el);
   } else {
     rowDivs.push($el);
     currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
  }
   for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
     rowDivs[currentDiv].height(currentTallest);
   }
 });
}

$(window).load(function() {
  equalheight('.eq-blocks');
});


$(window).resize(function(){
  equalheight('.eq-blocks');
});

});
