<?php
$img = get_field('columns')[0] == '4' ? '' : 'six_images';
?>
<section class="four_images <?=$img?>">
    <?php
$r = random_str(4);
foreach (get_field('images') as $i) {
    ?>
    <a href="<?=wp_get_attachment_image_url($i, 'full')?>"
        class="glightbox" data-gallery="gallery<?=$r?>">
        <img src="<?=wp_get_attachment_image_url($i, 'large')?>"
            alt="">
    </a>
    <?php
}
?>
</section>