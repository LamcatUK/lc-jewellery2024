<?php
$classes = $block['className'] ?? 'py-5';
?>
<section class="faq_block <?=$classes?>">
    <div class="container-xl" data-aos="fade">
        <?php
        if (get_field('faq_title')) {
            ?>
        <h2 class="h2 text-center text-md-start mb-4">
            <?=get_field('faq_title')?>
        </h2>
        <?php
        }
if (get_field('faq_intro')) {
    ?>
        <div class="mb-4 faq_intro">
            <?=get_field('faq_intro')?>
        </div>
        <?php
}
?>
        <div class="faq_block__inner">
            <?php
echo '<div itemscope="" itemtype="https://schema.org/FAQPage">';
$counter = 0;
while (have_rows('faqs')) {
    the_row();
    ?>
            <div itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div itemprop="name" class="faq__question">
                    <?=get_sub_field('question')?>
                </div>
                <div itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <div itemprop="text" class="faq__answer">
                        <?=get_sub_field('answer')?>
                    </div>
                </div>
            </div>
            <?php
}
echo '</div>';
?>
        </div>
</section>