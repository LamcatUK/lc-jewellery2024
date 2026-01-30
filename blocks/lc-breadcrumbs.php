<section class="breadcrumbs">
    <div class="container-xl text-center">
        <?php
        if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<div id="breadcrumbs" class="mt-2">', '</div>');
        }
        ?>
    </div>
</section>