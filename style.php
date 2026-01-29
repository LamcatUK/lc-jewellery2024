<?php
/**
 * Template Name: Style Guide
 *
 * This template is used to display the CSS properties defined in the SASS file.
 *
 * @package lc-jewellery2024
 */

if ( ! function_exists( 'wp_kses_post' ) ) {
	die( 'WordPress not loaded. Please access this page via the WordPress front end.' );
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Style Guide</title>
    <link rel="stylesheet" href="<?= esc_url( get_stylesheet_directory_uri() . '/css/child-theme.css' ); // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedStylesheet ?>">
    <style>
        h2 {
            border-bottom: 1px solid hsl(0 0% 0% / 0.2);
        }

        .data {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .output {
            display: grid;
            grid-template-columns: 200px auto;
        }

        .title {
            align-self: center;
        }

        .value {
            width: 100%;
            min-height: 50px;
            align-self: center;
        }

        .single {
            width: 100%;
            height: 50px;
        }
    </style>
</head>
<body>
    <h1>Style Guide - LC Jewellery 2024</h1>
    
    <section>
        <h2>Colors</h2>
        <div class="data">
            <div class="output">
                <div class="title">Primary</div>
                <div class="value single" style="background-color: var(--col-primary);"></div>
            </div>
            <div class="output">
                <div class="title">Green 400</div>
                <div class="value single" style="background-color: var(--col-green-400);"></div>
            </div>
            <div class="output">
                <div class="title">Green 900</div>
                <div class="value single" style="background-color: var(--col-green-900);"></div>
            </div>
            <div class="output">
                <div class="title">Grey 200</div>
                <div class="value single" style="background-color: var(--col-grey-200);"></div>
            </div>
            <div class="output">
                <div class="title">Grey 300</div>
                <div class="value single" style="background-color: var(--col-grey-300);"></div>
            </div>
            <div class="output">
                <div class="title">Grey 400</div>
                <div class="value single" style="background-color: var(--col-grey-400);"></div>
            </div>
            <div class="output">
                <div class="title">Grey 800</div>
                <div class="value single" style="background-color: var(--col-grey-800);"></div>
            </div>
            <div class="output">
                <div class="title">Light</div>
                <div class="value single" style="background-color: var(--col-light);"></div>
            </div>
            <div class="output">
                <div class="title">Dark</div>
                <div class="value single" style="background-color: var(--col-dark);"></div>
            </div>
        </div>
    </section>

    <section>
        <h2>Typography - Font Sizes</h2>
        <div class="data">
            <div class="output">
                <div class="title">100</div>
                <div class="value" style="font-size: var(--fs-100);">The quick brown fox</div>
            </div>
            <div class="output">
                <div class="title">200</div>
                <div class="value" style="font-size: var(--fs-200);">The quick brown fox</div>
            </div>
            <div class="output">
                <div class="title">300</div>
                <div class="value" style="font-size: var(--fs-300);">The quick brown fox</div>
            </div>
            <div class="output">
                <div class="title">400</div>
                <div class="value" style="font-size: var(--fs-400);">The quick brown fox</div>
            </div>
            <div class="output">
                <div class="title">500</div>
                <div class="value" style="font-size: var(--fs-500);">The quick brown fox</div>
            </div>
            <div class="output">
                <div class="title">600</div>
                <div class="value" style="font-size: var(--fs-600);">The quick brown fox</div>
            </div>
            <div class="output">
                <div class="title">700</div>
                <div class="value" style="font-size: var(--fs-700);">The quick brown fox</div>
            </div>
            <div class="output">
                <div class="title">900</div>
                <div class="value" style="font-size: var(--fs-900);">The quick brown fox</div>
            </div>
        </div>
    </section>

    <section>
        <h2>Typography - Font Families</h2>
        <div class="data">
            <div class="output">
                <div class="title">Headings</div>
                <div class="value" style="font-family: var(--ff-headings); font-size: var(--fs-600);">The quick brown fox</div>
            </div>
            <div class="output">
                <div class="title">Body</div>
                <div class="value" style="font-family: var(--ff-body); font-size: var(--fs-400);">The quick brown fox</div>
            </div>
        </div>
    </section>

    <section>
        <h2>Shadows</h2>
        <div class="data">
            <div class="output">
                <div class="title">Shadow 1</div>
                <div class="value single" style="box-shadow: var(--shadow-1); background: white;"></div>
            </div>
        </div>
    </section>
</body>
</html>
