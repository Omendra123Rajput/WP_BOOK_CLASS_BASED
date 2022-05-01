<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin
 *
 * @link
 * @since      1.0.0
 *
 * @package    Omi_wpbook
 * @subpackage Omi_wpbook/admin/partials
 */

/**
 * This function renders the custom settings page for 'book settings'
 *
 * @since      1.0.5
 */
function book_render_settings_page() {
    global $book_options;

    $currencies = array( 'USD', 'INR', 'EUR', 'GBP', 'JPY', 'CAD', 'AUD' ); ?>

    <h1><?php esc_html_e( 'Book Settings', 'omi_wpbook' ); ?></h1>
        <h3 class="title"><?php esc_html_e( 'Manage Options', 'omi_wpbook' ); ?></h3>

        <form method="post" action="options.php">

        <?php settings_fields( 'book-settings-group' ); ?>

        <div class="book-settings-content">
        <p>
            <label class="description" for="book_settings[currency]"> <?php esc_html_e( 'Select the currency', 'omi_wpbook' ); ?>: </label>

            <select id="book_settings[]" name="book_settings[currency]">
            <?php
                $selected_currency = esc_attr( $book_options[ 'currency' ] );
            foreach ( $currencies as $currency ) {
                if ( $selected_currency != $currency ) {
                    echo '<option value="' . $currency . '">' . $currency . '</option>';
                } else {
                    echo '<option selected value="' . $currency . '">' . $currency . '</option>';
                }
            }
            ?>
            </select></p>

        <p>
            <label class="description" for="book_settings[num_of_books]"> <?php esc_html_e( 'Number of books per page', 'omi_wpbook' ); ?>: </label>
            <input type="number" min="0" max="100" step="1" id="book_settings[num_of_books]" name="book_settings[num_of_books]" value="<?php esc_attr_e( $book_options[ 'num_of_books' ] ); ?>"/>
        </p>
        <p class="submit">
            <input type="submit" class="button-primary" value="Save Options" />
        </p>

        </div>
    </form>
    <?php
}


/**
 * Helper Function for rendering dashboard widget
 *
 * @since    1.1.0
 */
function book_render_dash_widget() {

    $categories = get_terms( array(
        'taxonomy'   => 'book_category',
        'hide_empty' => false,
        'number'     => '5',
        'orderby'    => 'count',
        'order'      => 'DESC',
    ) );

    if ( ! empty( $categories ) ) : ?>
        <p class="book-dash-head">
            <span><b><?php esc_html_e( 'Category Name', 'omi_wpbook' ); ?></b></span>
            <span><b><?php esc_html_e( 'Count', 'omi_wpbook' ); ?></b></span>
        </p>

        <ul class="book-dash-list">
        <?php
        // render out categories
        foreach ( $categories as $category ) { ?>
            <li><a
                href="<?php echo get_category_link( $category->term_id );?>"
                alt="<?php echo $category->name; ?>">
                <?php echo $category->name; ?>
                </a>
                <span class="count"><?php echo $category->count; ?></span>
            </li>
        <?php } ?>

        </ul>
    <?php else : ?>
        <p><i><?php esc_html_e( 'Add new book categories to see your top 5 book categories here!', 'omi_wpbook' ); ?></i></p>
    <?php
    endif;
}
