<?php
$txtcol = get_field('order') == 'Text/Image' ? 'order-2 order-md-1' : 'order-2 order-md-2';
$imgcol = get_field('order') == 'Text/Image' ? 'order-1 order-md-2' : 'order-1 order-md-1';

$txtanim = get_field('order') == 'Text/Image' ? 'fade-right' : 'fade-left';
$imganim = get_field('order') == 'Text/Image' ? 'fade-left' : 'fade-right';

$txtanim = 'fade';
$imganim = 'fade';

$title_align = (get_field('title_alignment') === 'left') ? 'text-start' : 'text-center';

switch (get_field('split')) {
    case 6040:
        $colText = 'col-md-7';
        $colImage = 'col-md-5';
        break;
    default:
        $colText = 'col-md-6';
        $colImage = 'col-md-6';
}

$classes = $block['className'] ?? 'py-5';

?>
<section class="feature <?= $classes ?>">
    <div class="container-xl">
        <?php
        if (get_field('title') ?? null) {
        ?>
            <div class="h2 <?= $title_align ?> d-md-none" data-aos="fade">
                <?= get_field('title') ?>
            </div>
        <?php
        }
        ?>
        <div class="row g-4">
            <div class="<?= $colText ?> <?= $txtcol ?> d-flex flex-column justify-content-center"
                data-aos="<?= $txtanim ?>">
                <?php
                if (get_field('title') ?? null) {
                ?>
                    <h2 class="d-none d-md-block <?= $title_align ?> h2">
                        <?= get_field('title') ?>
                    </h2>
                <?php
                }
                ?>
                <div><?= get_field('content') ?>
                </div>
                <?php
                if (get_field('link') ?? null) {
                    $l = get_field('link');
                ?>
                    <a href="<?= $l['url'] ?>"
                        target="<?= $l['target'] ?>"
                        class="btn btn-primary mx-auto mt-3"><?= $l['title'] ?></a>
                <?php
                }
                ?>
            </div>
            <div class="<?= $colImage ?> <?= $imgcol ?> d-flex align-items-center" data-aos="<?= $imganim ?>">
                <div class="video-thumbnail-wrapper mx-auto">
                    <?= wp_get_attachment_image(get_field('video_thumbnail'), 'large', false, [
                        'class' => 'feature__img video-thumbnail',
                        'alt'   => get_field('title'),
                    ]); ?>
                    <div class="video-thumbnail-overlay" data-bs-toggle="modal" data-bs-target="#videoModal">
                        <div class="play-button"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="ratio ratio-16x9">
                    <video id="modalVideo" controls>
                        <source src="<?= get_field('video') ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
add_action('wp_footer', function () {
?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var videoModal = document.getElementById('videoModal');
            var video = document.getElementById('modalVideo');

            if (videoModal && video) {
                // Play video when modal is shown
                videoModal.addEventListener('shown.bs.modal', function() {
                    video.play();
                });

                // Pause and reset video when modal is hidden
                videoModal.addEventListener('hidden.bs.modal', function() {
                    video.pause();
                    video.currentTime = 0;
                });
            }
        });
    </script>
<?php
}, 9999);
