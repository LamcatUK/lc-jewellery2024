<?php
$img = get_field('columns')[0] == '4' ? '' : 'six_images';
?>
<section class="four_images <?=$img?>">
    <?php
$r = random_str(4);
foreach (get_field('images') as $i) {
    $caption = wp_get_attachment_caption($i) ?? null;
    $alt = get_post_meta($i, '_wp_attachment_image_alt', true) ?? $caption;
    ?>
    <a href="<?=wp_get_attachment_image_url($i, 'full')?>"
        class="glightbox" data-glightbox="title: <?=esc_html($caption)?>" data-gallery="gallery<?=$r?>">
        <?=wp_get_attachment_image($i, 'large', false, array('alt' => esc_html($alt)))?>
    </a>
    <?php
}
?>
</section>