<?php
$txtcol = get_field('order') == 'Text/Image' ? 'order-2 order-md-1' : 'order-2 order-md-2';
$imgcol = get_field('order') == 'Text/Image' ? 'order-1 order-md-2' : 'order-1 order-md-1';

$txtanim = get_field('order') == 'Text/Image' ? 'fade-right' : 'fade-left';
$imganim = get_field('order') == 'Text/Image' ? 'fade-left' : 'fade-right';

$txtanim = 'fade';
$imganim = 'fade';
?>
<section class="showcase py-5">
    <div class="container-xl">
        <div class="h3 text-center d-md-none" data-aos="fade">
            <?= get_field('title') ?>
        </div>
        <div class="row g-5">
            <div class="col-lg-8 <?= $imgcol ?> d-flex align-items-center">
                <div class="row g-2">
                    <?php
                    $r = random_str(4);
                    $d = 0;
                    foreach (get_field('image') as $i) {
                    ?>
                        <div class="col-sm-4">
                            <a href="<?= wp_get_attachment_image_url($i, 'full') ?>"
                                class="glightbox" data-gallery="gallery<?= $r ?>" data-aos="<?= $imganim ?>" data-aos-delay="<?= $d ?>">
                                <?= wp_get_attachment_image($i, 'full', false, array('class' => 'showcase__image')) ?>
                            </a>
                        </div>
                    <?php
                        $d += 200;
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-4 <?= $txtcol ?> d-flex flex-column justify-content-center"
                data-aos="<?= $txtanim ?>">
                <h2 class="d-none d-md-block text-start h2">
                    <?= get_field('title') ?>
                </h2>
                <div><?= get_field('content') ?>
                </div>
            </div>
        </div>
    </div>
</section>