<?php
$classes = $block['className'] ?? 'py-5';
?>
<section class="accordion_block <?= $classes ?>">
    <div class="container-xl" data-aos="fade">
        <?php
        if (get_field('accordion_title')) {
        ?>
            <h2 class="h2 text-center text-md-start mb-4">
                <?= get_field('accordion_title') ?>
            </h2>
        <?php
        }
        if (get_field('accordion_intro')) {
        ?>
            <div class="mb-4 accordion_intro">
                <?= get_field('accordion_intro') ?>
            </div>
        <?php
        }
        ?>
        <div class="accordion" id="accordion">
            <?php
            $c = 0;
            while (have_rows('items')) {
                the_row();
            ?>
                <div class="accordion-item">
                    <h2 class="accordion-header accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c<?= $c ?>">
                        <?= get_sub_field('title') ?>
                    </h2>
                    <div id="c<?= $c ?>" class="accordion-collapse collapse" data-bs-parent="#accordion">
                        <div class="accordion-body">
                            <?= get_sub_field('content') ?>
                        </div>
                    </div>
                </div>
            <?php
                $c++;
            }
            ?>
        </div>
</section>