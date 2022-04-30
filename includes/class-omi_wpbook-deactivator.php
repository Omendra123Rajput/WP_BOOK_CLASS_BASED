<?php

/**
 * Fired during plugin deactivation
 *
 * @link
 * @since      1.0.0
 *
 * @package    Omi_wpbook
 * @subpackage Omi_wpbook/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Omi_wpbook
 * @subpackage Omi_wpbook/includes
 * @author     Omendra Rajput
 */
class Omi_wpbook_Deactivator {

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function deactivate() {
        // flush the rewrite rules on deactivation
        flush_rewrite_rules();
    }

}
