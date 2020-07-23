// HighLights Programs
jQuery(document).ready(function($) {
      $('.prgrm-slid').slick({
        dots: true,
        infinite: true,
        speed: 1000,
        slidesToShow:4,
        slidesToScroll: 1,
        centerMode: false,   
        infinite: false,
        centerPadding: '80px',
        variableWidth: false,
        autoplay: false,
        autoplaySpeed: 4000,
        arrows: true,
        responsive: [{
          breakpoint: 992,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        },
        {
           breakpoint: 400,
           settings: {
                slidesToShow: 1,
                slidesToScroll: 1
           }
        }]
    });
});
