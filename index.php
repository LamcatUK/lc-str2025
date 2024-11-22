<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();

$pp = get_option('page_for_posts');

?>
<section class="hero">
    <img src="<?=get_stylesheet_directory_uri()?>/img/hero-pattern.png" alt="" class="hero__bg">
    <div class="hero__words container-xl h-100 d-flex align-items-center">
        <div class="row w-100">
            <div class="col-md-6 d-flex flex-column align-items-start justify-content-center">
                <h1>The Beauty Thread</h1>
                <a href="/contact/" class="button button-primary">Book Now</a>
            </div>
        </div>
    </div>
    <div class="hero__img container-xl">
        <div class="row h-100">
            <div class="col-md-6 offset-md-6 position-relative d-grid">
            <?php
                echo wp_get_attachment_image( get_field('image'), 'large', false, array('alt' => '', 'class' => 'hero__image') );
            ?>
            </div>
        </div>
    </div>
</section>
<main id="main" class="pb-5">
    <div class="container-xl py-5 mb-5">
        <?php
$cats = get_categories(array('exclude' => array(32)));
?>
        <div class="filters mb-4">
            <?php
echo '<button class="button button-outline-primary button--sm active me-2 mb-2" data-filter="*">All</button>';
foreach ($cats as $cat) {
    echo '<button class="button button-outline-primary button--sm me-2 mb-2" data-filter=".' . acf_slugify($cat->name) . '">' . $cat->cat_name . '</button>';
}
?>
        </div>
        <div class="grid">
            <?php
    while (have_posts()) {
        the_post();
        $img = get_the_post_thumbnail_url(get_the_ID(), 'large');
        if (!$img) {
            $img = get_stylesheet_directory_uri() . '/img/default-blog.jpg';
        }
        $cats = get_the_category();
        $category = wp_list_pluck($cats, 'name');
        $flashcat = acf_slugify($category[0]);
        $catclass = implode(' ', array_map('acf_slugify', $category));
        $category = implode(', ', $category);

        $the_date = get_the_date('jS F, Y');

        ?>
            <a class="grid__card <?=$catclass?>"
                href="<?=get_the_permalink(get_the_ID())?>">
                <div class="card card--<?=$flashcat?>">
                    <div class="card__image_container">
                        <div
                            class="card__flash card__flash--<?=$flashcat?>">
                            <?=$category?>
                        </div>
                        <?=get_the_post_thumbnail(get_the_ID(), 'large', array('class' => 'card__image'))?>
                    </div>
                    <div class="card__inner">
                        <h3 class="card__title mb-0">
                            <?=get_the_title()?>
                        </h3>
                        <div class="card__date"><?=$the_date?>
                        </div>
                        <div class="card__content">
                            <div class="card__content__overlay"></div>
                            <?=wp_trim_words(get_the_content(get_the_ID()), 20)?>
                        </div>
                    </div>
                </div>
            </a>
            <?php
    }
?>
        </div>
    </div>
</main>
<?php
add_action('wp_footer', function () {
    ?>
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        var grid = document.querySelector('.grid');
        var iso = new Isotope(grid, {
            itemSelector: '.grid__card',
            percentPosition: true,
            layoutMode: 'fitRows',
            fitRows: {
                equalheight: true
            }
        });

        var filterButtons = document.querySelectorAll('.filters button');
        filterButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var filterValue = this.getAttribute('data-filter');
                iso.arrange({
                    filter: filterValue
                });
                filterButtons.forEach(function(btn) {
                    btn.classList.remove('active');
                });
                this.classList.add('active');
            });
        });

    });
</script>
<?php
}, 9999);

get_footer();
?>