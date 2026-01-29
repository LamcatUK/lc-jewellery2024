<?php
/**
 * Block Name: LC Partners
 *
 * This is the template that displays the LC Partners block.
 *
 * @package lc-jewellery2024
 */

defined( 'ABSPATH' ) || exit;


?>
<section class="partners">
	<div class="container-xl py-5">
		<?php
		if ( get_field( 'title' ) ) {
			?>
		<div class="h2 d-lg-none" data-aos="fade">
			<?= esc_html( get_field( 'title' ) ); ?>
		</div>
			<?php
		}
		?>
		<div class="row g-4">
			<div class="col-lg-6 d-flex flex-column justify-content-center"
				data-aos="fade">
				<?php
				if ( get_field('title') ) {
					?>
					<h2 class="d-none d-lg-block h2">
						<?= get_field('title'); ?>
					</h2>
					<?php
				}
				?>
				<div><?= get_field('content'); ?></div>
			</div>
			<div class="col-lg-6 partners__grid"
				data-aos="fade">
				<?php
				while ( have_rows( 'partners' ) ) {
					the_row();
					?>
				<a class="partners__partner" href="<?= esc_url( get_sub_field( 'page' )['url'] ); ?>">
					<?= wp_get_attachment_image( get_sub_field( 'logo' ), 'full', false, array( 'class' => 'partners__image' ) ); ?>
				</a>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</section>