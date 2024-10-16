<?php
$classes = $block['classList'] ?? 'pb-5';
?>
<section class="three_cols <?= $classes ?>">
    <div class="container-xl">
        <div class="three_cols__grid">
            <?php
            $tax = get_field('type') ?? null;
            $q = new WP_Query(array(
                'post_type' => 'products',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'ptype',
                        'field' => 'term_id',
                        'terms' => array($tax)
                    )
                )
            ));
            if ($q->have_posts()) {

                while ($q->have_posts()) {
                    $q->the_post();
                    $primary = get_the_post_thumbnail_url(get_the_ID(), 'full');
                    $imgs = get_field('images', get_the_ID()) ?? null;
                    $secondary = '';
                    if ($imgs) {
                        $secondary = wp_get_attachment_image_url($imgs[0], 'full');
                    }
            ?>
                    <a class="three_cols__card"
                        href="<?= get_the_permalink(get_the_ID()) ?>">
                        <div class="three_cols__image">
                            <img src="<?= $primary ?>" alt=""
                                class="three_cols__image--primary">
                            <?php
                            if ($secondary) {
                            ?>
                                <img src="<?= $secondary ?>" alt=""
                                    class="three_cols__image--secondary">
                            <?php
                            }
                            ?>
                        </div>
                        <div class="three_cols__content">
                            <h3 class="three_cols__title">
                                <?= get_the_title(get_the_ID()) ?>
                            </h3>
                            <div class="three_cols__materials">
                                <?= get_field('materials', get_the_ID()) ?>
                            </div>
                            <div class=" three_cols__price">
                                <?= get_field('price', get_the_ID()) ?>
                            </div>
                        </div>
                    </a>
            <?php
                }
            }
            ?>
        </div>
        <?php
        if (get_field('link') ?? null) {
            $l = get_field('link');
        ?>
            <div class="text-center mt-4">
                <a href="<?= $l['url'] ?>"
                    target="<?= $l['target'] ?>"
                    class="btn btn-primary"><?= $l['title'] ?></a>
            </div>
        <?php
        }
        ?>
    </div>
</section>