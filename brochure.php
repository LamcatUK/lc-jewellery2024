<?php
/**
 * Template Name: Brochure
 *
 * @package lc-jewellery2024
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header( 'nonav' );
$desktop_viewer_id = get_field( 'desktop_viewer_id' );
$mobile_viewer_id  = get_field( 'mobile_viewer_id' );
?>
<main id="main">
	<div id="dearpdf-wrapper"></div>
</main>
<script>
document.addEventListener("DOMContentLoaded", function () {
	var isMobile = /Mobi|Android|iPhone|iPad|iPod/i.test(navigator.userAgent);
	var container = document.getElementById("dearpdf-wrapper");

	if (!container) return;

	var viewerId = isMobile ? <?= esc_js( $mobile_viewer_id ); ?> : <?= esc_js( $desktop_viewer_id ); ?>;
	var ajaxurl = "<?= esc_url( admin_url( 'admin-ajax.php' ) ); ?>";

	fetch(ajaxurl + '?action=load_dearpdf&id=' + viewerId)
		.then(function (response) {
			if (!response.ok) {
				throw new Error('Network response was not ok. Status: ' + response.status);
			}
			return response.json();
		})
		.then(function (data) {
			if (!data.success || !data.data || !data.data.html) {
				console.warn('DearPDF response invalid or empty.');
				container.innerHTML = '<p style="color:red;">Viewer failed to load.</p>';
				return;
			}

			// Inject the HTML
			container.innerHTML = data.data.html;

			// Inject the config
			try {
				var config = JSON.parse(data.data.config);
				var configVar = 'df_option_' + config.id;
				window[configVar] = config;
			} catch (e) {
				console.error('Failed to parse DearPDF config:', e);
			}

			// Initialise DearPDF
			if (window.DEARPDF && typeof window.DEARPDF.parseElements === 'function') {
				window.DEARPDF.parseElements();
			} else {
				console.error('DearPDF not available or parseElements missing.');
			}
		})
		.catch(function (error) {
			console.error('DearPDF load failed:', error);
			container.innerHTML = '<p style="color:red;">Unable to load viewer.</p>';
		});
});
</script>

<?php

get_footer( 'nonav' );
?>