jQuery(document).ready(function($) {
        		"use strict";
        		//  TESTIMONIALS CAROUSEL HOOK
		        $('#customers-testimonials').owlCarousel({
		            loop: true,
		            center: true,
		            items: 3,
		            margin: 0,
		            autoplay: false,
		            dots:true,
		            autoplayTimeout: 8500,
		            smartSpeed: 450,
		            responsive: {
		              0: {
		                items: 1
		              },
		              768: {
		                items: 1
		              },
		              1200: {
		                items: 1
		              }
		            }
		        });
        	});

$('.home_slider').owlCarousel({
    loop:true,
    margin:0,
    autoplay:true,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
            items:1,
            nav:true,
            loop:false
        }
    }
   
})
$('.brands-carousel').owlCarousel({
    loop:true,
    margin:10,
    autoplay:false,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
            items:2,
            nav:true,
            loop:false
        }
    }
})
$('.brand_box').owlCarousel({
    loop:true,
    margin:10,
	items: 4,
    autoplay:false,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        575:{
            items:2,
            nav:true
        },
        768:{
            items:3,
            nav:false
        },
        1000:{
            items:4,
            nav:true,
            loop:false
        }
    }
})

$('.offer-carousel').owlCarousel({
    loop:true,
    margin:10,
	items: 3,
    autoplay:false,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:2,
            nav:false
        },
        1000:{
            items:3,
            nav:true,
            loop:false
        }
    }
})


$('.rate-carousel').owlCarousel({
    loop:true,
    margin:0,
    autoplay:false,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
            items:7,
            nav:true,
            loop:false
        }
    }
})

$('.welcome-carousel').owlCarousel({
    loop:true,
    margin:0,
    autoplay:true,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
            items:1,
            nav:true,
            loop:false
        }
    }
})

$('.activity-carousel').owlCarousel({
    loop:true,
    margin:0,
    autoplay:false,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        575:{
            items:2,
            nav:false
        },
        768:{
            items:3,
            nav:true,
            loop:false
        }
    }
})



$('.sariska-gallery-carousel').owlCarousel({
    loop:true,
    margin:0,
    autoplay:false,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        575:{
            items:2,
            nav:false
        },
        768:{
            items:3,
            nav:true,
            loop:false
        }
    }
})

$('.features-carousel').owlCarousel({
    loop:true,
    margin:0,
    autoplay:false,
    responsiveClass:true, 
    responsive:{
        0:{
            items:1,
            nav:true
        },
        575:{
            items:2,
            nav:false
        },
        768:{
            items:3,
            nav:true,
            loop:false
        } 
    }
    
})

$(document).ready(function(){
  $("#popup1").click(function(){
    $("#popup1-1").toggle();
  });
});

$(document).ready(function(){
  $("#cancel-popup1").click(function(){
    $("#popup1-1").hide();
  });
});

$(document).ready(function(){
  $("#popup2").click(function(){
    $("#popup2-1").toggle();
  });
});

$(document).ready(function(){
  $("#cancel-popup2").click(function(){
    $("#popup2-1").hide();
  });
});

$(document).ready(function(){
  $("#popup3").click(function(){
    $("#popup3-1").toggle();
  });
});

$(document).ready(function(){
  $("#cancel-popup3").click(function(){
    $("#popup3-1").hide();
  });
});

$(document).ready(function(){
  $("#popup4").click(function(){
    $("#popup4-1").toggle();
  });
});

$(document).ready(function(){
  $("#cancel-popup4").click(function(){
    $("#popup4-1").hide();
  });
});

$(document).ready(function(){
  $("#popup5").click(function(){
    $("#popup5-1").toggle();
  });
});

$(document).ready(function(){
  $("#cancel-popup5").click(function(){
    $("#popup5-1").hide();
  });
});

$(document).ready(function(){
  $("#popup6").click(function(){
    $("#popup6-1").toggle();
  });
});

$(document).ready(function(){
  $("#cancel-popup6").click(function(){
    $("#popup6-1").hide();
  });
});

$(document).ready(function(){
  $("#confirm").click(function(){
    $("#no-room-summary").hide();
	$("#room-booking-summary").show();
  });
});

$(document).ready(function(){
  $("#confirm1").click(function(){
    $("#no-room-summary").hide();
	$("#room-booking-summary").show();
  });
});

$(document).ready(function(){
  $("#confirm2").click(function(){
    $("#no-room-summary").hide();
	$("#room-booking-summary").show();
  });
});

$(document).ready(function(){
  $("#confirm3").click(function(){
    $("#no-room-summary").hide();
	$("#room-booking-summary").show();
  });
});

$(document).ready(function(){
  $("#confirm4").click(function(){
    $("#no-room-summary").hide();
	$("#room-booking-summary").show();
  });
});

$(document).ready(function(){
  $("#confirm5").click(function(){
    $("#no-room-summary").hide();
	$("#room-booking-summary").show();
  });
});

$(document).ready(function(){
  $("#roomBtnclose").click(function(){
    $("#no-room-summary").show();
	$("#room-booking-summary").hide();
  });
});

$(document).ready(function(){
  $("#alwar").click(function(){
	$("#hotel-detail").show();
	$("#gurgaon-hotel").hide();
  });
});

$(document).ready(function(){
  $("#gurgaon").click(function(){
	$("#gurgaon-hotel").show();
	$("#hotel-detail").hide();
  });
});

