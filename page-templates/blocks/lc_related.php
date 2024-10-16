<?php
if (get_field('related')) {

    $has_bg = get_field('has_bg');
    $bg = is_array($has_bg) && isset($has_bg[0]) && $has_bg[0] == 'Yes' ? 'bg--grey-200 my-5' : '';
?>
    <section class="related <?= $bg ?> py-5">
        <div class="container-xl">
            <?php
            if (get_field('title') ?? null) {
            ?>
                <h2 class="text-center"><?= get_field('title') ?></h2>
            <?php
            }
            ?>
            <div class="row g-2 justify-content-center">
                <?php
                $d = 0;
                foreach (get_field('related') as $o) {
                ?>
                    <div class="col-md-6 col-lg-3 text-center" data-aos="fade" data-aos-delay="<?= $d ?>">
                        <a href="<?= get_the_permalink($o) ?>" class="related__card">
                            <?= get_the_post_thumbnail($o, 'large', array('class' => 'mb-3')) ?>
                            <h3><?= get_the_title($o) ?> - <?= get_field('material', $o) ?></h3>
                            <div class="related__meta"><?= get_field('variant', $o) ?></div>
                        </a>
                    </div>
                <?php
                    $d += 50;
                }
                ?>
            </div>
        </div>
    </section>
<?php
}
