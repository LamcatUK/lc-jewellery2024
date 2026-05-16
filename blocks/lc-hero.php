<?php
/**
 * Block Name: LC Hero
 *
 * This is the template that displays the LC Hero block.
 *
 * @package lc-jewellery2024
 */

defined( 'ABSPATH' ) || exit;

$block_id = $block['id'] ?? wp_unique_id( 'lc-hero-' );
$align    = get_field( 'align' ) ?? null;
$class    = 'hero__bg ' . $align;

// $size = is_front_page() ? '' : 'hero--short';
$size = 'hero--short';
?>
<section id="<?= esc_attr( $block_id ); ?>" class="hero <?= esc_attr( $size ); ?>">
	<div class="container-xl px-0">
		<?= wp_get_attachment_image( get_field( 'background' ), 'full', false, array( 'class' => esc_attr( $class ) . ' hero__bg--parallax' ) ); ?>
	</div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
	var section = document.getElementById(<?= wp_json_encode( $block_id ); ?>);
	if (!section) return;

	var img = section.querySelector('.hero__bg--parallax');
	if (!img) return;
	if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

	var rafId = null;
	var currentY = 0;
	var targetY = 0;
	var baselinePercent = null;
	var strength = 140;

	img.style.willChange = 'transform';
	img.style.transform = 'translate3d(0, 0, 0)';

	function computePercent() {
		var rect = section.getBoundingClientRect();
		var windowHeight = window.innerHeight;

		if (rect.bottom <= -120 || rect.top >= windowHeight + 120) {
			return null;
		}

		var percent = (windowHeight - rect.top) / (windowHeight + rect.height);
		return Math.max(0, Math.min(1, percent));
	}

	function computeTarget() {
		var percent = computePercent();

		if (percent === null) {
			targetY = 0;
			return;
		}

		if (baselinePercent === null) {
			baselinePercent = percent;
		}

		targetY = (percent - baselinePercent) * strength;
	}

	function animate() {
		currentY += (targetY - currentY) * 0.12;
		if (Math.abs(targetY - currentY) < 0.1) {
			currentY = targetY;
		}

		img.style.transform = 'translate3d(0, ' + currentY.toFixed(2) + 'px, 0)';

		if (Math.abs(targetY - currentY) > 0.1) {
			rafId = window.requestAnimationFrame(animate);
		} else {
			rafId = null;
		}
	}

	function schedule() {
		computeTarget();

		if (!rafId) {
			rafId = window.requestAnimationFrame(animate);
		}
	}

	function onImageReady() {
		baselinePercent = null;
		currentY = 0;
		targetY = 0;
		img.style.transform = 'translate3d(0, 0, 0)';
		schedule();
	}

	window.addEventListener('scroll', schedule, { passive: true });
	window.addEventListener('resize', schedule);

	if (img.complete) {
		onImageReady();
	} else {
		img.addEventListener('load', onImageReady, { once: true });
	}

	schedule();
});
</script>