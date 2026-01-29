<?php
$classes = $block['className'] ?? 'py-5';
?>
<section class="featured <?= $classes ?>">
    <div class="container-xl">
        <h2 class="h4 text-center">As Seen In</h2>
        <?php
        if (have_rows('articles')) {
        ?>
            <div class="swiper articles-slider">
                <div class="swiper-wrapper">
                    <?php
                    while (have_rows('articles')) {
                        the_row();
                        $logo = get_sub_field('logo');
                        $link = get_sub_field('link');
                    ?>
                        <div class="swiper-slide">
                            <a href="<?= esc_url($link) ?>" target="_blank" rel="noopener noreferrer">
                                <img src="<?= esc_url($logo['url']) ?>" alt="<?= esc_attr($logo['alt']) ?>">
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        <?php
        } else {
            echo 'No articles found';
        }
        ?>
    </div>
</section>
<?php
add_action('wp_footer', function () {
?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new Swiper(".articles-slider", {
                slidesPerView: 2, // Default (Mobile)
                spaceBetween: 20,
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                breakpoints: {
                    768: {
                        slidesPerView: 3
                    }, // Tablet
                    1024: {
                        slidesPerView: 4
                    }, // Desktop
                }
            });
        });
    </script>
<?php
});
