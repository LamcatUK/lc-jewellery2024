<?php
$txtcol = get_field('order') == 'Text/Image' ? 'order-2 order-md-1' : 'order-2 order-md-2';
$imgcol = get_field('order') == 'Text/Image' ? 'order-1 order-md-2' : 'order-1 order-md-1';

$txtanim = get_field('order') == 'Text/Image' ? 'fade-right' : 'fade-left';
$imganim = get_field('order') == 'Text/Image' ? 'fade-left' : 'fade-right';

$txtanim = 'fade';
$imganim = 'fade';

?>
<section class="feature py-5">
    <div class="container-xl">
        <?php
        if (get_field('title') ?? null) {
        ?>
            <div class="h2 text-center d-md-none" data-aos="fade">
                <?= get_field('title') ?>
            </div>
        <?php
        }
        ?>
        <div class="row g-4">
            <div class="col-md-6 <?= $txtcol ?> d-flex flex-column justify-content-center"
                data-aos="<?= $txtanim ?>">
                <?php
                if (get_field('title') ?? null) {
                ?>
                    <h2 class="d-none d-md-block text-center h2">
                        <?= get_field('title') ?>
                    </h2>
                <?php
                }
                ?>
                <div><?= get_field('content') ?>
                </div>
                <?php
                if (get_field('link') ?? null) {
                    $l = get_field('link');
                ?>
                    <a href="<?= $l['url'] ?>"
                        target="<?= $l['target'] ?>"
                        class="btn btn-primary mx-auto mt-3"><?= $l['title'] ?></a>
                <?php
                }
                ?>
            </div>
            <div class="col-md-6 <?= $imgcol ?> d-flex align-items-center"
                data-aos="<?= $imganim ?>">
                <img src="<?= wp_get_attachment_image_url(get_field('image'), 'large') ?>"
                    alt="<?= get_field('title') ?>"
                    class="feature__img mx-auto">
            </div>
        </div>
    </div>
</section>