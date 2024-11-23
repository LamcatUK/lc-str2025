<!-- full_width -->
<section class="pb-4 bg--light">
    <div class="container-lg">
        <div class="row">
            <div class="col-lg">
                <?php if (get_sub_field('title')) {
                    echo '<h2>' . get_sub_field('title') . '</h2>';
                }
                ?>
                <?=get_sub_field('content')?>
            </div>
        </div>
    </div>
</section>
