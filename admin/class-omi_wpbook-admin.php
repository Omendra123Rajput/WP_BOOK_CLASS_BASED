<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link
 * @since      1.0.0
 *
 * @package    Omi_wpbook
 * @subpackage Omi_wpbook/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Omi_wpbook
 * @subpackage Omi_wpbook/admin
 * @author     Omendra Rajput
 */

/**
 * includes
 */
// for rendering shortcode's front-end and custom option page
require_once( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/omi_wpbook-admin-display.php' );

// for widget class
require_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/widgets.php' );

class Omi_wpbook_Admin {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Omi_wpbook_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Omi_wpbook_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/omi_wpbook-admin.css', array(), $this->version, 'all' );

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Omi_wpbook_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Omi_wpbook_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/omi_wpbook-admin.js', array( 'jquery' ), $this->version, false );

    }

    /**
     * ADD-ON FUNCTIONS START HERE
     */

    /*
     * Function that registers the 'book' post type
     *
     * @since    1.0.1
     */
	public function add_custom_post_type() {

        $labels = array(
            'name'          => __( 'Books', 'omi_wpbook' ),
            'singular_name' => __( 'Book', 'omi_wpbook' ),
            'add_new'       => __( 'Add Book', 'omi_wpbook' ),
            'all_items'     => __( 'All Books', 'omi_wpbook' ),
            'edit_item'     => __( 'Edit Book', 'omi_wpbook' ),
            'add_new_item'  => __( 'Add New Book', 'omi_wpbook' ),
            'new_item'      => __( 'Add Book', 'omi_wpbook' ),
            'view_item'     => __( 'View Book', 'omi_wpbook' ),
            'search_item'   => __( 'Search Book', 'omi_wpbook' ),
        );

        $args = array(
            'labels'          => $labels,
            'public'          => true,
            'capability_type' => 'post',
            'menu_icon'       => 'dashicons-book',
            'has_archive'     => true,
            'hierarchical'    => false,
            'supports'        => array(
                                    'title',
                                    'editor',
                                    'excerpt',
                                    'thumbnail',
                                    'revisions',
                                    'comments',
                                ),
        );

        register_post_type( 'book', $args );

    }
	/**
     * Function to add custom taxonomy 'Book Category'
     * This one is hierarchical taxonomy
     *
     * @since    1.0.2
     */
	public function hi_add_custom_taxonomy() {
        $labels = array(
            'name'               => __( 'Book Categories', 'omi_wpbook' ),
            'singular_name'      => __( 'Book Category', 'omi_wpbook' ),
            'search_items'       => __( 'Search Book Categories', 'omi_wpbook' ),
            'all_items'          => __( 'All Book Categories', 'omi_wpbook' ),
            'parent_item'        => 'Parent Type',
            'parent_item_column' => 'Parent Type:',
            'edit_item'          => __( 'Edit Book Category', 'omi_wpbook' ),
            'update_item'        => __( 'Update Book Category', 'omi_wpbook' ),
            'add_new_item'       => __( 'Add New Book Category', 'omi_wpbook' ),
            'new_item_name'      => __( 'New Category Name', 'omi_wpbook' ),
            'menu_name'          => __( 'Book Categories', 'omi_wpbook' ),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'rewrite'           => array( 'slug' => 'book_category' ),
        );

        // register taxonomy
        register_taxonomy('book_category', array('book'), $args);
    }
}
