$('.owl-carousel').owlCarousel({
    loop:true,
    autoplay:true,
    center:true,
    item:11,
    dots: false,
    nav:true,
    navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
    autoplayTimeout:4000,
    responsiveClass:true,
       responsive:{
        0:{
            items:5
        },
        600:{
            items:5
        },
        1000:{
            items:7
        }
    }

})