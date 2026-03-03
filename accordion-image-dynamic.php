<?php
/**
 * Plugin Name:       Accordion image dynamic
 * Plugin URI:        https://danilocalabrese.it
 * Description:       Widget accordion custom per Elementor con immagine dinamica e bottone per item.
 * Version:           1.15.0
 * Requires at least: 6.0
 * Requires PHP:      8.0
 * Author:            Danilo Calabrese
 * Author URI:        https://danilocalabrese.it
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       dc-widgets
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

add_action( 'wp_enqueue_scripts', function() {

    wp_register_script(
        'custom-accordion-js',
        plugin_dir_url( __FILE__ ) . 'assets/js/custom.js',
        [ 'jquery' ],
        '1.0.0',
        true
    );

    wp_register_style(
        'custom-accordion-css',
        plugin_dir_url( __FILE__ ) . 'assets/css/custom.css',
        [],
        '1.0.1'
    );

} );


function custom_elementor_widgets_include_files() {
    require_once  plugin_dir_path(__FILE__) . '/widgets/widget-accordion-custom.php';
}
add_action('elementor/widgets/widgets_registered', 'custom_elementor_widgets_include_files');

// Register Widgets
function custom_elementor_register_widgets($widgets_manager) {
    require_once  plugin_dir_path(__FILE__) . '/widgets/widget-accordion-custom.php';
    $widgets_manager->register(new \Widget_Accordion_Custom());
}
add_action('elementor/widgets/widgets_registered', 'custom_elementor_register_widgets');

// Register Custom Widget Category
function custom_elementor_add_widget_categories($elements_manager) {
    $elements_manager->add_category(
        'custom',
        [
            'title' => __('Custom', 'plugin-name'),
            'icon' => 'fa fa-plug', // Opzionale: icona per la categoria
        ]
    );
}
add_action('elementor/elements/categories_registered', 'custom_elementor_add_widget_categories');