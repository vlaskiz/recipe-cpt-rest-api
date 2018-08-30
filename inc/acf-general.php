<?php

defined( 'ABSPATH' ) || exit;

define('ACF_CORE_URI', get_stylesheet_directory_uri() . '/acf-core/');
define('ACF_CORE_DIR', get_stylesheet_directory() . '/acf-core/');

add_filter('acf/settings/path', 'custom_acf_settings_path');
function custom_acf_settings_path( $path ) {
    return ACF_CORE_URI;
}

add_filter('acf/settings/dir', 'custom_acf_settings_dir');
function custom_acf_settings_dir( $dir ) {
    return ACF_CORE_URI;
}

// Include ACF
include_once( ACF_CORE_DIR . 'acf.php' );

add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point( $path ) {
    // update path
    $path = get_stylesheet_directory() . '/acf-json';

    // return
    return $path;
}

function template_substitution($template, $data) {
    $placeholders = array_keys($data);
    foreach ($placeholders as &$placeholder) {
        $placeholder = strtoupper("{{$placeholder}}");
    }
    return str_replace($placeholders, array_values($data), $template);
}

// Hide ACF field group menu item
add_filter('acf/settings/show_admin', '__return_false');
