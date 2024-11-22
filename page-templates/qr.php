<?php
/*
Template Name: QR Links
*/
// Exit if accessed directly.
defined('ABSPATH') || exit;
 
get_header();
// <a class="qr__button" href="https://wa.me/<?=ltrim(parse_phone(get_field('contact_phone','options')), '+')?>" target="_blank">
?>
<main>
    <div class="container-xl qr">
        <h2 class="mb-0">Contact Us</h2>
        <a class="qr__button" href="tel:<?=parse_phone(get_field('contact_phone','options'))?>">
            <i class="fa-solid fa-phone"></i> Call <?=get_field('contact_phone','options')?>
        </a>
        <a class="qr__button" href="/get-quote/">
            <i class="fa-solid fa-coins"></i> Get Quote
        </a>
        <a class="qr__button" href="https://api.whatsapp.com/send?phone=<?=parse_phone(get_field('contact_phone','options'))?>&text=Hi,%20I%27m%20contacting%20you%20from%20the%20RJR%20Waste%20Clearance%20website." target="_blank">
            <i class="fa-brands fa-whatsapp"></i> WhatsApp
        </a>
        <a class="qr__button" href="mailto:<?=get_field('contact_email','options')?>">
            <i class="fa-solid fa-envelope"></i> Email
        </a>
        <h2 class="mb-0">Connect</h2>
        <?php
        $s = get_field('socials', 'options');
        // echo '<pre>' . var_dump($s) . '</pre>';
        
        if ($s['linkedin_url'] ?? null) {
            ?>
        <a href="<?=$s['linkedin_url']?>" target="_blank" class="qr__button">
            <i class="fa-brands fa-linkedin-in"></i> LinkedIn
        </a>
            <?php
        }
        if ($s['instagram_url'] ?? null) {
            ?>
        <a href="<?=$s['instagram_url']?>" target="_blank" class="qr__button">
            <i class="fa-brands fa-instagram"></i> Instagram
        </a>
            <?php
        }
        if ($s['facebook_url'] ?? null) {
            ?>
        <a href="<?=$s['facebook_url']?>" target="_blank" class="qr__button">
            <i class="fa-brands fa-facebook-f"></i> Facebook
        </a>
            <?php
        }
        ?>
    </div>
</main>
<?php
get_footer();
?>