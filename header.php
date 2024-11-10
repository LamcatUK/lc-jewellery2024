<?php

/**
 * The header for the theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package lc-jewels2024
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta
        charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, minimum-scale=1">
    <meta name="view-transition" content="same-origin">
    <link rel="preload"
        href="<?= get_stylesheet_directory_uri() ?>/fonts/cormorant-garamond-v16-latin-regular.woff2 "
        as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload"
        href="<?= get_stylesheet_directory_uri() ?>/fonts/URWClassico-Regular.woff "
        as="font" type="font/woff" crossorigin="anonymous">
    <?php
    if (!is_user_logged_in()) {
        if (get_field('ga_property', 'options')) {
    ?>
            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async
                src="https://www.googletagmanager.com/gtag/js?id=<?= get_field('ga_property', 'options') ?>">
            </script>
            <script>
                window.dataLayer = window.dataLayer || [];

                function gtag() {
                    dataLayer.push(arguments);
                }
                gtag('js', new Date());
                gtag('config',
                    '<?= get_field('ga_property', 'options') ?>'
                );
            </script>
        <?php
        }
        if (get_field('gtm_property', 'options')) {
        ?>
            <!-- Google Tag Manager -->
            <script>
                (function(w, d, s, l, i) {
                    w[l] = w[l] || [];
                    w[l].push({
                        'gtm.start': new Date().getTime(),
                        event: 'gtm.js'
                    });
                    var f = d.getElementsByTagName(s)[0],
                        j = d.createElement(s),
                        dl = l != 'dataLayer' ? '&l=' + l : '';
                    j.async = true;
                    j.src =
                        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                    f.parentNode.insertBefore(j, f);
                })(window, document, 'script', 'dataLayer',
                    '<?= get_field('gtm_property', 'options') ?>'
                );
            </script>
            <!-- End Google Tag Manager -->
    <?php
        }
    }
    if (get_field('google_site_verification', 'options')) {
        echo '<meta name="google-site-verification" content="' . get_field('google_site_verification', 'options') . '" />';
    }
    if (get_field('bing_site_verification', 'options')) {
        echo '<meta name="msvalidate.01" content="' . get_field('bing_site_verification', 'options') . '" />';
    }

    wp_head();
    ?>
</head>

<body <?php body_class(); ?>
    <?php understrap_body_attributes(); ?>>
    <?php
    do_action('wp_body_open');
    ?>
    <header class="navholder" id="navholder">
        <div class="pre_nav">
            <div class="container-xl">
                <div class="pre_nav__container">
                    <a href="/request-appointment/" class="d-none d-lg-grid pre_nav__link">Request an appointment</a>
                    <a href="/" class="logo-container" aria-label="Home">
                        <img src="<?= get_stylesheet_directory_uri() ?>/img/logo.svg" alt="" width="310" height="50">
                    </a>
                    <a class="d-none d-lg-grid pre_nav__link" href="mailto:enquiries@griffinandsloane.com">Email us</a>

                    <!-- Offcanvas Toggle Button -->
                    <button class="d-lg-none navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Desktop Nav -->
        <nav id="main-nav" class="navbar navbar-expand-lg d-none d-lg-flex">
            <div class="container-xl px-0">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location'  => 'primary_nav',
                        'container_class' => 'navbar-collapse',
                        'container_id' => 'navbar',
                        'menu_class'      => 'navbar-nav mx-auto w-100 d-flex justify-content-around',
                        'fallback_cb'     => '',
                        'menu_id'     => 'main-menu',
                        'depth'           => 2,
                        'walker'          => new Understrap_WP_Bootstrap_Navwalker()
                    )
                );
                ?>
            </div>
        </nav>

        <!-- Mobile Offcanvas Nav -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <a href="/" class="logo-container" aria-label="Home">
                    <img src="<?= get_stylesheet_directory_uri() ?>/img/logo-full.svg" alt="" width="1020" height="334">
                </a>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location'  => 'primary_nav',
                        'container_id'    => 'mobilenav',
                        'menu_class'      => 'navbar-nav w-100 d-flex justify-content-around',
                        'fallback_cb'     => '',
                        'menu_id'         => 'offcanvas-menu',
                        'depth'           => 2,
                        'walker'          => new Understrap_WP_Bootstrap_Navwalker()
                    )
                );
                ?>
                <a href="/request-appointment/" class="nav-link">Request an appointment</a>
            </div>

        </div>
    </header>

    <?php
    if (function_exists('WC')) {

        $cart_count = WC()->cart->get_cart_contents_count(); // Get the number of items in the cart
        $cart_url = wc_get_cart_url(); // Get the URL of the cart page
        $checkout_url = wc_get_checkout_url(); // Get the URL of the cart page
        $current_url = home_url(add_query_arg(null, null));

        if (
            $cart_count > 0
            && $current_url !== $cart_url
            && $current_url !== $checkout_url
        ) {
            // Display the cart link with the number of items
    ?>
            <div class="cart-popout">
                <a href="<?= esc_url($cart_url) ?>" class="cart-link">
                    <span class="cart-icon" title="Shopping Bag"></span>
                    <span class="cart-count"><?= esc_html($cart_count) ?></span>
                </a>
            </div>
    <?php
        }
    }
    ?>