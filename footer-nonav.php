<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package lc-jewellery2024
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<footer class="footer">
    <div class="colophon px-4">
        <div class="container-xl">
            <div class="d-md-flex justify-content-center gap-4 flex-wrap">
                <a href="/terms/">Terms of Use</a>
                <a href="/privacy-policy/">Privacy Policy</a>
                <a href="/cookie-policy/">Cookies Policy</a>
                <a href="/modern-slavery/">Modern Slavery Statement</a>
                <div>&copy; <?= esc_html( gmdate( 'Y' ) ); ?>
                    Griffin &amp; Sloane</div>
            </div>
        </div>
</footer>

<?php
wp_footer();
if ( get_field( 'gtm_property', 'options' ) ) {
	?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe
            src="https://www.googletagmanager.com/ns.html?id=<?= esc_attr( get_field( 'gtm_property', 'options' ) ); ?>"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
	<?php
}
?>
</body>

</html>