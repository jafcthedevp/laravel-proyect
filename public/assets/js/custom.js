/*-----------------------------------------------------------------------------------

    Template Name: patte

    Note: This is Custom Js file

-----------------------------------------------------------------------------------

    [Table of contents]
    
    01. slider-categorie
    02. hero-one-slider
    03. quotation-slider
    04. hero-two-slider
    05. client-slider
    06. logodata
    07. pets-slider
    08. Loder
    09. mobile-nav
    10. days
    11. count
    12. Cart Popup Start
    13. Header Search
    14. accordion-item
    15. pd-gallery
    16. overlay
    17. scrollTop

-----------------------------------------------------------------------------------*/

jQuery(document).ready(function($){
    if ( $.isFunction($.fn.owlCarousel) ) {
    /* 01. slider-categorie */ 
    $('.slider-categorie').owlCarousel({
        loop:true,
        dot:true,
        nav:true,
        autoplay:true,
        navText: ["<i class='fa-solid fa-arrow-left'></i>","<i class='fa-solid fa-arrow-right'></i>"],
        responsive:{
            0:{
                items:1
            },
            768:{
                items:2
            },
            993:{
                items:3
            },
            1360:{
                items:4
            }
          }
        })
    /* 02. hero-one-slider */
    $('.hero-one-slider').owlCarousel({
        loop:true,
        dot:true,
        nav:true,
        items:1,
        autoplay:true,
    })
    /* 03. quotation-slider */
    $('.quotation-slider').owlCarousel({
        loop:true,
        dot:false,
        nav:true,
        items:1,
        autoplay:true,
        touchDrag: false,
        mouseDrag: false,
        animateOut: 'fadeOut',
        navText: ["<i class='fa-solid fa-arrow-left'></i>","<i class='fa-solid fa-arrow-right'></i>"],
    })
    /* 04. hero-two-slider */
    $('.hero-two-slider').owlCarousel({
        loop:true,
        dot:true,
        nav:true,
        items:1,
        autoplay:true,
        navText: ["<i class='fa-solid fa-arrow-left'></i>","<i class='fa-solid fa-arrow-right'></i>"],
        animateOut: 'fadeOut'
        })
    /* 05. client-slider */
    $('.client-slider').owlCarousel({
        loop:true,
        dot:true,
        nav:true,
        autoplay:true,
        navText: ["<i class='fa-solid fa-arrow-left'></i>","<i class='fa-solid fa-arrow-right'></i>"],
        responsive:{
            0:{
                items:1
            },
            768:{
                items:1
            },
            1200:{
                items:2
            }
          }
        })
    /* 06. logodata */
    $('.logodata').owlCarousel({
        loop:true,
        dot:false,
        nav:false,
        autoplay:true,
        autoplayTimeout:3000,
        responsive:{
        0:{
            items:2
        },
        800:{
            items:3
        },
        1000:{
            items:4
        },
        1200:{
            items:5
        }
      }
    })
    /* 07. pets-slider */
    $('.pets-slider').owlCarousel({
        loop:true,
        dot:true,
        autoplay:true,
        responsive:{
            0:{
                items:1
            },
            768:{
                items:2
            },
            993:{
                items:2
            }
          }
        })
     }

     //* 08. Loder  *//
    $(function () {
        $('body').addClass('loaded');
    });

     /* 09. mobile-nav */
  jQuery('.mobile-nav .menu-item-has-children').on('click', function($) {

          jQuery(this).toggleClass('active');

        }); 

        jQuery('#nav-icon4').click(function($){

            jQuery('#mobile-nav').toggleClass('open');

        });

        jQuery('#res-cross').click(function($){

           jQuery('#mobile-nav').removeClass('open');

        });


        jQuery('.bar-menu').click(function($){

            jQuery('#mobile-nav').toggleClass('open');
            jQuery('#mobile-nav').toggleClass('hmburger-menu');
            jQuery('#mobile-nav').show();

        });

        jQuery('#res-cross').click(function($){

           jQuery('#mobile-nav').removeClass('open');

        });
     
  }) ;

/* 10. days */

if(jQuery("#days").length){

    (function () {
        const second = 1000,
        minute = second * 60,
        hour = minute * 160,
        day = hour * 184;

      let today = new Date(),
          dd = String(today.getDate()).padStart(2, "0"),
          mm = String(today.getMonth() + 1).padStart(2, "0"),
          yyyy = today.getFullYear(),
          nextYear = yyyy + 1,
          dayMonth = "12/30/",
          birthday = dayMonth + yyyy;
      
      today = mm + "/" + dd + "/" + yyyy;
      if (today > birthday) {
        birthday = dayMonth + nextYear;
      }
      
      
      const countDown = new Date(birthday).getTime(),
          x = setInterval(function() {    

            const now = new Date().getTime(),
                  distance = countDown - now;

            document.getElementById("days").innerText = Math.floor(distance / (day)),
              document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour)),
              document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute)),
              document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second);

            //do something later when date is reached
            if (distance < 0) {
              document.getElementById("headline").innerText = "It's my birthday!";
              document.getElementById("countdown").style.display = "none";
              document.getElementById("content").style.display = "block";
              clearInterval(x);
            }
            //seconds
          }, 0)
      }());
}
//end
/* 11. count */
let count = document.querySelectorAll(".count");
let arr = Array.from(count);

arr.map(function (item) {
  let startnumber = 0;

  function counterup() {
    startnumber++;
    item.innerHTML = startnumber;

    if (startnumber == item.dataset.number) {
      clearInterval(stop);
    }
  }
  let stop = setInterval(function () {
    counterup();
  }, 10);
});

// count end


/* 12. Cart Popup Start */

    jQuery('.pr-cart').on('click', function() {

      jQuery('.cart-popup').toggleClass('show-cart');

    });

// Cart Popup End


/* 13. Header Search */
    if($('.search-box-outer').length) {
        $('.search-box-outer').on('click', function() {
            $('body').addClass('search-active');
        });
        $('.close-search').on('click', function() {
            $('body').removeClass('search-active');
        });
    }


/* 14. accordion-item */

$('.accordion-item .heading').on('click', function(e) {
    e.preventDefault();

    if($(this).closest('.accordion-item').hasClass('active')) {
        $('.accordion-item').removeClass('active');
    } else {
        $('.accordion-item').removeClass('active');

        $(this).closest('.accordion-item').addClass('active');
    }
    var $content = $(this).next();
    $content.slideToggle(100);
    $('.accordion-item .content').not($content).slideUp('fast');
});

// end


/* 15. pd-gallery */
    $('.li-pd-imgs').on('click', function() {

      var img_src = "";

      $('.li-pd-imgs.nav-active').removeClass('nav-active');

      $(this).addClass('nav-active');

      img_src = $(this).find('img').attr('src');

      $('.pd-main-img').children('img').attr('src', img_src);

    });


    /* 16. overlay */
        var boxWidth = $("#lightbox").width();
                $(".white_content").animate({
                    opacity: 0,
                    width:0,
                    right : -10000
            });
            $("#close").on('click',function(){ 
            $(".white_content").animate({
                opacity: 0,
                width:0,
                right : -1000
            });
            });
            $("#show").on('click',function(){ 
            $(".white_content").animate({
                opacity: 1,
                right :0
            });

        });

    /* 17. scrollTop */

function inVisible(element) {
  var WindowTop = $(window).scrollTop();
  var WindowBottom = WindowTop + $(window).height();
  var ElementTop = element.offset().top;
  var ElementBottom = ElementTop + element.height();
  if ((ElementBottom <= WindowBottom) && ElementTop >= WindowTop)
    animate(element);
}

function animate(element) {
  if (!element.hasClass('ms-animated')) {
    var maxval = element.data('max');
    var html = element.html();
    element.addClass("ms-animated");
    $({
      countNum: element.html()
    }).animate({
      countNum: maxval
    }, {
      duration: 5000,
      easing: 'linear',
      step: function() {
        element.html(Math.floor(this.countNum) + html);
      },
      complete: function() {
        element.html(this.countNum + html);
      }
    });
  }

}

$(function() {
  $(window).scroll(function() {
    $("h2[data-max]").each(function() {
      inVisible($(this));
    });
  })
});
 let calcScrollValue = () => {
  let scrollProgress = document.getElementById("progress");
  let progressValue = document.getElementById("progress-value");
  let pos = document.documentElement.scrollTop;
  let calcHeight =
    document.documentElement.scrollHeight -
    document.documentElement.clientHeight;
  let scrollValue = Math.round((pos * 100) / calcHeight);
  if (pos > 100) {
    scrollProgress.style.display = "grid";
  } else {
    scrollProgress.style.display = "none";
  }
  scrollProgress.addEventListener("click", () => {
    document.documentElement.scrollTop = 0;
  });
  scrollProgress.style.background = `conic-gradient(#fa441d ${scrollValue}%, #fff ${scrollValue}%)`;
};

window.onscroll = calcScrollValue;
window.onload = calcScrollValue;

// end