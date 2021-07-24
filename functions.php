<?php

define( 'SOD_VERSION', rand());

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

// add_shortcode( 'zoho_form', 'zoho_form_func_2' );
function zoho_form_func_2($atts) {
    $a = shortcode_atts( array(
        'form_title' => 'Contact Form',
        'form_description' => '* All fields are required.',
    ), $atts );


    ob_start();
    ?>

    <!-- Note :
   - You can modify the font style and form style to suit your website. 
   - Code lines with comments Do not remove this code are required for the form to work properly, make sure that you do not remove these lines of code.
   - The Mandatory check script can modified as to suit your business needs.
   - It is important that you test the modified form before going live.-->
    <div id='crmWebToEntityForm' class='zcwf_lblLeft crmWebToEntityForm' style='color: black;max-width: 1140px;'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <META HTTP-EQUIV ='content-type' CONTENT='text/html;charset=UTF-8'>
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
    <form action='https://crm.zoho.com/crm/WebToLeadForm' name=WebToLeads4805080000000479003 method='POST' onSubmit='javascript:document.charset="UTF-8"; return checkMandatory4805080000000479003()' accept-charset='UTF-8'>
    <input type='text' style='display:none;' name='xnQsjsdp' value='3dd075b2ab7a579bc9febfdb0d5acfc42a540e22ad64e3675afda1b0e7b6d786'></input>
    <input type='hidden' name='zc_gad' id='zc_gad' value=''></input> 
    <input type='text' style='display:none;' name='xmIwtLD' value='6f017a7e93acf78ff892d147c52f3a1dcab65d2c849dbb64d4e62f3559df9ee3'></input>
    <input type='text'  style='display:none;' name='actionType' value='TGVhZHM='></input>
    <input type='text' style='display:none;' name='returnURL' value='https&#x3a;&#x2f;&#x2f;flexdecks.com&#x2f;' > </input>
    <!-- Do not remove this code. -->
    <input type='text' style='display:none;' id='ldeskuid' name='ldeskuid'></input>
    <input type='text' style='display:none;' id='LDTuvid' name='LDTuvid'></input>
    <!-- Do not remove this code. -->
    <style>
    html,body{
    margin: 0px;
    }
    #crmWebToEntityForm.zcwf_lblLeft {
    width:100%;
    padding: 45px 15px;
    margin: 0 auto;
    box-sizing: border-box;
    }
    #crmWebToEntityForm.zcwf_lblLeft * {
    box-sizing: border-box;
    }
    #crmWebToEntityForm{text-align: left;}
    #crmWebToEntityForm * {
    direction: ltr;
    }
    .zcwf_lblLeft .zcwf_title {
        word-wrap: break-word;
        padding: 0px 6px 10px;
        font-weight: bold;
        font-size: 22px;
        text-align: left;
        text-transform: none;
    }

    .zcwf_lblLeft .zcwf_description {
        word-wrap: break-word;
        padding: 0px 6px 10px;
        font-size: 18px;
        text-align: left;
        text-transform: none;
    }

    .zcwf_lblLeft .zcwf_col_fld input[type=text], .zcwf_lblLeft .zcwf_col_fld textarea {
        width: 100%;
        border: 1px solid #fff;
        background: #384554;
        border-radius: 0;
        padding: 5px 15px;
        margin-bottom: 20px;
        color: #fff;
    }

    .zcwf_lblLeft .zcwf_col_lab {
        font-size: 18px;
        font-weight: 500;
        margin-bottom: 15px;
        display: inline-block;
        color: #fff;
    }

    .zcwf_lblLeft .zcwf_col_fld {
        float: left;
        width: 100%;        
        position: relative;
        margin-top: 10px;
    }

    .zcwf_lblLeft .zcwf_col_fld .zcwf_button {
        border-radius: 0;
    }

    .zcwf_lblLeft .zcwf_privacy{padding: 6px;}
    .zcwf_lblLeft .wfrm_fld_dpNn{display: none;}
    .dIB{display: inline-block;}
    .zcwf_lblLeft .zcwf_col_fld_slt {
    width: 60%;
    border: 1px solid #ccc;
    background: #fff;
    border-radius: 4px;
    font-size: 12px;
    float: left;
    resize: vertical;
    }
    .zcwf_lblLeft .zcwf_row:after, .zcwf_lblLeft .zcwf_col_fld:after {
    content: '';
    display: table;
    clear: both;
    }
    .zcwf_lblLeft .zcwf_col_help {
    float: left;
    margin-left: 7px;
    font-size: 12px;
    max-width: 35%;
    word-break: break-word;
    }
    .zcwf_lblLeft .zcwf_help_icon {
    cursor: pointer;
    width: 16px;
    height: 16px;
    display: inline-block;
    background: #fff;
    border: 1px solid #ccc;
    color: #ccc;
    text-align: center;
    font-size: 11px;
    line-height: 16px;
    font-weight: bold;
    border-radius: 50%;
    }
    .zcwf_lblLeft .zcwf_row {
        /*margin: 15px 0px;*/
    }
    .zcwf_lblLeft .formsubmit {
   
    }
    .zcwf_lblLeft .zcwf_privacy_txt {
    color: rgb(0, 0, 0);
    font-size: 12px;
    font-family: Arial;
    display: inline-block;
    vertical-align: top;
    color: #333;
    padding-top: 2px;
    margin-left: 6px;
    }
    .zcwf_lblLeft .zcwf_button + .zcwf_button {
        margin-left: 10px;
    }
    .zcwf_lblLeft .zcwf_tooltip_over{
    position: relative;
    }
    .zcwf_lblLeft .zcwf_tooltip_ctn{
    position: absolute;
    background: #dedede;
    padding: 3px 6px;
    top: 3px;
    border-radius: 4px;word-break: break-all;
    min-width: 50px;
    max-width: 150px;
    color: #333;
    }
    .zcwf_lblLeft .zcwf_ckbox{
    float: left;
    }
    .zcwf_lblLeft .zcwf_file{
    width: 55%;
    box-sizing: border-box;
    float: left;
    }
    .clearB:after{
    content:'';
    display: block;
    clear: both;
    }

    .zcwf_col_lab span {
        color: #fff!important;
        margin-left: 10px;
    }

    @media all and (max-width: 600px) {
    .zcwf_lblLeft .zcwf_col_lab, .zcwf_lblLeft .zcwf_col_fld {
    width: auto;
    float: none !important;
    }
    .zcwf_lblLeft .zcwf_col_help {width: 40%;}
    }
    </style>
    
    <?php if (!empty($a['form_title'])): ?>
    <div class='zcwf_title' style='max-width: 600px;color: black;'><?php echo $a['form_title']; ?></div>
    <?php endif; ?>
    <?php if (!empty($a['form_description'])): ?>
    <div class='zcwf_description' style='max-width: 600px;color: black; font-style: italic;'><?php echo $a['form_description']; ?></div>
    <?php endif; ?>
    <div class='zcwf_row'>
        <div class='zcwf_col_lab' style=''>
            <label for='Company'>Company<span style='color:red;'>*</span></label>
        </div>
        <div class='zcwf_col_fld'>
            <input type='text' id='Company' name='Company' maxlength='100' placeholder=""></input>
            <div class='zcwf_col_help'></div>
        </div>
    </div>
    <div class='zcwf_row'>
        <div class='zcwf_col_lab' style=''>
            <label for='First_Name'>First Name<span style='color:red;'>*</span></label>
        </div>
        <div class='zcwf_col_fld'>
            <input type='text' id='First_Name' name='First Name' maxlength='40' placeholder=""></input>
            <div class='zcwf_col_help'></div>
        </div>
    </div>
    <div class='zcwf_row'>
        <div class='zcwf_col_lab' style=''>
            <label for='Last_Name'>Last Name<span style='color:red;'>*</span></label>
        </div>
        <div class='zcwf_col_fld'>
            <input type='text' id='Last_Name' name='Last Name' maxlength='80' placeholder=""></input>
            <div class='zcwf_col_help'></div>
        </div>
    </div>
    <div class='zcwf_row'>
        <div class='zcwf_col_lab' style=''>
            <label for='Phone'>Phone</label>
        </div>
        <div class='zcwf_col_fld'>
            <input type='text' id='Phone' name='Phone' maxlength='30' placeholder=""></input>
            <div class='zcwf_col_help'></div>
        </div>
    </div>

    <div class='zcwf_row wfrm_fld_dpNn'><div class='zcwf_col_lab'><label for='Lead_Source'>Lead Source</label></div><div class='zcwf_col_fld'><select class='zcwf_col_fld_slt' id='Lead_Source' name='Lead Source'  >
    <option value='-None-'>-None-</option>
    <option value='Advertisement'>Advertisement</option>
    <option value='Cold&#x20;Call'>Cold Call</option>
    <option value='Employee&#x20;Referral'>Employee Referral</option>
    <option value='External&#x20;Referral'>External Referral</option>
    <option value='Online&#x20;Store'>Online Store</option>
    <option value='Twitter'>Twitter</option>
    <option value='Facebook'>Facebook</option>
    <option value='Partner'>Partner</option>
    <option value='Google&#x2b;'>Google&#x2b;</option>
    <option value='Public&#x20;Relations'>Public Relations</option>
    <option value='Sales&#x20;Email&#x20;Alias'>Sales Email Alias</option>
    <option value='Seminar&#x20;Partner'>Seminar Partner</option>
    <option value='Internal&#x20;Seminar'>Internal Seminar</option>
    <option value='Trade&#x20;Show'>Trade Show</option>
    <option value='Web&#x20;Download'>Web Download</option>
    <option value='Web&#x20;Research'>Web Research</option>
    <option value='Chat'>Chat</option>
    <option selected value='Web&#x20;Form&#x20;Contact&#x20;Us'>Web Form Contact Us</option>
    </select><div class='zcwf_col_help'></div></div></div>

    <div class='zcwf_row'>
        <div class='zcwf_col_lab'>
            <label for='Email'>Email<span style='color:red;'>*</span></label>
        </div>
        <div class='zcwf_col_fld'>
            <input type='text' ftype='email' id='Email' name='Email' maxlength='100' placeholder=""></input>
            <div class='zcwf_col_help'></div>
        </div>
    </div>

    <div class='zcwf_row'>
        <div class='zcwf_col_lab'>
            <label for='Description'>Your Question<span style='color:red;'>*</span></label>
        </div>
        <div class='zcwf_col_fld'>
            <textarea id='Description' name='Description' placeholder=""></textarea>
            <div class='zcwf_col_help'></div>
        </div>
    </div>

    <div class='zcwf_row'> <div class='zcwf_col_lab'></div><div class='zcwf_col_fld'><div class='g-recaptcha' data-sitekey='6LfaXscaAAAAALOPlqP93nxWmQbFBIjTbXG3wuIC' data-theme='light' data-callback='rccallback4805080000000479003' captcha-verified='false' id='recap4805080000000479003'></div><div  id='recapErr4805080000000479003' style='font-size:12px;color:red;visibility:hidden;display:none'>Captcha validation failed. If you are not a robot then please try again.</div></div></div><div class='zcwf_row' style="margin-top: 20px;"><div class='zcwf_col_lab'></div><div class='zcwf_col_fld'><input type='submit' id='formsubmit' class='formsubmit zcwf_button s-btn s-normal' value='Submit' title='Submit'><input type='reset' class='zcwf_button s-btn s-normal' name='reset' value='Reset' title='Reset'></div></div>
    <script>

    /* Do not remove this code. */
    function rccallback4805080000000479003()
    {
    if(document.getElementById('recap4805080000000479003')!=undefined){
    document.getElementById('recap4805080000000479003').setAttribute('captcha-verified',true);
    }
    if(document.getElementById('recapErr4805080000000479003')!=undefined && document.getElementById('recapErr4805080000000479003').style.visibility == 'visible' ){
      document.getElementById('recapErr4805080000000479003').style.visibility='hidden';
      document.getElementById('recapErr4805080000000479003').style.display='none';
    }
    }
    function reCaptchaAlert4805080000000479003()
    {
    var recap = document.getElementById('recap4805080000000479003');
    if( recap !=undefined && recap.getAttribute('captcha-verified') == 'false')
    {
      document.getElementById('recapErr4805080000000479003').style.visibility='visible';
      document.getElementById('recapErr4805080000000479003').style.display='block';
    return false;
    }
    return true;
    }
    function validateEmail4805080000000479003()
    {
    var form = document.forms['WebToLeads4805080000000479003'];
    var emailFld = form.querySelectorAll('[ftype=email]');
    var i;
    for (i = 0; i < emailFld.length; i++)
    {
    var emailVal = emailFld[i].value;
    if((emailVal.replace(/^\s+|\s+$/g, '')).length!=0 )
    {
    var atpos=emailVal.indexOf('@');
    var dotpos=emailVal.lastIndexOf('.');
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=emailVal.length)
    {
    alert('Please enter a valid email address. ');
    emailFld[i].focus();
    return false;
    }
    }
    }
    return true;
    }

    function checkMandatory4805080000000479003() {
    var mndFileds = new Array('Company','Email','Description');
    var fldLangVal = new Array('Company','Email','Your\x20Question');
    for(i=0;i<mndFileds.length;i++) {
    var fieldObj=document.forms['WebToLeads4805080000000479003'][mndFileds[i]];
    if(fieldObj) {
    if (((fieldObj.value).replace(/^\s+|\s+$/g, '')).length==0) {
    if(fieldObj.type =='file')
    { 
    alert('Please select a file to upload.'); 
    fieldObj.focus(); 
    return false;
    } 
    alert(fldLangVal[i] +' cannot be empty.'); 
            fieldObj.focus();
            return false;
    }  else if(fieldObj.nodeName=='SELECT') {
        if(fieldObj.options[fieldObj.selectedIndex].value=='-None-') {
    alert(fldLangVal[i] +' cannot be none.'); 
    fieldObj.focus();
    return false;
    }
    } else if(fieldObj.type =='checkbox'){
    if(fieldObj.checked == false){
    alert('Please accept  '+fldLangVal[i]);
    fieldObj.focus();
    return false;
    } 
    } 
    try {
        if(fieldObj.name == 'Last Name') {
    name = fieldObj.value;
        }
    } catch (e) {}
    }
    }
    trackVisitor();
    if(!validateEmail4805080000000479003()){return false;}
    if(!reCaptchaAlert4805080000000479003()){return false;}
    document.querySelector('.crmWebToEntityForm .formsubmit').setAttribute('disabled', true);
    }

    function tooltipShow4805080000000479003(el){
    var tooltip = el.nextElementSibling;
    var tooltipDisplay = tooltip.style.display;
    if(tooltipDisplay == 'none'){
    var allTooltip = document.getElementsByClassName('zcwf_tooltip_over');
    for(i=0; i<allTooltip.length; i++){
    allTooltip[i].style.display='none';
    }
    tooltip.style.display = 'block';
    }else{
    tooltip.style.display='none';
    }
    }
    </script><script type='text/javascript' id='VisitorTracking'>var $zoho= $zoho || {};$zoho.salesiq = $zoho.salesiq || {widgetcode:'5f09baca57a83065cf4d63a1379d04b275bdc00ebb03b958e4e80983e86119c3', values:{},ready:function(){$zoho.salesiq.floatbutton.visible('hide');}};var d=document;s=d.createElement('script');s.type='text/javascript';s.id='zsiqscript';s.defer=true;s.src='https://salesiq.zoho.com/widget';t=d.getElementsByTagName('script')[0];t.parentNode.insertBefore(s,t);function trackVisitor(){try{if($zoho){var LDTuvidObj = document.forms['WebToLeads4805080000000479003']['LDTuvid'];if(LDTuvidObj){LDTuvidObj.value = $zoho.salesiq.visitor.uniqueid();}var firstnameObj = document.forms['WebToLeads4805080000000479003']['First Name'];if(firstnameObj){name = firstnameObj.value +' '+name;}$zoho.salesiq.visitor.name(name);var emailObj = document.forms['WebToLeads4805080000000479003']['Email'];if(emailObj){email = emailObj.value;$zoho.salesiq.visitor.email(email);}}} catch(e){}}</script>
    <!-- Do not remove this --- Analytics Tracking code starts --><script id='wf_anal' src='https://crm.zohopublic.com/crm/WebFormAnalyticsServeServlet?rid=6f017a7e93acf78ff892d147c52f3a1dcab65d2c849dbb64d4e62f3559df9ee3gid3dd075b2ab7a579bc9febfdb0d5acfc42a540e22ad64e3675afda1b0e7b6d786gid885e3c1045bd9bdcc91bdf30f82b5696gid14f4ec16431e0686150daa43f3210513'></script><!-- Do not remove this --- Analytics Tracking code ends. --></form>
    </div>

    <?php
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}


add_shortcode( 'zoho_form', 'zoho_form_func_3' );
function zoho_form_func_3($atts) {
    $a = shortcode_atts( array(
        'form_title' => 'Contact Form',
        'form_description' => '* All fields are required.',
    ), $atts );


    ob_start();
    ?>
<!-- Note :
   - You can modify the font style and form style to suit your website. 
   - Code lines with comments Do not remove this code are required for the form to work properly, make sure that you do not remove these lines of code.
   - The Mandatory check script can modified as to suit your business needs.
   - It is important that you test the modified form before going live.-->
   <div id='crmWebToEntityForm' class='zcwf_lblLeft crmWebToEntityForm' style='background-color: white;color: black;max-width: 600px;'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
   <META HTTP-EQUIV ='content-type' CONTENT='text/html;charset=UTF-8'>
   <script src='https://www.google.com/recaptcha/api.js' async defer></script>
<form action='https://crm.zoho.com/crm/WebToLeadForm' name=WebToLeads4805080000000479003 method='POST' onSubmit='javascript:document.charset="UTF-8"; return checkMandatory4805080000000479003()' accept-charset='UTF-8'>
 <input type='text' style='display:none;' name='xnQsjsdp' value='3dd075b2ab7a579bc9febfdb0d5acfc42a540e22ad64e3675afda1b0e7b6d786'></input>
 <input type='hidden' name='zc_gad' id='zc_gad' value=''></input> 
 <input type='text' style='display:none;' name='xmIwtLD' value='6f017a7e93acf78ff892d147c52f3a1dcab65d2c849dbb64d4e62f3559df9ee3'></input>
 <input type='text'  style='display:none;' name='actionType' value='TGVhZHM='></input>
 <input type='text' style='display:none;' name='returnURL' value='https&#x3a;&#x2f;&#x2f;flexdecks.com&#x2f;' > </input>
<!-- Do not remove this code. -->
<input type='text' style='display:none;' id='ldeskuid' name='ldeskuid'></input>
<input type='text' style='display:none;' id='LDTuvid' name='LDTuvid'></input>
<!-- Do not remove this code. -->
<style>
html,body{
margin: 0px;
}
#crmWebToEntityForm.zcwf_lblLeft {
width:100%;
padding: 25px;
margin: 0 auto;
box-sizing: border-box;
}
#crmWebToEntityForm.zcwf_lblLeft * {
box-sizing: border-box;
}
#crmWebToEntityForm{text-align: left;}
#crmWebToEntityForm * {
direction: ltr;
}
.zcwf_lblLeft .zcwf_title {
word-wrap: break-word;
padding: 0px 6px 10px;
font-weight: bold;
}
.zcwf_lblLeft .zcwf_col_fld input[type=text], .zcwf_lblLeft .zcwf_col_fld textarea {
width: 60%;
border: 1px solid #ccc !important;
resize: vertical;
border-radius: 2px;
float: left;
}
.zcwf_lblLeft .zcwf_col_lab {
width: 30%;
word-break: break-word;
padding: 0px 6px 0px;
margin-right: 10px;
margin-top: 5px;
float: left;
min-height: 1px;
}
.zcwf_lblLeft .zcwf_col_fld {
float: left;
width: 68%;
padding: 0px 6px 0px;
position: relative;
margin-top: 5px;
}
.zcwf_lblLeft .zcwf_privacy{padding: 6px;}
.zcwf_lblLeft .wfrm_fld_dpNn{display: none;}
.dIB{display: inline-block;}
.zcwf_lblLeft .zcwf_col_fld_slt {
width: 60%;
border: 1px solid #ccc;
background: #fff;
border-radius: 4px;
font-size: 14px;
float: left;
resize: vertical;
}
.zcwf_lblLeft .zcwf_row:after, .zcwf_lblLeft .zcwf_col_fld:after {
content: '';
display: table;
clear: both;
}
.zcwf_lblLeft .zcwf_col_help {
float: left;
margin-left: 7px;
font-size: 14px;
max-width: 35%;
word-break: break-word;
}
.zcwf_lblLeft .zcwf_help_icon {
cursor: pointer;
width: 16px;
height: 16px;
display: inline-block;
background: #fff;
border: 1px solid #ccc;
color: #ccc;
text-align: center;
font-size: 11px;
line-height: 16px;
font-weight: bold;
border-radius: 50%;
}
.zcwf_lblLeft .zcwf_row {margin: 15px 0px;}
.zcwf_lblLeft .formsubmit {
margin-right: 5px;
cursor: pointer;
color: #333;
font-size: 14px;
}
.zcwf_lblLeft .zcwf_privacy_txt {
color: rgb(0, 0, 0);
font-size: 14px;
font-family: Calibri;
display: inline-block;
vertical-align: top;
color: #333;
padding-top: 2px;
margin-left: 6px;
}
.zcwf_lblLeft .zcwf_button {
font-size: 14px;
color: #333;
border: 1px solid #ccc;
padding: 3px 9px;
border-radius: 4px;
cursor: pointer;
max-width: 120px;
overflow: hidden;
text-overflow: ellipsis;
white-space: nowrap;
}
.zcwf_lblLeft .zcwf_tooltip_over{
position: relative;
}
.zcwf_lblLeft .zcwf_tooltip_ctn{
position: absolute;
background: #dedede;
padding: 3px 6px;
top: 3px;
border-radius: 4px;word-break: break-all;
min-width: 50px;
max-width: 150px;
color: #333;
}
.zcwf_lblLeft .zcwf_ckbox{
float: left;
}
.zcwf_lblLeft .zcwf_file{
width: 55%;
box-sizing: border-box;
float: left;
}
.clearB:after{
content:'';
display: block;
clear: both;
}
@media all and (max-width: 600px) {
.zcwf_lblLeft .zcwf_col_lab, .zcwf_lblLeft .zcwf_col_fld {
width: auto;
float: none !important;
}
.zcwf_lblLeft .zcwf_col_help {width: 40%;}
}
</style>
<div class='zcwf_title' style='max-width: 600px;color: black;'>Contact Us</div>
<div class='zcwf_row'><div class='zcwf_col_lab' style='font-size:14px; font-family: Calibri;'><label for='Company'>Company<span style='color:red;'>*</span></label></div><div class='zcwf_col_fld'><input type='text' id='Company' name='Company' maxlength='100'></input><div class='zcwf_col_help'></div></div></div>
<div class='zcwf_row'><div class='zcwf_col_lab' style='font-size:14px; font-family: Calibri;'><label for='First_Name'>First Name<span style='color:red;'>*</span></label></div><div class='zcwf_col_fld'><input type='text' id='First_Name' name='First Name' maxlength='40'></input><div class='zcwf_col_help'></div></div></div>
<div class='zcwf_row'><div class='zcwf_col_lab' style='font-size:14px; font-family: Calibri;'><label for='Last_Name'>Last Name<span style='color:red;'>*</span></label></div><div class='zcwf_col_fld'><input type='text' id='Last_Name' name='Last Name' maxlength='80'></input><div class='zcwf_col_help'></div></div></div>
<div class='zcwf_row'><div class='zcwf_col_lab' style='font-size:14px; font-family: Calibri;'><label for='Phone'>Phone</label></div><div class='zcwf_col_fld'><input type='text' id='Phone' name='Phone' maxlength='30'></input><div class='zcwf_col_help'></div></div></div>
<div class='zcwf_row wfrm_fld_dpNn'><div class='zcwf_col_lab' style='font-size:14px; font-family: Calibri;'><label for='Lead_Source'>Lead Source</label></div><div class='zcwf_col_fld'><select class='zcwf_col_fld_slt' id='Lead_Source' name='Lead Source'  >
<option value='-None-'>-None-</option>
<option value='Chat'>Chat</option>
<option value='Cold&#x20;Call'>Cold Call</option>
<option value='Email&#x20;Campaign'>Email Campaign</option>
<option value='Employee&#x20;Referral'>Employee Referral</option>
<option value='Facebook'>Facebook</option>
<option value='Federal&#x20;Compass'>Federal Compass</option>
<option value='Google&#x20;Ad'>Google Ad</option>
<option value='Kee&#x20;Safety&#x20;Partner'>Kee Safety Partner</option>
<option value='Linkedin'>Linkedin</option>
<option value='Referral'>Referral</option>
<option value='Research'>Research</option>
<option value='Source&#x20;List'>Source List</option>
<option value='Trade&#x20;Show'>Trade Show</option>
<option value='Twitter'>Twitter</option>
<option selected value='Web&#x20;Form&#x20;Contact&#x20;Us'>Web Form Contact Us</option>
</select><div class='zcwf_col_help'></div></div></div>
<div class='zcwf_row'><div class='zcwf_col_lab' style='font-size:14px; font-family: Calibri;'><label for='Email'>Email<span style='color:red;'>*</span></label></div><div class='zcwf_col_fld'><input type='text' ftype='email' id='Email' name='Email' maxlength='100'></input><div class='zcwf_col_help'></div></div></div>
<div class='zcwf_row'><div class='zcwf_col_lab' style='font-size:14px; font-family: Calibri;'><label for='Description'>Your Question<span style='color:red;'>*</span></label></div><div class='zcwf_col_fld'><textarea id='Description' name='Description'></textarea><div class='zcwf_col_help'></div></div></div><div class='zcwf_row'> <div class='zcwf_col_lab'></div><div class='zcwf_col_fld'><div class='g-recaptcha' data-sitekey='6LfaXscaAAAAALOPlqP93nxWmQbFBIjTbXG3wuIC' data-theme='light' data-callback='rccallback4805080000000479003' captcha-verified='false' id='recap4805080000000479003'></div><div  id='recapErr4805080000000479003' style='font-size:12px;color:red;visibility:hidden;'>Captcha validation failed. If you are not a robot then please try again.</div></div></div><div class='zcwf_row'><div class='zcwf_col_lab'></div><div class='zcwf_col_fld'><input type='submit' id='formsubmit' class='formsubmit zcwf_button' value='Submit' title='Submit'><input type='reset' class='zcwf_button' name='reset' value='Reset' title='Reset'></div></div>
<script>

  /* Do not remove this code. */
  function rccallback4805080000000479003()
{
if(document.getElementById('recap4805080000000479003')!=undefined){
document.getElementById('recap4805080000000479003').setAttribute('captcha-verified',true);
}
if(document.getElementById('recapErr4805080000000479003')!=undefined && document.getElementById('recapErr4805080000000479003').style.visibility == 'visible' ){
document.getElementById('recapErr4805080000000479003').style.visibility='hidden';
}
}
function reCaptchaAlert4805080000000479003()
{
var recap = document.getElementById('recap4805080000000479003');
if( recap !=undefined && recap.getAttribute('captcha-verified') == 'false')
{
document.getElementById('recapErr4805080000000479003').style.visibility='visible';
return false;
}
return true;
}
function validateEmail4805080000000479003()
{
var form = document.forms['WebToLeads4805080000000479003'];
var emailFld = form.querySelectorAll('[ftype=email]');
var i;
for (i = 0; i < emailFld.length; i++)
{
var emailVal = emailFld[i].value;
if((emailVal.replace(/^\s+|\s+$/g, '')).length!=0 )
{
var atpos=emailVal.indexOf('@');
var dotpos=emailVal.lastIndexOf('.');
if (atpos<1 || dotpos<atpos+2 || dotpos+2>=emailVal.length)
{
alert('Please enter a valid email address. ');
emailFld[i].focus();
return false;
}
}
}
return true;
}

   function checkMandatory4805080000000479003() {
var mndFileds = new Array('Company','First Name','Last Name','Email','Description');
var fldLangVal = new Array('Company','First\x20Name','Last\x20Name','Email','Your\x20Question');
for(i=0;i<mndFileds.length;i++) {
 var fieldObj=document.forms['WebToLeads4805080000000479003'][mndFileds[i]];
 if(fieldObj) {
if (((fieldObj.value).replace(/^\s+|\s+$/g, '')).length==0) {
if(fieldObj.type =='file')
{ 
alert('Please select a file to upload.'); 
fieldObj.focus(); 
return false;
} 
alert(fldLangVal[i] +' cannot be empty.'); 
         fieldObj.focus();
         return false;
}  else if(fieldObj.nodeName=='SELECT') {
      if(fieldObj.options[fieldObj.selectedIndex].value=='-None-') {
alert(fldLangVal[i] +' cannot be none.'); 
fieldObj.focus();
return false;
  }
} else if(fieldObj.type =='checkbox'){
  if(fieldObj.checked == false){
alert('Please accept  '+fldLangVal[i]);
fieldObj.focus();
return false;
  } 
} 
try {
    if(fieldObj.name == 'Last Name') {
name = fieldObj.value;
     }
} catch (e) {}
   }
}
trackVisitor();
if(!validateEmail4805080000000479003()){return false;}
if(!reCaptchaAlert4805080000000479003()){return false;}
document.querySelector('.crmWebToEntityForm .formsubmit').setAttribute('disabled', true);
}

function tooltipShow4805080000000479003(el){
var tooltip = el.nextElementSibling;
var tooltipDisplay = tooltip.style.display;
if(tooltipDisplay == 'none'){
var allTooltip = document.getElementsByClassName('zcwf_tooltip_over');
for(i=0; i<allTooltip.length; i++){
allTooltip[i].style.display='none';
}
tooltip.style.display = 'block';
}else{
tooltip.style.display='none';
}
}
</script><script type='text/javascript' id='VisitorTracking'>var $zoho= $zoho || {};$zoho.salesiq = $zoho.salesiq || {widgetcode:'5f09baca57a83065cf4d63a1379d04b275bdc00ebb03b958e4e80983e86119c3', values:{},ready:function(){}};var d=document;s=d.createElement('script');s.type='text/javascript';s.id='zsiqscript';s.defer=true;s.src='https://salesiq.zoho.com/widget';t=d.getElementsByTagName('script')[0];t.parentNode.insertBefore(s,t);function trackVisitor(){try{if($zoho){var LDTuvidObj = document.forms['WebToLeads4805080000000479003']['LDTuvid'];if(LDTuvidObj){LDTuvidObj.value = $zoho.salesiq.visitor.uniqueid();}var firstnameObj = document.forms['WebToLeads4805080000000479003']['First Name'];if(firstnameObj){name = firstnameObj.value +' '+name;}$zoho.salesiq.visitor.name(name);var emailObj = document.forms['WebToLeads4805080000000479003']['Email'];if(emailObj){email = emailObj.value;$zoho.salesiq.visitor.email(email);}}} catch(e){}}</script>
<!-- Do not remove this --- Analytics Tracking code starts --><script id='wf_anal' src='https://crm.zohopublic.com/crm/WebFormAnalyticsServeServlet?rid=6f017a7e93acf78ff892d147c52f3a1dcab65d2c849dbb64d4e62f3559df9ee3gid3dd075b2ab7a579bc9febfdb0d5acfc42a540e22ad64e3675afda1b0e7b6d786gid885e3c1045bd9bdcc91bdf30f82b5696gid14f4ec16431e0686150daa43f3210513'></script><!-- Do not remove this --- Analytics Tracking code ends. --></form>
</div>

    <?php
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}