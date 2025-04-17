<?php
/**
 * The template for displaying all pages
 *
 * @package lc-jewellery2024
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="main">
    <?php
    the_post();
    the_content();
    ?>
</main>
<?php
get_footer();
?>