<?php
/**
 * LC Theme Functions
 *
 * @package lc-jewellery2024
 */

defined('ABSPATH') || exit;

require_once LC_THEME_DIR . '/inc/lc-utility.php';
require_once LC_THEME_DIR . '/inc/lc-posttypes.php';
require_once LC_THEME_DIR . '/inc/lc-blocks.php';
require_once LC_THEME_DIR . '/inc/lc-news.php';

// Remove unwanted SVG filter injection WP.
remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');

add_filter('big_image_size_threshold', '__return_false');

/**
 * Remove unwanted page templates from the theme.
 *
 * @param array $page_templates Array of page templates.
 * @return array Modified array of page templates.
 */
function child_theme_remove_page_template( $page_templates ) {
	unset($page_templates['page-templates/blank.php'], $page_templates['page-templates/empty.php'], $page_templates['page-templates/left-sidebarpage.php'], $page_templates['page-templates/right-sidebarpage.php'], $page_templates['page-templates/both-sidebarspage.php']);
	return $page_templates;
}
add_filter('theme_page_templates', 'child_theme_remove_page_template');

/**
 * Remove post format support from the theme.
 *
 * @return void
 */
function remove_understrap_post_formats() {
	remove_theme_support('post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ));
}
add_action('after_setup_theme', 'remove_understrap_post_formats', 11);

if ( function_exists('acf_add_options_page') ) {
	acf_add_options_page(
		array(
			'page_title' => 'Site-Wide Settings',
			'menu_title' => 'Site-Wide Settings',
			'menu_slug'  => 'theme-general-settings',
			'capability' => 'edit_posts',
		)
	);
}

/**
 * Initialize widgets and register navigation menus.
 *
 * @return void
 */
function widgets_init() {
	register_nav_menus(array(
		'primary_nav'  => __('Primary Nav', 'lc-jewellery2024'),
		'footer_menu1' => __('Footer Menu 1', 'lc-jewellery2024'),
		'footer_menu2' => __('Footer Menu 2', 'lc-jewellery2024'),
		'footer_menu3' => __('Footer Menu 3', 'lc-jewellery2024'),
	));

	unregister_sidebar('hero');
	unregister_sidebar('herocanvas');
	unregister_sidebar('statichero');
	unregister_sidebar('left-sidebar');
	unregister_sidebar('right-sidebar');
	unregister_sidebar('footerfull');
	unregister_nav_menu('primary');

	add_theme_support('disable-custom-colors');
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => 'Grey 200',
				'slug'  => 'bg--grey-200',
				'color' => '#f9f7f8',
			),
			array(
				'name'  => 'Grey 300',
				'slug'  => 'bg--grey-300',
				'color' => '#c9c7c8',
			),
			array(
				'name'  => 'Grey 400',
				'slug'  => 'bg--grey-400',
				'color' => '#767676',
			),
			array(
				'name'  => 'Grey 800',
				'slug'  => 'bg--grey-800',
				'color' => '#444444',
			),
			array(
				'name'  => 'Green 400',
				'slug'  => 'bg--green-400',
				'color' => '#ddeee8',
			),
			array(
				'name'  => 'Green 900',
				'slug'  => 'bg--green-900',
				'color' => '#0d211a',
			),
		)
	);
}
add_action('widgets_init', 'widgets_init', 11);


remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');

/**
 * Register custom dashboard widget for Lamcat.
 *
 * @return void
 */
function register_lc_dashboard_widget() {
	wp_add_dashboard_widget(
		'lc_dashboard_widget',
		'Lamcat',
		'lc_dashboard_widget_display'
	);
}
add_action('wp_dashboard_setup', 'register_lc_dashboard_widget');

/**
 * Display content for the Lamcat dashboard widget.
 *
 * @return void
 */
function lc_dashboard_widget_display() {
	?>
	<div style="display: flex; align-items: center; justify-content: space-around;">
		<img style="width: 50%;"
			src="<?= get_stylesheet_directory_uri() . '/img/lc-full.jpg'; ?>">
		<a class="button button-primary" target="_blank" rel="noopener nofollow noreferrer"
			href="mailto:hello@lamcat.co.uk/">Contact</a>
	</div>
	<div>
		<p><strong>Thanks for choosing Lamcat!</strong></p>
		<hr>
		<p>Got a problem with your site, or want to make some changes & need us to take a look for you?</p>
		<p>Use the link above to get in touch and we'll get back to you ASAP.</p>
	</div>
	<?php
}

/**
 * Modify excerpt more link.
 *
 * @param string $post_excerpt The post excerpt.
 * @return string Modified post excerpt.
 */
function understrap_all_excerpts_get_more_link( $post_excerpt ) {
	if ( is_admin() || ! get_the_ID() ) {
		return $post_excerpt;
	}
	return $post_excerpt;
}

/**
 * Enqueue theme styles and scripts.
 *
 * @return void
 */
function lc_theme_enqueue() {
	// Get the theme data.
	$the_theme     = wp_get_theme();
	$theme_version = $the_theme->get('Version');

	$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
	// Grab asset urls.
	$theme_styles  = "/css/child-theme{$suffix}.css";
	$theme_scripts = "/js/child-theme{$suffix}.js";

	$css_version = $theme_version; // . '.' . filemtime(get_stylesheet_directory() . $theme_styles);

	wp_enqueue_style('glightbox-stylesheet', get_stylesheet_directory_uri() . '/css/glightbox.min.css', array(), $the_theme->get('Version'));
	wp_enqueue_script('glightbox-scripts', get_stylesheet_directory_uri() . '/js/glightbox.min.js', array(), null, true);
	wp_enqueue_style('aos-style', get_stylesheet_directory_uri() . '/css/aos.css', array());
	wp_enqueue_script('aos', get_stylesheet_directory_uri() . '/js/aos.js', array(), null, true);
	wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), null);
	wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), null, true);
	wp_enqueue_script('child-understrap-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $css_version, true);
	wp_enqueue_style('child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $css_version);

	$js_version = $theme_version . '.' . filemtime(get_stylesheet_directory() . $theme_scripts);

	if ( is_singular() && comments_open() && get_option('thread_comments') ) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'lc_theme_enqueue');

/**
 * Get image id from first slide in lc-hero.
 *
 * @param int $post_id The post ID.
 * @return mixed The background image ID or null.
 */
function get_hero( $post_id ) {
	$blocks = parse_blocks(get_the_content(null, false, $post_id));
	$bg     = '';
	foreach ( $blocks as $b ) {
		if ( 'acf/lc-hero' === $b['blockName'] ) {
			$bg = $b['attrs']['data']['slides_0_background'];
			return $bg;
		}
	}
	return;
}

add_filter('wpcf7_autop_or_not', '__return_false');

/**
 * Load DearPDF viewer via AJAX.
 *
 * @return void
 */
function load_dearpdf_viewer() {
	$id = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;

	if ( $id > 0 ) {
		$html = do_shortcode( '[dearpdf id="' . $id . '"]' );

		// Extract the config JSON from the script tag before removing it.
		if ( preg_match( '#window\.df_option_\d+\s*=\s*(\{.*?\});#is', $html, $matches ) ) {
			$config_json = $matches[1];
		} else {
			$config_json = '{}';
		}

		// Remove the <script> block.
		$html = preg_replace( '#<script[^>]*>.*?</script>#is', '', $html );

		wp_send_json_success(array(
			'html'   => $html,
			'config' => $config_json,
		));
	} else {
		wp_send_json_error( 'Invalid viewer ID.' );
	}
}

add_action( 'wp_ajax_load_dearpdf', 'load_dearpdf_viewer' );
add_action( 'wp_ajax_nopriv_load_dearpdf', 'load_dearpdf_viewer' );

