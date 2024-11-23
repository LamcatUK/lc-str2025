<!-- two_col_7-5 -->
<section class="two_col_7-5 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php
                if (get_sub_field('title')) {
                    ?>
                <h2><?=get_sub_field('title')?></h2>
                    <?php
                }
                ?>
                <?=apply_filters( 'the_content', get_sub_field('content') )?>
            </div>
            <div class="col-md-4">
                <a href="https://www.linkedin.com/in/philip-harmer-95217546/?trk=profile-badge-cta" target="_blank" rel="noopener noreferrer" aria-label="Philip Harmer on LinkedIn">
                    <img src="<?=get_stylesheet_directory_uri()?>/img/PH-LinkedIn.png" width="252" height="367" class="img-fluid d-flex mx-auto" alt="Philip Harmer on LinkedIn">
                </a>
            </div>
        </div>
    </div>
</section>
