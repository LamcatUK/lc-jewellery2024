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
            style="background-image: url(<?= $img ?>)">
        </div>
    </section>

    <section class="full_text">
        <div class="container-xl text-center pt-5" data-aos="fade">
            <div class="full_text__pre_title">
                From the jeweller's bench
            </div>
            <h1 class="full_text__title">
                <?= single_cat_title() ?>
            </h1>
            <div class="max-ch text-center mx-auto">
                <?= category_description() ?>
            </div>
        </div>
    </section>
    <section class="news_index pb-4">
        <div class="container-xl bg-white py-4 px-0">
            <div class="navbuttons">
                <a href="/insights/" class="">All</a>
                <?php
                $current_category = get_queried_object();
                $category_slug = $current_category->slug;
                $allcats = get_categories();
                foreach ($allcats as $cat) {
                    if ($cat->slug == 'uncategorized') {
                        continue;
                    }
                    $active = $cat->slug == $current_category->slug ? 'active' : '';
                ?>
                    <a href="<?= get_category_link($cat->term_id) ?>"
                        class="<?= $active ?>"><?= $cat->name ?></a>
                <?php
                }
                ?>
            </div>
            <div class="news_index__grid">
                <?php
                $style = 'news_index__card--first';
                while (have_posts()) {
                    the_post();
                    $categories = get_the_category();
                    $cats = wp_list_pluck($categories, 'slug');
                    $cats = implode(' ', $cats);
                ?>
                    <a href="<?= get_the_permalink() ?>"
                        class="news_index__card <?= $style ?> <?= $cats ?>">
                        <div class="news_index__image">
                            <img src="<?= get_the_post_thumbnail_url(get_the_ID(), 'large') ?>"
                                alt="">
                        </div>
                        <div class="news_index__inner">
                            <h3 class="h2 mb-2"><?= get_the_title() ?></h3>
                            <p><?= get_field('excerpt', get_the_ID()) ?></p>
                            <div class="read_more">Read more </div>
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