<?php 
/*
Plugin Name: Musuem of Jewish Heritage Education Custom Configurations
Description: This plugin registers Musuem of Jewish Heritage Education custom configurations.
Version: 1.0.0
License: GPLv2
*/
// set acf pro save json directory
add_filter('acf/settings/save_json', function($path) {
    return WPMU_PLUGIN_DIR . '/mjhedu-custom-configurations/acf-json';
});
// set acf pro load json directory
add_filter('acf/settings/load_json', function($paths) {
    unset($paths[0]);
    $paths[] = WPMU_PLUGIN_DIR . '/mjhedu-custom-configurations/acf-json';
    return $paths;
});
?>