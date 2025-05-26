<?php
/**
 * The header for the theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package lc-str2025
 */

defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta
        charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="preload"
        href="<?= esc_url( get_stylesheet_directory_uri() . '/fonts/poppins-v21-latin-300.woff2' ); ?>"
        as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload"
        href="<?= esc_url( get_stylesheet_directory_uri() . '/fonts/poppins-v21-latin-600.woff2' ); ?>"
        as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload"
        href="<?= esc_url( get_stylesheet_directory_uri() . '/fonts/playfair-display-v37-latin-600.woff2' ); ?>"
        as="font" type="font/woff2" crossorigin="anonymous">
    <?php

    if ( get_field( 'gtm_property', 'option' ) ) {
        if ( ! is_user_logged_in() ) {
            echo '<meta name="gtm-tag" content="' . esc_attr( get_field( 'gtm_property', 'option' ) ) . '" />';
            ?>
            <script>
                (function(w, d, s, l, i) {
                    w[l] = w[l] || [];
                    w[l].push({
                        'gtm.start': new Date().getTime(),
                        event: 'gtm.js'
                    });
                    var f = d.getElementsByTagName(s)[0],
                        j = d.createElement(s),
                        dl = l != 'dataLayer' ? '&l=' + l : '';
                    j.async = true;
                    j.src =
                        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                    f.parentNode.insertBefore(j, f);
                })(window, document, 'script', 'dataLayer', '<?= esc_attr( get_field( 'gtm_property', 'option' ) ); ?>');
            </script>
            <?php
        }
    }
    if ( get_field( 'ga_property', 'option' ) ) {
        if ( ! is_user_logged_in() ) {
            ?>
            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async
                src="<?= esc_url( 'https://www.googletagmanager.com/gtag/js?id=' . get_field( 'ga_property', 'option' ) ); ?>">
            </script>
            <script>
                window.dataLayer = window.dataLayer || [];

                function gtag() {
                    dataLayer.push(arguments);
                }
                gtag('js', new Date());
                gtag('config',
                    '<?= esc_attr( get_field( 'ga_property', 'option' ) ); ?>'
                );
            </script>
            <?php
        }
    }
    if (get_field('google_site_verification', 'option')) {
        echo '<meta name="google-site-verification" content="' . get_field('google_site_verification', 'option') . '" />';
    }
    if (get_field('bing_site_verification', 'option')) {
        echo '<meta name="msvalidate.01" content="' . get_field('bing_site_verification', 'option') . '" />';
    }
    if (is_front_page() || is_page('contact')) {
        $social_links = get_field('socials', 'option');
        $filtered_links = array_values(array_filter($social_links, function ($url) {
            return !empty($url);
        }));
        ?>
        <script type="application/ld+json">
            {
                "@context": "http://schema.org",
                "@type": "Organization",
                "name": "Stormcatcher Business Legal Services UK",
                "url": "https://stormcatcher.co.uk/",
                "Description": "Stormcatcher Law is a friendly and approachable renowned niche law firm with a leading reputation and enviable track record across a wide range of areas of law, specialising in consumer law and civil dispute resolution, second to none in automotive law, building and construction and contract law. We provide legal advice and services for individuals and businesses. ",
                "sameAs": <?php
                            echo json_encode($filtered_links, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
                            ?>,
                "logo": "<?= get_stylesheet_directory_uri() ?>/img/stormcatcher-og-696x696.png",
                "contactPoint": [{
                    "@type": "ContactPoint",
                    "telephone": "+44-3337007676",
                    "contactType": "enquiries"
                }]
            }
        </script>
        <?php
    }
    ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php
    do_action( 'wp_body_open' );

    if ( get_field( 'gtm_property', 'option' ) ) {
        if ( ! is_user_logged_in() ) {
            ?>
            <!-- Google Tag Manager (noscript) -->
            <noscript><iframe
                    src="https://www.googletagmanager.com/ns.html?id=<?= get_field( 'gtm_property', 'option' ) ?>"
                    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
            <!-- End Google Tag Manager (noscript) -->
            <?php
        }
    }
    ?>
    <header class="pb-2 pt-2 pb-lg-0">
        <div class="container-xl header__grid">
            <div class="logo d-flex justify-content-between">
                <a href="/" title="Stormcatcher"><img src="<?= get_stylesheet_directory_uri() ?>/img/stormcatcher--dk.svg" alt="Stormcatcher" width="312" height="58"></a>
                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <div class="phone text-lg-end d-none d-lg-block">
                Call us today: <span class="fw-bold"><?= do_shortcode('[contact_phone]') ?></span>
            </div>
            <nav class="navbar navbar-expand-lg p-0">
                <?php

                wp_nav_menu(
                    array(
                        'theme_location'  => 'primary_nav',
                        'container_class' => 'collapse navbar-collapse',
                        'container_id'    => 'navbarNav',
                        'menu_class'      => 'navbar-nav w-100 justify-content-end gap-2 gap-lg-5',
                        'fallback_cb'     => '',
                        'depth'           => 2,
                        'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
                    )
                );
                ?>
            </nav>
        </div>
    </header>