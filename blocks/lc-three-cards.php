<?php
/**
 * Three Cards Block Template.
 *
 * @package lc-jewellery2024
 */

defined( 'ABSPATH' ) || exit;

$classes        = $block['classList'] ?? 'pb-5';
$use_16x9_cards = (bool) get_field( '16x9_cards' );

$cards = array();
for ( $index = 1; $index <= 3; $index++ ) {
	$link        = get_field( 'link_' . $index );
	$link_url    = is_array( $link ) ? ( $link['url'] ?? '' ) : '';
	$link_title  = is_array( $link ) ? ( $link['title'] ?? '' ) : '';
	$link_target = is_array( $link ) ? ( $link['target'] ?? '' ) : '';
	$link_rel    = '_blank' === $link_target ? 'noopener noreferrer' : '';
	$cards[]     = array(
		'image_url'   => wp_get_attachment_image_url( get_field( 'image_' . $index ), 'large' ),
		'title'       => get_field( 'title_' . $index ),
		'content'     => get_field( 'content_' . $index ),
		'link_url'    => $link_url,
		'link_title'  => $link_title,
		'link_target' => $link_target,
		'link_rel'    => $link_rel,
	);
}

?>
<section class="three_cards <?= $classes; ?>">
	<div class="container-xl">
		<div class="row g-4">
			<?php
			foreach ( $cards as $card ) {
				?>
				<div class="col-md-4 d-flex flex-column" data-aos="fade">
					<?php
					if ( $use_16x9_cards ) {
						?>
					<div class="mb-3 px-3">
						<div class="ratio ratio-16x9">
							<img src="<?= esc_url( $card['image_url'] ); ?>" style="object-fit: contain; object-position: center;" alt="">
						</div>
					</div>
						<?php
					} else {
						?>
					<img src="<?= esc_url( $card['image_url'] ); ?>" class="mb-2" alt="">
						<?php
					}
					?>
					<h2 class="h3 mb-2">
						<?= esc_html( $card['title'] ); ?>
					</h2>
					<div><?= $card['content']; ?></div>
					<?php
					if ( $card['link_url'] ) {
						?>
					<div class="mt-auto align-self-end">
						<a class="d-block mt-3 has-100-font-size ff-headings text-uppercase" href="<?= esc_url( $card['link_url'] ); ?>" target="<?= esc_attr( $card['link_target'] ); ?>" rel="<?= esc_attr( $card['link_rel'] ); ?>">
							<?= esc_html( $card['link_title'] ? $card['link_title'] : __( 'Learn more', 'lc-jewellery2024' ) ); ?>
						</a>
					</div>
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