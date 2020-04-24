<?php
/**
 * Register default theme options fields
 *
 * @package CloudMe
 */


/**
 * Register theme options fields
 *
 * @since  1.0
 *
 * @return array Theme options fields
 */
function cloudme_theme_option_fields() {
	$options = array();

	// Help information
	$options['help'] = array(
		'document' => 'http://vegatheme.com/docs/cloudme/',
		'support' => 'http://vegatheme.com/support/cloudme/',
	);


	// Sections
	$options['sections'] = array(
		'general' => array(
			'icon' => 'cog',
			'title' => esc_html__( 'General', 'cloudme' ),
		),
		'header' => array(
			'icon' => 'list',
			'title' => esc_html__( 'Header', 'cloudme' ),
		),
		'content' => array(
			'icon' => 'news',
			'title' => esc_html__( 'Blog', 'cloudme' ),
		),
		'whmcs' => array(
			'icon' => 'bell',
			'title' => esc_html__( 'WHMCS', 'cloudme' ),
		),
		'footer' => array(
			'icon' => 'rss',
			'title' => esc_html__( 'Footer', 'cloudme' ),
		),
		'style' => array(
			'icon' => 'palette',
			'title' => esc_html__( 'Style', 'cloudme' ),
		),
		'export' => array(
			'icon' => 'upload-to-cloud',
			'title' => esc_html__( 'Backup - Restore', 'cloudme' ),
		),
	);

	// Fields
	$options['fields'] = array();
	$options['fields']['general'] = array(
		array(
			'name' => 'logo',
			'label' => esc_html__( 'Logo', 'cloudme' ),
			'type' => 'image',
		),
		array(
			'name' => 'home_screen_icons',
			'label' => esc_html__( 'Home Screen Icons', 'cloudme' ),
			'desc' => esc_html__( 'Select image file that will be displayed on home screen of handheld devices.', 'cloudme' ),
			'type' => 'group',
			'children' => array(
				array(
					'name' => 'icon_ipad_retina',
					'type' => 'icon',
					'subdesc' => esc_html__( 'IPad Retina (144x144px)', 'cloudme' ),
				),
				array(
					'name' => 'icon_ipad',
					'type' => 'icon',
					'subdesc' => esc_html__( 'IPad (72x72px)', 'cloudme' ),
				),

				array(
					'name' => 'icon_iphone_retina',
					'type' => 'icon',
					'subdesc' => esc_html__( 'IPhone Retina (114x114px)', 'cloudme' ),
				),

				array(
					'name' => 'icon_iphone',
					'type' => 'icon',
					'subdesc' => esc_html__( 'IPhone (57x57px)', 'cloudme' ),
				)
			)
		),
		
	);

	$options['fields']['header'] = array(
		array(
			'name' => 'stickymenu',
			'label' => esc_html__( 'Sticky Menu', 'cloudme' ),
			'desc' => esc_html__( 'Enable sticky the menu on the top of site', 'cloudme' ),
			'type' => 'switcher',
			'default' => 0,
		),
		array(
			'name' => 'bg_nav',
			'label' => esc_html__( 'Background Navigation', 'cloudme' ),
			'type' => 'color',
		),
		array(
			'name' => 'bg_snav',
			'label' => esc_html__( 'Background Scroll Navigation', 'cloudme' ),
			'type' => 'color',
		),
		array(
			'name' => 'color_nav',
			'label' => esc_html__( 'Color Menu', 'cloudme' ),
			'type' => 'color',
		),
		array(
			'name' => 'pheader_h',
			'label' => esc_html__( 'Page Header Height', 'cloudme' ),
			'type' => 'number',
			'size' => 'small',
		),
	);

	$options['fields']['content'] = array(
		array(
			'name' => 'bg_head',
			'label' => esc_html__( 'Background Page Header', 'cloudme' ),
			'type' => 'image',
		),
		array(
			'name' => 'excerpt_length',
			'label' => esc_html__( 'Excerpt Length', 'cloudme' ),
			'type' => 'number',
			'size' => 'small',
			'default' => 30,
		),
		array(
			'name' => 'title_single',
			'label' => esc_html__( 'Title Single Blog', 'cloudme' ),
			'type' => 'text',
			'size' => 'medium'
		),
		array(
			'name' => 'author_post',
			'label' => esc_html__( 'Show Author Info', 'cloudme' ),
			'desc' => esc_html__( 'Enable author info on the single blog', 'cloudme' ),
			'type' => 'switcher',
			'default' => 1,
		),
	);

	$options['fields']['whmcs'] = array(
		array(
			'name' => 'whmcs_top',
			'label' => esc_html__( 'Background Header', 'cloudme' ),
			'desc' => esc_html__( 'Upload background image header WHMCS page', 'cloudme' ),
			'type' => 'image',
		),
		array(
			'name' => 'whmcs_banner',
			'label' => esc_html__( 'Background Banner', 'cloudme' ),
			'desc' => esc_html__( 'Upload background image banner WHMCS page', 'cloudme' ),
			'type' => 'image',
		),
	);

	$options['fields']['footer'] = array(
		array(
			'name' => 'topfooter',
			'label' => esc_html__( 'Top Footer', 'cloudme' ),
			'type' => 'switcher',
			'default' => 1,
		),
		array(
			'name' => 'address',
			'label' => esc_html__( 'Address', 'cloudme' ),
			'type' => 'text',
			'size' => 'medium'
		),
		array(
			'name' => 'phone',
			'label' => esc_html__( 'Phone Number', 'cloudme' ),
			'type' => 'text',
			'size' => 'medium'
		),
		array(
			'name' => 'livechat',
			'label' => esc_html__( 'Live Chat Link', 'cloudme' ),
			'type' => 'text',
			'size' => 'medium'
		),
		array(
			'name' => 'email',
			'label' => esc_html__( 'Email Link', 'cloudme' ),
			'type' => 'text',
			'size' => 'medium'
		),
		array(
			'name' => 'copyr',
			'label' => esc_html__( 'Copyright Text', 'cloudme' ),
			'type' => 'editor',
		),
		array(
			'name' => 'footer_color',
			'label' => esc_html__( 'Footer Background', 'cloudme' ),
			'type' => 'background',
		),
		array(
			'name' => 'socials',
			'label' => esc_html__( 'Socials', 'cloudme' ),
			'type' => 'social',
			'subdesc' => esc_html__( 'Click to social icon to add link', 'cloudme' ),
		),
	);

	$options['fields']['style'] = array(
		array(
			'name' => 'custom_color_scheme',
			'label' => esc_html__( 'Custom Color Scheme', 'cloudme' ),
			'desc' => esc_html__( 'Enable custom color scheme to pick your own color scheme', 'cloudme' ),
			'type' => 'group',
			'layout' => 'vertical',
			'children' => array(
				array(
					'name' => 'custom_color_scheme',
					'type' => 'switcher',
					'default' => false,
				),
				array(
					'name' => 'custom_color_1',
					'type' => 'color',
					'subdesc' => esc_html__( 'Custom Primary Color', 'cloudme' ),
				),
				array(
					'name' => 'custom_color_2',
					'type' => 'color',
					'subdesc' => esc_html__( 'Custom Secondary Color', 'cloudme' ),
				),
			)
		),
		array(
			'type' => 'divider',
		),
		array(
			'name'  => 'gg_map',
			'label' => esc_html__( 'Google Map API Key', 'cloudme' ),
			'type'  => 'text',
			'default' => 'AIzaSyAvpnlHRidMIU374bKM5-sx8ruc01OvDjI',
		),
		array(
			'name' => 'custom_css',
			'label' => esc_html__( 'Custom CSS', 'cloudme' ),
			'type' => 'code_editor',
			'language' => 'css',
			'subdesc' => esc_html__( 'Enter your custom style rules here', 'cloudme' )
		),
	);
	
	$options['fields']['export'] = array(
		array(
			'name' => 'backup',
			'label' => esc_html__( 'Backup Settings', 'cloudme' ),
			'subdesc' => esc_html__( 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options" button above', 'cloudme' ),
			'type' => 'backup',
		),
	);

	return $options;
}

add_filter( 'cloudme_theme_options', 'cloudme_theme_option_fields' );

/**
 * Generate custom color scheme css
 *
 * @since 1.0
 */
function cloudme_generate_custom_color_scheme() {
	parse_str( $_POST['data'], $data );

	if ( ! isset( $data['custom_color_scheme'] ) || ! $data['custom_color_scheme'] ) {
		return;
	}

	$color_1 = $data['custom_color_1'];
	$color_2 = $data['custom_color_2'];
	if ( ! $color_1 && ! $color_2 ) {
		return;
	}

	// Getting credentials
	$url = wp_nonce_url( 'themes.php?page=theme-options' );
	if ( false === ( $creds = request_filesystem_credentials( $url, '', false, false, null ) ) ) {
		return; // stop the normal page form from displaying
	}

	// Try to get the wp_filesystem running
	if ( ! WP_Filesystem( $creds ) ) {
		// Ask the user for them again
		request_filesystem_credentials( $url, '', true, false, null );
		return;
	}

	global $wp_filesystem;

	// Prepare LESS to compile
	$less = $wp_filesystem->get_contents( get_template_directory() . '/css/color-schemes.less' );
	if(  $color_1 ) {
		$less .= ".color-scheme($color_1);";
	}
	
	if(  $color_2 ) {
		$less .= ".color-scheme-2($color_2);";
	}

	// Compile
	require get_template_directory() . '/framework/theme-options/lessc.inc.php';
	$compiler = new lessc;
	$compiler->setFormatter( 'compressed' );
	$css = $compiler->compile( $less );

	// Get file path
	$upload_dir = wp_upload_dir();
	$dir = path_join( $upload_dir['basedir'], 'custom-css' );
	$file = $dir . '/color-scheme.css';

	// Create directory if it doesn't exists
	wp_mkdir_p( $dir );
	$wp_filesystem->put_contents( $file, $css, FS_CHMOD_FILE );


	wp_send_json_success();
}

add_action( 'cloudme_ajax_generate_custom_css', 'cloudme_generate_custom_color_scheme' );

/**
 * Load script for theme options
 *
 * @since 1.0.0
 *
 * @param string $hook
 */
function cloudme_enqueue_admin_scripts( $hook ) {
	if ( 'appearance_page_theme-options' != $hook ) {
		return;
	}

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

}

add_action( 'admin_enqueue_scripts', 'cloudme_enqueue_admin_scripts' );
