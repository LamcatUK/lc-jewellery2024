<?php
/**
 * Block template for LC Four Cards.
 *
 * Grid layout (2 columns):
 *   col:  1                   2
 *   row1: [card1 img]         [card2: img + text]
 *   row2: [card1 img]         [card3: img + text]
 *   row3: [card1 text]        [card4: img + text]
 *
 * @package lc-jewellery2024
 */

defined( 'ABSPATH' ) || exit;

$eyebrow = get_field( 'eyebrow' );
$title   = get_field( 'title' );
$content = get_field( 'content' );

$cards = get_field( 'cards' ) ? get_field( 'cards' ) : array();
$card1 = $cards[0] ?? null;
$card2 = $cards[1] ?? null;
$card3 = $cards[2] ?? null;
$card4 = $cards[3] ?? null;

?>
<section class="lc-four-cards">
	<div class="container-xl py-5">

		<?php if ( $eyebrow ) : ?>
		<p class="pretitle" data-aos="fade"><?= esc_html( $eyebrow ); ?></p>
		<?php endif; ?>

		<div class="row g-5 pb-5">
			<div class="col-md-6">
				<?php if ( $title ) : ?>
				<h2 class="h1 fs-900" data-aos="fade"><?= esc_html( $title ); ?></h2>
				<?php endif; ?>
			</div>
			<div class="col-md-6 d-flex align-items-end">
				<?php if ( $content ) : ?>
				<div class="fs-400 text-grey-400" data-aos="fade">
					<?= wp_kses_post( wpautop( $content ) ); ?>
				</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="lc-four-cards__grid">

			<?php /* ── Card 1: featured image — col 1, rows 1–2 ── */ ?>
			<?php if ( $card1 && ! empty( $card1['image'] ) ) : ?>
			<div class="lc-four-cards__card-img lc-four-cards__card-img--featured">
				<?= wp_get_attachment_image( $card1['image']['ID'], 'large', false, array( 'class' => 'lc-four-cards__img lc-four-cards__img--first', 'style' => ! empty( $card1['image_offset'] ) ? 'object-position: ' . esc_attr( $card1['image_offset'] ) . ';' : '' ) ); ?>
			</div>
			<?php endif; ?>

			<?php /* ── Card 2 — col 2, row 1 ── */ ?>
			<?php if ( $card2 ) : ?>
			<div class="lc-four-cards__cell lc-four-cards__cell--card">
				<?php if ( ! empty( $card2['image'] ) ) : ?>
				<div class="lc-four-cards__card-img">
					<?= wp_get_attachment_image( $card2['image']['ID'], 'medium_large', false, array( 'class' => 'lc-four-cards__img', 'style' => ! empty( $card2['image_offset'] ) ? 'object-position: ' . esc_attr( $card2['image_offset'] ) . ';' : '' ) ); ?>
				</div>
				<?php endif; ?>
				<div class="lc-four-cards__card-text" data-aos="fade">
					<?php if ( $card2['title'] ) : ?>
					<h3 class="lc-four-cards__card-title"><?= esc_html( $card2['title'] ); ?></h3>
					<?php endif; ?>
					<?php if ( $card2['content'] ) : ?>
					<div class="lc-four-cards__card-content fs-400"><?= wp_kses_post( wpautop( $card2['content'] ) ); ?></div>
					<?php endif; ?>
					<?php if ( ! empty( $card2['link'] ) ) : ?>
					<a href="<?= esc_url( $card2['link']['url'] ); ?>" class="lc-four-cards__link"<?= ! empty( $card2['link']['target'] ) ? ' target="' . esc_attr( $card2['link']['target'] ) . '"' : ''; ?>><?= esc_html( $card2['link']['title'] ); ?> &rarr;</a>
					<?php endif; ?>
				</div>
			</div>
			<?php endif; ?>

			<?php /* ── Card 3 — col 2, row 2 ── */ ?>
			<?php if ( $card3 ) : ?>
			<div class="lc-four-cards__cell lc-four-cards__cell--card">
				<?php if ( ! empty( $card3['image'] ) ) : ?>
				<div class="lc-four-cards__card-img">
					<?= wp_get_attachment_image( $card3['image']['ID'], 'medium_large', false, array( 'class' => 'lc-four-cards__img', 'style' => ! empty( $card3['image_offset'] ) ? 'object-position: ' . esc_attr( $card3['image_offset'] ) . ';' : '' ) ); ?>
				</div>
				<?php endif; ?>
				<div class="lc-four-cards__card-text" data-aos="fade">
					<?php if ( $card3['title'] ) : ?>
					<h3 class="lc-four-cards__card-title"><?= esc_html( $card3['title'] ); ?></h3>
					<?php endif; ?>
					<?php if ( $card3['content'] ) : ?>
					<div class="lc-four-cards__card-content fs-400"><?= wp_kses_post( wpautop( $card3['content'] ) ); ?></div>
					<?php endif; ?>
					<?php if ( ! empty( $card3['link'] ) ) : ?>
					<a href="<?= esc_url( $card3['link']['url'] ); ?>" class="lc-four-cards__link"<?= ! empty( $card3['link']['target'] ) ? ' target="' . esc_attr( $card3['link']['target'] ) . '"' : ''; ?>><?= esc_html( $card3['link']['title'] ); ?> &rarr;</a>
					<?php endif; ?>
				</div>
			</div>
			<?php endif; ?>

			<?php /* ── Card 1: featured text — col 1, row 3 ── */ ?>
			<?php if ( $card1 ) : ?>
			<div class="lc-four-cards__card-text lc-four-cards__card-text--featured">
				<div data-aos="fade">
					<?php if ( $card1['title'] ) : ?>
					<h3 class="lc-four-cards__card-title"><?= esc_html( $card1['title'] ); ?></h3>
					<?php endif; ?>
					<?php if ( $card1['content'] ) : ?>
					<div class="lc-four-cards__card-content fs-400"><?= wp_kses_post( wpautop( $card1['content'] ) ); ?></div>
					<?php endif; ?>
					<?php if ( ! empty( $card1['link'] ) ) : ?>
					<a href="<?= esc_url( $card1['link']['url'] ); ?>" class="lc-four-cards__link"<?= ! empty( $card1['link']['target'] ) ? ' target="' . esc_attr( $card1['link']['target'] ) . '"' : ''; ?>><?= esc_html( $card1['link']['title'] ); ?> &rarr;</a>
					<?php endif; ?>
				</div>
			</div>
			<?php endif; ?>

			<?php /* ── Card 4 — col 2, row 3 ── */ ?>
			<?php if ( $card4 ) : ?>
			<div class="lc-four-cards__cell lc-four-cards__cell--card">
				<?php if ( ! empty( $card4['image'] ) ) : ?>
				<div class="lc-four-cards__card-img">
					<?= wp_get_attachment_image( $card4['image']['ID'], 'medium_large', false, array( 'class' => 'lc-four-cards__img', 'style' => ! empty( $card4['image_offset'] ) ? 'object-position: ' . esc_attr( $card4['image_offset'] ) . ';' : '' ) ); ?>
				</div>
				<?php endif; ?>
				<div class="lc-four-cards__card-text" data-aos="fade">
					<?php if ( $card4['title'] ) : ?>
					<h3 class="lc-four-cards__card-title"><?= esc_html( $card4['title'] ); ?></h3>
					<?php endif; ?>
					<?php if ( $card4['content'] ) : ?>
					<div class="lc-four-cards__card-content fs-400"><?= wp_kses_post( wpautop( $card4['content'] ) ); ?></div>
					<?php endif; ?>
					<?php if ( ! empty( $card4['link'] ) ) : ?>
					<a href="<?= esc_url( $card4['link']['url'] ); ?>" class="lc-four-cards__link"<?= ! empty( $card4['link']['target'] ) ? ' target="' . esc_attr( $card4['link']['target'] ) . '"' : ''; ?>><?= esc_html( $card4['link']['title'] ); ?> &rarr;</a>
					<?php endif; ?>
				</div>
			</div>
			<?php endif; ?>

		</div><!-- .lc-four-cards__grid -->
	</div>
</section>
