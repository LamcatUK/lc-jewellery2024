<?php
/**
 * Block template for LC Feature Title Text.
 *
 * @package lc-jewellery2024
 */

defined( 'ABSPATH' ) || exit;

$title_col = 'order-2 order-md-1';
$text_col  = 'order-1 order-md-2';

$title_anim = 'fade';
$text_anim  = 'fade';

$title_align = 'text-start';

switch ( get_field('split') ) {
	case 6040:
		$col_text  = 'col-md-7';
		$col_title = 'col-md-5';
		break;
	default:
		$col_text  = 'col-md-6';
		$col_title = 'col-md-6';
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
			<div class="<?= $col_text; ?> <?= $title_col; ?> d-flex flex-column justify-content-start"
				data-aos="<?= $title_anim; ?>">
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
				<?php
				if ( get_field('link') ?? null ) {
					$l = get_field('link');
					?>
					<a href="<?= $l['url']; ?>"
						target="<?= $l['target']; ?>"
						class="btn btn-primary mx-auto mt-3"><?= $l['title']; ?></a>
					<?php
				}
				?>
			</div>
			<div class="<?= $col_text; ?> <?= $text_col; ?>"
				data-aos="<?= $text_anim; ?>">
				<?= wp_kses_post( get_field( 'content' ) ); ?>
			</div>
		</div>
	</div>
</section>