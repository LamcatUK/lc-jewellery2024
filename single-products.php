<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();
$img = get_the_post_thumbnail_url(get_the_ID(), 'full');
?>
<main id="main" class="product">
    <?php
    $content = get_the_content();
$blocks = parse_blocks($content);
$after;

/*
?>
    <section class="breadcrumbs container-xl">
        <?php
if (function_exists('yoast_breadcrumb')) {
    yoast_breadcrumb('<div id="breadcrumbs" class="mb-2">', '</div>');
}
?>
</section>
<?php
*/
?>
    <div class="container-fluid mb-4 px-0">
        <div class="row g-2">
            <div class="col-lg-6 product__image">
                <div class="images carousel slide" id="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <?php
                        $c = 1;
foreach (get_field('images') as $i) {
    ?>
                        <button type="button" data-bs-target="#carousel"
                            data-bs-slide-to="<?=$c?>"
                            aria-label="Slide <?=$c?>"></button>
                        <?php
    $c++;
}

?>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <a href="<?=$img?>" class="glightbox"
                                data-gallery="gallery1">
                                <img src="<?=$img?>" alt="image"
                                    class="d-block w-100" />
                            </a>
                        </div>
                        <?php
                            foreach (get_field('images') as $i) {
                                ?>
                        <div class="carousel-item">
                            <a href="<?=wp_get_attachment_image_url($i, 'full')?>"
                                class="glightbox" data-gallery="gallery1">
                                <img src="<?=wp_get_attachment_image_url($i, 'full')?>"
                                    alt="image" class="d-block w-100" />
                            </a>
                        </div>
                        <?php
                            }
?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 product__content d-flex align-items-center bg--grey-200">
                <div class="product__inner">
                    <h1 class="product__title">
                        <?=get_the_title()?>
                    </h1>
                    <div class="product__materials">
                        <?=get_field('materials')?>
                    </div>
                    <div class="product__price">
                        <?=get_field('price')?>
                    </div>
                    <?php
$first = 0;
foreach ($blocks as $block) {
    if ($first == 1) {
        continue;
    }
    if ($block['blockName'] == 'core/paragraph') {
        $first = 1;
    }
    echo render_block($block);
}
?>
                    <a href="/contact-us/" class="btn btn-primary">Enquire</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-xl">
        <div class="row">
            <div class="col-md-6">
                <h2>Description</h2>
                <?php
foreach ($blocks as $block) {
    echo render_block($block);
}
?>
                <div class="product__reference">Reference:
                    <?=get_field('reference')?>
                </div>
            </div>
            <div class="col-md-6">
                <h2>Details</h2>
                <?php
                while (have_rows('details')) {
                    the_row();
                    ?>
                <h3>
                    <?=get_sub_field('title')?>
                </h3>
                <div class="mb-4">
                    <?=get_sub_field('content')?>
                </div>
                <?php
                }
?>
            </div>
        </div>
    </div>
    <?php
    if (get_field('related_products')) {
        ?>
    <section class="related bg--grey-200 py-5">
        <div class="container-xl">
            <h2>You may also like</h2>
            <div class="four_cols__grid">
                <?php
            foreach (get_field('related_products') as $p) {
                $primary = get_the_post_thumbnail_url($p->ID, 'full');
                $imgs = get_field('images', $p->ID) ?? null;
                $secondary = '';
                if ($imgs) {
                    $secondary = wp_get_attachment_image_url($imgs[0], 'full');
                }
                ?>
                <a class="four_cols__card"
                    href="<?=get_the_permalink($p->ID)?>">
                    <div class="four_cols__image">
                        <img src="<?=$primary?>" alt=""
                            class="four_cols__image--primary">
                        <?php
                            if ($secondary) {
                                ?>
                        <img src="<?=$secondary?>" alt=""
                            class="four_cols__image--secondary">
                        <?php
                            }
                ?>
                    </div>
                    <div class="four_cols__content">
                        <h3><?=get_the_title($p->ID)?></h3>
                        <div class="four_cols__materials">
                            <?=get_field('materials', $p->ID)?>
                        </div>
                        <div class=" four_cols__price">
                            <?=get_field('price', $p->ID)?>
                        </div>
                    </div>
                </a>
                <?php
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
add_action('wp_footer', function () {
    ?>
<link rel="stylesheet"
    href="<?=get_stylesheet_directory_uri()?>/css/glightbox.css" />
<script src="<?=get_stylesheet_directory_uri()?>/js/glightbox.min.js">
</script>
<script type="text/javascript">
    const lightbox = GLightbox();
</script>
<?php
}, 9999);

get_footer();
?>