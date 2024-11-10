<?php
$align = get_field('align') ?? null;
$class = 'hero__bg ' . $align;
?>
<section class="hero">
    <div class="container-xl px-0">
        <?= wp_get_attachment_image(get_field('background'), 'full', false, array('class' => $class)) ?>
    </div>
</section>