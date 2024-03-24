<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();
$img = get_the_post_thumbnail_url(get_the_ID(), 'full');
?>
<div class="blog-overlay"></div>
<main id="main" class="blog">
    <?php
    $content = get_the_content();
$blocks = parse_blocks($content);
$sidebar = array();
$after;
?>
    <div class="container-xl">
        <div class="row g-3">
            <div class="col-lg-9 order-2 pt-2 pt-lg-3 content_col">
                <img src="<?=$img?>" alt="" class="blog__image mb-4">
                <div class="blog__content bg-white mb-2">
                    <h1 class="blog__title"><?=get_the_title()?></h1>
                    <?php
/*
<div class="news_index__meta mb-4">
$categories = get_the_category();

if ($categories) {
    foreach ($categories as $category) {
        ?>
                        <span
                            class="news_index__category"><?=esc_html($category->name)?></span>
                        <?php
    }
}
?>
                    </div>
                    <?php
*/
$count = estimate_reading_time_in_minutes(get_the_content(), 200, true, true);
echo '<div class="blog__read">' . $count . '</div>';

foreach ($blocks as $block) {
    if ($block['blockName'] == 'core/heading') {
        if (!array_key_exists('level', $block['attrs'])) {
            $heading = strip_tags($block['innerHTML']);
            $id = acf_slugify($heading);
            echo '<a id="' . $id . '" class="anchor"></a>';
            $sidebar[$heading] = $id;
        }
    }
    echo render_block($block);
}
?>
                </div>
            </div>
            <div class="col-lg-3 order-1 sidebar_col">
                <div class="sidebar pb-2">
                    <div class="h6 d-lg-none headline mb-0 collapsed" data-bs-toggle="collapse" href="#links"
                        role="button">Quick
                        Links
                    </div>
                    <div class="h6 d-none d-lg-block headline">Quick Links</div>
                    <div class="collapse d-lg-block" id="links">
                        <ul class="pt-3 pt-lg-0">
                            <?php
                    foreach ($sidebar as $s => $l) {
                        ?>
                            <li><a
                                    href="#<?=$l?>"><?=$s?></a>
                            </li>
                            <?php
                    }
?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
            $cats = get_the_category();
$ids = wp_list_pluck($cats, 'term_id');
$r = new WP_Query(array(
    'category__in' => $ids,
    'posts_per_page' => 3,
    'post__not_in' => array(get_the_ID())
));
if ($r->have_posts()) {
    ?>
    <section class="related_news pb-2">
        <div class="container-xl">
            <div class="bg-white py-4 mb-2">
                <h2>Related Articles</h2>
                <div class="news_index__grid">
                    <?php
                    $d = 0;
    while ($r->have_posts()) {
        $r->the_post();
        $ph = get_the_post_thumbnail_url(get_the_ID(), 'large') ?: get_stylesheet_directory_uri() . '/img/missing-hero.png';
        ?>
                    <a href="<?=get_the_permalink()?>"
                        class="news_index__card" data-aos="fade"
                        data-aos-delay="<?=$d?>">
                        <div class="news_index__image">
                            <img src="<?=$ph?>"
                                alt="<?=get_the_title()?>">
                        </div>
                        <div class="news_index__inner">
                            <h3><?=get_the_title()?></h3>
                        </div>
                    </a>
                    <?php
    $d += 100;
    }
    ?>
                </div>
            </div>
        </div>
    </section>
    <?php
}
?>
    <section class="breadcrumbs container-xl">
        <?php
if (function_exists('yoast_breadcrumb')) {
    yoast_breadcrumb('<div id="breadcrumbs" class="my-2">', '</div>');
}
?>
    </section>

</main>
<?php
add_action('wp_footer', function () {
    ?>
<script>
    const links = document.querySelectorAll('div#links > ul > li a');

    function removeShowClass() {
        const divLinks = document.querySelector('div#links');
        if (divLinks.classList.contains('show')) {
            divLinks.classList.remove('show');
        }
    }
    links.forEach(link => {
        link.addEventListener('click', removeShowClass);
    });
</script>
<?php
});
get_footer();
?>