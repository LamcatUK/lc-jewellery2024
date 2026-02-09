<?php
/**
 * Block Name: LC Cards
 *
 * This is the template that displays the LC Cards block.
 *
 * @package lc-jewellery2024
 */

defined( 'ABSPATH' ) || exit;

$class = $block['className'] ?? 'py-5';
?>
<section class="cards <?= esc_attr( $class ); ?>">
	<div class="container-xl">
		<div class="row">
			<?php
			while ( have_rows( 'cards' ) ) {
				the_row();
				$l = get_sub_field('cta');
				?>
			<div class="col-lg-6 cards__card" data-aos="fade">
				<?= wp_get_attachment_image( get_sub_field( 'image' ), 'full', false, array( 'class' => 'cards__image' ) ); ?>
				<h2 class="h3"><?= esc_html( get_sub_field( 'title' ) ); ?></h2>
				<div><?= wp_kses_post( get_sub_field( 'content' ) ); ?></div>
				<?php
				if ( $l && is_array( $l ) && isset( $l['title'], $l['url'], $l['target'] ) ) {
					?>
				<div class="cards__cta"><a href="<?= esc_url( $l['url'] ); ?>" target="<?= esc_attr( $l['target'] ); ?>"><?= esc_html( $l['title'] ); ?></a></div>
					<?php
				}
				?>
			</div>
				<?php
			}
			?>
		</div>
	</div>
</section>