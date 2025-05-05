<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();
global $product;

$img = get_the_post_thumbnail_url(get_the_ID(), 'full');
?>
<main id="main" class="watch">
    <div class="container-xl">
        <?php woocommerce_output_all_notices(); ?>
    </div>
    <section class="breadcrumbs">
        <div class="container-xl">
            <div id="breadcrumbs" class="my-2">
                <span>
                    <span>
                        <a href="/">Home</a>
                    </span> »
                    <span>
                        <a href="/master-watchmaking/">Master Watchmaking</a>
                    </span> »
                    <span>
                        <a href="/master-watchmaking/artur-akmaev-watches/">Artur Akmaev Watches</a>
                    </span> »
                    <span class="breadcrumb_last" aria-current="page"><?= $product->get_sku() ?></span>
                </span>
            </div>
        </div>
    </section>
    <div class="container-fluid mb-4 px-0">
        <div class="row g-2">
            <div class="col-lg-6 watch__image">
                <div class="images carousel slide h-100" id="carousel" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <?php
                        $c = 1;
                        $gallery_image_ids = $product->get_gallery_image_ids();
                        if ($gallery_image_ids) {
                            foreach ($gallery_image_ids as $i) {
                        ?>
                                <button type="button" data-bs-target="#carousel"
                                    data-bs-slide-to="<?= $c ?>"
                                    aria-label="Slide <?= $c ?>"></button>
                        <?php
                                $c++;
                            }
                        }
                        ?>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item h-100 active">
                            <a href="<?= $img ?>" class="glightbox"
                                data-gallery="gallery1">
                                <img src="<?= $img ?>" alt="image"
                                    class="d-block w-100" />
                            </a>
                        </div>
                        <?php


                        if ($gallery_image_ids) {
                            foreach ($gallery_image_ids as $i) {
                        ?>
                                <div class="carousel-item h-100">
                                    <a href="<?= wp_get_attachment_image_url($i, 'full') ?>"
                                        class="glightbox" data-gallery="gallery1">
                                        <img src="<?= wp_get_attachment_image_url($i, 'full') ?>"
                                            alt="image" class="d-block w-100" />
                                    </a>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-lg-6 watch__content d-flex align-items-center bg--grey-200">
                <div class="watch__inner">
                    <h1 class="watch__title">
                        <?= get_the_title() ?>
                    </h1>
                    <div class="watch__variant">
                        <?= $product->get_short_description() ?>
                    </div>
                    <div class="watch__sku">
                        <?= $product->get_sku(); ?>
                    </div>
                    <div class="watch__materials">
                        <?= get_field('material') ?>
                    </div>
                    <div class="watch__price mb-5">
                        Price on Application
                        <?php
                        // £<?= number_format($product->get_price())
                        ?>
                    </div>
                    <!-- div class="fs-200 mb-5">*Prices may be subject to alteration at any time and do not constitute a contract.</div -->
                    <div class="mb-4">
                        <a href="/contact-us/" class="btn btn-primary">Enquire</a>
                    </div>
                    <?php
                    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
                    // woocommerce_template_single_add_to_cart();
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container-xl">
        <div class="row">
            <div class="col-md-6">
                <h2>Description</h2>
                <?php
                echo apply_filters('the_content', get_the_content());
                ?>
                <div class="product__reference mt-4">Reference:
                    <?= $product->get_sku(); ?>
                </div>
            </div>
            <div class="col-md-6">
                <h2>Specification</h2>
                <dl>
                    <?php
                    while (have_rows('gs_product_attributes')) {
                        the_row();
                    ?>
                        <dt>
                            <?= get_sub_field('title') ?>
                        </dt>
                        <dd>
                            <?= get_sub_field('detail') ?>
                        </dd>
                    <?php
                    }
                    ?>
                </dl>
            </div>
        </div>
    </div>
    <?php
    $related_ids = wc_get_related_products($product->get_id(), 4);

    $product_cats = get_the_terms($product->get_id(), 'product_cat');
    $related_ids = wp_list_pluck($product_cats, 'term_id');
    $collection_name = wp_list_pluck($product_cats, 'name');

    $related_ids[] = $product->get_id();
    if (!empty($related_ids)) {
    ?>
        <section class="related py-5">
            <div class="container-xl">
                <h2 class="text-center"><?= $collection_name[0] ?></h2>
                <div class="row g-2 justify-content-center">
                    <?php
                    $args = array(
                        'post_type'      => 'product',
                        'posts_per_page' => 4,
                        // 'post__in'       => $related_ids,
                        'orderby'        => 'title',
                        'order'          => 'ASC',
                        'tax_query'      => array(
                            array(
                                'taxonomy' => 'product_cat',
                                'field'    => 'term_id',
                                'terms'    => $related_ids,
                                'operator' => 'IN', // Finds products in any of the given categories
                            ),
                        ),
                    );

                    $d = 0;
                    $related_query = new WP_Query($args);
                    if ($related_query->have_posts()) {
                        while ($related_query->have_posts()) {
                            $related_query->the_post();
                            $related_product = wc_get_product(get_the_ID());
                            $o = $related_product->get_id();

                            $front = get_the_post_thumbnail($o, 'large', array('class' => 'related__front'));

                            // get gallery images here
                            $back = '';
                            $gallery_image_ids = $related_product->get_gallery_image_ids();
                            if (!empty($gallery_image_ids)) {
                                $back = $gallery_image_ids[0];
                                $back = wp_get_attachment_image($back, 'large', false, array('class' => 'related__back'));
                            }
                    ?>
                            <div class="col-md-6 col-lg-3 text-center" data-aos="fade" data-aos-delay="<?= $d ?>">
                                <a href="<?= get_the_permalink($o) ?>" class="related__card">
                                    <div class="related__images">
                                        <?= $front ?>
                                        <?= $back ?>
                                    </div>
                                    <h3><?= get_the_title($o) ?> - <?= get_field('material', $o) ?></h3>
                                    <div class="related__meta"><?= get_field('variant', $o) ?></div>
                                </a>
                            </div>
                    <?php
                            $d += 50;
                        }
                    }
                    ?>
                </div>
            </div>
        </section>
    <?php
    }
    ?>
</main>
<?php
get_footer();
?>