<section class="contact py-5">
    <div class="container-xl">
        <div class="row gy-5">
            <div class="col-lg-5">
                <h2 class="h3">Contact Us Directly</h2>
                <ul class="fa-ul mb-4">
                    <li><span class="fa-li"><i class="fa-solid fa-phone"></i></span> <?= do_shortcode('[contact_phone]') ?></li>
                    <li><span class="fa-li"><i class="fa-solid fa-paper-plane"></i></span> <?= do_shortcode('[contact_email]') ?></li>
                </ul>
                <h2 class="h4">Connect on Social Media</h2>
                <div class="mb-4">
                    <?= do_shortcode('[social_icons]') ?>
                </div>
                <?= do_shortcode('[lc_open_ajax]') ?>
            </div>
            <div class="col-lg-7">
                <h2 class="h3">Send a Message</h2>
                <?= do_shortcode("[contact-form-7 id='" . get_field('form_id') . "']") ?>
            </div>
        </div>
    </div>
</section>