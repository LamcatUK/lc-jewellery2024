<?php
$classes = $block['classList'] ?? 'pb-5';
?>
<section class="three_cols <?=$classes?>">
    <div class="container-xl">
        <div class="three_cols__grid">
            <?php
            if (get_field('products') ?? null) {
                foreach (get_field('products') as $p) {
                    $primary = get_the_post_thumbnail_url($p->ID, 'full');
                    $imgs = get_field('images', $p->ID) ?? null;
                    $secondary = '';
                    if ($imgs) {
                        $secondary = wp_get_attachment_image_url($imgs[0], 'full');
                    }
                    ?>
            <a class="three_cols__card"
                href="<?=get_the_permalink($p->ID)?>">
                <div class="three_cols__image">
                    <img src="<?=$primary?>" alt=""
                        class="three_cols__image--primary">
                    <?php
                            if ($secondary) {
                                ?>
                    <img src="<?=$secondary?>" alt=""
                        class="three_cols__image--secondary">
                    <?php
                            }
                    ?>
                </div>
                <div class="three_cols__content">
                    <h3 class="three_cols__title">
                        <?=get_the_title($p->ID)?>
                    </h3>
                    <div class="three_cols__materials">
                        <?=get_field('materials', $p->ID)?>
                    </div>
                    <div class=" three_cols__price">
                        <?=get_field('price', $p->ID)?>
                    </div>
                </div>
            </a>
            <?php
                }
            }
?>
        </div>
        <?php
        // only display link if all cards are filled
        if (get_field('link') != '' && count(get_field('products')) > 3) {
            $l = get_field('link');
            ?>
        <div class="text-center mt-4">
            <a href="<?=$l['url']?>"
                target="<?=$l['target']?>"
                class="btn btn-primary"><?=$l['title']?></a>
        </div>
        <?php
        }
?>
    </div>
</section>