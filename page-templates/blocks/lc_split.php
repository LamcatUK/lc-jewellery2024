<?php
$classes = $block['className'] ?? null;
$bg = get_field('colour') ?? null;

$image_order = get_field('order') == 'Image/Text' ? '' : 'order-md-2';
$text_order = get_field('order') == 'Image/Text' ? '' : 'order-md-1';
$text_alignment = get_field('order') == 'Image/Text' ? 'text--right' : 'text--left  ';

$img = wp_get_attachment_image_url(get_field('image'), 'full') ?: get_stylesheet_directory_uri() . '/img/placeholder-800x450.png';
?>
<section
    class="split <?= $bg ?> <?= $classes ?>">
    <div class="container-fluid">
        <div class="h2 d-md-none text-center pt-3">
            <?= get_field('title') ?>
        </div>
        <div class="row">
            <div class="col-md-6 split__image <?= $image_order ?>"
                style="background-image:url(<?= $img ?>)"
                data-aos="fade">
            </div>
            <div class="col-md-6 <?= $text_order ?>" data-aos="fade">
                <div class="ps-xl-3 py-5 <?= $text_alignment ?>">
                    <h2 class="h2 d-none d-md-block">
                        <?= get_field('title') ?>
                        </h3>
                        <?= get_field('content') ?>
                        <?php
                        if (get_field('link') ?? null) {
                            $l = get_field('link');
                        ?>
                            <a href="<?= $l['url'] ?>"
                                class="btn btn-primary mx-auto ms-md-0"
                                target="<?= $l['target'] ?>"><?= $l['title'] ?></a>
                        <?php
                        }
                        ?>
                </div>
            </div>
        </div>
    </div>
</section>