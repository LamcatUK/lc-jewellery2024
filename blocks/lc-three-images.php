<?php
/**
 * Block template for LC Three Images.
 *
 * @package lc-jewellery2024
 */

defined( 'ABSPATH' ) || exit;

$bg_class = '';
if ( isset( $block['supports']['color']['background'] ) && $block['supports']['color']['background'] ) {
	$bg_color = $block['backgroundColor'] ?? '';
	if ( $bg_color ) {
		$bg_class = 'has-' . esc_attr( $bg_color ) . '-background-color';
	}
}


$section_classes = array( 'three-images' );
if ( $bg_class ) {
	$section_classes[] = $bg_class;
}
if ( $text_class ) {
	$section_classes[] = $text_class;
}
if ( ! empty( $block['className'] ) ) {
	$custom_classes = preg_split( '/\s+/', trim( (string) $block['className'] ) );
	if ( is_array( $custom_classes ) ) {
		foreach ( $custom_classes as $custom_class ) {
			$sanitized_class = sanitize_html_class( $custom_class );
			if ( $sanitized_class ) {
				$section_classes[] = $sanitized_class;
			}
		}
	}
} else {
	$section_classes[] = 'py-5';
}

$aspect_1 = get_field('aspect_1') ? get_field('aspect_1') : 'ratio-1x1';
$aspect_2 = get_field('aspect_2') ? get_field('aspect_2') : 'ratio-16x9';
$aspect_3 = get_field('aspect_3') ? get_field('aspect_3') : 'ratio-4x3';

?>
<section class="<?= esc_attr( implode( ' ', $section_classes ) ); ?>">
	<div class="container-xl">
		<div class="row g-5">
			<div class="col-md-4 d-flex align-items-end">
			<?= wp_get_attachment_image( get_field('image_1'), 'full', false, array( 'class' => 'img-fluid ' . esc_attr( $aspect_1 ) ) ); ?>
			</div>
			<div class="col-md-4 d-flex align-items-end">
			<?= wp_get_attachment_image( get_field('image_2'), 'full', false, array( 'class' => 'img-fluid ' . esc_attr( $aspect_2 ) ) ); ?>
			</div>
			<div class="col-md-4 d-flex align-items-end">
			<?= wp_get_attachment_image( get_field('image_3'), 'full', false, array( 'class' => 'img-fluid ' . esc_attr( $aspect_3 ) ) ); ?>
			</div>
		</div>
	</div>
</section>