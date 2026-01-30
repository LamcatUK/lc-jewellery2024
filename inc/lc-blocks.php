<?php
/**
 * Register ACF Blocks
 *
 * @package lc-jewellery2024
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register custom ACF blocks for the theme.
 *
 * @return void
 */
function acf_blocks() {
	if ( function_exists('acf_register_block_type') ) {

		// INSERT NEW BLOCKS HERE.

		acf_register_block_type(array(
			'name'            => 'lc_nav_cards',
			'title'           => __('LC Nav Cards'),
			'category'        => 'layout',
			'icon'            => 'cover-image',
			'render_template' => 'blocks/lc-nav-cards.php',
			'mode'            => 'edit',
			'supports'        => array( 'mode' => false ),
		));

		acf_register_block_type(array(
			'name'            => 'lc_partners',
			'title'           => __('LC Partners'),
			'category'        => 'layout',
			'icon'            => 'cover-image',
			'render_template' => 'blocks/lc-partners.php',
			'mode'            => 'edit',
			'supports'        => array( 'mode' => false ),
		));

		acf_register_block_type(array(
			'name'            => 'lc_featured',
			'title'           => __('LC Featured'),
			'category'        => 'layout',
			'icon'            => 'cover-image',
			'render_template' => 'blocks/lc-featured.php',
			'mode'            => 'edit',
			'supports'        => array( 'mode' => false ),
		));

		acf_register_block_type(array(
			'name'            => 'lc_quote',
			'title'           => __('LC Quote'),
			'category'        => 'layout',
			'icon'            => 'cover-image',
			'render_template' => 'blocks/lc-quote.php',
			'mode'            => 'edit',
			'supports'        => array( 'mode' => false ),
		));

		acf_register_block_type(array(
			'name'            => 'lc_testimonial_slider',
			'title'           => __('LC Testimonial Slider'),
			'category'        => 'layout',
			'icon'            => 'cover-image',
			'render_template' => 'blocks/lc-testimonial-slider.php',
			'mode'            => 'edit',
			'supports'        => array( 'mode' => false ),
		));

		acf_register_block_type(array(
			'name'            => 'lc_hero',
			'title'           => __('LC Hero'),
			'category'        => 'layout',
			'icon'            => 'cover-image',
			'render_template' => 'blocks/lc-hero.php',
			'mode'            => 'edit',
			'supports'        => array( 'mode' => false ),
		));
		acf_register_block_type(array(
			'name'            => 'lc_text_image',
			'title'           => __('LC Text/Image'),
			'category'        => 'layout',
			'icon'            => 'cover-image',
			'render_template' => 'blocks/lc-text-image.php',
			'mode'            => 'edit',
			'supports'        => array( 'mode' => false ),
		));
		acf_register_block_type(array(
			'name'            => 'lc_text_video',
			'title'           => __('LC Text/Video'),
			'category'        => 'layout',
			'icon'            => 'cover-image',
			'render_template' => 'blocks/lc-text-video.php',
			'mode'            => 'edit',
			'supports'        => array( 'mode' => false ),
		));
		acf_register_block_type(array(
			'name'            => 'lc_full_width',
			'title'           => __('LC Full Width'),
			'category'        => 'layout',
			'icon'            => 'cover-image',
			'render_template' => 'blocks/lc-full-width.php',
			'mode'            => 'edit',
			'supports'        => array(
				'mode'   => false,
				'anchor' => true,
			),
		));
		acf_register_block_type(array(
			'name'            => 'lc_split',
			'title'           => __('LC Split'),
			'category'        => 'layout',
			'icon'            => 'cover-image',
			'render_template' => 'blocks/lc-split.php',
			'mode'            => 'edit',
			'supports'        => array( 'mode' => false ),
		));
		acf_register_block_type(array(
			'name'            => 'lc_three_cards',
			'title'           => __('LC Three Cards'),
			'category'        => 'layout',
			'icon'            => 'cover-image',
			'render_template' => 'blocks/lc-three-cards.php',
			'mode'            => 'edit',
			'supports'        => array( 'mode' => false ),
		));
		acf_register_block_type(array(
			'name'            => 'lc_three_cols',
			'title'           => __('LC Three Cols'),
			'category'        => 'layout',
			'icon'            => 'cover-image',
			'render_template' => 'blocks/lc-three-cols.php',
			'mode'            => 'edit',
			'supports'        => array( 'mode' => false ),
		));
		acf_register_block_type(array(
			'name'            => 'lc_products_by_cat',
			'title'           => __('LC Products by Category'),
			'category'        => 'layout',
			'icon'            => 'cover-image',
			'render_template' => 'blocks/lc-products-by-cat.php',
			'mode'            => 'edit',
			'supports'        => array( 'mode' => false ),
		));
		acf_register_block_type(array(
			'name'            => 'lc_products_by_tag',
			'title'           => __('LC Products by Tag'),
			'category'        => 'layout',
			'icon'            => 'cover-image',
			'render_template' => 'blocks/lc-products-by-tag.php',
			'mode'            => 'edit',
			'supports'        => array( 'mode' => false ),
		));
		acf_register_block_type(array(
			'name'            => 'lc_faqs',
			'title'           => __('LC FAQs'),
			'category'        => 'layout',
			'icon'            => 'cover-image',
			'render_template' => 'blocks/lc-faqs.php',
			'mode'            => 'edit',
			'supports'        => array( 'mode' => false ),
		));
		acf_register_block_type(array(
			'name'            => 'lc_accordion',
			'title'           => __('LC Accordion'),
			'category'        => 'layout',
			'icon'            => 'cover-image',
			'render_template' => 'blocks/lc-accordion.php',
			'mode'            => 'edit',
			'supports'        => array( 'mode' => false ),
		));
		acf_register_block_type(array(
			'name'            => 'lc_latest_news',
			'title'           => __('LC Latest Insights'),
			'category'        => 'layout',
			'icon'            => 'cover-image',
			'render_template' => 'blocks/lc-latest-news.php',
			'mode'            => 'edit',
			'supports'        => array( 'mode' => false ),
		));
		acf_register_block_type(array(
			'name'            => 'lc_four_images',
			'title'           => __('LC Four Images'),
			'category'        => 'layout',
			'icon'            => 'cover-image',
			'render_template' => 'blocks/lc-four-images.php',
			'mode'            => 'edit',
			'supports'        => array( 'mode' => false ),
		));
		acf_register_block_type(array(
			'name'            => 'lc_banner',
			'title'           => __('LC Banner'),
			'category'        => 'layout',
			'icon'            => 'cover-image',
			'render_template' => 'blocks/lc-banner.php',
			'mode'            => 'edit',
			'supports'        => array( 'mode' => false ),
		));
		acf_register_block_type(array(
			'name'            => 'lc_related',
			'title'           => __('LC Related'),
			'category'        => 'layout',
			'icon'            => 'cover-image',
			'render_template' => 'blocks/lc-related.php',
			'mode'            => 'edit',
			'supports'        => array( 'mode' => false ),
		));
		acf_register_block_type(array(
			'name'            => 'lc_breadcrumbs',
			'title'           => __('LC Breadcrumbs'),
			'category'        => 'layout',
			'icon'            => 'cover-image',
			'render_template' => 'blocks/lc-breadcrumbs.php',
			'mode'            => 'edit',
			'supports'        => array( 'mode' => false ),
		));
		acf_register_block_type(array(
			'name'            => 'lc_showcase',
			'title'           => __('LC Showcase'),
			'category'        => 'layout',
			'icon'            => 'cover-image',
			'render_template' => 'blocks/lc-showcase.php',
			'mode'            => 'edit',
			'supports'        => array( 'mode' => false ),
		));
		acf_register_block_type(array(
			'name'            => 'lc_divider',
			'title'           => __('LC Divider'),
			'category'        => 'layout',
			'icon'            => 'cover-image',
			'render_template' => 'blocks/lc-divider.php',
			'mode'            => 'edit',
			'supports'        => array( 'mode' => false ),
		));
		acf_register_block_type(array(
			'name'            => 'lc_cards',
			'title'           => __('LC Cards'),
			'category'        => 'layout',
			'icon'            => 'cover-image',
			'render_template' => 'blocks/lc-cards.php',
			'mode'            => 'edit',
			'supports'        => array( 'mode' => false ),
		));
	}
}
add_action('acf/init', 'acf_blocks');

// Gutenburg core modifications.
add_filter('register_block_type_args', 'core_image_block_type_args', 10, 3);

/**
 * Modify core block type arguments to add custom render callbacks.
 *
 * @param array  $args Array of arguments for registering a block type.
 * @param string $name Block type name including namespace.
 * @return array Modified block type arguments.
 */
function core_image_block_type_args( $args, $name ) {
	if ( 'core/paragraph' === $name ) {
		$args['render_callback'] = 'modify_core_add_container';
	}
	if ( 'core/heading' === $name ) {
		$args['render_callback'] = 'modify_core_add_container';
	}
	if ( 'core/list' === $name ) {
		$args['render_callback'] = 'modify_core_add_container';
	}

	return $args;
}

/**
 * Wrap core block content in a container div.
 *
 * @param array  $attributes Block attributes.
 * @param string $content    Block content.
 * @return string Modified block content wrapped in container.
 */
function modify_core_add_container( $attributes, $content ) {
	ob_start();
	// $class = $block['className'];
	?>
	<div class="container-xl">
		<?= $content; ?>
	</div>
	<?php
	$content = ob_get_clean();
	return $content;
}


?>