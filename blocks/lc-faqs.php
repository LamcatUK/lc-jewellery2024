<?php
/**
 * Block template for LC FAQs.
 *
 * @package lc-jewellery2024
 */

defined( 'ABSPATH' ) || exit;

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

$block_faq_items = array();
while ( have_rows( 'faqs' ) ) {
	the_row();

	$block_faq_items[] = array(
		'question' => wp_strip_all_tags( (string) get_sub_field( 'question' ) ),
		'answer'   => wp_strip_all_tags( (string) get_sub_field( 'answer' ) ),
	);
}

lc_faq_add_schema_items( $block_faq_items );

$classes = $block['className'] ?? 'py-5';
?>
<section class="faq_block <?= esc_attr( $classes ); ?>">
	<div class="container-xl" data-aos="fade">
		<?php
		if ( get_field( 'faq_title' ) ) {
			?>
		<h2 class="h2 text-center text-md-start mb-4">
			<?= wp_kses_post( get_field( 'faq_title' ) ); ?>
		</h2>
			<?php
		}

		if ( get_field( 'faq_intro' ) ) {
			?>
		<div class="mb-4 faq_intro">
			<?= wp_kses_post( get_field( 'faq_intro' ) ); ?>
		</div>
			<?php
		}
		?>

		<div class="faq_block__inner">
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
</section>