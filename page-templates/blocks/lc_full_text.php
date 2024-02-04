<section class="full_text">
    <div class="container-xl text-center py-5" data-aos="fade">
        <?php
        if (get_field('pre_title') ?? null) {
            ?>
        <div class="full_text__pre_title">
            <?=get_field('pre_title')?>
        </div>
        <?php
        }
        if (get_field('title') ?? null) {
            ?>
        <h1 class="full_text__title">
            <?=get_field('title')?>
        </h1>
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