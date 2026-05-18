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

<script>
document.addEventListener('DOMContentLoaded', function () {
	var section = document.getElementById(<?= wp_json_encode( $block_id ); ?>);
	if (!section) return;

	var img = section.querySelector('.lc-image-text-feature__bg--parallax');
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
