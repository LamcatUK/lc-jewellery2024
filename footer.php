<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package lc-jewellery2024
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

?>
<section class="totop">
    <div class="container-xl text-center py-2">
        <a href="#" id="backToTop"><i class="fa-solid fa-angle-up"></i>
            <div>Back to top</div>
        </a>
    </div>
</section>
<footer class="footer">
    <div class="container-xl pt-5 pb-4">
        <div class="row pb-2 pb-lg-4 mx-0 g-4">
            <div class="col-12 col-lg-3 mb-2 text-center text-lg-start">
                <img src="<?=get_stylesheet_directory_uri()?>/img/logo.svg"
                    alt="" width=310 height=50>
            </div>
            <div class="col-md-4 col-lg-2 mb-2 text-center text-md-start">
                <?php wp_nav_menu(array('theme_location' => 'footer_menu1')); ?>
            </div>
            <div class="col-md-4 col-lg-2 text-center text-md-start">
                <?php wp_nav_menu(array('theme_location' => 'footer_menu2')); ?>
            </div>
            <div class="col-md-4 col-lg-3 text-center text-md-start">
                <?php wp_nav_menu(array('theme_location' => 'footer_menu3')); ?>
            </div>
            <div class="col-12 col-lg-2 text-center text-lg-start">
                <div class="social-icons">
                    <?=do_shortcode('[social_icons]')?>
                </div>
            </div>
        </div>
    </div>
    <div class="colophon px-4">
        <div class="container-xl">
            <div class="d-md-flex justify-content-center gap-4 flex-wrap">
                <a href="/terms/">Terms of Use</a>
                <a href="/privacy-policy/">Privacy Policy</a>
                <a href="/cookie-policy/">Cookies Policy</a>
                <a href="/modern-slavery/">Modern Slavery Statement</a>
                <div>&copy; <?=date('Y')?>
                    Griffin &amp; Sloane</div>
            </div>
        </div>
</footer>

<div class="modal fade" id="appointment" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="h4 modal-title">Request an Appointment </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=do_shortcode('[contact-form-7 id="' . get_field('appointment_form_id', 'options') . '"]')?>
            </div>
        </div>
    </div>
</div>



<?php wp_footer();
if (get_field('gtm_property', 'options')) {
    ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe
        src="https://www.googletagmanager.com/ns.html?id=<?=get_field('gtm_property', 'options')?>"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php
}
?>
</body>

</html>