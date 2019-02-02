$(document).on('ready', function () {

  // initialization of popups
  $.HSCore.components.HSPopup.init('.js-fancybox');

  // initialization of carousel
  $.HSCore.components.HSCarousel.init('.js-carousel');

  if (document.querySelector('#slider-shop') !== null) {
    document.getElementById("slider-shop") && $("#slider-shop").nivoSlider({
      effect: "fade",
      controlNavThumbs: !0,
      manualAdvance: !0,
      directionNav: !1
    })
  }

  // initialization of popovers
  $('[data-toggle="popover"]').popover();

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

});

$(window).on('load', function () {
  // initialization of header
  $.HSCore.components.HSHeaderSide.init($('#js-header'));
  $.HSCore.helpers.HSHamburgers.init('.hamburger');

  // initialization of sticky blocks
  // $.HSCore.components.HSStickyBlock.init('.js-sticky-block');
});

(function ($) {

	$.fn.SameHeight = function () {

		diffBoxAndContent = 0;

		this.run = function () {
			// Boxes
			var bhs = this.map(function () {
				return $(this).height();
			}).get();
			var mbh = Math.max.apply(null, bhs);

			// Contents
			var chs = this.children().map(function () {
				return $(this).height();
			}).get();
			var mch = Math.max.apply(null, chs);

			diffBoxAndContent = mbh - mch;
			this.height(mbh);
		};

		this.update = function () {
			var chs = this.children().map(function () {
				return $(this).height();
			}).get();
			var mch = Math.max.apply(null, chs);
			var newHeight = mch + diffBoxAndContent;
			this.height(newHeight);
		};

		this.run();
		my = this;
		var resize = function () {
			my.update();
		};
		$(window).resize(resize);

		return this;
	};
})(jQuery);
