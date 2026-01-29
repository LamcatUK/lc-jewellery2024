<?php
/**
 * Block Name: LC Hero
 *
 * This is the template that displays the LC Hero block.
 *
 * @package lc-jewellery2024
 */

defined( 'ABSPATH' ) || exit;

$align = get_field('align') ?? null;
$class = 'hero__bg ' . $align;

// $size = is_front_page() ? '' : 'hero--short';
$size = 'hero--short';
?>
<section class="hero <?= $size; ?>">
	<div class="container-xl px-0">
		<?= wp_get_attachment_image( get_field( 'background' ), 'full', false, array( 'class' => $class ) ); ?>
	</div>
</section>