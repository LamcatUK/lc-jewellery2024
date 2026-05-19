<?php
/**
 * Template for LC Text Image block.
 *
 * @package lc-jewellery2024
 */

defined('ABSPATH') || exit;

$txtcol = 'Text/Image' === get_field('order') ? 'order-2 order-md-1' : 'order-2 order-md-2';
$imgcol = 'Text/Image' === get_field('order') ? 'order-1 order-md-2' : 'order-1 order-md-1';

$txtanim = 'Text/Image' === get_field('order') ? 'fade-right' : 'fade-left';
$imganim = 'Text/Image' === get_field('order') ? 'fade-left' : 'fade-right';

$txtanim = 'fade';
$imganim = 'fade';

$title_align = ( get_field('title_alignment') === 'left' ) ? 'text-start' : 'text-center';

switch ( get_field('split') ) {
	case 6040:
		$col_text  = 'col-md-7';
		$col_image = 'col-md-5';
		break;
	default:
		$col_text  = 'col-md-6';
		$col_image = 'col-md-6';
}

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

?>
<section class="<?= esc_attr( implode( ' ', $section_classes ) ); ?> py-5">
	<div class="container-xl">
		<?php
		if ( get_field('eyebrow') ?? null ) {
			?>
			<div class="pretitle--sm <?= $title_align; ?> d-md-none" data-aos="fade">
				<?= get_field('eyebrow'); ?>
			</div>
			<?php
		}
		if ( get_field('title') ?? null ) {
			?>
			<div class="h2 <?= $title_align; ?> d-md-none" data-aos="fade">
				<?= get_field('title'); ?>
			</div>
			<?php
		}
		?>
		<div class="row g-4">
			<div class="<?= $col_text; ?> <?= $txtcol; ?> d-flex flex-column justify-content-center"
				data-aos="<?= $txtanim; ?>">
				<?php
				if ( get_field('eyebrow') ?? null ) {
					?>
					<div class="pretitle--sm <?= $title_align; ?> d-none d-md-block">
						<?= get_field('eyebrow'); ?>
					</div>
					<?php
				}
				if ( get_field('title') ?? null ) {
					?>
					<h2 class="d-none d-md-block <?= $title_align; ?> h2">
						<?= get_field('title'); ?>
					</h2>
					<?php
				}
				?>
				<div><?= get_field('content'); ?>
				</div>
				<?php
				if ( get_field('link') ?? null ) {
					$l = get_field('link');
					$a = get_field('link_alignment') ? 'mx-auto' : '';
					?>
					<a href="<?= $l['url']; ?>"
						target="<?= $l['target']; ?>"
						class="btn btn-primary mt-3 <?= $a; ?>"><?= $l['title']; ?></a>
					<?php
				}
				?>
			</div>
			<div class="<?= $col_image; ?> <?= $imgcol; ?> d-flex align-items-center"
				data-aos="<?= $imganim; ?>">
				<img src="<?= wp_get_attachment_image_url(get_field('image'), 'large'); ?>"
					alt="<?= get_field('title'); ?>"
					class="feature__img mx-auto">
			</div>
		</div>
	</div>
</section>