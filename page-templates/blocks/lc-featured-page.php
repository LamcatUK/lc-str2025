<?php


defined( 'ABSPATH' ) || exit;

$classes = $block['clases'] ?? 'py-5';

$featured_page = get_field( 'page' );

$featured_title = get_the_title( $featured_page );

$featured_category      = get_the_category( $featured_page );
$featured_category_name = ! empty( $featured_category ) ? $featured_category[0]->name : null;

$featured_background = null;
$blocks              = parse_blocks( get_post_field( 'post_content', $featured_page ) );

foreach ( $blocks as $block ) {
    if ( isset( $block['blockName'] ) && $block['blockName'] === 'acf/lc-hero' ) {
        if ( isset( $block['attrs']['data']['background'] ) ) {
            $featured_background = $block['attrs']['data']['background'];
        }
        break;
    }
}

?>
<section class="lc-featured-page <?= esc_attr( $classes ); ?>">
	<div class="container-xl">
		<a href="<?= esc_url( get_the_permalink( $featured_page ) ); ?>" class="success_card">
			<?php
			if ( $featured_background ) {
				?>
				<div class="success_card__featured success_card__featured_grid">
					<?= wp_get_attachment_image( $featured_background, 'large', false, array( 'class' => 'featured_grid__image' ) ); ?>
					<div>
						<div class="d-flex flex-wrap justify-content-between">
							<h2 class="text-black"><?= esc_html( $featured_title ); ?></h2>
							<?php
							if ( $featured_category_name ) {
								?>
							<div class="success_card__pill mb-4">
								<?= esc_html( $featured_category_name ); ?>
							</div>
								<?php
							}
							?>
						</div>
						<?= wp_kses_post( get_first_paragraphs_min_words( get_the_content( null, false, $featured_page ), 30 ) ); ?>
						<div class="text-end">
							<span class="success_card__read-more">Read More...</span>
						</div>
					</div>
				</div>
				<?php
			} else {
				?>
				<div class="success_card__featured d-flex flex-wrap justify-content-between">
					<h2 class="success_card__title"><?= esc_html( $featured_title ); ?></h2>
					<?php
					if ( $featured_category_name ) {
						?>
					<div class="success_card__pill mb-4">
						<?= esc_html( $featured_category_name ); ?>
					</div>
						<?php
					}
					?>
				</div>
				<?= wp_kses_post( get_first_paragraphs_min_words( get_the_content( null, false, $featured_page ), 30 ) ); ?>
				<div class="text-end">
					<span class="success_card__read-more">Read More...</span>
				</div>
			</div>
				<?php
			}
			?>
		</a>
    </div>
</section>