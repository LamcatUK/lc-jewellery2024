<?php
/**
 * Block template for LC Text Quote.
 *
 * @package lc-jewellery2024
 */

defined( 'ABSPATH' ) || exit;

$eyebrow = get_field( 'eyebrow' );
$title   = get_field( 'title' );
$content = get_field( 'content' );
$quote   = get_field( 'quote' );

$bg_class = '';
if ( isset( $block['supports']['color']['background'] ) && $block['supports']['color']['background'] ) {
	$bg_color = $block['backgroundColor'] ?? '';
	if ( $bg_color ) {
		$bg_class = 'has-' . esc_attr( $bg_color ) . '-background-color';
	}
}

$text_class = '';
if ( isset( $block['supports']['color']['text'] ) && $block['supports']['color']['text'] ) {
	$text_color = $block['textColor'] ?? '';
	if ( $text_color ) {
		$text_class = 'has-' . esc_attr( $text_color ) . '-color';
	}
}

$section_classes = array( 'feature' );
if ( $bg_class ) {
	$section_classes[] = $bg_class;
}
if ( $text_class ) {
	$section_classes[] = $text_class;
}
if ( ! empty( $block['className'] ) ) {
	$section_classes = array_merge( $section_classes, preg_split( '/\s+/', trim( (string) $block['className'] ) ) );
} else {
	$section_classes[] = 'py-5';
}

?>
<section class="<?= esc_attr( implode( ' ', $section_classes ) ); ?>">
	<div class="container-xl">
		<div class="row g-4 align-items-center">
			<div class="col-md-6" data-aos="fade">
				<?php
				if ( $eyebrow ) {
					?>
					<div class="pretitle--sm">
						<?= esc_html( $eyebrow ); ?>
					</div>
					<?php
				}
				if ( $title ) {
					?>
					<h2 class="h2">
						<?= esc_html( $title ); ?>
					</h2>
					<?php
				}
				if ( $content ) {
					?>
					<div><?= wpautop( wp_kses_post( $content ) ); ?></div>
					<?php
				}
				?>
			</div>
			<div class="col-md-6 mb-5 mb-md-0" data-aos="fade">
				<?php
				if ( $quote ) {
					?>
					<blockquote class="border-start ps-4 mb-0">
						<p class="fs-3 mb-0"><?= wp_kses_post( $quote ); ?></p>
					</blockquote>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</section>

