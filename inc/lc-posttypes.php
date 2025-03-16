<?php
function register_testimonial_cpt()
{
    $labels = array(
        'name'               => __('Testimonials', 'textdomain'),
        'singular_name'      => __('Testimonial', 'textdomain'),
        'menu_name'          => __('Testimonials', 'textdomain'),
        'add_new'            => __('Add New', 'textdomain'),
        'add_new_item'       => __('Add New Testimonial', 'textdomain'),
        'edit_item'          => __('Edit Testimonial', 'textdomain'),
        'view_item'          => __('View Testimonial', 'textdomain'),
        'all_items'          => __('All Testimonials', 'textdomain'),
        'search_items'       => __('Search Testimonials', 'textdomain'),
        'not_found'          => __('No testimonials found.', 'textdomain'),
        'not_found_in_trash' => __('No testimonials found in Trash.', 'textdomain'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false, // Makes it private
        'show_ui'            => true, // Show in admin
        'show_in_menu'       => true, // Show in admin menu
        'show_in_rest'       => true, // Enables Gutenberg support
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon'          => 'dashicons-testimonial',
        'has_archive'        => false, // No archive
        'rewrite'            => false, // No pretty URLs
        'query_var'          => false, // No direct access via ?testimonial=slug
        'exclude_from_search' => true, // Not included in site search
        'publicly_queryable'  => false, // Prevents direct access
        'capability_type'    => 'post',
    );

    register_post_type('testimonial', $args);
}
add_action('init', 'register_testimonial_cpt');
