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
            <div class="full_text mb-4" data-aos="fade">
                <div class="full_text__pre_title">
                    The Art & Science of Fine Craftsmanship
                </div>
                <h1 class="full_text__title">
                    From the jeweller's bench
                </h1>
                <p class="text-center max-ch mx-auto" data-aos="fade">At Griffin & Sloane, craftsmanship extends beyond creation—it is a story of artistry, heritage, and expertise. Our insights invite you to explore the intricacies of fine jewellery, the evolution of horology, and the timeless allure of the world's most extraordinary gemstones.</p>
            </div>
            <div class="news_index__grid pb-5">
                <?php
                $d = 100;
                while ($q->have_posts()) {
                    $q->the_post();
                    $ph = get_the_post_thumbnail_url(get_the_ID(), 'large') ?: get_stylesheet_directory_uri() . '/img/missing-hero.png';
                ?>
                    <a href="<?= get_the_permalink() ?>"
                        class="news_index__card" data-aos="fade"
                        data-aos-delay="<?= $d ?>">
                        <div class="news_index__image">
                            <img src="<?= $ph ?>"
                                alt="<?= get_the_title() ?>">
                        </div>
                        <div class="news_index__inner">
                            <h3 class="h2 mb-2"><?= get_the_title() ?></h3>
                            <p><?= get_field('excerpt', get_the_ID()) ?></p>
                            <div class="read_more">Read more </div>
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