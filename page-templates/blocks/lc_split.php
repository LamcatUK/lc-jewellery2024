<?php
$classes = $block['className'] ?? 'pb-5';

$orderImg = get_field('order') == 'Image Text' ? "order-2 order-md-1" : "order-2";
$orderText = get_field('order') == 'Image Text' ? "order-1 order-md-2" : "order-1";
$inner = get_field('order') == 'Image Text' ? 'split__inner--left' : 'split__inner--right';
?>
<section class="split container-fluid <?=$classes?>">
    <div class="row">
        <div class="col-md-6 split__image <?=$orderImg?>"
            style="background-image:url(<?=wp_get_attachment_image_url(get_field('image'), 'full')?>)"
            data-aos="fade">
        </div>
        <div
            class="col-md-6 split__text d-flex align-items-end bg--grey-200 <?=$orderText?>">
            <div class="split__inner <?=$inner?> py-5"
                data-aos="fade">
                <h2 class="h2">
                    <?=get_field('title')?>
                </h2>
                <div class="split__content">
                    <?=get_field('content')?>
                </div>
                <?php
                if (get_field('link') ?? null) {
                    $l = get_field('link');
                    ?>
                <a href="<?=$l['url']?>"
                    target="<?=$l['target']?>"
                    class="btn btn-primary mt-4"><?=$l['title']?></a>
                <?php
                }
?>
            </div>
        </div>
    </div>
</section>