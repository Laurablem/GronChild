(function () {
	'use strict';

	jQuery(function ($) {
		function setFlickityNavAria($el) {
			$el.find('.flickity-button.previous').attr('aria-label', 'Forrige');
			$el.find('.flickity-button.next').attr('aria-label', 'Næste');
		}

		// Bind før .flickity(), ellers kan ready være affyret inden lytteren sættes.
		function bindFlickityReady($el) {
			$el.on('ready.flickity', function () {
				$el.flickity('resize');
				setFlickityNavAria($el);
			});
		}

		var hasFlickityTargets = false;

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
			$(window).on('load', function () {
				$('.image-gallery-triple, .image-gallery').each(function () {
					var $el = $(this);
					if ($el.data('flickity')) {
						$el.flickity('resize');
						setFlickityNavAria($el);
					}
				});
			});

			var resizeTimer;
			$(window).on('resize', function () {
				clearTimeout(resizeTimer);
				resizeTimer = setTimeout(function () {
					$('.image-gallery-triple, .image-gallery').each(function () {
						var $el = $(this);
						if ($el.data('flickity')) {
							$el.flickity('resize');
						}
					});
				}, 150);
			});
		}
	});

	// Finder alle merch-sektioner på siden (hvis komponenten bruges flere steder).
	const merchSections = document.querySelectorAll('.merchkort');
	merchSections.forEach((section) => {
		// Henter knapper (byer) og billeder inden for den aktuelle sektion.
		const buttons = section.querySelectorAll('[data-merch-index]');
		const images = section.querySelectorAll('[data-merch-image]');
		// Stopper tidligt hvis der mangler data at arbejde med.
		if (!buttons.length || !images.length) return;

		// Opdaterer aktivt billede og aktiv knap ud fra valgt indeks.
		function setActive(indexToShow) {
			// Viser kun billedet, der matcher det valgte indeks.
			images.forEach((img) => {
				const isMatch = img.dataset.merchImage === String(indexToShow);
				img.style.display = isMatch ? '' : 'none';
			});
			// Marker den aktive knap visuelt og for tilgængelighed (aria-pressed).
			buttons.forEach((btn) => {
				const isActive = btn.dataset.merchIndex === String(indexToShow);
				btn.classList.toggle('is-active', isActive);
				btn.setAttribute('aria-pressed', isActive ? 'true' : 'false');
			});
		}
		// Vælg første knap/billede som standard ved load.
		const firstIndex = buttons[0].dataset.merchIndex;
		setActive(firstIndex);

		// Skifter aktivt billede når brugeren klikker på en knap.
		buttons.forEach((button) => {
			button.addEventListener('click', function () {
				setActive(this.dataset.merchIndex);
			});
		});
	});
})();
