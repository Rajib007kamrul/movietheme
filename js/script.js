jQuery(document).ready(function ($) {
  // $(".owl-carousel").owlCarousel();

  $(".owl-carousel").owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    // navText: [
    //   "<div class='nav-btn fa fa-facebook'></div>",
    //   "<div class='nav-btn fa fa-facebook'></div>",
    // ],
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 3,
      },
      1000: {
        items: 5,
      },
    },
  });
  $(".bxslider").bxSlider();
});
