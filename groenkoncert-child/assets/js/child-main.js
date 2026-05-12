(function () {
	'use strict';

	//Flickity slider - anvender jQuery
	jQuery(function ($) {
		if ($('.image-gallery-triple').length > 0) {
			var $carousel = $('.image-gallery-triple').flickity({
				cellAlign: 'left',
				pageDots: false,
				imagesLoaded: true,
				groupCells: true,
				wrapAround: true
			});

			var prevButton = document.querySelector('.flickity-button.previous');
			var nextButton = document.querySelector('.flickity-button.next');
			if (prevButton) {
				prevButton.setAttribute('aria-label', 'Forrige');
			}
			if (nextButton) {
				nextButton.setAttribute('aria-label', 'Næste');
			}

			setTimeout(function () {
				$carousel.flickity('resize');
			}, 3000);
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
