<?php
$classes = $block['classList'] ?? 'py-5';
?>
<section class="three_cols <?= $classes ?>">
    <div class="container-xl">
        <div class="row gx-2 gy-4 justify-content-center">
            <?php
            $tax = get_field('type') ?? null;
            $q = new WP_Query(array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                'order'          => 'ASC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'term_id',
                        'terms' => array($tax)
                    )
                )
            ));

            $d = 0;
            if ($q->have_posts()) {

                while ($q->have_posts()) {
                    $q->the_post();
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

                    global $post;
                    $post = get_post($o);
                    setup_postdata($post);

                    if (has_term(array('dloke'), 'product_tag', $o)) {
                        $title = get_the_title($o) . ' - ' . get_field('material', $o);
                        $meta = get_field('variant', $o);
                    } elseif (has_term(array('artur-akmaev'), 'product_tag', $o)) {
                        $title = get_the_title($o);
                        $meta = $related_product->get_short_description();
                    } else {
                        $title = get_the_title($o);
                        $meta = get_the_title($o);
                    }
            ?>
                    <div class="col-md-6 col-lg-3 text-center" data-aos="fade" data-aos-delay="<?= $d ?>">
                        <a class="related__card"
                            href="<?= get_the_permalink($o) ?>">
                            <div class="related__images">
                                <?= $front ?>
                                <?= $back ?>
                            </div>
                            <h3><?= $title ?></h3>
                            <div class="related__meta">
                                <?= $meta ?>
                            </div>
                        </a>
                    </div>
            <?php
                    $d += 50;
                }
                wp_reset_postdata(); // Always reset after modifying $post
            }
            ?>
        </div>
    </div>
</section>