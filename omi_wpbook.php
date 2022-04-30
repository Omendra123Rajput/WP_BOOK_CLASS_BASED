<?php

/**
 * Plugin wp-book root file.
 *
 * Plugin Name:       WP Book
 * Plugin URI:        https://github.com/Omendra123Rajput/wordpress-book
 * Description:       To manage all book related functionalities.
 * Version:           1.0.0
 * Author:            Omendra Rajput
 * Author URI:        https://mail.google.com/mail/u/0/#inbox
 * License:           GPL v2 or later
 * Text Domain:       wp-book
 * Domain Path:       /languages/
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Rename this for your plugin and update it as you release new versions.
 */
define('OMENDRA_WPBOOK_VERSION', '1.1.0');

/**
 * Global variables
 */
$defaults = array(
    'currency' => 'INR',
    'num_of_books' => '10',
);
$book_options = get_option( 'book_settings', $defaults );

if ( $book_options == '' ) {
    update_option( 'book_settings', $defaults );
}
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-rahi_wpbook-activator.php
 */
function omi_wpbook_activate() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-omi_wpbook-activator.php';
    Omi_wpbook_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-rahi_wpbook-deactivator.php
 */
function omi_wpbook_deactivate() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-omi_wpbook-deactivator.php';
    omi_wpbook_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'omi_wpbook_activate' );
register_deactivation_hook( __FILE__, 'omi_wpbook_deactivate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-omi_wpbook.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */

function omi_wpbook_run() {

    $plugin = new Omi_wpbook();
    $plugin->run();
}
omi_wpbook_run();
