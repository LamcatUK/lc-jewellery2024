<?php
/**
 * Utility functions for the LC Jewellery 2024 theme.
 *
 * This file contains various helper functions and shortcodes used throughout the theme.
 *
 * @package LC_Jewellery2024
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Parses and formats a phone number by removing spaces, parentheses, and other characters.
 *
 * @param string $phone The phone number to be parsed.
 * @return string The formatted phone number.
 */
function parse_phone( $phone ) {
    $phone = preg_replace( '/\s+/', '', $phone );
    $phone = preg_replace( '/\(0\)/', '', $phone );
    $phone = preg_replace( '/[\(\)\.]/', '', $phone );
    $phone = preg_replace( '/-/', '', $phone );
    $phone = preg_replace( '/^0/', '+44', $phone );
    return $phone;
}

/**
 * Splits lines in the given content by replacing <br /> tags with <br>&nbsp;<br>.
 *
 * @param string $content The content to be processed.
 * @return string The processed content with split lines.
 */
function split_lines( $content ) {
    $content = preg_replace( '/<br \/>/', '<br>&nbsp;<br>', $content );
    return $content;
}

add_shortcode(
    'contact_email',
    function () {
        if ( get_field( 'contact_email', 'options' ) ) {
            $email = get_field( 'contact_email', 'options' );
            return '<a href="mailto:' . antispambot( $email ) . '">' . antispambot( $email ) . '</a>';
        }
    }
);

add_shortcode(
    'contact_email_icon',
    function () {
        if ( get_field( 'contact_email', 'options' ) ) {
            $email = get_field( 'contact_email', 'options' );
            return '<a href="mailto:' . antispambot( $email ) . '"><i class="fa-solid fa-envelope"></i></a>';
        }
    }
);

add_shortcode(
    'contact_phone',
    function () {
        if ( get_field( 'contact_phone', 'options' ) ) {
            return '<a href="tel:' . parse_phone( get_field( 'contact_phone', 'options' ) ) . '">' . get_field( 'contact_phone', 'options' ) . '</a>';
        }
    }
);

add_shortcode(
    'contact_phone2',
    function () {
        if ( get_field( 'phone_2', 'options' ) ) {
            return '<a href="tel:' . parse_phone( get_field( 'phone_2', 'options' ) ) . '">' . get_field( 'phone_2', 'options' ) . '</a>';
        }
    }
);

/**
 * Outputs social media icons with links based on the options set in the theme.
 *
 * This function retrieves social media URLs from theme options and generates
 * corresponding icons with links to those URLs.
 *
 * @return string The HTML markup for the social media icons.
 */
function social_icons() {
	ob_start();

	$socials = array(
		'linkedin_url'  => 'linkedin-in',
		'facebook_url'  => 'facebook-f',
		'instagram_url' => 'instagram',
		'twitter_url'   => 'x-twitter',
		'youtube_url'   => 'youtube',
		'tiktok_url'    => 'tiktok',
	);

	foreach ( $socials as $field => $icon ) {
		$url = get_field( $field, 'options' );

		if ( ! empty( $url ) ) {
			?>
			<a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer">
				<i class="fa-brands fa-<?php echo esc_attr( $icon ); ?>"></i>
			</a>
			<?php
		}
	}

	return ob_get_clean();
}
add_shortcode( 'social_icons', 'social_icons' );

/**
 * Grab the specified data like Thumbnail URL of a publicly embeddable video hosted on Vimeo.
 *
 * @param  str $video_id The ID of a Vimeo video.
 * @param  str $data     Video data to be fetched.
 * @return str           The specified data.
 */
function get_vimeo_data_from_id( $video_id, $data ) {
    // width can be 100, 200, 295, 640, 960 or 1280.
    $request = wp_remote_get( 'https://vimeo.com/api/oembed.json?url=https://vimeo.com/' . $video_id . '&width=960' );

    $response = wp_remote_retrieve_body( $request );

    $video_array = json_decode( $response, true );

    return $video_array[ $data ];
}


/**
 * Adds custom styles to the Gutenberg editor.
 *
 * This function outputs CSS styles to adjust the appearance of the Gutenberg editor,
 * including block widths and overflow behavior.
 */
function cb_gutenberg_admin_styles() {
    echo '
        <style>
            /* Main column width */
            .wp-block {
                max-width: 1040px;
            }
 
            /* Width of "wide" blocks */
            .wp-block[data-align="wide"] {
                max-width: 1080px;
            }
 
            /* Width of "full-wide" blocks */
            .wp-block[data-align="full"] {
                max-width: none;
            }
            
            .block-editor-page #wpwrap {
                overflow-y: auto !important;
            }
        </style>
    ';
}
add_action( 'admin_head', 'cb_gutenberg_admin_styles' );


// disable full-screen editor view by default.


if ( is_admin() ) {
    /**
     * Disables the fullscreen editor mode by default in the WordPress block editor.
     *
     * This function checks if the fullscreen mode is active and toggles it off
     * when the block editor assets are enqueued.
     */
    function lc_disable_editor_fullscreen_by_default() {
        $script = "jQuery( window ).load(function() { const isFullscreenMode = wp.data.select( 'core/edit-post' ).isFeatureActive( 'fullscreenMode' ); if ( isFullscreenMode ) { wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' ); } });";
        wp_add_inline_script( 'wp-blocks', $script );
    }
    add_action( 'enqueue_block_editor_assets', 'lc_disable_editor_fullscreen_by_default' );
}



/**
 * Retrieves the ID of the topmost ancestor of the current post.
 *
 * This function checks if the current post has a parent and, if so,
 * returns the ID of the topmost ancestor. If the post has no parent,
 * it returns the ID of the current post.
 *
 * @return int The ID of the topmost ancestor or the current post.
 */
function get_the_top_ancestor_id() {
    global $post;
    if ( $post->post_parent ) {
        $ancestors = array_reverse( get_post_ancestors( $post->ID ) );
        return $ancestors[0];
    } else {
        return $post->ID;
    }
}


/**
 * Converts a time string in HH:MM:SS format to ISO 8601 duration format.
 *
 * @param string $time_string The time string in HH:MM:SS format.
 * @return string The time string converted to ISO 8601 duration format.
 */
function lc_time_to_8601( $time_string ) {
    $time   = explode( ':', $time_string );
    $output = 'PT' . $time[0] . 'H' . $time[1] . 'M' . $time[2] . 'S';
    return $output;
}

/**
 * Generates a random string of specified length using characters from the given keyspace.
 *
 * @param int    $length The length of the random string to generate.
 * @param string $keyspace The characters to use for generating the random string.
 * @return string The generated random string.
 * @throws \RangeException If the length is less than 1.
 */
function random_str(
    int $length = 64,
    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
): string {
    if ( $length < 1 ) {
        throw new \RangeException( 'Length must be a positive integer' );
    }
    $pieces = array();
    $max    = mb_strlen( $keyspace, '8bit' ) - 1;
    for ( $i = 0; $i < $length; ++$i ) {
        $pieces[] = $keyspace[ random_int( 0, $max ) ];
    }
    return implode( '', $pieces );
}

/**
 * Generates social share links for a given post ID.
 *
 * This function creates social media share links for Twitter, LinkedIn, and Facebook
 * based on the permalink of the specified post.
 *
 * @param int $id The ID of the post to generate share links for.
 * @return string The HTML markup for the social share links.
 */
function lc_social_share( $id ) {
    ob_start();
    $url = get_the_permalink( $id );

    ?>
    <div class="text-larger text--yellow mb-5">
        <div class="h4 text-dark">Share</div>
        <a target='_blank' href='<?= esc_url( 'https://twitter.com/share?url=' . $url ); ?>'
            class="mr-2"><i class='fa-brands fa-twitter'></i></a>
        <a target='_blank'
            href='<?= esc_url( 'http://www.linkedin.com/shareArticle?url=' . $url ); ?>'
            class="mr-2"><i class='fa-brands fa-linkedin-in'></i></a>
        <a target='_blank'
            href='<?= esc_url( 'http://www.facebook.com/sharer.php?u=' . $url ); ?>'><i
                class='fa-brands fa-facebook-f'></i></a>
    </div>
    <?php

    $out = ob_get_clean();
    return $out;
}


/**
 * Enables the Strict-Transport-Security (HSTS) header.
 *
 * This function adds the HSTS header to enforce secure (HTTPS) connections
 * to the website for a duration of one year.
 */
function enable_strict_transport_security_hsts_header() {
    header( 'Strict-Transport-Security: max-age=31536000' );
}
add_action( 'send_headers', 'enable_strict_transport_security_hsts_header' );


/**
 * Generates a list of items from a given string with line breaks.
 *
 * This function takes a string containing line breaks and converts each line
 * into a list item, preserving <br /> tags.
 *
 * @param string $field The input string containing line breaks.
 * @return string The HTML markup for the list items.
 */
function lc_list( $field ) {
    ob_start();
    $field   = strip_tags( $field, '<br />' );
    $bullets = preg_split( "/\r\n|\n|\r/", $field );
    foreach ( $bullets as $b ) {
        if ( '' === $b ) {
            continue;
        }
        ?>
        <li><?= esc_html( $b ); ?></li>
        <?php
    }
    return ob_get_clean();
}


/**
 * Converts a file size in bytes to a human-readable format.
 *
 * @param int $size The size in bytes.
 * @param int $precision The number of decimal places to include.
 * @return string The formatted size with appropriate unit (e.g., KB, MB, GB).
 */
function format_bytes( $size, $precision = 2 ) {
    $base     = log( $size, 1024 );
    $suffixes = array( '', 'K', 'M', 'G', 'T' );

    return round( pow( 1024, $base - floor( $base ) ), $precision ) . ' ' . $suffixes[ floor( $base ) ];
}


// REMOVE TAG AND COMMENT SUPPORT.

// Disable Tags Dashboard WP.
add_action( 'admin_menu', 'my_remove_sub_menus' );

/**
 * Removes the Tags submenu from the WordPress admin dashboard.
 *
 * This function hides the Tags submenu under the Posts menu in the WordPress admin area.
 */
function my_remove_sub_menus() {
    remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' );
}
/**
 * Removes tags support from posts.
 *
 * This function unregisters the 'post_tag' taxonomy for the 'post' post type.
 */
function myprefix_unregister_tags() {
    unregister_taxonomy_for_object_type( 'post_tag', 'post' );
}
add_action( 'init', 'myprefix_unregister_tags' );

add_action(
    'admin_init',
    function () {
        // Redirect any user trying to access comments page.
        global $pagenow;

        if ( 'edit-comments.php' === $pagenow ) {
            wp_safe_redirect( admin_url() );
            exit;
        }

        // Remove comments metabox from dashboard.
        remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );

        // Disable support for comments and trackbacks in post types.
        foreach ( get_post_types() as $post_type ) {
            if ( post_type_supports( $post_type, 'comments' ) ) {
                remove_post_type_support( $post_type, 'comments' );
                remove_post_type_support( $post_type, 'trackbacks' );
            }
        }
    }
);

// Close comments on the front-end.
add_filter( 'comments_open', '__return_false', 20, 2 );
add_filter( 'pings_open', '__return_false', 20, 2 );

// Hide existing comments.
add_filter( 'comments_array', '__return_empty_array', 10, 2 );

// Remove comments page in menu.
add_action(
    'admin_menu',
    function () {
        remove_menu_page( 'edit-comments.php' );
    }
);

// Remove comments links from admin bar.
add_action(
    'init',
    function () {
        if ( is_admin_bar_showing() ) {
            remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
        }
    }
);

/**
 * Removes the comments menu from the WordPress admin bar.
 *
 * This function ensures that the comments menu is not displayed
 * in the WordPress admin bar for all users.
 */
function remove_comments() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu( 'comments' );
}
add_action( 'wp_before_admin_bar_render', 'remove_comments' );


/**
 * Estimates the reading time for a given content in minutes.
 *
 * This function calculates the estimated reading time based on the word count
 * of the content and the specified words per minute. It can also process Gutenberg
 * blocks and return a formatted output if required.
 *
 * @param string $content The content to estimate reading time for.
 * @param int    $words_per_minute The number of words read per minute (default: 300).
 * @param bool   $with_gutenberg Whether to parse Gutenberg blocks (default: false).
 * @param bool   $formatted Whether to return a formatted string (default: false).
 * @return int|string The estimated reading time in minutes, or a formatted string if $formatted is true.
 */
function estimate_reading_time_in_minutes( $content = '', $words_per_minute = 300, $with_gutenberg = false, $formatted = false ) {
    // In case if content is build with gutenberg parse blocks.
    if ( $with_gutenberg ) {
        $blocks       = parse_blocks( $content );
        $content_html = '';

        foreach ( $blocks as $block ) {
            $content_html .= render_block( $block );
        }

        $content = $content_html;
    }

    // Remove HTML tags from string.
    $content = wp_strip_all_tags( $content );

    // When content is empty return 0.
    if ( ! $content ) {
        return 0;
    }

    // Count words containing string.
    $words_count = str_word_count( $content );

    // Calculate time for read all words and round.
    $minutes = ceil( $words_count / $words_per_minute );

    if ( $formatted ) {
        $minutes = '<p class="reading">Estimated reading time ' . $minutes . ' ' . pluralise( $minutes, 'minute' ) . '</p>';
    }

    return $minutes;
}

/**
 * Returns the plural form of a word based on the quantity.
 *
 * @param int    $quantity The quantity to determine singular or plural form.
 * @param string $singular The singular form of the word.
 * @param string $plural   Optional. The plural form of the word. If not provided, it will be auto-generated.
 * @return string The appropriate singular or plural form of the word.
 */
function pluralise( $quantity, $singular, $plural = null ) {
    if ( 1 === $quantity || 0 === strlen( $singular ) ) {
        return $singular;
    }
    if ( null !== $plural ) {
        return $plural;
    }

    $last_letter = strtolower( $singular[ strlen( $singular ) - 1 ] );
    switch ( $last_letter ) {
        case 'y':
            return substr( $singular, 0, -1 ) . 'ies';
        case 's':
            return $singular . 'es';
        default:
            return $singular . 's';
    }
}

/**
 * Shortcode to obfuscate an email address.
 *
 * This function generates a shortcode that obfuscates an email address to protect it from spam bots.
 * It uses JavaScript to reconstruct the email address on the client side.
 *
 * @param array $atts Shortcode attributes. Expects 'address' as the email address to obfuscate.
 * @return string The obfuscated email address wrapped in a span element.
 */
function lc_obfuscate_email_shortcode( $atts ) {
	$atts = shortcode_atts(
        array(
		    'address' => '',
        ),
        $atts,
        'obfuscate_email'
    );

	if ( empty( $atts['address'] ) || ! is_email( $atts['address'] ) ) {
		return '';
	}

	$email  = $atts['address'];
	$parts  = explode( '@', $email );
	$user   = esc_attr( $parts[0] );
	$domain = esc_attr( $parts[1] );

	// Flag to load script once.
	if ( ! did_action( 'wp_footer' ) ) {
		add_action( 'wp_footer', 'lc_obfuscate_email_script', 100 );
	}

	return '<span class="lc-obfuscated-email" data-user="' . $user . '" data-domain="' . $domain . '"></span>';
}

/**
 * Outputs a JavaScript snippet to reconstruct obfuscated email addresses.
 *
 * This function adds a script to the footer that processes elements with the class
 * 'lc-obfuscated-email' and reconstructs the email address using data attributes.
 * It ensures the script is only loaded once.
 */
function lc_obfuscate_email_script() {
    static $script_loaded = false;
    if ( $script_loaded ) {
        return;
    }
    $script_loaded = true;
    ?>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll('.lc-obfuscated-email').forEach(function (el) {
                const user = el.dataset.user;
                const domain = el.dataset.domain;
                if (user && domain) {
                    const address = user + '@' + domain;
                    const link = document.createElement('a');
                    link.href = 'mailto:' + address;
                    link.textContent = address;
                    el.replaceWith(link);
                }
            });
        });
    </script>
    <?php
}

add_shortcode( 'obfuscate_email', 'lc_obfuscate_email_shortcode' );
?>