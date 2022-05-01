<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link
 * @since      1.0.0
 *
 * @package    Omi_wpbook
 * @subpackage Omi_wpbook/public/partials
 */
/**
 * Helper Function for rendering book info
 * for shortcode
 *
 * @since    1.0.6
 */
function render_custom_metadata( $all_info ) {

    global $book_options;
    ?>
    <ul class="meta-wrapper">
        <li>
            <label for="book_author_name_field"><?php esc_html_e( 'Author\'s Name', 'omi_wpbook' ); ?></label>
            <input type="text" id="book_author_name_field" name="book_author_name_field" value="<?php echo esc_attr( $all_info[ 'author_name' ] ); ?>"/>
        </li>

        <li>
            <label for="book_price_field"><?php esc_html_e( 'Price', 'omi_wpbook' ); ?></label>
            <input class="currency-input" type="number" step="0.01" min="0" id="book_price_field" name="book_price_field" <?php echo 'value="' . esc_attr( $all_info[ 'price' ] ) . '"'; ?> />
            <a title="Change Currency" href="<?php echo get_site_url() . '/wp-admin/admin.php?page=book-settings' ?>">
                <div class="currency .bg-secondary"><span><?php echo esc_attr( $book_options[ 'currency' ] )?> </span> </div>
            </a>
        </li>

        <li>
            <label for="book_publisher_field"><?php esc_html_e( 'Publisher', 'omi_wpbook' ); ?></label>
            <input type="text" id="book_publisher_field" name="book_publisher_field" value=" <?php echo esc_attr( $all_info[ 'publisher' ] ); ?>"/>
        </li>

        <li>
            <label for="book_year_field"><?php esc_html_e( 'Year', 'omi_wpbook' ); ?></label>
            <input type="number" min="1900" max="2099" step="1" id="book_year_field" name="book_year_field" <?php echo 'value="' . esc_attr( $all_info[ 'year' ] ) . '"' ?> />
        </li>

        <li>
            <label for="book_edition_field"><?php esc_html_e( 'Edition', 'omi_wpbook' ); ?></label>
            <input type="number" min="0" id="book_edition_field" name="book_edition_field" <?php echo 'value="' . esc_attr( $all_info[ 'edition' ] ) . '"' ?> />
        </li>

        <li>
            <label for="book_url_field">URL</label>
            <input type="text" id="book_url_field" name="book_url_field" value=" <?php echo esc_attr( $all_info[ 'url' ] ); ?> "/>
        </li>

    </ul>

    <?php
}

/**
 * Helper Function for rendering book info
 * for shortcode
 *
 * @since    1.0.6
 * @param    $args arguments passed from the base function which passes custom wp_query args.
 */
function render_book_info_shortcode( $args ) {

    global $book_options;

    $html = '';

    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts() ) {

        while ( $the_query->have_posts() ) {

            $the_query->the_post();

            $all_info = get_metadata( 'bookinfo', get_the_id(), '_additional_info_key' )[0];

            $html .= '<ul>';

            if ( get_the_title() != '' )
                $html .= '<li>Title : <a href=' . get_post_permalink() . '/>' . get_the_title() . '</a></li>';

            if ( $all_info[ 'author_name' ] != '' )
                $html .= '<li>Author : <a href=' . get_the_author_link() . '/>'  . $all_info[ 'author_name' ] . '</a></li>';
            else
                $html .= '<li>Author : ' . get_the_author() . '</li>';

            if ( ( $all_info[ 'price' ] != '' ) && ( $book_options[ 'currency' ] != '') )
                $html .= '<li>Price : ' . $all_info[ 'price' ] . ' ' . $book_options[ 'currency' ] . '</li>';

            if ( $all_info[ 'publisher' ] != '' )
                $html .= '<li>Publisher : ' . $all_info[ 'publisher' ] . '</li>';

            if ( $all_info[ 'year' ] != '' )
                $html .= '<li>Year : ' . $all_info[ 'year' ] . '</li>';
            else
                $html .= '<li>Year : ' . get_the_date('Y') . '</li>';

            if ( $all_info[ 'edition' ] != '' )
                $html .= '<li>Edition : ' . $all_info[ 'edition' ] . '</li>';

            if ( $all_info[ 'url' ]  != '' )
                $html .= '<li>Url : <a href="' . $all_info[ 'url' ] . '">' . $all_info[ 'url' ] . '</a></li>';

            if ( get_the_content() != '' )
                $html .= '<li>Content : ' . get_the_content() . '</li>';

            $html .= '</ul>';
        }

        wp_reset_postdata();
    } else {
        $html .= '<h2>No books found</h2>';
    }

    wp_reset_query();

    return $html;
}



?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
