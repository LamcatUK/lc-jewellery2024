<?php
/* Template Name: Watch */
// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();
$img = get_the_post_thumbnail_url(get_the_ID(), 'full');
$content = get_the_content();
$blocks = parse_blocks($content);
?>
<main id="main" class="watch">
    <section class="breadcrumbs">
        <div class="container-xl">
            <?php
            if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<div id="breadcrumbs" class="my-2">', '</div>');
            }
            ?>
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
                        foreach (get_field('images') as $i) {
                        ?>
                            <button type="button" data-bs-target="#carousel"
                                data-bs-slide-to="<?= $c ?>"
                                aria-label="Slide <?= $c ?>"></button>
                        <?php
                            $c++;
                        }
                        ?>
                    </div>
                    <div class="carousel-inner h-100">
                        <div class="carousel-item h-100 active">
                            <a href="<?= $img ?>" class="glightbox"
                                data-gallery="gallery1">
                                <img src="<?= $img ?>" alt="image"
                                    class="d-block w-100" />
                            </a>
                        </div>
                        <?php
                        foreach (get_field('images') as $i) {
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
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 watch__content d-flex align-items-center bg--grey-200">
                <div class="watch__inner">
                    <h1 class="watch__title">
                        <?= get_field('product_name') ?>
                    </h1>
                    <div class="watch__materials">
                        <?= get_field('model_no') ?>
                    </div>
                    <div class="watch__variant">
                        <?= get_field('variant') ?>
                    </div>
                    <div class="watch__variant">
                        <?= get_field('material') ?>
                    </div>
                    <div class="watch__price">
                        $<?= number_format(get_field('price_usd')) ?>
                    </div>
                    <div class="fs-200 mb-5">*Prices may be subject to alteration at any time and do not constitute a contract.</div>
                    <?php
                    if (get_field('buy_link') ?? null) {
                        $l = get_field('buy_link');
                    ?>
                        <a href="<?= $l['url'] ?>" target="<?= $l['target'] ?>" class="btn btn-primary"><?= $l['title'] ?></a>
                    <?php
                    } else {
                    ?>
                        <a href="/contact-us/?subject=<?= get_field('model_no') ?>" class="btn btn-primary">Enquire</a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container-xl">
        <div class="row g-2">
            <div class="col-md-6">
                <h2>Description</h2>
                <?= get_field('detail') ?>
            </div>
            <div class="col-md-6">
                <h2>Specification</h2>
                <dl>
                    <?php
                    while (have_rows('spec')) {
                        the_row();
                    ?>
                        <dt><?= get_sub_field('title') ?></dt>
                        <dd><?= get_sub_field('detail') ?></dd>
                    <?php
                    }
                    ?>
                </dl>
            </div>
        </div>
    </div>
    <?php
    foreach ($blocks as $block) {
        echo render_block($block);
    }
    ?>
    <section class="breadcrumbs">
        <div class="container-xl">
            <?php
            if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<div id="breadcrumbs" class="mb-2">', '</div>');
            }
            ?>
        </div>
    </section>
</main>
<?php
get_footer();
?>