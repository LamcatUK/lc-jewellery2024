<?php
/**
 * Block Name: LC Four Images
 *
 * This is the template that displays the LC Four Images block.
 *
 * @package lc-jewellery2024
 */

defined( 'ABSPATH' ) || exit;

$img = 4 === get_field('columns')[0] ? '' : 'six_images';

$delay = 0;

$images_per_row = 4 === get_field('columns')[0] ? 4 : 6;
?>
<section class="four_images <?= $img; ?>">
	<?php
	$r     = random_str(4);
	$index = 0;
	foreach ( get_field('images') as $i ) {
		$caption = wp_get_attachment_caption($i) ?? null;
		$alt     = get_post_meta($i, '_wp_attachment_image_alt', true) ?? $caption;

		// Reset delay at the start of each new row.
		if ( 0 < $index && 0 === $index % $images_per_row ) {
			$delay = 0;
		}
		?>
	<a href="<?= wp_get_attachment_image_url($i, 'full'); ?>"
		class="glightbox" data-glightbox="title: <?= esc_html($caption); ?>" data-gallery="gallery<?= $r; ?>"
		data-aos="fade"
		data-aos-delay="<?= esc_attr( $delay ); ?>">
		<?= wp_get_attachment_image($i, 'large', false, array( 'alt' => esc_html($alt) )); ?>
	</a>
		<?php
		$delay += 100;
		++$index;
	}
	?>
</section>