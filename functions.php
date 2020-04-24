<?php

//Custom fields:
require_once get_template_directory() . '/framework/meta-boxes.php';
require_once get_template_directory() . '/shortcodes.php';
require_once get_template_directory() . '/framework/theme-options.php';
require_once get_template_directory() . '/framework/theme-options/framework.php';
require_once get_template_directory() . '/framework/wp_bootstrap_navwalker.php';
require_once get_template_directory() . '/framework/DomainAvailability.php';

//Theme Set up:
function cloudme_theme_setup() {

   /*

     * Make theme available for translation.

     * Translations can be filed in the /languages/ directory.

     * If you're building a theme based on cubic, use a find and replace

     * to change 'cubic' to the name of your theme in all the template files

     */

    load_theme_textdomain( 'cloudme', get_template_directory() . '/languages' );

    /** Set Content width **/
    if ( ! isset( $content_width ) ) 
        $content_width = 900;
    /*
     * This theme uses a custom image size for featured images, displayed on
     * "standard" posts and pages.
     */
	  add_theme_support( 'custom-header' ); 
	  add_theme_support( 'custom-background' );
	
    add_theme_support( 'post-thumbnails' );
    // Adds RSS feed links to <head> for posts and comments.
    add_theme_support( 'automatic-feed-links' );
    // Switches default core markup for search form, comment form, and comments
    // to output valid HTML5.
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
    //Post formats
    add_theme_support( 'post-formats', array(
        'audio',  'gallery', 'image', 'video',
    ) );

    //Tags
    add_theme_support( 'title-tag' );

    // This theme uses wp_nav_menu() in one location.
  	register_nav_menus( array(
          'primary'   => esc_html__('Primary Menu', 'cloudme')
  	) );
}
add_action( 'after_setup_theme', 'cloudme_theme_setup' );

function cloudme_load_custom_wp_admin_style() {
        wp_register_style( 'custom_wp_admin_css', get_template_directory_uri() . '/framework/admin-style.css', false, '1.0.0' );
        wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'cloudme_load_custom_wp_admin_style' );

/*Register Fonts*/
function cloudme_theme_fonts_url() {
    $fonts_url = '';
    
    $mon = _x( 'on', 'Lato font: on or off', 'cloudme' );

    if ( 'off' !== $mon ) {
        $font_families = array();
 
        if ( 'off' !== $mon ) {
            $font_families[] = 'Lato:300,400,700,900';
        }
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }
 
    return esc_url_raw( $fonts_url );

}
/*
Enqueue scripts and styles.
*/
function cloudme_theme_scripts() {
    wp_enqueue_style( 'cloudme-fonts', cloudme_theme_fonts_url(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'cloudme_theme_scripts' );

function cloudme_theme_scripts_styles() {

	$protocol = is_ssl() ? 'https' : 'http';

    /** All frontend css files **/
    wp_enqueue_style( 'cloudme-bootstrap', get_template_directory_uri().'/css/bootstrap.css');
    wp_enqueue_style( 'cloudme-owl-car', get_template_directory_uri().'/css/owl.carousel.css');
    wp_enqueue_style( 'cloudme-owl-theme', get_template_directory_uri().'/css/owl.theme.css');
    wp_enqueue_style( 'cloudme-owltransitions', get_template_directory_uri().'/css/owl.transitions.css');
    wp_enqueue_style( 'cloudme-animate', get_template_directory_uri().'/css/animate.min.css');
    wp_enqueue_style( 'cloudme-tablesaw', get_template_directory_uri().'/css/tablesaw.stackonly.css');    
    wp_enqueue_style( 'cloudme-slicknav', get_template_directory_uri().'/css/slicknav.css');
    wp_enqueue_style( 'cloudme-morphext', get_template_directory_uri().'/css/morphext.css');
    wp_enqueue_style( 'cloudme-normalize', get_template_directory_uri().'/css/normalize.css');
	  wp_enqueue_style( 'cloudme-font-awesome', get_template_directory_uri().'/css/font-awesome.min.css');
    wp_enqueue_style( 'vc_font_awesome_5' );
	  wp_enqueue_style( 'cloudme-style', get_stylesheet_uri(), array(), '21-05-2015' );
	
		
    /** Js for comment on single post **/    
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ){
    	wp_enqueue_script( 'comment-reply' );
	}

    // Load custom color scheme file
    $color_1 = cloudme_theme_option('custom_color_1');
    $color_2 = cloudme_theme_option('custom_color_2');
    if ( intval( cloudme_theme_option( 'custom_color_scheme' ) ) && ($color_1  || $color_2) ) {

        $upload_dir = wp_upload_dir();
        $dir        = path_join( $upload_dir['baseurl'], 'custom-css' );
        $file       = $dir . '/color-scheme.css';
        wp_enqueue_style( 'cloudme-color-scheme', $file, 1.0 );
    }

    /** All frontend js files **/
  	wp_enqueue_script("cloudme-maps-js", "$protocol://maps.googleapis.com/maps/api/js?key=".cloudme_theme_option( 'gg_map' )."",array('jquery'),false,false);
  	wp_enqueue_script("cloudme-modernizr", get_template_directory_uri()."/js/vendor/modernizr.js",array('jquery'),false,true);
	wp_enqueue_script("cloudme-hoverIntent", get_template_directory_uri()."/js/vendor/hoverIntent.js",array('jquery'),false,true);
 	wp_enqueue_script("cloudme-morphext", get_template_directory_uri()."/js/vendor/morphext.min.js",array('jquery'),false,true);
	wp_enqueue_script("cloudme-superfish", get_template_directory_uri()."/js/vendor/superfish.min.js",array('jquery'),false,true);
	wp_enqueue_script("cloudme-carousel", get_template_directory_uri()."/js/vendor/owl.carousel.min.js",array('jquery'),false,false);
	wp_enqueue_script("cloudme-wow", get_template_directory_uri()."/js/vendor/wow.min.js",array('jquery'),false,true);
  	wp_enqueue_script("cloudme-animateNumber", get_template_directory_uri()."/js/vendor/jquery.animateNumber.min.js",array('jquery'),false,true);
  	wp_enqueue_script("cloudme-waypoints", get_template_directory_uri()."/js/vendor/waypoints.min.js",array('jquery'),false,true);
  	wp_enqueue_script("cloudme-slicknav", get_template_directory_uri()."/js/vendor/jquery.slicknav.min.js",array(),false,true);
  	wp_enqueue_script("cloudme-masonry", get_template_directory_uri()."/js/vendor/masonry.pkgd.min.js",array('jquery'),false,true);
	wp_enqueue_script("cloudme-sorter", get_template_directory_uri()."/js/vendor/jquery-ui.min.js",array('jquery'),false,true);
	wp_enqueue_script("cloudme-custom", get_template_directory_uri()."/js/custom.js",array('jquery'),false,true);
  	wp_localize_script( 'cloudme-custom', 'wdc_ajax', array(
      	'ajaxurl'       => admin_url( 'admin-ajax.php' ),
      	'wdc_nonce'     => wp_create_nonce( 'wdc_nonce' ))
  	);
}
add_action( 'wp_enqueue_scripts', 'cloudme_theme_scripts_styles');

if(!function_exists('cloudme_custom_frontend_style')){
	function cloudme_custom_frontend_style(){
    $background = cloudme_theme_option( 'footer_color' );
    $topfoot = '';
    $bg_head  = '';
    $bg_nav  = '';
    $bg_snav = '';
    $color_m = '';
    $ph_high = '';
    $whmcs_top = '';
    $whmcs_banner = '';
    $bg_css = ! empty( $background['color'] ) ? "{$background['color']}" : '';

  if ( ! empty( $background['image'] ) ) {
   $bg_css .= " url({$background['image']})";
   $bg_css .= " {$background['repeat']}";
   $bg_css .= " {$background['position_x']} {$background['position_y']}";
   $bg_css .= " {$background['attachment']}";
   $bg_css .= ! empty( $background['size'] ) ? " {$background['size']}" : '';
  }
 
  if( ! empty($bg_css)){
    $bg_css = 'footer{background:'.$bg_css.'}';
  }
  if(cloudme_theme_option( 'topfooter_color' )){
    $topfoot = '.social{background:'.cloudme_theme_option( 'topfooter_color' ).'}';
  }
  if(cloudme_theme_option( 'bg_nav' )){
    $bg_nav = 'header .top, .top.sticky{background:'.cloudme_theme_option( 'bg_nav' ).'}';
  }
  if(cloudme_theme_option( 'bg_snav' )){
    $bg_snav = '.top.sticky.sticked{background:'.cloudme_theme_option( 'bg_snav' ).'}';
  }
  if(cloudme_theme_option( 'color_nav' )){
    $color_m = '.top .sf-menu a{color:'.cloudme_theme_option( 'color_nav' ).'}';
  }
  if(cloudme_theme_option( 'pheader_h' )){
    $ph_high = '.page-top{min-height:'.cloudme_theme_option( 'pheader_h' ).'px}';
  }
  if ( cloudme_theme_option('bg_head') ) {
   $bg_head .= "header.bg-blog{background-image:url(".cloudme_theme_option('bg_head').");} ";
  }
  if ( cloudme_theme_option('whmcs_top') ) {
   $whmcs_top .= ".whmcs-page .top{background-image:url(".cloudme_theme_option('whmcs_top').");} ";
  }
  if ( cloudme_theme_option('whmcs_banner') ) {
   $whmcs_banner .= "section#home-banner{background-image:url(".cloudme_theme_option('whmcs_banner').");} ";
  }
 
  $bg_css .= cloudme_theme_option('custom_css');
  $bg_css .= $topfoot;
  $bg_css .= $bg_head;
  $bg_css .= $bg_nav;
  $bg_css .= $bg_snav;
  $bg_css .= $color_m;
  $bg_css .= $ph_high;
  $bg_css .= $whmcs_top;
  $bg_css .= $whmcs_banner;
  if(! empty($bg_css)){
	echo '<style type="text/css">'.$bg_css.'</style>';
    }
}
}

add_action('wp_head', 'cloudme_custom_frontend_style');

//Search Domain
function cloudme_wdc_display_func(){
    check_ajax_referer( 'wdc_nonce', 'security' );

if(isset($_POST['domain']))
{
    $domain = str_replace(array('www.', 'http://'), NULL, $_POST['domain']);
    $domain = preg_replace("/[^-a-zA-Z0-9.]+/", "", $domain);
    if(strlen($domain) > 0)
    {
        
        $Domains = new DomainAvailability();
        $available = $Domains->is_available($domain);
        $custom_found_result_text = '<i class="fa fa-check"></i>'.esc_html__('Congratulations!', 'cloudme').'<b>'.$domain.'</b> '.esc_html__('is available!', 'cloudme').'';
        $custom_not_found_result_text = '<i class="fa fa-times"></i> '.esc_html__(' Sorry!', 'cloudme').' <b>'.$domain.'</b>'.esc_html__(' is already taken!', 'cloudme').'';
        $custom_not_found_result_text2 = esc_html__('WHOIS server not found for that TLD', 'cloudme');
        
        if ($available == '1') {
                $result = array('status'=>1,'domain'=>$domain, 'text'=> '<p class="domain-checker-available">'.$custom_found_result_text.'</p>');
                echo json_encode($result);
        } elseif ($available == '0') {
                $result = array('status'=>0,'domain'=>$domain, 'text'=> '<p class="domain-checker-unavailable">'.$custom_not_found_result_text.'</p>');
                echo json_encode($result);
        }elseif ($available == '2'){
                $result = array('status'=>0,'domain'=>$domain, 'text'=> '<p class="not-available">'.$custom_not_found_result_text2.'</p>');
                echo json_encode($result);
        }
        
    }
    else
    {
        echo 'Please enter the domain name';
    }
}
die();
}
add_action('wp_ajax_wdc_display','cloudme_wdc_display_func');
add_action('wp_ajax_nopriv_wdc_display','cloudme_wdc_display_func');

// Widget Sidebar
function cloudme_widgets_init() {
	register_sidebar( array(
        'name'          => esc_html__( 'Primary Sidebar', 'cloudme' ),
        'id'            => 'sidebar-1',        
		'description'   => esc_html__( 'Appears in the sidebar section of the site.', 'cloudme' ),        
		'before_widget' => '<div id="%1$s" class="widget %2$s">',        
		'after_widget'  => '</div>',        
		'before_title'  => '<h4 class="widget_title">',        
		'after_title'   => '</h4>'
    ) );
    register_sidebar( array(
		'name'          => esc_html__( 'Footer One Widget Area', 'cloudme' ),
		'id'            => 'footer-area-1',
		'description'   => esc_html__( 'Footer Widget that appears on the Footer.', 'cloudme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Two Widget Area', 'cloudme' ),
		'id'            => 'footer-area-2',
		'description'   => esc_html__( 'Footer Widget that appears on the Footer.', 'cloudme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Three Widget Area', 'cloudme' ),
		'id'            => 'footer-area-3',
		'description'   => esc_html__( 'Footer Widget that appears on the Footer.', 'cloudme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Fourth Widget Area', 'cloudme' ),
		'id'            => 'footer-area-4',
		'description'   => esc_html__( 'Footer Widget that appears on the Footer.', 'cloudme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );    
 
}
add_action( 'widgets_init', 'cloudme_widgets_init' );

//Socials footer
function cloudme_socials() {
 $output  = array();
 $socials = array_filter( (array) cloudme_theme_option( 'socials' ) );
 
 if ( empty( $socials ) ) {
  return;
 }

 foreach ( (array) $socials as $name => $value ) {
  $display = $name;

  if ( $name == 'google' ) {
   $display = 'googleplus';
   $name    = 'google+';
  }

  if ( $name == 'mail' ) {
   $value   = 'mailto:' . esc_attr( $value );
  } else {
   $value = esc_url( $value );
  }

  $output[] = sprintf(
   '<li class="%s"><a href="%s" class="bb-%s" target="_blank">%s</a></li>',
   $display,
   $value,
   esc_attr( $name ),
   esc_attr( $name ),
   $display
  );
 }

 if ( $output ) {
  echo implode( "\n\t", $output );
 }
}


/** Custom theme option post excerpt **/
function cloudme_excerpt() {

  if(cloudme_theme_option('excerpt_length')){
    $limit = cloudme_theme_option('excerpt_length');
  }else{
    $limit = 15;
  }
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

/** Excerpt Section Blog Post **/
function cloudme_blog_excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

//pagination
function cloudme_pagination($prev = '<i class="fa fa-angle-double-left"></i>', $next = '<i class="fa fa-angle-double-right"></i>', $pages='') {
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    if($pages==''){
        global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
    }
    $pagination = array(
		'base' 			=> str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
		'format' 		=> '',
		'current' 		=> max( 1, get_query_var('paged') ),
		'total' 		=> $pages,		
        'type'			=> 'list',
        'prev_text'     => $prev,
        'next_text'     => $next,
		'end_size'		=> 3,
		'mid_size'		=> 3
    );
    $return =  paginate_links( $pagination );
	echo str_replace( "<ul class='page-numbers'>", '', $return );
}

/* Custom form search */
function cloudme_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="search-form blogsearch" action="' . home_url( '/' ) . '" >  
    	<input class="form-control" type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="'.esc_html__('Search & Press Enter', 'cloudme').'" />
    </form>';
    return $form;
}
add_filter( 'get_search_form', 'cloudme_search_form' );

/* Custom comment List: */
function cloudme_theme_comment($comment, $args, $depth) {    
   $GLOBALS['comment'] = $comment; ?>

    <li class="comment">
        <div class="comment-body" id="comment-<?php comment_ID(); ?>">
            <div class="comment-author vcard">
                <?php echo get_avatar($comment,$size='80',$default='http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536' ); ?>
                <h6><?php printf(esc_html__('%s','cloudme'), get_comment_author()) ?></h6>
                <div class="comment-time"><a href=""><?php the_time('F d, Y'); ?></a></div>
            </div>
            <div class="comment-meta commentmetadata">
                <?php if ($comment->comment_approved == '0'){ ?>
                     <p><em><?php esc_html_e('Your comment is awaiting moderation.','cloudme') ?></em></p>
                <?php }else{ ?>
                    <?php comment_text() ?>
                <?php } ?>
                <div class="reply">
                    <span class="comment-reply-link"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
                </div>
            </div>
        </div>
    </li>
   
<?php
}

//Code Visual Compurso.
require_once get_template_directory() . '/vc_shortcode.php';

// Add new Param in Row
if(function_exists('vc_add_param')){

vc_add_param('vc_row',array(
                              "type" => "dropdown",
                              "heading" => esc_html__('Fullwidth', 'cloudme'),
                              "param_name" => "fullwidth",
                              "value" => array(   
                                                esc_html__('No', 'cloudme') => 'no',  
                                                esc_html__('Yes', 'cloudme') => 'yes',                                                                                
                                              ),
                              "description" => esc_html__("Select Fullwidth or not, Default: No fullwidth", "cloudme"),      
                            ) 
    );
	
	
vc_remove_param( "vc_row", "parallax" );
vc_remove_param( "vc_row", "parallax_image" );
vc_remove_param( "vc_row", "parallax_speed_bg" );
vc_remove_param( "vc_row", "parallax_speed_video" );
vc_remove_param( "vc_row", "full_width" );
vc_remove_param( "vc_row", "full_height" );
vc_remove_param( "vc_row", "video_bg" );
vc_remove_param( "vc_row", "video_bg_parallax" );
vc_remove_param( "vc_row", "content_placement" );
vc_remove_param( "vc_row", "video_bg_url" );
vc_remove_param( "vc_row", "columns_placement" );
vc_remove_param( "vc_row", "gap" );
vc_remove_param( "vc_row", "equal_height" );
vc_remove_element( "vc_basic_grid" );
vc_remove_element( "vc_masonry_grid" );
vc_remove_element( "vc_media_grid" );
vc_remove_element( "vc_masonry_media_grid" );
}
//}

/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.5.0-alpha
 * @author     Thomas Griffin
 * @author     Gary Jones
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/framework/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'cloudme_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function cloudme_theme_register_required_plugins() {

    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $protocol = is_ssl() ? 'http' : 'http';
    $plugins = array(

        // Plugin Download the http://wordpress.org
        array(
            'name'               => 'Meta Box',
            'slug'               => 'meta-box',
            'required'           => true,
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(            
            'name'               => 'WPBakery Visual Composer', // The plugin name.
            'slug'               => 'js_composer', // The plugin slug (typically the folder name).
            'source'             => $protocol.'://oceanthemes.net/plugins-required/js_composer.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ),
        array(
            'name'                     => 'WHMCS Bridge', // The plugin name
            'slug'                     => 'whmcs-bridge', // The plugin slug (typically the folder name)
            'required'                 => false, // If false, the plugin is only 'recommended' instead of required
        ),

        // This is an example of how to include a plugin from a private repo in your theme.

        array(            
            'name'               => 'OT Testimonial', // The plugin name.
            'slug'               => 'ot_testimonial', // The plugin slug (typically the folder name).
            'source'             => $protocol.'://oceanthemes.net/plugins-required/donald/ot_testimonial.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
        array(
            'name'                     => 'Contact Form 7', // The plugin name
            'slug'                     => 'contact-form-7', // The plugin slug (typically the folder name)
            'required'                 => false, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name'                     => 'Newsletter', // The plugin name
            'slug'                     => 'newsletter', // The plugin slug (typically the folder name)
            'required'                 => false, // If false, the plugin is only 'recommended' instead of required
        ),
        
    );

    /*
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are wrapped in a sprintf(), so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => esc_html__( 'Install Required Plugins', 'cloudme' ),
            'menu_title'                      => esc_html__( 'Install Plugins', 'cloudme' ),
            'installing'                      => esc_html__( 'Installing Plugin: %s', 'cloudme' ), // %s = plugin name.
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'cloudme' ),
            'notice_can_install_required'     => _n_noop(
                'This theme requires the following plugin: %1$s.',
                'This theme requires the following plugins: %1$s.',
                'cloudme'
            ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop(
                'This theme recommends the following plugin: %1$s.',
                'This theme recommends the following plugins: %1$s.',
                'cloudme'
            ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop(
                'Sorry, but you do not have the correct permissions to install the %s plugin.',
                'Sorry, but you do not have the correct permissions to install the %s plugins.',
                'cloudme'
            ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop(
                'The following required plugin is currently inactive: %1$s.',
                'The following required plugins are currently inactive: %1$s.',
                'cloudme'
            ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop(
                'The following recommended plugin is currently inactive: %1$s.',
                'The following recommended plugins are currently inactive: %1$s.',
                'cloudme'
            ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop(
                'Sorry, but you do not have the correct permissions to activate the %s plugin.',
                'Sorry, but you do not have the correct permissions to activate the %s plugins.',
                'cloudme'
            ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop(
                'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
                'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
                'cloudme'
            ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop(
                'Sorry, but you do not have the correct permissions to update the %s plugin.',
                'Sorry, but you do not have the correct permissions to update the %s plugins.',
                'cloudme'
            ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop(
                'Begin installing plugin',
                'Begin installing plugins',
                'cloudme'
            ),
            'activate_link'                   => _n_noop(
                'Begin activating plugin',
                'Begin activating plugins',
                'cloudme'
            ),
            'return'                          => esc_html__( 'Return to Required Plugins Installer', 'cloudme' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'cloudme' ),
            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'cloudme' ), // %s = dashboard link.
            'contact_admin'                   => esc_html__( 'Please contact the administrator of this site for help.', 'cloudme' ),

            'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}

?>