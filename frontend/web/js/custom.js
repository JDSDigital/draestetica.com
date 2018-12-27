// initialization of google map
function initMap() {
  $.HSCore.components.HSGMap.init('.js-g-map');
}

$(document).on('ready', function () {
  
  // initialization of go to
  $.HSCore.components.HSGoTo.init('.js-go-to');

  // initialization of carousel
  $.HSCore.components.HSCarousel.init('.js-carousel');

  $('#we-provide').slick('setOption', 'responsive', [{
    breakpoint: 992,
    settings: {
      slidesToShow: 2
    }
  }, {
    breakpoint: 576,
    settings: {
      slidesToShow: 1
    }
  }], true);

  // initialization of HSDropdown component
  $.HSCore.components.HSDropdown.init($('[data-dropdown-target]'), {
    afterOpen: function(){
      $(this).find('input[type="search"]').focus();
    }
  });

  // initialization of masonry
  $('.masonry-grid').imagesLoaded().then(function () {
    $('.masonry-grid').masonry({
      columnWidth: '.masonry-grid-sizer',
      itemSelector: '.masonry-grid-item',
      percentPosition: true
    });
  });

  // initialization of popups
  $.HSCore.components.HSPopup.init('.js-fancybox');
});

$(window).on('load', function () {
  // initialization of header
  $.HSCore.components.HSHeaderSide.init($('#js-header'));
  $.HSCore.helpers.HSHamburgers.init('.hamburger');

  // initialization of HSMegaMenu component
  $('.js-mega-menu').HSMegaMenu({
    event: 'hover',
    direction: 'vertical',
    breakpoint: 991
  });
});
