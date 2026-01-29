<?php
/**
 * Block Name: LC Nav Cards
 *
 * This is the template that displays the LC Nav Cards block.
 *
 * @package lc-jewellery2024
 */

defined( 'ABSPATH' ) || exit;

$class = $block['className'] ?? 'py-5';
?>
<section class="cards <?= esc_attr( $class ); ?>">
	<div class="container-xl">
		<div class="row justify-content-center" data-aos="fade-up">
			<?php
			while ( have_rows( 'cards' ) ) {
				the_row();
				$l = get_sub_field('cta');
				?>
			<div class="col-lg-4 cards__card">
				<a href="<?= esc_url( $l['url'] ); ?>">
					<?= wp_get_attachment_image( get_sub_field( 'image' ), 'full', false, array( 'class' => 'cards__image' ) ); ?>
					<h2 class="h3"><?= esc_html( get_sub_field( 'title' ) ); ?></h2>
					<div><?= wp_kses_post( get_sub_field( 'content' ) ); ?></div>
				</a>
			</div>
				<?php
			}
			?>
		</div>
	</div>
</section>