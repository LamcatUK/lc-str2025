<?php
/**
 * Template for displaying the video feature block.
 *
 * @package lc-str2025
 */

defined( 'ABSPATH' ) || exit;

$colour  = strtolower( get_field( 'background' ) ) ?? null;
$bg_size = get_field( 'bg_size' ) ?? null;

$bg_inner  = '';
$bg_outer  = '';
$pad_inner = '';
$pad_outer = '';

if ( $colour ) {
    if ( 'Full Width' === $bg_size ) {
        $bg_outer  = 'bg-' . $colour;
        $pad_inner = 'py-4';
    } else {
        $bg_inner  = 'bg-' . $colour;
        $pad_inner = 'p-4';
    }
} elseif ( 'Full Width' !== $bg_size ) {
	$pad_inner = '';
}


$featured_video     = get_field( 'featured_video_id' );
$featured_video_url = 'https://www.youtube.com/embed/' . get_field( 'featured_video_id' ) . '?rel=0';
$featured_watch_url = 'https://www.youtube.com/watch?v=' . get_field( 'featured_video_id' ) . '&embeds_referring_euri=https%3A%2F%2Fstormcatcher.co.uk%2F';
$video_title        = get_field( 'featured_video_title' );
$video_description  = get_field( 'featured_video_description' );
$video_thumbnail    = get_field( 'featured_video_thumbnail' );
?>
<section class="video_feature <?= esc_attr( trim( "$bg_outer $pad_outer" ) ); ?>">
	<div class="<?= esc_attr( trim( "$bg_inner $pad_inner" ) ); ?>">
		<h2 class="h3 mb-4"><?= esc_html( get_field( 'featured_video_title' ) ); ?></h2>
		<div class="ratio ratio-16x9 mb-4">
			<iframe 
				src="<?= esc_url( $featured_video_url ); ?>" 
				title="<?= esc_html( get_field( 'featured_video_title' ) ); ?>" 
				allowfullscreen>
			</iframe>
		</div>
		<p><?= esc_html( get_field( 'featured_video_description' ) ); ?></p>
		<a href="<?= esc_url( $featured_watch_url ); ?>" target="_blank" class="button button-primary">Watch on YouTube</a>

		<?php
		if ( get_field( 'additional_videos' ) ) {
			?>
			<?php
			if ( get_field( 'additional_videos_title' ) ) {
				?>
				<h2 class="h4 mt-5 mb-0"><?= esc_html( get_field( 'additional_videos_title' ) ); ?></h2>
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
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "VideoObject",
    "name": "<?= esc_js( $video_title ); ?>",
    "description": "<?= esc_js( $video_description ); ?>",
    "thumbnailUrl": "<?= esc_url( $video_thumbnail ); ?>",
    "uploadDate": "<?= esc_attr( gmdate( 'c', strtotime( get_field( 'video_upload_date' ) ) ) ); ?>",
    "contentUrl": "<?= esc_url( $featured_watch_url ); ?>",
    "embedUrl": "<?= esc_url( $featured_video_url ); ?>",
    "publisher": {
        "@type": "Organization",
        "name": "Stormcatcher",
        "logo": {
            "@type": "ImageObject",
            "url": "<?= esc_url( get_stylesheet_directory_uri() . '/img/stormcatcher--dk.svg' ); ?>"
        }
    }
}
</script>
<?php
add_action(
	'wp_footer',
	function () {
		?>
		<script>
			document.addEventListener('DOMContentLoaded', function () {
				var sliderElement = document.querySelector('.video_feature__slider');
				if (!sliderElement) { return; }
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