<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package lc-str2025
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

?>
<footer>
    <div class="container-xl">
        <div class="row py-3 py-lg-4 gy-4">
            <div class="col-12 col-xl-5 order-4 order-xl-1">
                <img src="<?= get_stylesheet_directory_uri() ?>/img/stormcatcher--wo.svg" width="1163" height="215" alt="Stormcatcher" class="mb-3 mx-auto mx-xl-0">
                <div class="fs-100 text-center text-xl-start">Stormcatcher Law, Stormcatcher Business Lawyers and Lawplan are trading names of Law Plan Services Limited, registered in England. Registered No: 10443305. Registered Office 58 Doods Park Road, Reigate, Surrey RH2 0PY. Authorised and Regulated by the Financial Conduct Authority. Reference: 937045</div>
            </div>
            <div class="col-sm-6 col-md-4 col-xl-2 col-xxl-2 order-1 order-xl-2">
                <div class="footer__title">Expertise</div>
                <?php wp_nav_menu(array('theme_location' => 'footer_menu_1')); ?>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-4 col-xl-2 order-2 order-xl-3">
                <div class="footer__title">Useful Links</div>
                <?php wp_nav_menu(array('theme_location' => 'footer_menu_2')); ?>
            </div>
            <div class="col-12 col-md-4 col-xl-3 order-3 order-xl-4">
                <div class="footer__title">Contact Us</div>
                <ul class="fa-ul">
                    <li><span class="fa-li"><i class="fa-solid fa-phone"></i></span> <a class="footer__call mb-4" href="tel:<?= parse_phone(get_field('contact_phone', 'options')) ?>"><?= get_field('contact_phone', 'options') ?></a></li>
                    <li><span class="fa-li"><i class="fa-solid fa-paper-plane"></i></span> <a class="footer__email mb-4" href="mailto:<?= get_field('contact_email', 'options') ?>"><?= get_field('contact_email', 'options') ?></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="colophon">
        <div class="container-xl py-2">
            <div class="row g-2">
                <div class="col-xl-10 text-center text-xl-start">
                    &copy; <?= date('Y') ?> Lawplan Services Limited |
                    <a href="/terms/">Terms</a> |
                    <a href="/privacy-policy/">Privacy</a> &amp; <a href="/cookie-policy/">Cookie</a> Policies
                </div>
                <div class="col-xl-2 text-center text-xl-end">
                    Site by <a href="https://www.lamcat.co.uk/" target="_blank">Lamcat</a>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>