<?php
/**
 * LC Review Block Template.
 *
 * @package lc-str2025
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="reviews pb-4">
    <div class="container">
		<div class="insights__title mb-4 d-flex justify-content-center align-items-center text-center gap-5" data-aos="fadein">
            <div class="line"></div>
			<h2>What Our <span>Customers Are Saying</span></h2>
            <div class="line"></div>
        </div>
        <?= do_shortcode( '[trustindex data-widget-id=4f2cc5d27f7c67788958c82c4a]' ); ?>
        <div class="text-center">
            <a href="https://www.google.com/search?source=hp&ei=N3HIXKDnO4_RwAKlmZfYAg&q=stormcatcher&btnK=Google+Search&oq=stormcatcher&gs_l=psy-ab.3..35i39j0l9.52.1740..2105...0.0..0.272.1391.9j2j2......0....1..gws-wiz.....0..0i131j0i67j0i10.pospPCI58gk#btnK=Google%20Search&lrd=0x4875fb4ef1606575:0x6da2094290a62fbd,1,,," target="_blank" rel="noopener nofollow" class="btn btn-orange">View our Reviews on Google</a>
        </div>
    </div>
</section>
