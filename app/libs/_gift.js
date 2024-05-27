export function gift() {
	const giftPopup = document.querySelector('.gift__popup')
	const giftClose = document.querySelector('.gift__popup-close')
	const giftBtn = document.querySelector('.gift__popup-btn')
	let giftPopupVisible = false

	if (giftPopup && giftClose && giftBtn) {
		giftClose.addEventListener('click', () => {
			giftPopup.classList.remove('--visible')
		})

		giftBtn.addEventListener('click', () => {
			giftPopup.classList.remove('--visible')
		})

		window.addEventListener('scroll', function () {
			let scrollPosition = window.scrollY

			if (scrollPosition >= 100 && !giftPopupVisible) {
				giftPopup.classList.add('--visible')
				giftPopupVisible = true
			}
		})
	}
}
