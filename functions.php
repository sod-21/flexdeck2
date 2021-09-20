<?php

define( 'SOD_VERSION', '1.0.1');

function sod_scripts() {
    wp_register_style( 'adobe-font', 'https://use.typekit.net/prg2xec.css', array(), SOD_VERSION );
    wp_enqueue_style( 'adobe-font' );

    wp_register_style( 'sod-style', get_stylesheet_directory_uri() . '/dist/css/app.css', array(), SOD_VERSION );
    wp_enqueue_style( 'sod-style');

    wp_deregister_style('_s-style');

    wp_register_script('sod-lib', get_stylesheet_directory_uri() .'/vendor/lib.js', array('jquery'), SOD_VERSION);
    wp_enqueue_script( 'sod-lib' );
    
    wp_register_script('sod-script', get_stylesheet_directory_uri() .'/vendor/theme.js', array ('jquery', 'sod-lib'), SOD_VERSION);
    wp_enqueue_script( 'sod-script' );

    
}

function remove_sod_scripts() {
    if (!is_admin() && !is_page('apply-online')) {
        wp_dequeue_style( 'ufb-jquery-ui' );
        wp_dequeue_style( 'ufb-font-css' );
        wp_dequeue_style( 'ufb-custom-select-css' );
        wp_dequeue_style( 'ufb-front-css' );
        wp_dequeue_style( 'ufb-fileuploader-animation' );
        wp_dequeue_style( 'ufb-fileuploader' );

        wp_dequeue_script( 'ufb-fileuploader' );
        wp_dequeue_script( 'ufb-custom-select-js' );
        wp_dequeue_script( 'ufb-touch-ui' );
        wp_dequeue_script( 'ufb-front-js' );
    }
}

add_action( 'wp_enqueue_scripts', 'sod_scripts', 11 );
add_action( 'wp_enqueue_scripts', 'remove_sod_scripts', 100);

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
        // echo "<img src='$placeholder'  src='$placeholder' width='$width' height='$height' class='lazy $className' data-src='$url' />";
        echo "<img src='$placeholder'  src='$placeholder' width='1' height='1' class='lazy $className' data-src='$url' />";
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
   <div id='crmWebToEntityForm' class='zcwf_lblLeft crmWebToEntityForm' style='max-width: 600px;'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
   <META HTTP-EQUIV ='content-type' CONTENT='text/html;charset=UTF-8'>
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
border-radius: 0;
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
<div class='zcwf_row'><div class='zcwf_col_lab' ><label for='Company'>Company<span  >*</span></label></div><div class='zcwf_col_fld'><input type='text' id='Company' name='Company' maxlength='100'></input><div class='zcwf_col_help'></div></div></div>
<div class='zcwf_row'><div class='zcwf_col_lab' ><label for='First_Name'>First Name<span  >*</span></label></div><div class='zcwf_col_fld'><input type='text' id='First_Name' name='First Name' maxlength='40'></input><div class='zcwf_col_help'></div></div></div>
<div class='zcwf_row'><div class='zcwf_col_lab' ><label for='Last_Name'>Last Name<span  >*</span></label></div><div class='zcwf_col_fld'><input type='text' id='Last_Name' name='Last Name' maxlength='80'></input><div class='zcwf_col_help'></div></div></div>
<div class='zcwf_row'><div class='zcwf_col_lab' ><label for='Phone'>Phone</label></div><div class='zcwf_col_fld'><input type='text' id='Phone' name='Phone' maxlength='30'></input><div class='zcwf_col_help'></div></div></div>
<div class='zcwf_row wfrm_fld_dpNn'><div class='zcwf_col_lab' ><label for='Lead_Source'>Lead Source</label></div><div class='zcwf_col_fld'><select class='zcwf_col_fld_slt' id='Lead_Source' name='Lead Source'  >
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
<div class='zcwf_row'><div class='zcwf_col_lab'  ><label for='Email'>Email<span >*</span></label></div><div class='zcwf_col_fld'><input type='text' ftype='email' id='Email' name='Email' maxlength='100'></input><div class='zcwf_col_help'></div></div></div>
<div class='zcwf_row'><div class='zcwf_col_lab' ><label for='Description'>Your Question<span >*</span></label></div><div class='zcwf_col_fld'><textarea id='Description' name='Description' rows="4"></textarea><div class='zcwf_col_help'></div></div></div><div class='zcwf_row'> <div class='zcwf_col_lab'></div><div class='zcwf_col_fld'><div class='g-recaptcha' data-sitekey='6LfaXscaAAAAALOPlqP93nxWmQbFBIjTbXG3wuIC' data-theme='light' data-callback='rccallback4805080000000479003' captcha-verified='false' id='recap4805080000000479003'></div><div  id='recapErr4805080000000479003' style='font-size:12px;color:red;visibility:hidden;'>Captcha validation failed. If you are not a robot then please try again.</div></div></div><div class='zcwf_row'><div class='zcwf_col_lab'></div><div class='zcwf_col_fld'><input type='submit' id='formsubmit' class='formsubmit zcwf_button s-btn s-normal' value='Submit' title='Submit'><input type='reset' class='zcwf_button s-btn s-normal' name='reset' value='Reset' title='Reset'></div></div>
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
<script type="text/javascript">
    window.addEventListener('load', function() {
        
        var node = document.createElement("script");
        node.src = 'https://www.google.com/recaptcha/api.js';
        node.type = "text/javascript";
        node.id = "recaptcha_js";
        document.getElementsByTagName('HEAD')[0].appendChild(node);

        node = document.createElement("script");
        node.src = 'https://crm.zohopublic.com/crm/WebFormAnalyticsServeServlet?rid=6f017a7e93acf78ff892d147c52f3a1dcab65d2c849dbb64d4e62f3559df9ee3gid3dd075b2ab7a579bc9febfdb0d5acfc42a540e22ad64e3675afda1b0e7b6d786gid885e3c1045bd9bdcc91bdf30f82b5696gid14f4ec16431e0686150daa43f3210513';
        node.type = "text/javascript";
        node.id = "wf_anal";
        document.getElementsByTagName('HEAD')[0].appendChild(node);
        
    });
</script>
</form>
</div>

    <?php
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

add_shortcode( 'zoho_form4', 'zoho_form_func_4' );
function zoho_form_func_4() {
    $a = shortcode_atts( array(
        'form_title' => '',
        'form_description' => '',
    ), $atts );
$page_url = get_permalink();

    ob_start();
?>
<!-- Note :
   - You can modify the font style and form style to suit your website. 
   - Code lines with comments Do not remove this code are required for the form to work properly, make sure that you do not remove these lines of code.
   - The Mandatory check script can modified as to suit your business needs.
   - It is important that you test the modified form before going live.-->
   <div class="crmresponse" style="display: none; font-size: 20px;">Your request has been received. We'll reach out soon!</div>
   <div id='crmWebToEntityForm' class='zcwf_lblLeft crmWebToEntityForm' style=' max-width: 900px;'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
   <META HTTP-EQUIV ='content-type' CONTENT='text/html;charset=UTF-8'>
   <script src='https://www.google.com/recaptcha/api.js' async defer></script>
<form action='https://crm.zoho.com/crm/WebToLeadForm' name=WebToLeads4805080000002819028 method='POST' enctype='multipart/form-data' onSubmit='javascript:document.charset="UTF-8"; return checkMandatory4805080000002819028()' accept-charset='UTF-8'>
 <input type='text' style='display:none;' name='xnQsjsdp' value='3dd075b2ab7a579bc9febfdb0d5acfc42a540e22ad64e3675afda1b0e7b6d786'></input>
 <input type='hidden' name='zc_gad' id='zc_gad' value=''></input> 
 <input type='text' style='display:none;' name='xmIwtLD' value='6f017a7e93acf78ff892d147c52f3a1df3276daafc6826088aa23c749a85f027'></input>
 <input type='text'  style='display:none;' name='actionType' value='TGVhZHM='></input>
 <input type='text' style='display:none;' name='returnURL' value='<?php echo $page_url; ?>#success' > </input>
<!-- Do not remove this code. -->
<script type="text/javascript">
    if (window.location.hash == "#success") {
        document.querySelector(".crmresponse").style.display = "block";
        document.getElementById("crmWebToEntityForm").style.display = "none";
        window.location.hash = "";
    }    
</script>
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
    width: 100%;
    border: 1px solid #ccc!important;
    resize: vertical;
    border-radius: 0;
    padding: 5px 15px;
    font-size: 18px;
    line-height: 1.5;
}

.zcwf_lblLeft .zcwf_col_lab {
    word-break: break-word;
    padding: 0px 6px 0px;
    margin-right: 10px;
    margin-top: 5px;
    min-height: 1px;
}
.zcwf_lblLeft .zcwf_col_fld {
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
display: none;
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
.zcwf_lblLeft .zcwf_row {margin: 10px 0px;}
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
max-width: 150px;
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

.zcwf_lblLeft .zcwf_col_lab {
        font-size: 18px;
        font-weight: 500;        
        display: inline-block;
    }


@media all and (max-width: 600px) {
.zcwf_lblLeft .zcwf_col_lab, .zcwf_lblLeft .zcwf_col_fld {
width: auto;
float: none !important;
}
.zcwf_lblLeft .zcwf_col_help {width: 40%;}
}

.zcwf-container {
    display: flex;
    flex-wrap: wrap;
}

.zcwf-container .zcwf_row {
    width: 100%;
}

@media all and (min-width: 990px) {
.zcwf-container .zcwf_row {
    flex: 1 0 50%;
    max-width: 50%;
    padding: 0 10px;
}

.zcwf_100 {
    width: 100%;
    flex: 1 0 100%!important;
    max-width: 100%!important;
}


}

.g-recaptcha {
    display: flex;
    justify-content: center;
}

</style>
<div class='zcwf_title' style='max-width: 600px;color: black;display: none;'>Schedule Site Visit</div>
<div class="zcwf-container">
<div class='zcwf_row'><div class='zcwf_col_lab' ><label for='Company'>Company<span style='color:red;'>*</span></label></div><div class='zcwf_col_fld'><input type='text' id='Company' name='Company' maxlength='100'></input><div class='zcwf_col_help'></div></div></div>
<div class='zcwf_row'><div class='zcwf_col_lab' ><label for='Last_Name'>Last Name<span style='color:red;'>*</span></label></div><div class='zcwf_col_fld'><input type='text' id='Last_Name' name='Last Name' maxlength='80'></input><div class='zcwf_col_help'></div></div></div>
<div class='zcwf_row'><div class='zcwf_col_lab' ><label for='First_Name'>First Name<span style='color:red;'>*</span></label></div><div class='zcwf_col_fld'><input type='text' id='First_Name' name='First Name' maxlength='40'></input><div class='zcwf_col_help'></div></div></div>
<div class='zcwf_row'><div class='zcwf_col_lab' ><label for='Designation'>Title</label></div><div class='zcwf_col_fld'><input type='text' id='Designation' name='Designation' maxlength='100'></input><div class='zcwf_col_help'></div></div></div>
<div class='zcwf_row'><div class='zcwf_col_lab' ><label for='Phone'>Phone<span style='color:red;'>*</span></label></div><div class='zcwf_col_fld'><input type='text' id='Phone' name='Phone' maxlength='30'></input><div class='zcwf_col_help'></div></div></div>
<div class='zcwf_row'><div class='zcwf_col_lab' ><label for='Email'>Email<span style='color:red;'>*</span></label></div><div class='zcwf_col_fld'><input type='text' ftype='email' id='Email' name='Email' maxlength='100'></input><div class='zcwf_col_help'></div></div></div>
<div class='zcwf_row'><div class='zcwf_col_lab' ><label for='Street'>Street</label></div><div class='zcwf_col_fld'><input type='text' id='Street' name='Street' maxlength='250'></input><div class='zcwf_col_help'></div></div></div>
<div class='zcwf_row'><div class='zcwf_col_lab' ><label for='City'>City</label></div><div class='zcwf_col_fld'><input type='text' id='City' name='City' maxlength='100'></input><div class='zcwf_col_help'></div></div></div>
<div class='zcwf_row'><div class='zcwf_col_lab' ><label for='State'>State</label></div><div class='zcwf_col_fld'><input type='text' id='State' name='State' maxlength='100'></input><div class='zcwf_col_help'></div></div></div>
<div class='zcwf_row'><div class='zcwf_col_lab' ><label for='Zip_Code'>Zip Code</label></div><div class='zcwf_col_fld'><input type='text' id='Zip_Code' name='Zip Code' maxlength='30'></input><div class='zcwf_col_help'></div></div></div>
<div class='zcwf_row'><div class='zcwf_col_lab' ><label for='LEADCF81'>Preferred Contact Date</label></div><div class='zcwf_col_fld'><input type='text' id='LEADCF81' name='LEADCF81' maxlength='20' ftype='date' placeholder='MMM D, YYYY' tplid='4805080000002819028LEADCF81' onfocus='formCalender.stEv(event);formCalender.createCalendar(this);' autocomplete='off'></input><div id='template4805080000002819028LEADCF81'  onclick='formCalender.stEv(event);'  class='tempCalDiv'></div><div class='zcwf_col_help'></div></div></div>
<div class='zcwf_row'><div class='zcwf_col_lab' >Upload Related Project Image</div>
<div class='zcwf_col_fld'><div class='clearB'><input type='file' class='zcwf_file' name='theFile' id='theFile4805080000002819028' multiple /><div class='zcwf_col_help'><span title='Please provide and image of the area of concern if possible' style='cursor: pointer; width: 16px; height: 16px; display: inline-block; background: #fff; border: 1px solid #ccc; color: #ccc; text-align: center; font-size: 11px; line-height: 16px; font-weight: bold; border-radius: 50%;' onclick='tooltipShow4805080000002819028(this)'>?</span><div class='zcwf_tooltip_over' style='display: none;'><span class='zcwf_tooltip_ctn'>null</span></div></div></div><p style='color:black;font-size:11px;padding-left:3px;'>File(s) size limit is 20MB.</p>
</div></div>
<div class='zcwf_row zcwf_100'><div class='zcwf_col_lab' ><label for='Description'>Tell Us About Your Project</label></div><div class='zcwf_col_fld'><textarea id='Description' name='Description' rows="4"></textarea><div class='zcwf_col_help'> <span title='Please provide a description of your safe access concerns' style='cursor: pointer; width: 16px; height: 16px; display: inline-block; background: #fff; border: 1px solid #ccc; color: #ccc; text-align: center; font-size: 11px; line-height: 16px; font-weight: bold; border-radius: 50%;' onclick='tooltipShow4805080000002819028(this)'>?</span><div class='zcwf_tooltip_over' style='display: none;'><span class='zcwf_tooltip_ctn'>Please provide a description of your safe access concerns</span></div></div></div></div>
<div class='zcwf_row wfrm_fld_dpNn'><div class='zcwf_col_lab' ><label for='Lead_Source'>Lead Source</label></div><div class='zcwf_col_fld'><select class='zcwf_col_fld_slt' id='Lead_Source' name='Lead Source'  >
<option value='-None-'>-None-</option>
<option value='Chat'>Chat</option>
<option value='Cold&#x20;Call'>Cold Call</option>
<option value='Email&#x20;Campaign'>Email Campaign</option>
<option value='Employee&#x20;Referral'>Employee Referral</option>
<option value='Facebook'>Facebook</option>
<option value='Federal&#x20;Compass'>Federal Compass</option>
<option value='Google&#x20;Ad'>Google Ad</option>
<option selected value='Inspection&#x20;Landing&#x20;Page'>Inspection Landing Page</option>
<option value='Kee&#x20;Safety&#x20;Partner'>Kee Safety Partner</option>
<option value='Linkedin'>Linkedin</option>
<option value='Referral'>Referral</option>
<option value='Research'>Research</option>
<option value='Source&#x20;List'>Source List</option>
<option value='Trade&#x20;Show'>Trade Show</option>
<option value='Twitter'>Twitter</option>
<option value='Web&#x20;Form&#x20;Contact&#x20;Us'>Web Form Contact Us</option>
</select><div class='zcwf_col_help'></div></div></div><div class='zcwf_row zcwf_100'> <div class='zcwf_col_fld'><div class='g-recaptcha' data-sitekey='6LfaXscaAAAAALOPlqP93nxWmQbFBIjTbXG3wuIC' data-theme='light' data-callback='rccallback4805080000002819028' captcha-verified='false' id='recap4805080000002819028'></div><div  id='recapErr4805080000002819028' style='font-size:12px;color:red;visibility:hidden;'>Captcha validation failed. If you are not a robot then please try again.</div></div></div><div class='zcwf_row zcwf_100'> <div class='zcwf_col_fld'  style="text-align: center;">
    <input type='submit' id='formsubmit'  style=" border-radius: 0;" class='formsubmit zcwf_button  s-btn s-normal' value='Submit' title='Submit'>
    <!-- <input type='reset' class='zcwf_button' name='reset' value='Reset' title='Reset'> -->
</div></div>
</div>
<script type='text/javascript'>var formCalender={userPattern:'YYYY-MM-DD',currDateObj:void 0,currMonth:void 0,currYear:void 0,currDate:void 0,currMonthEnd:[31,28,31,30,31,30,31,31,30,31,30,31],monthName:void 0,days:void 0,displayPanel:void 0,isHideToday:void 0,calDefColor:'#515CCB',weekdays:{1:'Sunday',2:'Monday',3:'Tuesday',4:'Wednesday',5:'Thursday',6:'Friday',7:'Saturday'},months:{1:'January',2:'February',3:'March',4:'April',5:'May',6:'June',7:'July',8:'August',9:'September',10:'October',11:'November',12:'December'},init:function(){this.monthName=[{html:'January',value:0},{html:'February',value:1},{html:'March',value:2},{html:'April',value:3},{html:'May',value:4},{html:'June',value:5},{html:'July',value:6},{html:'August',value:7},{html:'September',value:8},{html:'October',value:9},{html:'November',value:10},{html:'December',value:11}],this.days=['ssunday','smonday','stuesday','swednesday','sthursday','sfriday','ssaturday'],this.dayNamesShort=['Sun','Mon','Tue','Wed','Thu','Fri','Sat'],this.daysBasedOnPrefernce=['ssunday','smonday','stuesday','swednesday','sthursday','sfriday','ssaturday'];var e=this.daysBasedOnPrefernce[0];this.daysBasedOnPrefernce.shift(1),this.daysBasedOnPrefernce.push(e);var t=this.dayNamesShort[0];this.dayNamesShort.shift(1),this.dayNamesShort.push(t),this.currDateObj=new Date,this.currMonth=this.currDateObj.getMonth(),this.currYear=this.currDateObj.getFullYear(),this.currYear<1e3&&(this.currYear+=1900),this.currDate=this.currDateObj.getDate()},getTitle:function(){return this.monthName[this.currMonth].html+' '+this.currYear},createCalendar:function(e){for(var t=document.getElementsByClassName('tempCalDiv'),a=t.length,r=0;r<a;r++){var n=t[r].style;'block'===n.display&&(n.display='none')}this.calendarNode=e,this.userPattern=this.calendarNode.placeholder;var s=this.calendarNode.value,i=!1;if(s){var l=dateFormatConvert.validate(s,this.userPattern);l&&(this.currDate=l.getDate(),this.currMonth=l.getMonth(),this.currYear=l.getFullYear(),this.currYear<1e3&&(this.currYear=Number(this.currYear)+1900))}else i=!0,formCalender.init();this.monthName||formCalender.init(),this.createDatePicker(this.currDate,this.currMonth,this.currYear,i,!1)},createDatePicker:function(e,t,a,r,n){1===this.currMonth&&(this.currMonthEnd[1]=this.currYear%400==0||this.currYear%4==0&&this.currYear%100!=0?29:28);var s=new Date(a,t,1),i=6,l=this.daysBasedOnPrefernce.indexOf(this.days[s.getDay()])+1;i=31===this.currMonthEnd[t]&&l>=6||30===this.currMonthEnd[t]&&7===l?7:28===this.currMonthEnd[t]&&1===l?5:6;var d=this.getTitle(e,a,t),o=this.dayNamesShort,h='<div id=\'calenDiv\'><i id=\'calArrow\' style=\'display:none;\' class=\'dIB SocialArrow\'></i><div><div>';h+='<div class=\'txt-ctr\'><span class=\'calNav dIB vam yearNavLft\' onclick=\'formCalender.updateDatePicker(event,undefined, -1)\'><i class=\'arrow left mRMinus2\'></i><i class=\'arrow left\'></i></span><span class=\'calNav dLft dIB vam\' onClick=\'formCalender.updateDatePicker(event,-1)\' id=\'pm\'><i class=\'arrow left\'></i></span><span class=\'sCalMon\'>'+d+'</span><span class=\'calNav dRgt vam\' onClick =\'formCalender.updateDatePicker(event,1)\' id=\'nm\'><i class=\'arrow right\'></i></span><span class=\'calNav dIB vam yearNavRgt\' onclick=\'formCalender.updateDatePicker(event,undefined, 1)\'><i class=\'arrow right\'></i><i class=\'arrow right mLMinus2\'></i></span></div>',h+='<table  class=\'calDay\'  id =\'weekDays\' style=\'color:#868686; font-size:8px; margin-left:0\'><tr> <th>'+o[0]+'</th> <th>'+o[1]+'</th><th>'+o[2]+'</th><th>'+o[3]+'</th> <th>'+o[4]+'</th> <th>'+o[5]+'</th> <th>'+o[6]+'</th></tr></table>',h+='</div>',h+='<table id=\'calHeader\' class=\'calDay\' style=\'margin-left:0; margin-top:-5px;\' width=\'100%\' cellspacing=\'0\' cellpadding=\'0\' border=\'0\' >';var c='',u=new Date,y=a||u.getFullYear(),v=e||u.getDate(),g=void 0===t?u.getMonth():t,m=u.getMonth(),p=u.getFullYear();u.getDate();m===t&&a===p&&(c=' style=\'display:none\'');for(var f,D,M,b=s.getDay();1!==b;)s.setDate(s.getDate()-1),b=s.getDay();for(var x=1;x<=i;x++){h+='<tr>';for(var Y=1;Y<8;Y++){f=s.getMonth(),D=s.getFullYear(),M=s.getDate(),D+'-'+(parseInt(f)+1)+'-'+M;var F='cdate lt-gray';if(M===v&&D===y&&f===g&&(F='cdate lt-gray'),f===g&&(F='cdate'),(r&&M===v&&m===g&&p===y||!n&&M===v&&f===g&&D===y)&&(F='sel'),n){var k=dateFormatConvert.validate(this.calendarNode.value,formCalender.userPattern);k&&M===k.getDate()&&f===k.getMonth()&&D===k.getFullYear()&&(F='sel')}h+='<td class=\''+F+'\' onClick=\'formCalender.displaySelectedDate(\"'+M+' '+f+' '+D+'\")\'>'+M+'</td>',s.setDate(s.getDate()+1)}h+='</tr>'}h+='</table>',h+='<div>',this.isHideToday||(h+='<div id=\'calBtns\' class=\'pT15 pB15 fL\'><a'+c+' class=\'cP fL\' href=\'javascript:;\' id=\'todayBtn\' onclick=\'formCalender.displaySelectedDate(\"today\")\'>Today</a>'),h+='</div>',h+='</div>',h+='</div></div>';var C=document.getElementById('template'+this.calendarNode.getAttribute('tplid'));C.innerHTML=h,C.style.display='block'},displaySelectedDate:function(e,t){if(!t)t=this.calendarNode;if('today'===e){var a=new Date;e=a.getDate()+' '+a.getMonth()+' '+a.getFullYear()}e=e.split(' ');var r=dateFormatConvert.convertFormat(new Date(e[2],e[1],e[0]),this.userPattern);t.value=r,t.focus(),t.placeholder=this.userPattern,formCalender.closeDatePicker(),t.addEventListener('keyup',function(e){formCalender.calendarNode=this;var t=this.value,a=dateFormatConvert.validate(t,formCalender.userPattern);if(a){var r={};r.date=a.getDate(),r.month=a.getMonth(),r.year=a.getFullYear(),formCalender.updateDatePicker(e,void 0,void 0,r)}}),t.blur()},closeDatePicker:function(){document.getElementById('template'+this.calendarNode.getAttribute('tplid')).style.display='none'},updateDatePicker:function(e,t,a,r){var n=document.getElementById('template'+this.calendarNode.getAttribute('tplid'));r&&(this.currDate=r.date,this.currMonth=r.month,this.currYear=r.year),void 0!==t?1===t?11===this.currMonth?(this.currMonth=0,this.currYear++):this.currMonth++:0===this.currMonth?(this.currMonth=11,this.currYear--):this.currMonth--:void 0!==a&&(this.currYear=parseInt(this.currYear)+a),this.createDatePicker(this.currDate,this.currMonth,this.currYear,!1,!0),n.style.display='block'},stEv:function(e){e||(e=window.event),e&&(e.cancelBubble=!0,e.stopPropagation&&e.stopPropagation())}};window.onclick=function(){for(var e=document.getElementsByClassName('tempCalDiv'),t=e.length,a=0;a<t;a++){var r=e[a];if(document.activeElement===document.querySelector('input[tplid=\''+r.id.replace('template','')+'\']'))return;var n=e[a].style;'block'===n.display&&(n.display='none')}};var dateFormatConvert={shortMon:['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],longMon:['January','February','March','April','May','June','July','August','September','October','November','December'],dayArr:[31,28,31,30,31,30,31,31,30,31,30,31],wod:1,lm:'userdate',_dateObj:void 0,lLimit:80,formats:[{val:'YYYY',type:'year',regex:/\d{4}/,len:4},{val:'GGGG',type:'year',regex:/\d{4}/,len:4,isWEG:!0},{val:'gggg',type:'year',regex:/\d{4}/,len:4,isWEG:!0},{val:'YY',type:'year',regex:/\d{2}/,len:2},{val:'GG',type:'year',regex:/\d{2}/,len:2,isWEG:!0},{val:'gg',type:'year',regex:/\d{2}/,len:2,isWEG:!0},{val:'MMMM',type:'month',regex:/[A-z]{3,}/,long:!0,str:!0,array:['January','February','March','April','May','June','July','August','September','October','November','December']},{val:'MMM',str:!0,type:'month',regex:/[A-z]{3,}/,array:['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']},{val:'Mo',suff:!0,type:'month',regex:/\d{1,2}(?=st|nd|rd|th)/,max:12},{val:'MM',type:'month',regex:/\d{2}/,len:2,max:12,alt:!0},{val:'M',type:'month',regex:/\d{1,2}/,max:12},{val:'DDDD',type:'date',regex:/\d{3}/,len:3,year:!0},{val:'DDDo',type:'date',suff:!0,regex:/\d{1,3}(?=st|nd|rd|th)/,len:3,year:!0,ignore:/\d{3}(?=st|nd|rd|th)/},{val:'DDD',type:'date',regex:/\d{1,3}/,year:!0,ignore:/\d{3}/},{val:'Do',type:'date',suff:!0,regex:/\d{1,2}(?=st|nd|rd|th)/},{val:'DD',type:'date',regex:/\d{2}/,len:2,alt:!0},{val:'D',type:'date',regex:/\d{1,2}/},{val:'dddd',type:'longdate',regex:/[A-z]{3,}/,long:!0,str:!0,array:['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday']},{val:'ddd',type:'longdate',regex:/[A-z]{3}/,str:!0,array:['Sun','Mon','Tue','Wed','Thu','Fri','Sat']},{val:'dd',type:'longdate',regex:/[A-z]{2}/,str:!0,array:['Su','Mo','Tu','We','Th','Fr','Sa']},{val:'do',type:'longdate',regex:/\d{1}(?=st|nd|rd|th)/,suff:!0},{val:'d',type:'longdate',regex:/\d{1}/}],parseFormat:function(e,t){for(var a,r=this.formats,n=[],s=r.length,i=0;i<s;i++){var l=r[i];if(!e.length)break;if(e.indexOf(l.val)>-1){if(t&&l.alt){a=!0;continue}a&&(l.val=r[i-1].val,l=r[i-1]),a=!1,n.push({format:l,index:e.indexOf(l.val)}),e=e.replace(l.val,Math.pow(10,l.val.length-1)),i--}else;}return n.sort(function(e,t){return e.index-t.index})},convertFormat:function(e,t){this._dateObj=e;var a=this._dateObj,r=this.parseFormat(t,!0),n={},s={date:a.getDate(),month:a.getMonth(),year:a.getFullYear(),day:a.getDay()};t=this.fmReplace(t.replace(/{{|}}/g,''),r);for(var i=r.length,l=0;l<i;l++){var d=r[l].format;switch(d.type){case'date':t=t.replace(d.val+this.lm,this.crctLength(d.year?this.totdate(s.month,this.isLeap(s.year),s.date):s.date,d.len,d.suff));break;case'month':t=d.str?t.replace(d.val+this.lm,d.array[s.month]):t.replace(d.val+this.lm,this.crctLength(s.month+1,d.len,d.suff));break;case'year':t=t.replace(d.val+this.lm,2===d.len?this.crctLength(s.year%100,2):4===(s.year+'').length?s.year:this.crctLength(s.year,4)),n.year=n.year||[],n.year.push(d);break;case'day':case'week':n.flag=!0,n[d.type]=n[d.type]||[],n[d.type].push(d);break;case'longdate':t=d.str?t.replace(d.val+this.lm,d.array[s.day]):t.replace(d.val+this.lm,this.crctLength(s.day,null,d.suff))}}return t.replace(/{{|}}/g,'')},fmReplace:function(e,t){for(var a=0,r=t.length,n=0;n<r;n++)e=e.slice(0,t[n].index+a)+t[n].format.val+this.lm+e.slice(t[n].index+a+t[n].format.val.length),a+=8;return e},totdate:function(e,t,a){for(var r=0,n=0;n<e;n++)r+=this.dayArr[n],t&&1===n&&(r+=1);return r+(a||0)},crctLength:function(e,t,a){var r='';if(a&&(r=this.nthconv(e)),t){e=e.toString();for(var n=1;n<t;n++)e.length<=n&&(e='0'+e)}return e+r},nthconv:function(e){if(e>3&&e<21)return'th';switch(e%10){case 1:return'st';case 2:return'nd';case 3:return'rd';default:return'th'}},isLeap:function(e){return 2===(e+='').length&&(e=this.getCorrectYear(parseInt(e))),(e=parseInt(e))%4==0&&e%100!=0||e%400==0},getCorrectYear:function(e){var t=e+'';if(e=parseInt(e),2===t.length){var a=(new Date).getFullYear(),r=parseInt(a/100),n=a%100,s=(n-this.lLimit+100)%100;e=n>s?e<s?r+1+''+this.crctLength(e,2):r+''+this.crctLength(e,2):e<s?r+''+this.crctLength(e,2):r-1+''+this.crctLength(e,2)}return e},valFormat:function(e,t){for(var a={},r=new Date((new Date).getFullYear(),0),n=this.parseFormat(t,!0),s=e,i=t=t.replace(/{{|}}/g,''),l=n.length,d=0;d<l;d++){var o,h=n[d].format;switch(h.type){case'date':case'year':case'week':case'day':h.regex.test(e)?(o='year'===h.type?e.match(h.regex)[h.match||0]:parseInt(e.match(h.regex)[h.match||0]),a[h.type]=o,e=this.replaceVal(e,h.regex,h.suff),s=this.replaceVal(s,h.regex,h.suff,h.val),h.year&&(a.date=getDay(a.date).day)):a.year&&a.week?(a[h.type]=this.wod,t=t.replace(h.val,''),i=i.replace(h.val,'')):a[h.type]='Invalid',/date/i.test(h.type)&&0===a[h.type]&&(a[h.type]='Invalid');break;case'month':h.regex.test(e)?(o=this.getMonth(e.match(h.regex)[0],h.suff,h.str,h.long),a.month=o.val,e=this.replaceVal(e,o.mon||h.regex,h.suff),s=this.replaceVal(s,o.mon||h.regex,h.suff,h.val)):a.month='Invalid',a.month<0&&(a.month='Invalid');break;case'longdate':h.regex.test(e)&&(o=h.str?this.findVal(h.array,e.match(h.regex)[0]):parseInt(e.match(h.regex)[0]),a.longdate=this.isDef(o.index)?o.index:o,e=this.replaceVal(e,o.mon||o,h.suff),s=this.replaceVal(s,o.mon||o,h.suff,h.val))}t=t.replace(h.valForm||h.val,'')}if(this.isDef(a.longdate)&&a.day&&a.day!==a.longdate?r.setFullYear('Invalid'):this.isDef(a.year)&&r.setFullYear(this.getCorrectYear(a.year)),this.isDef(a.month)&&r.setMonth(a.month),this.isDef(a.date)&&r.setDate(a.date<=this.dayArr[r.getMonth()]+(1===r.getMonth()&&this.isLeap(r.getFullYear())?1:0)?a.date:'Invalid'),this._isCorrectFormat=e.length===t.length&&i===s&&this.validate(r))return r},validate:function(e,t){var a=e.constructor;if(a===Date)return this._dateObj=e,'Invalid Date'!==e.toString();if(a===String&&t){var r=this.valFormat(e,t);return r&&this._isCorrectFormat&&(this._format=t),r}},replaceVal:function(e,t,a,r){return e=e.replace(t,r||''),a&&(e=e.replace(/st|nd|rd|th/,'')),e},getMonth:function(e,t,a,r){var n;if(a){var s=this.findVal(r?this.longMon:this.shortMon,e);n=s.mon,e=s.index,(!n||e>11)&&(e='Invalid')}else(e=parseInt(e)-1)>11&&(e='Invalid');return{val:e,mon:n}},findVal:function(e,t){var a,r,n=e.length;for(r=0;r<n;r++)if(new RegExp(e[r]).test(t)){a=e[r];break}return{mon:a,index:r}},isDef:function(e){return void 0!==e}};</script>
<style>
#calenDiv{padding:10px;display:table; width: 195px;font-family: helvetica,sans-serif !important;}
.calNav{width:20px; height:15px; display:inline-block;position:relative; top:4px; cursor:pointer}
#calenDiv .calNav {width:15px;}
#calenDiv .yearNavLft {right:10px;}
#calenDiv .yearNavRgt {left:10px;}
#calenDiv .dLft {right:5px; }
#calenDiv .dRgt {left:5px;}
.dLft{right:10px;opacity:0.8; }
.dRgt{left:10px;opacity:0.8;}
.yearNavLft{right:15px; }
.yearNavRgt{left:15px;opacity:0.6;}
#calenDiv table.calDay {border-spacing:6px; margin-top:0}
#calenDiv table.calDay td{ padding:3px 4px; font-size:11px}
#calenDiv table.calDay th {padding: 0 3px;font-size: 11px;padding-right: 0;padding-left: 1px;color: #888;width: 22px;cursor: default;border-radius: 3px;text-align: center;font-weight: normal;}
#calenDiv #weekDays{margin-top: 10px;margin-bottom: 5px;border-top: 1px solid #cbcbcb;border-bottom: 1px solid #cbcbcb;border-spacing: 5px;margin-left: 0;color: #868686;}
#calenDiv .sCalMon {cursor: default;display: inline-block;color: #888;width: 110px;font-size: 12px;}
table.calDay td:hover{background-color:#e8e8e8;}
table.calDay{ color:#222; margin-left:-10px; border-spacing:12px;}
table.calDay td, table.calDay th{ font-size:1.4rem; cursor:default;border-radius:3px; text-align:center;  padding:3px 5px; font-family: helvetica,sans-serif !important; }
table.calDay td.sel,table.calDay td.sel:hover{color:#fff; background:#b3b3b3; border-radius:3px;}
table.calDay td.noNum,table.calDay td.lt-gray{color:#d8d8d8;}
.vpvl, .txt-ctr {text-align: center;}
#calBtns a, .lyteCalBtns .lyteCalCurrentDate a {color: #338cf0;font-size: 14px;text-decoration: none;}
#calenDiv #calBtns {width: 183px;margin-left: 10px;border-top: 0;font-size: 11px;padding: 3px 0 12px!important;}
.arrow {border: solid #666;border-width: 0 1px 1px 0;display: inline-block;height: 6px;width: 6px;}
#calenDiv .right {transform: rotate(-45deg);-webkit-transform: rotate(-45deg);}
#calenDiv .left {transform: rotate(135deg); -webkit-transform: rotate(135deg);}
.mLMinus2{margin-left: -2px;}
.mRMinus2{margin-right: -2px;}
.vam{vertical-align: middle;}
.tempCalDiv{display: none;margin: 0;position: absolute;z-index: 1000;background-color: #fff; border: 1px solid #ccc; -webkit-box-shadow: 0 2px 10px rgba(0,0,0,0.3);box-shadow: 0 2px 10px rgba(0,0,0,0.3); border-top: 0;top: 20px;}</style>
<script>

  /* Do not remove this code. */
  function rccallback4805080000002819028()
{
if(document.getElementById('recap4805080000002819028')!=undefined){
document.getElementById('recap4805080000002819028').setAttribute('captcha-verified',true);
}
if(document.getElementById('recapErr4805080000002819028')!=undefined && document.getElementById('recapErr4805080000002819028').style.visibility == 'visible' ){
document.getElementById('recapErr4805080000002819028').style.visibility='hidden';
}
}
function reCaptchaAlert4805080000002819028()
{
var recap = document.getElementById('recap4805080000002819028');
if( recap !=undefined && recap.getAttribute('captcha-verified') == 'false')
{
document.getElementById('recapErr4805080000002819028').style.visibility='visible';
return false;
}
return true;
}
function validateEmail4805080000002819028()
{
var form = document.forms['WebToLeads4805080000002819028'];
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
function validateDateFormat4805080000002819028()
{
var form = document.forms['WebToLeads4805080000002819028'];
var dateFlds = form.querySelectorAll('[ftype=date]');
var i;
for (i = 0; i < dateFlds.length; i++)
{
var dateFld = dateFlds[i];
var usrPtrn = dateFld.placeholder;
var dateVal = dateFld.value;
if(dateVal.trim() != ''){
var vald = dateFormatConvert.validate(dateVal,usrPtrn);
if(!vald){
alert('Please enter a valid date ');
dateFld.focus();
return false;
}
}
}
return true;
}

   function checkMandatory4805080000002819028() {
var mndFileds = new Array('Company','First Name','Last Name','Email','Phone');
var fldLangVal = new Array('Company','First\x20Name','Last\x20Name','Email','Phone');
for(i=0;i<mndFileds.length;i++) {
 var fieldObj=document.forms['WebToLeads4805080000002819028'][mndFileds[i]];
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
if(!validateFileUpload4805080000002819028()){return false;}

if(!validateEmail4805080000002819028()){return false;}
if(!reCaptchaAlert4805080000002819028()){return false;}
if(!validateDateFormat4805080000002819028()){return false;}
document.querySelector('.crmWebToEntityForm .formsubmit').setAttribute('disabled', true);
}

function validateFileUpload4805080000002819028(){
var uploadedFiles = document.getElementById('theFile4805080000002819028'); 
var totalFileSize =0; 
if(uploadedFiles.files.length >3){ 
alert('You can upload a maximum of three files at a time.'); 
return false; 
} 
if ('files' in uploadedFiles) { 
if (uploadedFiles.files.length != 0) { 
for (var i = 0; i < uploadedFiles.files.length; i++) { 
var file = uploadedFiles.files[i]; 
if ('size' in file) { 
totalFileSize = totalFileSize + file.size; 
} 
} 
if(totalFileSize > 20971520){ 
alert('Total file(s) size should not exceed 20MB.'); 
return false; 
} 
} 
} 
return true; 
}
function tooltipShow4805080000002819028(el){
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
</script>
<script type="text/javascript">
    window.addEventListener('load', function() {
        
        var node = document.createElement("script");
        node.src = 'https://www.google.com/recaptcha/api.js';
        node.type = "text/javascript";
        node.id = "recaptcha_js";
        document.getElementsByTagName('HEAD')[0].appendChild(node);

        node = document.createElement("script");
        node.src = 'https://crm.zohopublic.com/crm/WebFormAnalyticsServeServlet?rid=6f017a7e93acf78ff892d147c52f3a1df3276daafc6826088aa23c749a85f027gid3dd075b2ab7a579bc9febfdb0d5acfc42a540e22ad64e3675afda1b0e7b6d786gid885e3c1045bd9bdcc91bdf30f82b5696gid14f4ec16431e0686150daa43f3210513';
        node.type = "text/javascript";
        node.id = "wf_anal";
        document.getElementsByTagName('HEAD')[0].appendChild(node);
        
    });
</script>
</form>
</div>
<?php
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}