<?php

/** Constants */
defined('THEME_URI') || define('THEME_URI', get_template_directory_uri());
defined('THEME_PATH') || define('THEME_PATH', realpath(__DIR__));
include_once THEME_PATH . '/includes/curl_client.php';
include_once THEME_PATH . '/includes/functions.php';
require_once THEME_PATH . '/includes/register-sidebar.php';

// Constants
defined('DISALLOW_FILE_EDIT') || define('DISALLOW_FILE_EDIT', FALSE);
defined('TEXT_DOMAIN') || define('TEXT_DOMAIN', 'jp-basic');
define('JPB_THEME_PATH', realpath(__DIR__));

//Theme settings
require(get_template_directory() . '/inc/theme-options.php');

//include_once __DIR__ . '/includes/register-script.php';
include_once __DIR__ . '/includes/register-script-local.php';
include_once __DIR__ . '/includes/register-style.php';
//include_once __DIR__ . '/includes/register-style-local.php';

/**
 * Add scripts and styles to all Admin pages
 */
function jscustom_admin_scripts() {
    wp_enqueue_media();
    wp_register_script('custom-upload', get_template_directory_uri() . '/js/media-uploader.js', array('jquery'));
    wp_enqueue_script('custom-upload');
}

add_action('admin_print_scripts', 'jscustom_admin_scripts');

add_action('wp_enqueue_scripts', function () {

    /* Styles */
    wp_enqueue_style('bootstrap');
    wp_enqueue_style('animate');
    wp_enqueue_style('hover');
    wp_enqueue_style('font-awesome');
    // Theme
    wp_enqueue_style('main-theme');

    /* Scripts */
    wp_enqueue_script('modernizr');
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap');
    wp_enqueue_script('jquery-form');

    // Bootstrap Alerts
    wp_register_script('bootstrap-alerts', apply_filters('js_cdn_uri', THEME_URI . '/js/bootstrap-alerts.min.js', 'bootstrap-alerts'), array('jquery', 'bootstrap'), NULL, TRUE);
    wp_enqueue_script('bootstrap-alerts');


    // Bootstrap Theme
    //wp_register_style('bootstrap-theme', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css', array('bootstrap'), '3.3.4');
    // wp_enqueue_style('bootstrap-theme');
    // Add defer atribute
    do_action('defer_script', array('jquery-form', 'bootstrap-alerts'));

    // Bootstrap complemetary text align
    wp_register_style('bs-text-align', THEME_URI . '/css/bootstrap-text-align.min.css', array('bootstrap'), '1.0');
    wp_enqueue_style('bs-text-align');

    // Wordpress Core
    wp_register_style('wordpress-core', THEME_URI . '/css/wordpress-core.min.css', array('bootstrap', 'bs-text-align'), '1.0');
    wp_enqueue_style('wordpress-core');

    if (is_child_theme()) {
        // Theme
        wp_register_style('theme', get_stylesheet_uri(), array('animate'), '1.0');
        wp_enqueue_style('theme');
    }
});

include_once __DIR__ . '/includes/theme-features.php';

add_theme_support('post-thumbnails');
add_image_size('img_page', 1140, 450, true);

/**
 * Encoded Mailto Link
 *
 * Create a spam-protected mailto link written in Javascript
 *
 * @param	string	the email address
 * @param	string	the link title
 * @param	mixed	any attributes
 * @return	string
 */
function safe_mailto($email, $title = '', $attributes = '') {
    $title = (string) $title;

    if ($title === '') {
        $title = $email;
    }

    $x = str_split('<a href="mailto:', 1);

    for ($i = 0, $l = strlen($email); $i < $l; $i++) {
        $x[] = '|' . ord($email[$i]);
    }

    $x[] = '"';

    if ($attributes !== '') {
        if (is_array($attributes)) {
            foreach ($attributes as $key => $val) {
                $x[] = ' ' . $key . '="';
                for ($i = 0, $l = strlen($val); $i < $l; $i++) {
                    $x[] = '|' . ord($val[$i]);
                }
                $x[] = '"';
            }
        } else {
            for ($i = 0, $l = strlen($attributes); $i < $l; $i++) {
                $x[] = $attributes[$i];
            }
        }
    }

    $x[] = '>';

    $temp = array();
    for ($i = 0, $l = strlen($title); $i < $l; $i++) {
        $ordinal = ord($title[$i]);

        if ($ordinal < 128) {
            $x[] = '|' . $ordinal;
        } else {
            if (count($temp) === 0) {
                $count = ($ordinal < 224) ? 2 : 3;
            }

            $temp[] = $ordinal;
            if (count($temp) === $count) {
                $number = ($count === 3) ? (($temp[0] % 16) * 4096) + (($temp[1] % 64) * 64) + ($temp[2] % 64) : (($temp[0] % 32) * 64) + ($temp[1] % 64);
                $x[] = '|' . $number;
                $count = 1;
                $temp = array();
            }
        }
    }

    $x[] = '<';
    $x[] = '/';
    $x[] = 'a';
    $x[] = '>';

    $x = array_reverse($x);

    $output = "<script type=\"text/javascript\">\n"
            . "\t//<![CDATA[\n"
            . "\tvar l=new Array();\n";

    for ($i = 0, $c = count($x); $i < $c; $i++) {
        $output .= "\tl[" . $i . "] = '" . $x[$i] . "';\n";
    }

    $output .= "\n\tfor (var i = l.length-1; i >= 0; i=i-1) {\n"
            . "\t\tif (l[i].substring(0, 1) === '|') document.write(\"&#\"+unescape(l[i].substring(1))+\";\");\n"
            . "\t\telse document.write(unescape(l[i]));\n"
            . "\t}\n"
            . "\t//]]>\n"
            . '</script>';

    return $output;
}

require_once __DIR__ . '/admin/admin.php';

//Register Menu

function register_global_menus() {
    register_nav_menus(
            array(
                'header-menu' => __('Header Menu')
            )
    );
}

add_action('init', 'register_global_menus');

// Register Custom Navigation Walker
require_once('wp_bootstrap_navwalker.php');

class Custom_Walker extends Walker_Nav_Menu {

    function start_el(&$output, $item, $depth, $args) {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat("\t", $depth) : '' ); // code indent
        // depth dependent classes
        $depth_classes = array(
            ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
            ( $depth >= 2 ? 'sub-sub-menu-item' : '' ),
            ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
            'menu-item-depth-' . $depth
        );
        $depth_class_names = esc_attr(implode(' ', $depth_classes));

        // passed classes
        $classes = empty($item->classes) ? array() : (array) $item->classes;

        if (!in_array($item->object, array('custom'))) {
            $post_data = get_post($item->object_id);
            $classes[] = $post_data->post_type . '-' . $post_data->post_name;
        }

        $class_names = esc_attr(implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item)));

        // build html
        $output .= $indent . '<li id="nav-menu-item-' . $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

        // link attributes
        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

        $item_output = sprintf('%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s', $args->before, $attributes, $args->link_before, apply_filters('the_title', $item->title, $item->ID), $args->link_after, $args->after
        );

        // build html
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

}

function rw_register_meta_box() {
    if (!class_exists('RW_Meta_Box') or ! is_admin())
        return;
    $post_ID = !empty($_POST['post_ID']) ?
            $_POST['post_ID'] :
            (!empty($_GET['post']) ? $_GET['post'] : FALSE);

    $post_name = '';
    if ($post_ID) {
        $current_post = get_post($post_ID);
        if ($current_post) {
            $current_post_type = $current_post->post_type;
            $post_name = $current_post->post_name;
        } else {
            $post_name = '';
        }
    }

    $meta_box[] = array(
        'id' => 'custom_post_fields',
        'title' => 'More',
        'pages' => array('post'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => 'Icon',
                'id' => 'icon_category',
                'type' => 'select',
                'options' => array(
                    'https://www.purplelab.com/wp-content/uploads/2016/12/Benchmarking-Appropriateness-white.png' => 'Appropriateness Report Retriever',
                    'https://www.purplelab.com/wp-content/uploads/2016/12/Cost-Report-Retriever-white.png' => 'Cost Report Retriever',
                    'https://www.purplelab.com/wp-content/uploads/2016/12/WhiteOutcome.png' => 'Experience Report Retriever',
                    'https://www.purplelab.com/wp-content/uploads/2016/12/qualitywhite.png' => 'Outcomes Report Retriever',
                ),
            ),
            array(
                'name' => 'Color of box',
                'id' => 'color_box',
                'type' => 'select',
                'options' => array(
                    'blue-bg' => 'Blue',
                    'orange-bg' => 'Orange',
                    'purple-bg' => 'Purple',
                    'light-blue-bg' => 'Light Blue',
                    'dark-blue-bg' => 'Dark Blue',
                ),
            ),
            array(
                'name' => 'Citation',
                'id' => 'citation_field',
                'type' => 'wysiwyg',
            ),
            array(
                'name' => 'Article (PDF)',
                'id' => 'article_pdf',
                'type' => 'file',
                'max_file_uploads' => 1,
            ),
            array(
                'name' => 'Citation',
                'id' => 'citation_field_2',
                'type' => 'wysiwyg',
            ),
            array(
                'name' => 'Article (PDF) 2',
                'id' => 'article_pdf_2',
                'type' => 'file',
                'max_file_uploads' => 1,
            ),
            array(
                'name' => 'Citation',
                'id' => 'citation_field_3',
                'type' => 'wysiwyg',
            ),
            array(
                'name' => 'Article (PDF) 3',
                'id' => 'article_pdf_3',
                'type' => 'file',
                'max_file_uploads' => 1,
            )
    ));

    if ($post_name == 'home') {

        $meta_box[] = array(
            'id' => 'info_home',
            'title' => 'Information home',
            'pages' => array('page'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => 'Content',
                    'id' => 'cont_des',
                    'type' => 'wysiwyg',
                ),
                array(
                    'name' => 'Content box two',
                    'id' => 'cont_des_2',
                    'type' => 'wysiwyg',
                )
        ));
    }

    $meta_box[] = array(
        'id' => 'id_videos',
        'title' => 'ID Video',
        'pages' => array('videos'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'id' => 'id_video_url',
                'type' => 'text',
            )
    ));

    if ($post_name == 'life-sciences' || $post_name == 'payers' || $post_name == 'providers') {

        $meta_box[] = array(
            'id' => 'info_add',
            'title' => 'More information',
            'pages' => array('page'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => 'Box Green',
                    'id' => 'content_box_green',
                    'type' => 'wysiwyg',
                ),
                array(
                    'name' => 'Box White',
                    'id' => 'content_box_white',
                    'type' => 'wysiwyg',
                ),
                array(
                    'name' => 'Box Orange',
                    'id' => 'content_box_pink',
                    'type' => 'wysiwyg',
                ),
                array(
                    'name' => 'Box White Two',
                    'id' => 'content_box_white_two',
                    'type' => 'wysiwyg',
                ),
                array(
                    'name' => 'Box purple',
                    'id' => 'content_box_purple',
                    'type' => 'wysiwyg',
                ),
                array(
                    'name' => 'Box White Three',
                    'id' => 'content_box_white_three',
                    'type' => 'wysiwyg',
                ),
        ));
    }

    if ($post_name == 'our-offer') {

        $meta_box[] = array(
            'id' => 'info_add_offer',
            'title' => 'More information',
            'pages' => array('page'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'id' => 'list_with_images',
                    'type' => 'group',
                    'clone' => true,
                    'fields' => array(
                        array(
                            'name' => 'Image',
                            'id' => "sector-object-img",
                            'type' => 'image_advanced',
                            'max_file_uploads' => 1,
                        ),
                        array(
                            'name' => 'Text',
                            'id' => 'text_list',
                            'type' => 'wysiwyg',
                        )
                    ),
                ),
                array(
                    'name' => 'Container Green',
                    'id' => 'cont_des_add',
                    'type' => 'wysiwyg',
                ),
                array(
                    'name' => 'Icon',
                    'id' => 'img-icon',
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                ),
                array(
                    'name' => 'Content',
                    'id' => 'cont_des_add_2',
                    'type' => 'wysiwyg',
                )
        ));
    }

    if ($post_name == 'dashboard') {
        $meta_box[] = array(
            'id' => 'info_add_dashboard',
            'title' => 'Buttons',
            'pages' => array('page'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'id' => 'button-options',
                    'type' => 'group',
                    'clone' => true,
                    'hidden' => array('post_format', 'aside'),
                    'fields' => array(
                        array(
                            'name' => 'Image',
                            'id' => "btn-object-img",
                            'type' => 'image_advanced',
                            'max_file_uploads' => 1,
                        ),
                        array(
                            'name' => 'Line One',
                            'id' => 'text_line_one',
                            'type' => 'text',
                        ),
                        array(
                            'name' => 'Line Two',
                            'id' => 'text_line_two',
                            'type' => 'text',
                        ),
                        array(
                            'id' => 'option_to_show',
                            'name' => 'Option of button',
                            'desc' => 'Pick Your option',
                            'type' => 'select',
                            'options' => array(
                                'Page' => 'Page',
                                'Popup' => 'Popup',
                            )
                        ),
                        array(
                            'name' => 'URL',
                            'id' => 'url_btn_dashboard',
                            'type' => 'text',
                            'hidden' => array('option_to_show', '!=', 'Page')
                        ),
                        array(
                            'id' => 'visibility_option',
                            'name' => 'Open in new window?',
                            'type' => 'checkbox',
                            'hidden' => array('option_to_show', '!=', 'Page')
                        ),
                        array(
                            'id' => 'hide_option',
                            'name' => 'Hide box',
                            'type' => 'checkbox',
                            'hidden' => array('option_to_show', '!=', 'Page')
                        ),
                        array(
                            'id' => 'action_to_take',
                            'name' => 'What action are you going to take?',
                            'type' => 'radio',
                            'options' => array(
                                'Video' => 'Video Embed (Popup)',
                                'Map' => 'Google Map Embed (Popup)',
                                'Code' => 'Code Embed (Popup)',
                                'Form' => 'Form'
                            ),
                            'hidden' => array('option_to_show', '!=', 'Popup')
                        ),
                        array(
                            'id' => 'video_embed',
                            'name' => 'URL of video (Youtube, vimeo, ... )',
                            'type' => 'textarea',
                            'hidden' => array('action_to_take', '!=', 'Video')
                        ),
                        array(
                            'id' => 'map_embed',
                            'name' => 'Embed code of Google Map',
                            'type' => 'textarea',
                            'hidden' => array('action_to_take', '!=', 'Map')
                        ),
                        array(
                            'id' => 'code_embed',
                            'name' => 'Content',
                            'type' => 'wysiwyg',
                            'hidden' => array('action_to_take', '!=', 'Code')
                        ),
                        array(
                            'name' => 'Title Popup',
                            'id' => 'form_embed_title',
                            'type' => 'text',
                            'hidden' => array('action_to_take', '!=', 'Form')
                        ),
                        array(
                            'id' => 'form_embed',
                            'name' => 'Content',
                            'type' => 'text',
                            'hidden' => array('action_to_take', '!=', 'Form')
                        )
                    ),
                ),
        ));
    }

    if (is_array($meta_box)) {
        foreach ($meta_box as $value) {
            new RW_Meta_Box($value);
        }
    }
}

add_action('wp_ajax_rwmb_reorder_images', array("RWMB_Image_Field", 'wp_ajax_reorder_images'));
add_action('wp_ajax_rwmb_delete_file', array("RWMB_File_Field", 'wp_ajax_delete_file'));
add_action('wp_ajax_rwmb_attach_media', array("RWMB_Image_Advanced_Field", 'wp_ajax_attach_media'));
add_action('admin_init', 'rw_register_meta_box');

// Register Custom Post Type
function custom_videos() {

    $labels = array(
        'name' => _x('Videos', 'Post Type General Name', 'jp-basic'),
        'singular_name' => _x('Video', 'Post Type Singular Name', 'jp-basic'),
        'menu_name' => __('Videos', 'jp-basic'),
        'name_admin_bar' => __('Videos', 'jp-basic'),
        'archives' => __('Item Archives', 'jp-basic'),
        'attributes' => __('Item Attributes', 'jp-basic'),
        'parent_item_colon' => __('Parent Item:', 'jp-basic'),
        'all_items' => __('All Items', 'jp-basic'),
        'add_new_item' => __('Add New Item', 'jp-basic'),
        'add_new' => __('Add New', 'jp-basic'),
        'new_item' => __('New Item', 'jp-basic'),
        'edit_item' => __('Edit Item', 'jp-basic'),
        'update_item' => __('Update Item', 'jp-basic'),
        'view_item' => __('View Item', 'jp-basic'),
        'view_items' => __('View Items', 'jp-basic'),
        'search_items' => __('Search Item', 'jp-basic'),
        'not_found' => __('Not found', 'jp-basic'),
        'not_found_in_trash' => __('Not found in Trash', 'jp-basic'),
        'featured_image' => __('Featured Image', 'jp-basic'),
        'set_featured_image' => __('Set featured image', 'jp-basic'),
        'remove_featured_image' => __('Remove featured image', 'jp-basic'),
        'use_featured_image' => __('Use as featured image', 'jp-basic'),
        'insert_into_item' => __('Insert into item', 'jp-basic'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'jp-basic'),
        'items_list' => __('Items list', 'jp-basic'),
        'items_list_navigation' => __('Items list navigation', 'jp-basic'),
        'filter_items_list' => __('Filter items list', 'jp-basic'),
    );
    $args = array(
        'label' => __('Video', 'jp-basic'),
        'description' => __('Videos', 'jp-basic'),
        'labels' => $labels,
        'supports' => array('title', 'editor'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-video-alt3',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    register_post_type('videos', $args);
}

add_action('init', 'custom_videos', 0);
