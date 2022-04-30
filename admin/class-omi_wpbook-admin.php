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
	/**
     * Function to add custom taxonomy 'Book Tags'
     * This one is non-hierarchical taxonomy
     *
     * @since    1.0.2
     */
    public function add_custom_taxonomy() {
        $labels = array(
            'name'          => __( 'Book Tags', 'omi_wpbook' ),
            'singular_name' => __( 'Book Tag', 'omi_wpbook' ),
            'all_items'     => __( 'All Book Tags', 'omi_wpbook' ),
            'edit_item'     => __( 'Edit Book Tag', 'omi_wpbook' ),
            'update_item'   => __( 'Update Book Tag', 'omi_wpbook' ),
            'add_new_item'  => __( 'Add New Book Tag', 'omi_wpbook' ),
            'new_item_name' => __( 'New Tag Name', 'omi_wpbook' ),
            'menu_name'     => __( 'Book Tags', 'omi_wpbook' ),
        );

        $args = array(
            'hierarchical'      => false,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'rewrite'           => array( 'slug' => 'book_tag' ),
        );

        // register taxonomy
        register_taxonomy('book_tag', array('book'), $args);
    }

	/**
     * Function to add custom meta boxes
     *
     * @since    1.0.3
     */
    public function book_create_meta_box() {

        /**
         *  add_meta_box(String id, String title, function callback, mixed screen, String context, String priority,
         *      Array callback_args);
         * id -> used to store and retrive your meta data
         * title -> what user sees
         * callback -> function called
         * screen -> used to indicate where the metabox is to be displayed
         * context -> (normal, side) show on right side or in editor column
         * priority -> (high, default, low) gives priority to display
         * These four args are enough, rest are optional
         */

        add_meta_box( 'details', __( 'Additional Information',  'omi_wpbook' ), array( $this, 'book_meta_info_callback' ), 'book' );

    }

    public function book_meta_info_callback( $post ) {

        /**
         *  Use nonce for verification
         *
         * wp_nonce_field( String $action, String $name )
         *
         * $action -> Action name. Should give the context to what is taking place. Optional but recommended.
         * $name ->  Nonce name. This is the name of the nonce hidden form field to be created.
         */
        wp_nonce_field( 'book_save_meta_info', 'book_additional_info_nonce' );

        // retrive all information
        $all_info = get_metadata( 'bookinfo', $post->ID, '_additional_info_key' )[0];

        // RENDER HTML
        render_custom_metadata( $all_info );

    }

    // support function to save meta info
    public function book_save_meta_info( $post_id ) {

        // Nonce verification. If nonce does not match, return
        if ( ! wp_verify_nonce( $_POST[ 'book_additional_info_nonce' ], 'book_save_meta_info' ) ) {
            return;
        }

        // If post is being auto saved by wordpress, no need to save meta data
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        // make sure user has permission to change meta data
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        // collect and sanitize data
        $author_name = sanitize_text_field( $_POST[ 'book_author_name_field' ] );
        $price       = sanitize_text_field( $_POST[ 'book_price_field' ] );
        $publisher   = sanitize_text_field( $_POST[ 'book_publisher_field' ] );
        $year        = sanitize_text_field( $_POST[ 'book_year_field' ] );
        $edition     = sanitize_text_field( $_POST[ 'book_edition_field' ] );
        $url         = sanitize_text_field( $_POST[ 'book_url_field' ] );

        // push all info to db as an array
        $all_info = array(
            'author_name' => $author_name,
            'price'       => $price,
            'publisher'   => $publisher,
            'year'        => $year,
            'edition'     => $edition,
            'url'         => $url,
        );

        // update the data to db
        update_metadata( 'bookinfo', $post_id, '_additional_info_key', $all_info );
    }


}
