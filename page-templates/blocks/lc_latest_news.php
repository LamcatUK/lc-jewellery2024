<?php
$q = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'ignore_sticky_posts' => 1
));
if ($q->have_posts()) {
    ?>
<section class="latest py-5">
    <div class="container-xl py-4 px-0">
        <h2 class="h2 pb-3 text-center" data-aos="fade">Latest Insights</h2>
        <div class="news_index__grid pb-5">
            <?php
            $d = 100;
    while($q->have_posts()) {
        $q->the_post();
        $ph = get_the_post_thumbnail_url(get_the_ID(), 'large') ?: get_stylesheet_directory_uri() . '/img/missing-hero.png';
        ?>
            <a href="<?=get_the_permalink()?>"
                class="news_index__card" data-aos="fade"
                data-aos-delay="<?=$d?>">
                <img src="<?=$ph?>"
                    alt="<?=get_the_title()?>">
                <div class="news_index__inner">
                    <h3 class="h2"><?=get_the_title()?></h3>
                </div>
            </a>
            <?php
            $d += 100;
    }
    ?>
        </div>
        <div class="text-center"><a href="/insights/" class="btn btn-primary">View All</a></div>
    </div>
</section>
<?php
}
?>