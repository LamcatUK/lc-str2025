<?php
/**
 * LC Single Bio Block
 *
 * @package lc-str2025
 */


$bio = get_field( 'biography' );

if ( ! empty( $bio ) ) {
	$content = get_field( $bio, 'option' );
	if ( ! empty( $content ) ) {
		$img = get_field( 'phil_photo', 'option' );
		?>
	<div class="container">
		<div class="bio">
			<div class="row">
				<div class="col-md-2">
					<?= wp_get_attachment_image( $img, 'medium', false, array( 'class' => 'bio-image' ) ) ?>
				</div>
				<div class="col-md-10">
					<h2>About Philip Harmer</h2>
					<div class="mb-4"><?= wp_kses_post( $content ); ?></div>
					<a href="<?= esc_url( 'tel:' . parse_phone( get_field( 'contact_phone', 'option' ) ) ); ?>" class="button button-primary"><i class="fas fa-phone"></i> Call</a>
					<a href="<?= esc_url( 'mailto:' . antispambot( get_field( 'contact_email', 'option' ) ) ); ?>" class="button button-primary"><i class="fas fa-paper-plane"></i> Email</a>
				</div>
			</div>
		</div>
	</div>
		<?php
	}
}