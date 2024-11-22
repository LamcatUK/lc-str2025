<?php

/**
 * The header for the theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package lc-str2025
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta
        charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="preload"
        href="<?= get_stylesheet_directory_uri() ?>/fonts/poppins-v21-latin-300.woff2"
        as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload"
        href="<?= get_stylesheet_directory_uri() ?>/fonts/poppins-v21-latin-600.woff2"
        as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload"
        href="<?= get_stylesheet_directory_uri() ?>/fonts/playfair-display-v37-latin-600.woff2"
        as="font" type="font/woff2" crossorigin="anonymous">
    <?php
    if (get_field('gtm_property', 'options')) {
        if (!is_user_logged_in()) {
    ?>
            <!-- Google Tag Manager -->
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
                })(window, document, 'script', 'dataLayer', '<?= get_field('gtm_property', 'options') ?>');
            </script>
            <!-- End Google Tag Manager -->
        <?php
        }
    }
    if (get_field('ga_property', 'options')) {
        if (!is_user_logged_in()) {
        ?>
            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async
                src="https://www.googletagmanager.com/gtag/js?id=<?= get_field('ga_property', 'options') ?>">
            </script>
            <script>
                window.dataLayer = window.dataLayer || [];

                function gtag() {
                    dataLayer.push(arguments);
                }
                gtag('js', new Date());
                gtag('config',
                    '<?= get_field('ga_property', 'options') ?>'
                );
            </script>
        <?php
        }
    }
    if (get_field('google_site_verification', 'options')) {
        echo '<meta name="google-site-verification" content="' . get_field('google_site_verification', 'options') . '" />';
    }
    if (get_field('bing_site_verification', 'options')) {
        echo '<meta name="msvalidate.01" content="' . get_field('bing_site_verification', 'options') . '" />';
    }
    if (is_front_page() || is_page('contact-us')) {
        ?>
        <script type="application/ld+json">
            {

            }
        </script>
    <?php
    }
    ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php
    do_action('wp_body_open');

    if (get_field('gtm_property', 'options')) {
        if (!is_user_logged_in()) {
    ?>
            <!-- Google Tag Manager (noscript) -->
            <noscript><iframe
                    src="https://www.googletagmanager.com/ns.html?id=<?= get_field('ga_property', 'options') ?>"
                    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
            <!-- End Google Tag Manager (noscript) -->
    <?php
        }
    }
    ?>
    <header class="pb-2 pt-2 pb-lg-0">
        <div class="container-xl header__grid">
            <div class="logo d-flex justify-content-between">
                <a href="/" title="Stormcatcher"><img src="<?= get_stylesheet_directory_uri() ?>/img/stormcatcher--dk.svg" alt="Stormcatcher" width="1163" height="215"></a>
                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <div class="phone text-lg-end d-none d-lg-block">
                Call us today: <span class="fw-bold">0333 7007 676</span>
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