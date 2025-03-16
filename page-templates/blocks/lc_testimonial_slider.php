<section class="testimonial py-5">
    <div class="container-xl">
        <?php if ($title = get_field('title')) : ?>
            <h2 class="h3"><?= esc_html($title) ?></h2>
        <?php endif; ?>

        <div class="swiper testimonial-slider">
            <div class="swiper-wrapper">
                <?php
                $t = new WP_Query([
                    'post_type'      => 'testimonial',
                    'posts_per_page' => -1,
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC'
                ]);

                if ($t->have_posts()) :
                    while ($t->have_posts()) :
                        $t->the_post();
                ?>
                        <div class="swiper-slide testimonial__item">
                            <div class="testimonial__item__content">
                                <?= wp_kses_post(get_the_content()) ?>
                            </div>
                            <div class="testimonial__item__author">
                                <div class="testimonial__item__author__name">
                                    <?= esc_html(get_the_title()) ?>
                                </div>
                            </div>
                        </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>

        </div>
    </div>
    <?php
    include get_theme_file_path('page-templates/blocks/lc_divider.php');
    ?>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiperContainer = document.querySelector('.testimonial-slider');

        function setMaxHeight() {
            let maxHeight = 0;
            document.querySelectorAll('.testimonial-slider .swiper-slide').forEach(slide => {
                maxHeight = Math.max(maxHeight, slide.offsetHeight);
            });

            // Apply the max height to the Swiper container
            swiperContainer.style.height = maxHeight + 'px';
        }

        const swiper = new Swiper('.testimonial-slider', {
            loop: true,
            spaceBetween: 20,
            slidesPerView: 1,
            centeredSlides: true,
            effect: "fade", // Enables fade effect
            fadeEffect: {
                crossFade: true // Ensures smooth transitions
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            on: {
                init: setMaxHeight, // Set height on init
                slideChange: setMaxHeight, // Recalculate on slide change
            }
        });

        // Recalculate height on window resize
        window.addEventListener('resize', setMaxHeight);
    });
</script>