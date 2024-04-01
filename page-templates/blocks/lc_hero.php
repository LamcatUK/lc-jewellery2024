<?php
$bg = wp_get_attachment_image_url(get_field('background'), 'full');
?>
<section class="hero">
    <div class="container-xl"
        style="background-image: url(<?=$bg?>)">
    </div>
</section>