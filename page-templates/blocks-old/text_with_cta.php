<!-- text-with_cta -->
<section class="pb-4">
    <div class="container-lg">
        <div class="row">
            <div class="col-lg-8">
                <?php
                if (get_sub_field('title')) {
                    ?>
                <h2><?=get_sub_field('title')?></h2>
                    <?php
                }
                ?>
                <?=apply_filters( 'the_content', get_sub_field('content') )?>
            </div>
            <div class="col-lg-4">
                <div class="card cta">
                    <div class="card-body text-center">
                        <div class="card-title">
                        <p><?=get_sub_field('cta')?></p>
                        <p><a href="tel:+443337007676" class="callbtn">0333 700 7676</a></p>
                        </div>
                        <a href="tel:+443337007676" class="btn-orange callbtn mb-2"><i class="icon-phone"></i> Call</a>
                        <a href='ma&#105;&#108;to&#58;&#107;%6Eow%6C%65%&#54;4%67&#37;6&#53;&#64;&#115;to%7&#50;mc&#97;tc&#37;&#54;8e&#114;&#46;c&#111;&#46;&#117;k' class="btn-orange emailbtn mb-2"><i class="icon-envelope"></i> Email</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
