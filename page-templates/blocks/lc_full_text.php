<?php
$classes = $block['className'] ?? 'py-5';
?>
<section class="full_text">
    <div class="container-xl text-center pt-5 <?=$classes?>"
        data-aos="fade">
        <?php
        if (get_field('pre_title') ?? null) {
            ?>
        <div class="full_text__pre_title">
            <?=get_field('pre_title')?>
        </div>
        <?php
        }
if (get_field('title') ?? null) {
    $level = get_field('level');
    ?>
        <<?=$level?> class="full_text__title">
            <?=get_field('title')?>
        </<?=$level?>>
        <?php
}
?>
        <div class="max-ch text-center mx-auto">
            <?=apply_filters('the_content', get_field('content'))?>
        </div>
        <?php
if (get_field('cta') ?? null) {
    $l = get_field('cta');
    ?>
        <a class="btn btn-primary mx-auto mt-3"
            href="<?=$l['url']?>"
            target="<?=$l['target']?>">
            <?=$l['title']?>
        </a>
        <?php
}
?>
    </div>
</section>