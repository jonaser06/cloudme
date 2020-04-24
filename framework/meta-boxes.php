<?php

/**
 * Register meta boxes
 *
 * @since 1.0
 *
 * @param array $meta_boxes
 *
 * @return array
 */

function cloudme_register_meta_boxes( $meta_boxes ) {



	$prefix = '_cmb_';

	// Post format

	$meta_boxes[] = array(

		'id'       => 'format_detail',

		'title'    => esc_html__( 'Format Details', 'cloudme' ),

		'pages'    => array( 'post' ),

		'context'  => 'normal',

		'priority' => 'high',

		'autosave' => true,

		'fields'   => array(

			array(

				'name'             => esc_html__( 'Image', 'cloudme' ),

				'id'               => $prefix . 'image',

				'type'             => 'image_advanced',

				'class'            => 'image',

				'max_file_uploads' => 1,

			),

			array(

				'name'  => esc_html__( 'Gallery', 'cloudme' ),

				'id'    => $prefix . 'images',

				'type'  => 'image_advanced',

				'class' => 'gallery',

			),

			array(

				'name'  => esc_html__( 'Quote', 'cloudme' ),

				'id'    => $prefix . 'quote',

				'type'  => 'textarea',

				'cols'  => 20,

				'rows'  => 2,

				'class' => 'quote',

			),

			array(

				'name'  => esc_html__( 'Author', 'cloudme' ),

				'id'    => $prefix . 'quote_author',

				'type'  => 'text',

				'class' => 'quote',

			),

			array(

				'name'  => esc_html__( 'Audio', 'cloudme' ),

				'id'    => $prefix . 'link_audio',

				'type'  => 'textarea',

				'cols'  => 20,

				'rows'  => 2,

				'class' => 'audio',

				'desc' => 'Ex: https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/139083759',

			),

			array(

				'name'  => esc_html__( 'Video', 'cloudme' ),

				'id'    => $prefix . 'link_video',

				'type'  => 'textarea',

				'cols'  => 20,

				'rows'  => 2,

				'class' => 'video',

				'desc' => 'Example: <b>http://www.youtube.com/embed/0ecv0bT9DEo</b> or <b>http://player.vimeo.com/video/47355798</b>',

			),			

		),

	);

	
	$meta_boxes[] = array(

		'id'       => 'testi_dt',

		'title'    => esc_html__( 'Testimonial Details', 'cloudme' ),

		'pages'    => array( 'testimonial' ),

		'context'  => 'normal',

		'priority' => 'high',

		'autosave' => true,

		'fields'   => array(				

			array(

				'name'  => esc_html__( 'Extra Info', 'cloudme' ),

				'id'    => $prefix . 'info',

				'type'  => 'textarea',

				'cols'  => 20,

				'rows'  => 2,

			),
			array(

				'name'             => esc_html__( 'Testimoial Image', 'cloudme' ),

				'id'               => $prefix . 'testi_image',

				'type'             => 'image_advanced',

				'max_file_uploads' => 1,

			),
			array(

				'name'  => esc_html__( 'Testimoial Video', 'cloudme' ),

				'id'    => $prefix . 'testi_video',

				'type'  => 'textarea',

				'cols'  => 20,

				'rows'  => 2,

				'desc' => 'Example: <b>http://www.youtube.com/embed/0ecv0bT9DEo</b> or <b>http://player.vimeo.com/video/47355798</b>',

			),				

		),

	);

	$meta_boxes[] = array(

		'id'       => 'page_dt',

		'title'    => esc_html__( 'Page Details', 'cloudme' ),

		'pages'    => array( 'page' ),

		'context'  => 'normal',

		'priority' => 'high',

		'autosave' => true,

		'fields'   => array(				

			array(

				'name'  => esc_html__( 'Page Subtitle', 'cloudme' ),

				'id'    => $prefix . 'page_sub',

				'type'  => 'text',

				'class' => '',

			),
			array(

				'name'  => esc_html__( 'Color Subtitle', 'cloudme' ),

				'id'    => $prefix . 'color_sub',

				'type'  => 'color',

			),
			array(

				'name'             => esc_html__( 'Background Image Header', 'cloudme' ),

				'id'               => $prefix . 'bg_header',

				'type'             => 'image_advanced',

				'max_file_uploads' => 1,

			),		

		),

	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'cloudme_register_meta_boxes' );

/**
 * Enqueue scripts for admin
 *
 * @since  1.0
 */
function cloudme_admin_enqueue_scripts( $hook ) {
	// Detect to load un-minify scripts when WP_DEBUG is enable
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
		wp_enqueue_script( 'cloudme-backend-js', get_template_directory_uri()."/js/admin.js", array( 'jquery' ), '1.0.0', true );
	}
}
add_action( 'admin_enqueue_scripts', 'cloudme_admin_enqueue_scripts' );

