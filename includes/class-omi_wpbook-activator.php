<?php

/**
 * Fired during plugin activation
 *
 * @link
 * @since      1.0.0
 *
 * @package    Omi_wpbook
 * @subpackage Omi_wpbook/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Omi_wpbook
 * @subpackage Omi_wpbook/includes
 * @author     Omendra Rajput
 */
class Omi_wpbook_Activator {

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function activate() {

        // flush rewrite rules on plugin activation
        flush_rewrite_rules();

        // create custom table on plugin activation
        $version = '1.0.0';

        if ( defined( 'OMI_WPBOOK_VERSION' ) ) {
            $version = OMI_WPBOOK_VERSION;
        }
        $omi_wpbook_admin = new Omi_wpbook_Admin( 'omi_wpbook', $version );
        $omi_wpbook_admin->book_create_custom_table();

    }

}
