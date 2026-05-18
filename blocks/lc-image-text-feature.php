<?php
/**
 * Block template for LC Image Text Feature.
 *
 * @package lc-jewellery2024
 */

defined( 'ABSPATH' ) || exit;

$block_id = $block['id'] ?? wp_unique_id( 'lc-image-text-feature-' );
$bg       = get_field( 'background' );
$eyebrow  = get_field( 'eyebrow' );
$title    = get_field( 'title' );
$content  = get_field( 'content' );
$link     = get_field( 'link' );

?>
<section id="<?php echo esc_attr( $block_id ); ?>" class="lc-image-text-feature">
	<?php
	if ( $bg ) {
		echo wp_get_attachment_image( $bg['ID'], 'full', false, array( 'class' => 'lc-image-text-feature__bg lc-image-text-feature__bg--parallax' ) );
	}
	?>

	<div class="lc-image-text-feature__overlay"></div>

	<div class="container-xl lc-image-text-feature__content">
		<div class="row">
			<div class="col-lg-6 offset-lg-6">
				<?php
				if ( $eyebrow ) {
					?>
				<p class="pretitle" data-aos="fade"><?= esc_html( $eyebrow ); ?></p>
					<?php
				}

				if ( $title ) {
					?>
				<h2 class="h1 fs-900" data-aos="fade"><?= esc_html( $title ); ?></h2>
					<?php
				}

				if ( $content ) {
					?>
				<div class="fs-400 text-grey-400" data-aos="fade">
					<?= wp_kses_post( wpautop( $content ) ); ?>
				</div>
					<?php
				}

				if ( $link ) {
					?>
					<a href="<?= esc_url( $link['url'] ); ?>"
						target="<?= esc_attr( $link['target'] ); ?>"
						class="btn btn-primary btn-primary--reverse mt-3"
						data-aos="fade">
						<?= esc_html( $link['title'] ); ?>
					</a>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</section>