<?php
/**
 * Block template for LC Title QA.
 *
 * @package lc-jewellery2024
 */

defined( 'ABSPATH' ) || exit;

$title_anim = 'fade';
$text_anim  = 'fade';

$block_faq_items = array();
while ( have_rows( 'faqs' ) ) {
	the_row();

	$block_faq_items[] = array(
		'question' => wp_strip_all_tags( (string) get_sub_field( 'question' ) ),
		'answer'   => wp_strip_all_tags( (string) get_sub_field( 'answer' ) ),
	);
}

if ( ! function_exists( 'lc_faq_add_schema_items' ) ) {
	/**
	 * Collect FAQ items and output FAQPage schema once per request.
	 *
	 * @param array $items FAQ items for the current block instance.
	 * @return void
	 */
	function lc_faq_add_schema_items( array $items ) {
		static $all_items = array();
		static $hooked    = false;

		foreach ( $items as $item ) {
			$all_items[] = $item;
		}

		if ( ! $hooked ) {
			$hooked = true;

			add_action(
				'wp_footer',
				static function () use ( &$all_items ) {
					if ( empty( $all_items ) ) {
						return;
					}

					$entities = array_map(
						static function ( $item ) {
							return array(
								'@type'          => 'Question',
								'name'           => $item['question'],
								'acceptedAnswer' => array(
									'@type' => 'Answer',
									'text'  => $item['answer'],
								),
							);
						},
						$all_items
					);

					$schema = array(
						'@context'   => 'https://schema.org',
						'@type'      => 'FAQPage',
						'mainEntity' => $entities,
					);

					echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
				}
			);
		}
	}
}

lc_faq_add_schema_items( $block_faq_items );

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

$section_classes = array( 'title-qa' );
if ( $bg_class ) {
	$section_classes[] = $bg_class;
}
if ( $text_class ) {
	$section_classes[] = $text_class;
}

?>
<section class="<?= esc_attr( implode( ' ', $section_classes ) ); ?> py-5">
	<div class="container-xl">
		<div class="row g-4">
			<div class="col-md-6 d-flex flex-column justify-content-start"
				data-aos="<?= $title_anim; ?>">
				<?php
				if ( get_field( 'eyebrow' ) ?? null ) {
					?>
					<div class="pretitle--sm d-none d-md-block">
						<?= wp_kses_post( get_field( 'eyebrow' ) ); ?>
					</div>
					<?php
				}
				if ( get_field( 'title' ) ?? null ) {
					?>
					<h2 class="d-none d-md-block h2">
						<?= wp_kses_post( get_field( 'title' ) ); ?>
					</h2>
					<?php
				}
				?>
			</div>
			<div class="col-md-6 faq_block"
				data-aos="<?= $text_anim; ?>">
				<?php
				while ( have_rows( 'faqs' ) ) {
					the_row();
					?>
					<div class="faq__item">
						<div class="faq__question">
							<?= esc_html( get_sub_field( 'question' ) ); ?>
						</div>
						<div class="faq__answer">
							<?= wp_kses_post( get_sub_field( 'answer' ) ); ?>
						</div>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</section>