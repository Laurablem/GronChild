(function () {
	'use strict';

	jQuery(function ($) {
      	// Gør Flickitys forrige/næste-knapper mere tilgængelige med danske aria-labels
		function setFlickityNavAria($el) {
			$el.find('.flickity-button.previous').attr('aria-label', 'Forrige');
			$el.find('.flickity-button.next').attr('aria-label', 'Næste');
		}

		// Kører når Flickity er klar, så slideren får rigtig størrelse og rigtige labels
		function bindFlickityReady($el) {
			$el.on('ready.flickity', function () {
				$el.flickity('resize');
				setFlickityNavAria($el);
			});
		}

      	// Holder styr på om der findes Flickity-slidere på siden
		var hasFlickityTargets = false;

      	// Starter Flickity på trippelslideren, så billederne kan swipe/klikkes igennem
		if ($('.image-gallery-triple').length > 0) {
			hasFlickityTargets = true;
			$('.image-gallery-triple').each(function () {
				var $el = $(this);
				bindFlickityReady($el);
				$el.flickity({
					cellAlign: 'left',
					pageDots: false,
					imagesLoaded: true,
					groupCells: true,
					wrapAround: true
				});
			});
		}

      	// Starter Flickity på print-slideshowet, så billederne kan swipe/klikkes igennem
		if ($('.image-gallery-child').length > 0) {
			hasFlickityTargets = true;
			$('.image-gallery-child').each(function () {
				var $el = $(this);
				bindFlickityReady($el);
				$el.flickity({
					cellAlign: 'left',
					pageDots: false,
					imagesLoaded: true,
					wrapAround: true
				});
			});
		}

		if (hasFlickityTargets) {
          
          	// Retter sliderne til igen, når siden er helt loadet
			$(window).on('load', function () {
				$('.image-gallery-triple, .image-gallery-child').each(function () {
					var $el = $(this);
					if ($el.data('flickity')) {
						$el.flickity('resize');
						setFlickityNavAria($el);
					}
				});
			});

			var resizeTimer;
          
          	// Retter sliderne til igen, når skærmstørrelsen ændrer sig
			$(window).on('resize', function () {
				clearTimeout(resizeTimer);
				resizeTimer = setTimeout(function () {
					$('.image-gallery-triple, .image-gallery-child').each(function () {
						var $el = $(this);
						if ($el.data('flickity')) {
							$el.flickity('resize');
						}
					});
				}, 150);
			});
		}
	});

	// Finder alle merch-sektioner på siden (hvis komponenten bruges flere steder)
	const merchSections = document.querySelectorAll('.merchkort');
	merchSections.forEach((section) => {
		// Finder knapper (byer) og billeder i merchkortet, så de kan kobles sammen
		const buttons = section.querySelectorAll('[data-merch-index]');
		const images = section.querySelectorAll('[data-merch-image]');
		// Stopper hvis der mangler knapper eller billeder
		if (!buttons.length || !images.length) return;

		// Skifter hvilket billede og hvilken knap der er aktiv
		function setActive(indexToShow) {
			// Viser kun det billede, der passer til den knap brugeren har valgt
			images.forEach((img) => {
				const isMatch = img.dataset.merchImage === String(indexToShow);
				img.style.display = isMatch ? '' : 'none';
			});
			// Giver den valgte knap active-klassen, så den kan styles med CSS
			buttons.forEach((btn) => {
				const isActive = btn.dataset.merchIndex === String(indexToShow);
				btn.classList.toggle('is-active', isActive);
				btn.setAttribute('aria-pressed', isActive ? 'true' : 'false');
			});
		}
		// Viser det første merchkort fra start
		const firstIndex = buttons[0].dataset.merchIndex;
		setActive(firstIndex);

		// Skifter merchkort når brugeren klikker på en knap
		buttons.forEach((button) => {
			button.addEventListener('click', function () {
				setActive(this.dataset.merchIndex);
			});
		});
	});
})();

