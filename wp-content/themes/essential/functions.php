<?php

/**
 * Essential functions and definitions
 *
 * @package essential
 */

defined( 'T_URI' )  or define( 'T_URI',  get_template_directory_uri() );
defined( 'T_PATH' ) or define( 'T_PATH', get_template_directory() );
defined( 'F_PATH' ) or define( 'F_PATH', T_PATH . '/inc' );

/* Admin CSS */

if(!function_exists('essential_admin_css')) {
    function essential_admin_css() {
        wp_enqueue_style('admin-styles', T_URI . '/assets/css/admin.css');
    }
}

add_action('login_head', 'essential_admin_css');
add_action('admin_enqueue_scripts', 'essential_admin_css');

// Framework integration
require_once F_PATH . '/custom/actions-config.php';
require_once F_PATH . '/customizer.php';
require_once F_PATH . '/custom-header.php';
require_once F_PATH . '/custom/helper-functions.php';
require_once F_PATH . '/class-tgm-plugin-activation.php';
require_once F_PATH . '/acf/acf-config.php';

if ( ! isset( $content_width ) ) {
	$content_width = 1200;
}

if ( ! function_exists('essential_after_setup' ) ) {
    function essential_after_setup() {

        load_theme_textdomain( 'essential', get_template_directory() . '/languages' );

        register_nav_menus(
            array(
                'primary-menu'  => esc_html__( 'Primary menu', 'essential' ),
            )
        );

        add_theme_support( 'post-formats', array('video', 'gallery', 'audio', 'quote'));
        add_theme_support( 'custom-header' );
        add_theme_support( 'custom-background' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'title-tag' );

        add_image_size( 'essential-portfolio', '800', '533' );
    }
}
add_action( 'after_setup_theme', 'essential_after_setup' );

/**
 * Сustom essential menu.
 */
if ( ! function_exists('essential_custom_menu' ) ) {
    function essential_custom_menu() {
        if ( has_nav_menu( 'primary-menu' ) ) {
            wp_nav_menu(
                array(
                  'theme_location'    => 'primary-menu',
                  'container_class'   => 'collapse navbar-collapse',
                  'menu_class'        => 'navbar-nav mobile',
                  'container_id'      => 'main-nav',
                  'walker'            => new EssentialTopMenuWalker()
                )
            );
        } elseif(current_user_can('administrator'))  {
            print '<span class="no-menu">' . esc_html__( 'Please register Top Navigation from', 'essential' ) . '<a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" target="_blank">' . esc_html__( 'Appearance &gt; Menus', 'essential' ) . '</a></span>';
        }
    }
}

if ( ! class_exists('EssentialTopMenuWalker' ) ) {
    class EssentialTopMenuWalker extends Walker_Nav_Menu {
        // change view of top navigation menu items
        function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

            $class_names = $value = '';
            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $classes[] = 'menu-item-' . esc_attr( $item->ID );
            $classes[] = 'page-scroll';

            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
            $class_names = ' class="' . esc_attr( $class_names ) . '"';

            $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
            $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

            $output .= $indent . '<li ' . $id . $value . $class_names .'>';

            $cur_post = get_post($item->object_id);
            $slug = "#" . $cur_post->post_name;

            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';

            if ( substr_count($class_names, 'menu-item-has-children') ) {
                $attributes .= ' data-toggle="dropdown"';
            }

            $page_list = apply_filters('essential_custom_page_list', essential_get_options('essential_sortable_pages'));

            if ( get_option('show_on_front') == 'page' && essential_get_options('enable_onepage') ) {
                $pages = get_all_page_ids();
                $blog_page = get_option( 'page_for_posts' );

                if ( $blog_page && ( $key = array_search( $blog_page, $pages ) ) !== false ) {
                    unset($pages[$key]);
                }

                if ( !empty( $page_list ) && in_array( $item->object_id, $page_list ) ) { // Custom page list in onepage
                    if( is_page() && in_array( get_the_ID(), $page_list ) ) {
                        $attributes .= ! empty( $item->object_id )  ? ' class="anchor-scroll" href="' . esc_url( $slug ) . '"' : '';
                    } else {
                        $attributes .= ! empty( $item->object_id )  ? ' href="' . esc_url( home_url( '/' ) ) . '#' . $cur_post->post_name . '"' : '';
                    }
                } else {
                    $attributes .= ! empty( $item->url ) ? ' href="' . esc_url( $item->url ) . '"' : '';
                }
            } else {
                $attributes .= ! empty( $item->url ) ? ' href="' . esc_url( $item->url ) . '"' : '';
            }

            $item_output = $args->before;
            $item_output .= '<a '. $attributes .'>';
            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
    }
}

/**
* Get Options Theme
*/
if (!function_exists('essential_get_options')) :
    function essential_get_options( $setting = false, $default = array() ) {

        $options = get_option( 'essential_themes_options' );

        $options = (array) $options;

        if ( empty($options)) return $default;

        if (!$setting) return $options;

        if ( !empty( $options[ $setting ] ) ) {
            return $options[$setting];
        } else {
            return $default;
        }

        return array();
    }
endif;

add_action("customize_register", "essential_customize_register");

add_theme_support('align-wide');

add_theme_support('align-full');

add_theme_support('editor-styles');

add_editor_style('assets/css/style-editor.css');

add_editor_style( essential_fonts_url() );

?>
