<!-- related_pages -->
<section class="py-4 bg--light">
    <div class="container-lg">
        <div class="row">
            <div class="col-lg">
                <h3>Related Pages</h3>
                <?php
                $related = get_sub_field('page');
                if( $related ){
                    ?>
                    <ul>
                    <?php foreach( $related as $post ) {
                        setup_postdata($post);
                        ?>
                        <li>
                            <a href="<?=get_the_permalink()?>"><?=get_the_title()?></a>
                        </li>
                        <?php
                    }
                    ?>
                    </ul>
                    <?php
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
</section>
