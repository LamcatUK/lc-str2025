<?php
$duration = lc_time_to_8601(get_sub_field('video_duration'));
?>
<!-- video -->
<section class="video">
    <div class="container">
        <div class="embed-responsive embed-responsive-16by9 my-5">
            <iframe class="embed-responsive-item"
                title="<?=get_sub_field('video_description')?>"
                src="https://www.youtube.com/embed/<?=get_sub_field('video_id')?>?rel=0"
                allowfullscreen="allowfullscreen"></iframe>
        </div>
    </div>
</section>
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "VideoObject",
        "name": "<?=get_sub_field('video_title')?>",
        "description": "<?=get_sub_field('video_description')?>",
        "thumbnailUrl": "https://img.youtube.com/vi/<?=get_sub_field('video_id')?>/0.jpg",
        "uploadDate": "<?=get_sub_field('video_date')?>",
        "duration": "<?=$duration?>",
        "embedUrl": "https://www.youtube.com/embed/<?=get_sub_field('video_id')?>"
    }
</script>