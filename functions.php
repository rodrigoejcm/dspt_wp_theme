<?php
    add_action( 'wp_enqueue_scripts', 'child_enqueue_styles' );
    function child_enqueue_styles() {
        wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
        wp_enqueue_style( 'style-event', get_stylesheet_directory_uri() . '/css/event.css',false,'1.1','all');
    }


    
    function event_files(){
        if( is_page('eventos') )
        {
            wp_enqueue_style( 'style-timeline', get_stylesheet_directory_uri() . '/css/event.css',false,'1.1','all');
        }
    }
    add_action( 'wp_enqueue_scripts', 'event_files' );
    
    
    function timeline_files(){
        if( is_page('timeline') )
        {
            wp_enqueue_style( 'style-timeline', get_stylesheet_directory_uri() . '/css/style.css',false,'1.1','all');
            wp_enqueue_script( 'script-scroll', 'https://cdn.jsdelivr.net/scrollreveal.js/3.3.1/scrollreveal.min.js', array ( 'jquery' ), 1.1, true);
            wp_enqueue_script( 'script-tabletop', get_stylesheet_directory_uri() . '/js/tabletop.js', false, 1.1, true);
            wp_enqueue_script( 'script-sheets', get_stylesheet_directory_uri() . '/js/sheets.js', array ( 'script-tabletop' ), 1.1, true);
            wp_enqueue_script( 'script-timeline', get_stylesheet_directory_uri() . '/js/index.js', array ( 'script-sheets' ), 1.1, true);
        }
    }
    add_action( 'wp_enqueue_scripts', 'timeline_files' );



    function companiespost_files(){
        if( is_post_type_archive('companies')  )
        {
            wp_enqueue_style( 'style-companies', get_stylesheet_directory_uri() . '/css/cmpny_courses.css',false,'1.1','all');
            wp_enqueue_script( 'script-lodash', 'https://cdnjs.cloudflare.com/ajax/libs/lodash.js/2.4.1/lodash.min.js',false, 1.1, true);
            wp_enqueue_script( 'script-list', 'https://cdnjs.cloudflare.com/ajax/libs/list.js/1.1.1/list.min.js' , false, 1.1, true);
            wp_enqueue_script( 'script-list-paginations', 'https://cdnjs.cloudflare.com/ajax/libs/list.pagination.js/0.1.1/list.pagination.min.js' , array ( 'script-list' ), 1.1, true);
            wp_enqueue_script( 'script-companies', get_stylesheet_directory_uri() . '/js/companies.js', array ( 'script-list','script-list-paginations','script-lodash' ), 1.1, true);
        }
    }
    add_action( 'wp_enqueue_scripts', 'companiespost_files' );

    function coursepost_files(){
        if( is_post_type_archive('ds_courses')  )
        {
            wp_enqueue_style( 'style-companies', get_stylesheet_directory_uri() . '/css/cmpny_courses.css',false,'1.1','all');
            wp_enqueue_script( 'script-lodash', 'https://cdnjs.cloudflare.com/ajax/libs/lodash.js/2.4.1/lodash.min.js',false, 1.1, true);
            wp_enqueue_script( 'script-list', 'https://cdnjs.cloudflare.com/ajax/libs/list.js/1.1.1/list.min.js' , false, 1.1, true);
            wp_enqueue_script( 'script-list-paginations', 'https://cdnjs.cloudflare.com/ajax/libs/list.pagination.js/0.1.1/list.pagination.min.js' , array ( 'script-list' ), 1.1, true);
            wp_enqueue_script( 'script-courses', get_stylesheet_directory_uri() . '/js/courses.js', array ( 'script-list','script-list-paginations','script-lodash' ), 1.1, true);
        }
    }
    add_action( 'wp_enqueue_scripts', 'coursepost_files' );


    function post_per_page( $query ) {
    
        if ( is_post_type_archive('companies') || is_post_type_archive('ds_courses') ) {
            $query->set( 'posts_per_page', 50 );
            return;
        }
    }
    add_action( 'pre_get_posts', 'post_per_page', 1 );

    /* to support displaying custom post types */

    add_theme_support(‘add_avia_builder_post_type_option’);
    add_theme_support(‘avia_template_builder_custom_post_type_grid’);

    
    function avia_include_shortcode_template($paths)
        {
            $template_url = get_stylesheet_directory();
            array_unshift($paths, $template_url.'/avia-shortcodes/');

            return $paths;
        }
        add_filter('avia_load_shortcodes', 'avia_include_shortcode_template', 15, 1);

    
    
?>