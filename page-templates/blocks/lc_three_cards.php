<?php
$classes = $block['classList'] ?? 'pb-5';
?>
<section class="three_cards <?=$classes?>">
    <div class="container-xl">
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade">
                <img src="<?=wp_get_attachment_image_url(get_field('image_1'), 'large')?>"
                    class="mb-2" alt="">
                <h2 class="h3 mb-2">
                    <?=get_field('title_1')?>
                </h2>
                <div><?=get_field('content_1')?>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade">
                <img src="<?=wp_get_attachment_image_url(get_field('image_2'), 'large')?>"
                    class="mb-2" alt="">
                <h2 class="h3 mb-2">
                    <?=get_field('title_2')?>
                </h2>
                <div><?=get_field('content_2')?>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade">
                <img src="<?=wp_get_attachment_image_url(get_field('image_3'), 'large')?>"
                    class="mb-2" alt="">
                <h2 class="h3 mb-2">
                    <?=get_field('title_3')?>
                </h2>
                <div><?=get_field('content_3')?>
                </div>
            </div>
        </div>
    </div>
</section>