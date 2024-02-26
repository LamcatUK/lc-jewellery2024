<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

$page_for_posts = get_option('page_for_posts');

get_header();
?>
<main id="main">
    <?php
$img = get_the_post_thumbnail_url($page_for_posts, 'full') ?? null;
?>
    <section class="hero">
        <div class="container-xl"
            style="background-image: url(<?=$img?>)">
        </div>
    </section>

    <section class="full_text">
        <div class="container-xl text-center py-5" data-aos="fade">
            <div class="full_text__pre_title">
                From the jeweller's bench
            </div>
            <h1 class="full_text__title">
                Insights
            </h1>
            <div class="max-ch text-center mx-auto">
                Here, we share expert knowledge and fascinating stories designed to guide and inspire. From the secrets
                behind selecting the perfect diamond to understanding the intricacies of jewellery craftsmanship, our
                articles illuminate every corner of the gemstone universe. Dive into our insights and enrich your
                journey through the captivating realm of gems.
            </div>
        </div>
    </section>
    <section class="news_index pb-4">
        <div class="container-xl bg-white py-4 px-0">
            <?=get_the_content(null, false, $page_for_posts)?>
            <div class="news_index__grid">
                <?php
    $style = 'news_index__card--first';
while (have_posts()) {
    the_post();
    $categories = get_the_category();
    ?>
                <a href="<?=get_the_permalink()?>"
                    class="news_index__card <?=$style?>">
                    <img src="<?=get_the_post_thumbnail_url(get_the_ID(), 'large')?>"
                        alt="">
                    <div class="news_index__inner">
                        <h2><?=get_the_title()?></h2>
                        <?php
                            /*
                            <div class="news_index__meta">
    if ($categories) {
        foreach ($categories as $category) {
            ?>
                            <span
                                class="news_index__category"><?=esc_html($category->name)?></span>
                            <?php
        }
    }
                            </div>
    */
    ?>

                    </div>
                </a>
                <?php
    $style = '';
}
?>
            </div>
        </div>
    </section>
</main>
<?php

get_footer();
?>