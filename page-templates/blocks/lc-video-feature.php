<?php
/**
 * Template for displaying the video feature block.
 *
 * @package lc-str2025
 */

$colour     = strtolower( get_field( 'background' ) ) ?? null;
$background = 'bg-' . $colour;

$bg_size = get_field( 'bg_size' ) ?? null;

$bg_inner = '';
$bg_outer = '';

if ( 'Full Width' === $bg_size ) {
	$bg_outer = $background;
} else {
	$bg_inner = $background;
}

$featured_video     = get_field( 'featured_video_id' );
$featured_video_url = 'https://www.youtube.com/embed/' . get_field( 'featured_video_id' ) . '?rel=0';

$featured_watch_url = 'https://www.youtube.com/watch?v=' . get_field( 'featured_video_id' ) . '&embeds_referring_euri=https%3A%2F%2Fstormcatcher.co.uk%2F';
?>
<section class="video_feature <?= esc_attr( $bg_outer ); ?> py-4">
	<div class="container-xl <?= esc_attr( $bg_inner ); ?> p-4">
		<div class="row g-5">
			<div class="col-md-6">
				<div class="ratio ratio-16x9">
					<iframe 
						src="<?= esc_url( $featured_video_url ); ?>" 
						title="<?= esc_html( get_field( 'featured_video_title' ) ); ?>" 
						allowfullscreen>
					</iframe>
				</div>
			</div>
			<div class="col-md-6">
				<h2><?= esc_html( get_field( 'featured_video_title' ) ); ?></h2>
				<p><?= esc_html( get_field( 'featured_video_description' ) ); ?></p>
				<a href="<?= esc_url( $featured_watch_url ); ?>" target="_blank" class="button button-primary">Watch on YouTube</a>
			</div>
		</div>

		<?php
		if ( get_field( 'additional_videos' ) ) {
			?>
			<?php
			if ( get_field( 'additional_videos_title' ) ) {
				?>
				<h2 class="h3 mt-4 mb-0"><?= esc_html( get_field( 'additional_videos_title' ) ); ?></h2>
				<?php
			}
			?>

			<div class="video_feature__slider splide pt-4" aria-label="Additional Videos">
				<div class="splide__track">
					<ul class="splide__list">
						<?php
						while ( have_rows( 'additional_videos' ) ) {
							the_row();
							$video_id  = get_sub_field( 'video_id' );
							$video_url = 'https://www.youtube.com/embed/' . $video_id . '?rel=0';
							?>
							<li class="splide__slide">
								<div class="ratio ratio-16x9">
									<iframe
										src="<?= esc_url( $video_url ); ?>"
										title=""
										allowfullscreenQ
									></iframe>
								</div>
							</li>
							<?php
						}
						?>
					</ul>
				</div>
			</div>
			<?php
		}
		?>
	</div>
</section>

<?php
add_action(
	'wp_footer',
	function () {
		?>
		<script>
			document.addEventListener('DOMContentLoaded', function () {
				new Splide('.video_feature__slider', {
					perPage: 3,
					perMove: 1,
					gap: '1rem',
					arrows: false,
					pagination: false,
					breakpoints: {
						992: {
							perPage: 2,
							autoplay: true,
						},
						576: {
							perPage: 1,
							autoplay: true,
						},
					},
				}).mount();
			});
		</script>
		<?php
	},
	9999
);