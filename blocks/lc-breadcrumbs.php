<?php
/**
 * Block Name: LC Breadcrumbs
 *
 * This is the template that displays the LC Breadcrumbs block.
 *
 * @package lc-jewellery2024
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="breadcrumbs">
	<div class="container-xl text-center">
		<?php
		if ( function_exists( 'yoast_breadcrumb' ) ) {
			yoast_breadcrumb('<div id="breadcrumbs" class="mt-4">', '</div>');
		}
		?>
	</div>
</section>