<?php
$cats = get_sub_field('category');
?>
<!-- related_posts -->
<section class="pb-4">
    <div class="container">
        <?=related_posts_by_cat($cats)?>
    </div>
</section>
