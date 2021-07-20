<?php

define( 'SOD_VERSION', "1.0.1");

function sod_scripts() {
    wp_register_style( 'adobe-font', 'https://use.typekit.net/prg2xec.css', array(), SOD_VERSION );
    wp_enqueue_style( 'adobe-font' );

    wp_register_style( 'sod-style', get_stylesheet_directory_uri() . '/dist/css/app.css', array(), SOD_VERSION );
    wp_enqueue_style( 'sod-style');

    wp_deregister_style('_s-style');

    // wp_register_script('sod-slick', get_stylesheet_directory_uri() .'/node_modules/slick-carousel/slick/slick.min.js', array ('jquery'), SOD_VERSION);
    // wp_enqueue_script( 'sod-slick' );

    wp_register_script('sod-lib', get_stylesheet_directory_uri() .'/vendor/lib.js', array('jquery'), SOD_VERSION);
    wp_enqueue_script( 'sod-lib' );
    
    wp_register_script('sod-script', get_stylesheet_directory_uri() .'/vendor/theme.js', array ('jquery', 'sod-lib'), SOD_VERSION);
    wp_enqueue_script( 'sod-script' );

    
}

add_action( 'wp_enqueue_scripts', 'sod_scripts', 11 );

// function sod_file_types_to_uploads ($file_types) {
//     $new_filetypes = array();
//     $new_filetypes['svg'] = 'image/svg+xml';
//     $file_types = array_merge($file_types, $new_filetypes );
//     return $file_types;
// }

// add_filter( 'upload_mimes', 'sod_file_types_to_uploads ');

add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

    global $wp_version;
    if ( $wp_version !== '4.7.1' ) {
       return $data;
    }
  
    $filetype = wp_check_filetype( $filename, $mimes );
  
    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];
  
  }, 10, 4 );
  
  function sod_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }

add_filter( 'upload_mimes', 'sod_mime_types' );

function sod_register_new_menu() {
    register_nav_menus(
        array(
            'secondary-menu' => __('Secondary', 'Sod')
        )
    );

    // $slug = 'service';

    // register_post_type( 'service',
    //     array(
    //         'labels' => array(
    //             'name' => __( 'Service','sod' ),
    //             'singular_name' => __( 'Service Item','sod' ),
    //             'add_item' => __('New Service Item','sod'),
    //             'add_new_item' => __('Add New Service Item','sod'),
    //             'edit_item' => __('Edit Service Item','sod')
    //         ),
    //         'public' => true,
    //         'has_archive' => true,
    //         'rewrite' => array('slug' => $slug),
    //         'menu_position' => 4,
    //         'show_ui' => true,
    //         'supports' => array('author', 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'comments')
    //     )
    // );

    $slug = 'industry';

    register_post_type( 'industry',
        array(
            'labels' => array(
                'name' => __( 'Industry','qode' ),
                'singular_name' => __( 'Industry Item','qode' ),
                'add_item' => __('New Industry Item','qode'),
                'add_new_item' => __('Add New Industry Item','qode'),
                'edit_item' => __('Edit Industry Item','qode')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => $slug),
            'menu_position' => 4,
            'show_ui' => true,
            'supports' => array('author', 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'comments')
        )
    );

    $slug = 'military';

    register_post_type( 'military',
        array(
            'labels' => array(
                'name' => __( 'Military','qode' ),
                'singular_name' => __( 'Military Item','qode' ),
                'add_item' => __('New Military Item','qode'),
                'add_new_item' => __('Add New Military Item','qode'),
                'edit_item' => __('Edit Military Item','qode')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => $slug),
            'menu_position' => 4,
            'show_ui' => true,
            'supports' => array('author', 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'comments')
        )
    );

    $slug = 'testimonial';
    register_post_type( 'testimonial',
        array(
            'labels' => array(
                'name' => __( 'Testimonial','qode' ),
                'singular_name' => __( 'Testimonial Item','qode' ),
                'add_item' => __('New Testimonial Item','qode'),
                'add_new_item' => __('Add New Testimonial Item','qode'),
                'edit_item' => __('Edit Testimonial Item','qode')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => $slug),
            'menu_position' => 4,
            'show_ui' => true,
            'supports' => array('author', 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'comments')
        )
    );
    
    $labels = array(
        'name' => __( 'Groups', 'qode' ),
        'singular_name' => __( 'Group', 'qode' ),
        'search_items' =>  __( 'Search Groups','qode' ),
        'all_items' => __( 'All Groups','qode' ),
        'parent_item' => __( 'Parent Group','qode' ),
        'parent_item_colon' => __( 'Parent Group:','qode' ),
        'edit_item' => __( 'Edit Group','qode' ), 
        'update_item' => __( 'Update Group','qode' ),
        'add_new_item' => __( 'Add New Group','qode' ),
        'new_item_name' => __( 'New Group Name','qode' ),
        'menu_name' => __( 'Groups','qode' ),
  );
  
    register_taxonomy(
		'group',
		['testimonial'],
		array(
			'labels' => $labels,
			'rewrite' => array( 'slug' => 'group' ),
            'show_ui' => true,
			'hierarchical' => true,
            'show_admin_column' => true
		)
	);
    add_shortcode("testimonial", 'make_testimonial');
}

add_action( 'init', 'sod_register_new_menu');

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
        'menu-slug'     => 'theme-header',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
        'menu-slug'     => 'theme-footer',
		'parent_slug'	=> 'theme-general-settings',
	));
	
}

function sod_generate_image_tag($url, $classes=[]) {
    if ($url) {
        list($width, $height, $type, $attr) = getimagesize($url);
        $className = implode(" ", $classes);
        $placeholder = get_stylesheet_directory_uri() . '/img/transparent.png';
        echo "<img src='$placeholder'  src='$placeholder' width='$width' height='$height' class='lazy $className' data-src='$url' />";
    }

    return ;
}

function make_testimonial ($atts, $contents) {
    extract(
        shortcode_atts(
            array('ids' => '',
            'title' => '')
        , $atts
        ));

    // $post_ids = [];
    // if ($ids) {
    //     $post_ids = explode(",", $ids);    
    // }
    
         
    // exit;
    $html = '';
    $posts = get_posts(
        array(
            "post_type" => "testimonial",            
            'post_status' => "publish",
            'numberposts' => -1    
        )
    );

    if (!empty($posts)) {
        
        $results = [];
        foreach ( $posts as $post ) {
            $pid = $post->ID;
            $rate = get_field("rate", $pid);
            $customer = get_field("customer", $pid );

            if ($customer == $ids):
                $results[] = array(
                    "id" => $pid,
                    "content" => $post->post_content,
                    "caption" => get_field("caption", $pid ),
                    "rate" => $rate,
                    "customer" => $customer,
                );
            endif;
        }

        if (!empty($results)):
            ob_start();
        ?>
        <div class="container image_carousel ">
        <?php
        foreach ( $results as $res ) {
            // setup_postdata($post);
            $pid = $res["id"];
            $rate = $res["rate"];
            $customer = $res["customer"];

            ?>            
            <div class="slide-item testimonial-item">
                <div class="testimonial-content">
               <h3><?php echo $title; ?></h3>
               <q class="quote"><?php echo $res["content"]; ?></q>
               <div class="customers">
                   -<span class="name"><?php echo $customer;?></span>,
                   <span class="caption"><?php echo  $res["caption"];?></span>
                </div>

                <div class="star-rating">
                    <?php for ($i = 0; $i < 5; $i++): 
                        if ($i < $rate) { ?>
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-star <?php echo $className; ?>"><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" class=""></path></svg>
                    <?php } else {
                        ?>                    
                    <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-star "><path d="M528.1 171.5L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6zM388.6 312.3l23.7 138.4L288 385.4l-124.3 65.3 23.7-138.4-100.6-98 139-20.2 62.2-126 62.2 126 139 20.2-100.6 98z" ></path></svg>
                    <?php } ?>
                    <?php endfor; ?>
                </div>
                </div>
            </div>
            <?php
         
            // wp_reset_postdata();
        }   
        ?>
        </div>
        <?php 
        $html = ob_get_clean();
        return $html;
           endif;
        
        return "";

    } else {
        return "";
    }
}

add_filter( 'pre_get_posts', function ($query) {
    if (!$query->is_admin && $query->is_search) {
        $query->set( 'post_type', array( 'post', 'page', 'industry', 'military'));
    }

    return $query;
});

add_action( 'wpcf7_init', function() {
    wpcf7_add_form_tag( 'current_url', 'sod_current_url_form_tag_handler', array( 'name-attr' => true ) );
} );
 
 
function sod_current_url_form_tag_handler( $tag ) { 
    global $wp;
    $name = $tag['name'];    
    if (empty($name)) return '';
    $url = home_url( $wp->request );
    $html = '<input type="hidden" name="' . $name . '" value="' . $url . '" />';
    return $html;
}