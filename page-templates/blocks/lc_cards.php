<?php
$class = $block['className'] ?? 'py-5';
?>
<section class="cards <?= $class ?>">
    <div class="container-xl">
        <div class="row">
            <?php
            while (have_rows('cards')) {
                the_row();
                $l = get_sub_field('cta');
            ?>
                <div class="col-lg-6 cards__card">
                    <?= wp_get_attachment_image(get_sub_field('image'), 'full', false, ['class' => 'cards__image']) ?>
                    <h2 class="h3"><?= get_sub_field('title') ?></h2>
                    <div><?= get_sub_field('content') ?></div>
                    <div class="cards__cta"><a href="<?= $l['url'] ?>" target="<?= $l['target'] ?>"><?= $l['title'] ?></a></div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>