<section class="pr-popup added_to_cart" id="added_to_cart_popup">
	<div class="pr-popup__wrap">
		<button class="close closer" data-close="added_to_cart_popup"></button>
		<p class="title body body-xl bold">
			<?= __('Кошик', 'proacto') ?>
		</p>
		<p class="text body body-m regular">
			<?= __('Товар додано до кошика', 'proacto') ?>
		</p>
		<div class="pr-popup__wrap-buttons">
			<a href="<?= wc_get_cart_url() ?>" class="button button-l primary">
				<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1.5 1.5H1.72362C2.11844 1.5 2.31619 1.5 2.47722 1.57123C2.6192 1.63403 2.74059 1.73515 2.82812 1.86336C2.92724 2.00855 2.96304 2.20241 3.03448 2.58939L4.83337 12.3334L13.5182 12.3333C13.8958 12.3333 14.0853 12.3333 14.2417 12.2666C14.3799 12.2077 14.4991 12.1122 14.5876 11.9908C14.6877 11.8535 14.7301 11.6697 14.8148 11.3026L14.8154 11.3L16.1231 5.6333L16.1234 5.63211C16.2519 5.07513 16.3164 4.79596 16.2456 4.57699C16.1835 4.38485 16.0529 4.22195 15.8797 4.11827C15.682 4 15.3965 4 14.8239 4H3.58333M14 16.5C13.5398 16.5 13.1667 16.1269 13.1667 15.6667C13.1667 15.2064 13.5398 14.8333 14 14.8333C14.4602 14.8333 14.8333 15.2064 14.8333 15.6667C14.8333 16.1269 14.4602 16.5 14 16.5ZM5.66667 16.5C5.20643 16.5 4.83333 16.1269 4.83333 15.6667C4.83333 15.2064 5.20643 14.8333 5.66667 14.8333C6.1269 14.8333 6.5 15.2064 6.5 15.6667C6.5 16.1269 6.1269 16.5 5.66667 16.5Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
				<span>
					<?= __('Перейти до кошику', 'proacto') ?>
				</span>
			</a>
			<button class="button button-l secondary closer" data-close="added_to_cart_popup">
				<?= __('Продовжити покупки', 'proacto') ?>
			</button>
		</div>
	</div>
</section>
