<?php
/**
 * Template for displaying single blog posts.
 *
 * @package lc-str2025
 */

defined( 'ABSPATH' ) || exit;

$post_id = get_the_ID();
$img     = get_the_post_thumbnail( $post_id, 'full', array( 'class' => 'single-blog__image' ) );

add_action(
    'wp_head',
    function () {
        global $schema;
        echo esc_html( $schema );
    }
);

get_header();

?>
<main id="main" class="single-blog">
    <?php
    $content = get_the_content();
    $blocks  = parse_blocks( $content );
    $sidebar = array();
    $after;
    ?>
    <section class="breadcrumbs container-xl pb-2">
        <?php
        if ( function_exists( 'yoast_breadcrumb' ) ) {
            yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
        }
        ?>
    </section>
    <div class="container-xl">
        <div class="row g-4 pb-4">
            <div class="col-lg-9 order-2 order-lg-1">
                <h1 class="single-blog__title"><?= esc_html( get_the_title() ); ?></h1>
                <?= wp_kses_post( $img ); ?>
                <div class="single-blog__read">
                    <?= esc_html( get_the_date() ); ?><span>|</span>
                    <?= wp_kses_post( estimate_reading_time_in_minutes( get_the_content(), 200, true, true ) ); ?>
                </div>
                <?php
                foreach ( $blocks as $block ) {
                    if ( 'core/heading' === $block['blockName'] ) {
                        if ( ! array_key_exists( 'level', $block['attrs'] ) ) {
                            $heading    = wp_strip_all_tags( $block['innerHTML'] );
                            $heading_id = sanitize_title( $heading );
                            echo '<a id="' . esc_attr( $heading_id ) . '" class="anchor"></a>';
                            $sidebar[ $heading ] = $heading_id;
                        }
                    }
                    echo apply_filters( 'the_content', render_block( $block ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                }

                $categories = get_the_category( $post_id );

                if ( ! empty( $categories ) ) {
                    $first_category = $categories[0]; // This is a WP_Term object.
                    echo '<div class="mt-4 mb-5">';
                    echo wp_kses_post( phil_bio( $first_category->slug ) );
                    echo '</div>';
                }
                ?>
            </div>
            <div class="col-lg-3 order-1 order-lg-2">
                <div class="sidebar-insights">
                    <?php
                    if ( $sidebar ) {
                        ?>
                        <div class="quicklinks">
                            <div class="h5 has-line d-none d-lg-inline-block">Quick Links</div>
                            <button class="d-lg-none accordion-button collapsed h5" type="button" data-bs-toggle="collapse"
                                data-bs-target="#links" aria-expanded="true" aria-controls="links">Quick Links</button>

                            <!-- <div class="h5 d-lg-none" data-bs-toggle="collapse" href="#links" role="button">Quick Links</div> -->
                            <div class="collapse d-lg-block" id="links">
                                <ul class="pt-3 pt-lg-0">
                                    <?php
                                    foreach ( $sidebar as $heading => $heading_id ) {
                                        ?>
                                        <li><a
                                                href="#<?= esc_attr( $heading_id ); ?>"><?= esc_html( $heading ); ?></a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="sidebar-insights__cta mt-3 d-none d-lg-block">
                        <div class="fw-600 mb-3">Contact Stormcatcher for First Free Advice</div>
                        <div class="d-flex gap-2 justify-content-center align-items-center">
                            <a href="<?= esc_url( 'tel:' . parse_phone( get_field( 'contact_phone', 'option' ) ) ); ?>" class="button button-primary"><i class="fas fa-phone"></i> Call</a>
                            <a href="<?= esc_url( 'mailto:' . antispambot( get_field( 'contact_email', 'option' ) ) ); ?>" class="button button-primary"><i class="fas fa-paper-plane"></i> Email</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php

    $cats = get_the_category();
    $ids  = wp_list_pluck( $cats, 'term_id' );

    $q = new WP_Query(
        array(
            'post_type'      => 'post',
            'category__in'   => $ids,
            'posts_per_page' => 4,
            'post__not_in'   => array( get_the_ID() ),
        )
    );

    if ( $q->have_posts() ) {
        ?>
        <section class="related py-5 bg-grey-100">
            <div class="container-xl">
                <h3 class="fs-700 fancy fancy--wide"><span>Related</span> Insights</h3>
                <div class="grid my-4">
                    <?php
                    while ( $q->have_posts() ) {
                        $q->the_post();
                        $img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                        if ( ! $img ) {
                            $img = get_stylesheet_directory_uri() . '/img/default-blog.jpg';
                        }
                        ?>
                        <a class="grid__card grid__card--sm"
                            href="<?= esc_url( get_the_permalink( get_the_ID() ) ); ?>">
                            <div class="card__image_container">
                                <?= get_the_post_thumbnail( get_the_ID(), 'large', array( 'class' => 'card__image' ) ); ?>
                            </div>
                            <div class="card__inner">
                                <h3 class="card__title mb-0">
                                    <?= esc_html( get_the_title() ); ?>
                                </h3>
                            </div>
                        </a>
                        <?php
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </section>
        <?php
    }
    ?>
</main>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Person",
  "name": "Philip Harmer",
  "url": "https://stormcatcher.co.uk/about/",
  "image": "https://stormcatcher.co.uk/wp-content/uploads/2025/04/xphilip-harmer-e1745870942730-300x300.jpg.pagespeed.ic.cF5N3hgHPj.jpg",
  "jobTitle": "Consumer Rights Lawyer",
  "description": "Philip Harmer is a specialist consumer rights lawyer and founder of Stormcatcher Law. Called to the Bar at Middle Temple following completion of the Bar Professional Training Course at BPP Law School Holborn, he holds an LLB (Hons) Upper Second Class and an LLM from the University of Kent, specialising in consumer law and policy, banking and finance, and corporate governance. He has advised industry bodies and provided legal insight to the BBC, Morning Live and Watchdog.",
  "knowsAbout": [
    "Consumer Rights Law",
    "Consumer Law and Policy",
    "Consumer Credit Act 1974",
    "Consumer Rights Act 2015",
    "Faulty Goods Claims",
    "Misrepresentation and Mis-Selling",
    "Automotive Consumer Disputes",
    "Banking and Finance Law",
    "Corporate Governance",
    "Alternative Dispute Resolution",
    "International Arbitration",
    "International Trade Law",
    "Commercial Law"
  ],
  "hasCredential": [
    {
      "@type": "EducationalOccupationalCredential",
      "name": "Foundation Degree in Law, Legal System, Jurisprudence and Philosophy",
      "credentialCategory": "degree",
      "recognizedBy": {
        "@type": "Organization",
        "name": "MidKent College"
      }
    },
    {
      "@type": "EducationalOccupationalCredential",
      "name": "LLB (Hons) Qualifying Law Degree, Upper Second Class",
      "credentialCategory": "degree",
      "description": "Options in Company Law and Employment. Chair of Kent Law Clinic, winner of The Queen's Award 2008.",
      "recognizedBy": {
        "@type": "Organization",
        "name": "University of Kent"
      }
    },
    {
      "@type": "EducationalOccupationalCredential",
      "name": "LLM Master of Laws",
      "credentialCategory": "degree",
      "description": "Specialising in Consumer Law and Policy, Banking and Finance, and Corporate Governance. Member of Kent Law Clinic.",
      "recognizedBy": {
        "@type": "Organization",
        "name": "University of Kent"
      }
    },
    {
      "@type": "EducationalOccupationalCredential",
      "name": "Bar Professional Training Course, specialising in International Trade and Commercial Law",
      "credentialCategory": "professional qualification",
      "description": "Member of the Honourable Society of Middle Temple.",
      "recognizedBy": {
        "@type": "Organization",
        "name": "BPP Law School Holborn"
      }
    },
    {
      "@type": "EducationalOccupationalCredential",
      "name": "CIArb Accelerated Route to Membership in International Arbitration",
      "credentialCategory": "professional qualification",
      "recognizedBy": {
        "@type": "Organization",
        "name": "Chartered Institute of Arbitrators"
      }
    }
  ],
  "memberOf": {
    "@type": "Organization",
    "name": "Honourable Society of Middle Temple",
    "url": "https://www.middletemple.org.uk"
  },
  "alumniOf": [
    {
      "@type": "CollegeOrUniversity",
      "name": "University of Kent",
      "url": "https://www.kent.ac.uk"
    },
    {
      "@type": "CollegeOrUniversity",
      "name": "BPP Law School",
      "url": "https://www.bpp.com"
    },
    {
      "@type": "EducationalOrganization",
      "name": "MidKent College",
      "url": "https://www.midkent.ac.uk"
    }
  ],
  "worksFor": {
    "@type": "LegalService",
    "name": "Stormcatcher Law",
    "url": "https://stormcatcher.co.uk",
    "telephone": "+443337007676",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "58 Doods Park Road",
      "addressLocality": "Reigate",
      "addressRegion": "Surrey",
      "postalCode": "RH2 0PY",
      "addressCountry": "GB"
    }
  },
  "sameAs": [
    "https://www.linkedin.com/in/philip-harmer-95217546/"
  ]
}
</script>
<?php
get_footer();
?>