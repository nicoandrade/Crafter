<?php
/**
 * Crafter Theme Customizer.
 *
 * @package Crafter
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function crafter_customize_register( $wp_customize ) {

	/**
	 * Control for the PRO buttons
	 */
	class crafter_Pro_Version extends WP_Customize_Control{
		public function render_content()
		{
			$args = array(
				'a' => array(
					'href' => array(),
					'title' => array()
					),
				'br' => array(),
				'em' => array(),
				'strong' => array(),
				);
			echo wp_kses( $this->label, $args );
		}
	}

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';


	/*
    Colors
    ===================================================== */
		/*
		Text
		------------------------------ */
		$wp_customize->add_setting( 'crafter_text_color', array( 'default' => '#999999', 'transport' => 'postMessage', 'sanitize_callback' => 'sanitize_hex_color', ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'crafter_text_color', array(
			'label'        => esc_attr__( 'Text Color', 'crafter' ),
			'section'    => 'colors',
		) ) );

		/*
		Link
		------------------------------ */
		$wp_customize->add_setting( 'crafter_link_color', array( 'default' => '#e9ac40', 'transport' => 'postMessage', 'sanitize_callback' => 'sanitize_hex_color', ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'crafter_link_color', array(
			'label'        => esc_attr__( 'Link Color', 'crafter' ),
			'section'    => 'colors',
		) ) );


	/*
	Get Sections order
	------------------------------ */
	$sections_items = get_option( 'crafter_sortable_items' );
	$sections_sorted = array();
	if ( ! empty( $sections_items ) ) {
		foreach ( $sections_items as $key => $value ) {
			$sections_sorted[$value] = ( $key + 1 ) * 10;
		}
	}else{
		//Default order
		$sections_sorted['crafter_welcome_section'] = 10;
	    $sections_sorted['crafter_services_section'] = 20;
	    $sections_sorted['crafter_about_section'] = 30;
	    $sections_sorted['crafter_video_section'] = 40;
	    $sections_sorted['crafter_bullet_points_section'] = 50;
	    $sections_sorted['crafter_pricing_section'] = 60;
	    $sections_sorted['crafter_clients_section'] = 70;
	    $sections_sorted['crafter_testimonials_section'] = 80;
	    $sections_sorted['crafter_blog_section'] = 90;

	}



	/*
    Sections
    ===================================================== */
    $wp_customize->add_panel( 'crafter_front_page_sections', array(
		'title' => esc_attr__( 'Front Page Sections', 'crafter' ),
		'description' => '', // Include html tags such as <p>.
		'priority' => 160,
		'active_callback' => 'is_front_page',
	) );

    	/*
    	Welcome
    	------------------------------ */
    	$wp_customize->add_section( 'crafter_welcome_section', array(
			'title' => esc_attr__( 'Welcome', 'crafter' ),
			'description' => esc_attr__( 'Display a big image and welcome message.', 'crafter' ),
			'panel' => 'crafter_front_page_sections',
			'priority' => $sections_sorted['crafter_welcome_section'],
		) );

		$wp_customize->add_setting( 'crafter_welcome_title', array( 'default' => esc_attr__( 'Meet Crafter, your next WordPress Theme', 'crafter' ), 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_text', ) );
		$wp_customize->add_control( 'crafter_welcome_title', array(
			'type' => 'text',
			'section' => 'crafter_welcome_section', // Required, core or custom.
			'label' => esc_attr__( 'Welcome Message', 'crafter' ),
		) );

		$wp_customize->add_setting( 'crafter_welcome_text', array( 'default' => esc_html__( 'The perfect theme for your bussiness or corporate site. Responsive and beautiful design will make your site stand out!.', 'crafter' ), 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_textarea', ) );
		$wp_customize->add_control( 'crafter_welcome_text', array(
			'type' => 'textarea',
			'section' => 'crafter_welcome_section', // Required, core or custom.
			'label' => esc_attr__( 'Text', 'crafter' ),
			//'description' => esc_attr__( '', 'crafter' ),
		) );

		$wp_customize->add_setting( 'crafter_welcome_link_title', array( 'default' => esc_html__( 'Learn More', 'crafter' ), 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_text', ) );
		$wp_customize->add_control( 'crafter_welcome_link_title', array(
			'type' => 'text',
			'section' => 'crafter_welcome_section', // Required, core or custom.
			'label' => esc_attr__( "Link Title", 'crafter' ),
		) );

		$wp_customize->add_setting( 'crafter_welcome_link_url', array( 'default' => '#', 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_url', ) );
		$wp_customize->add_control( 'crafter_welcome_link_url', array(
			'type' => 'url',
			'section' => 'crafter_welcome_section', // Required, core or custom.
			'label' => esc_attr__( "Link URL", 'crafter' ),
		) );

		$wp_customize->add_setting( 'crafter_welcome_image', array( 'default' => '', 'transport' => 'postMessage', 'sanitize_callback' => 'attachment_url_to_postid', ) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'crafter_welcome_image', array(
	        'label'    => esc_attr__( 'Welcome Image', 'crafter' ),
	        'section'  => 'crafter_welcome_section',
	        'settings' => 'crafter_welcome_image',
		) ) );

		$wp_customize->add_setting( 'crafter_welcome_enable', array( 'default' => true, 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_bool', ) );
	    $wp_customize->add_control( 'crafter_welcome_enable', array(
			'section' => 'crafter_welcome_section', // Required, core or custom.
			'label' => esc_attr__( "Use this section?", 'crafter' ),
			'type'    => 'checkbox',
		) );

    	/*
    	Services
    	------------------------------ */
    	$wp_customize->add_section( 'crafter_services_section', array(
			'title' => esc_attr__( 'Services', 'crafter' ),
			'description' => esc_attr__( 'Display services with icons.', 'crafter' ),
			'panel' => 'crafter_front_page_sections',
			'priority' => $sections_sorted['crafter_services_section'],
		) );

		$wp_customize->add_setting( 'crafter_services_title', array( 'default' => esc_attr__( 'What We Do', 'crafter' ), 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_text', ) );
		$wp_customize->add_control( 'crafter_services_title', array(
			'type' => 'text',
			'section' => 'crafter_services_section', // Required, core or custom.
			'label' => esc_attr__( 'Title', 'crafter' ),
		) );

		$wp_customize->add_setting( 'crafter_services_text', array( 'default' => '', 'sanitize_callback' => 'crafter_sanitize_text', ) );
		$wp_customize->add_control( new crafter_Display_Text_Control( $wp_customize, 'crafter_services_text', array(
			'section' => 'crafter_services_section', // Required, core or custom.
			'label' => __( 'To add services go to: <br><a href="#" data-section="sidebar-widgets-services-section">Customize -> Widgets -> Front Page - Service Section</a>. <br>Then add the "<strong>Crafter - Service widget</strong>"', 'crafter' ),
		) ) );

		$wp_customize->add_setting( 'crafter_services_enable', array( 'default' => true, 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_bool', ) );
	    $wp_customize->add_control( 'crafter_services_enable', array(
			'section' => 'crafter_services_section', // Required, core or custom.
			'label' => esc_attr__( "Use this section?", 'crafter' ),
			'type'    => 'checkbox',
		) );

    	/*
    	About
    	------------------------------ */
		$wp_customize->add_section( 'crafter_about_section', array(
			'title' => esc_attr__( 'About', 'crafter' ),
			'description' => esc_attr__( 'Display images and descriptions.', 'crafter' ),
			'panel' => 'crafter_front_page_sections',
			'priority' => $sections_sorted['crafter_about_section'],
		) );

		$wp_customize->add_setting( 'crafter_about_title', array( 'default' => esc_attr__( 'About Us', 'crafter' ), 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_text', ) );
		$wp_customize->add_control( 'crafter_about_title', array(
			'type' => 'text',
			'section' => 'crafter_about_section', // Required, core or custom.
			'label' => esc_attr__( 'Section Title', 'crafter' ),
		) );

		$wp_customize->add_setting( 'crafter_about_title1', array( 'default' => esc_attr__( 'Successful Projects', 'crafter' ), 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_text', ) );
		$wp_customize->add_control( 'crafter_about_title1', array(
			'type' => 'text',
			'section' => 'crafter_about_section', // Required, core or custom.
			'label' => esc_attr__( 'Title 1', 'crafter' ),
		) );

		$wp_customize->add_setting( 'crafter_about_text1', array( 'default' => esc_html__( 'Maecenas sed diam eget risus varius blandit sit amet non magna. Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.', 'crafter' ), 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_textarea', ) );
		$wp_customize->add_control( 'crafter_about_text1', array(
			'type' => 'textarea',
			'section' => 'crafter_about_section', // Required, core or custom.
			'label' => esc_attr__( 'Quote 1', 'crafter' ),
			//'description' => esc_attr__( '', 'crafter' ),
		) );


		$wp_customize->add_setting( 'crafter_about_title2', array( 'default' => esc_attr__( 'Hard Work', 'crafter' ), 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_text', ) );
		$wp_customize->add_control( 'crafter_about_title2', array(
			'type' => 'text',
			'section' => 'crafter_about_section', // Required, core or custom.
			'label' => esc_attr__( 'Title 2', 'crafter' ),
		) );

		$wp_customize->add_setting( 'crafter_about_text2', array( 'default' => esc_html__( 'Maecenas sed diam eget risus varius blandit sit amet non magna. Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.', 'crafter' ), 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_textarea', ) );
		$wp_customize->add_control( 'crafter_about_text2', array(
			'type' => 'textarea',
			'section' => 'crafter_about_section', // Required, core or custom.
			'label' => esc_attr__( 'Quote 2', 'crafter' ),
			//'description' => esc_attr__( '', 'crafter' ),
		) );


		$wp_customize->add_setting( 'crafter_about_title3', array( 'default' => esc_attr__( 'Creative Ideas', 'crafter' ), 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_text', ) );
		$wp_customize->add_control( 'crafter_about_title3', array(
			'type' => 'text',
			'section' => 'crafter_about_section', // Required, core or custom.
			'label' => esc_attr__( 'Title 3', 'crafter' ),
		) );

		$wp_customize->add_setting( 'crafter_about_text3', array( 'default' => esc_html__( 'Maecenas sed diam eget risus varius blandit sit amet non magna. Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.', 'crafter' ), 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_textarea', ) );
		$wp_customize->add_control( 'crafter_about_text3', array(
			'type' => 'textarea',
			'section' => 'crafter_about_section', // Required, core or custom.
			'label' => esc_attr__( 'Quote 3', 'crafter' ),
			//'description' => esc_attr__( '', 'crafter' ),
		) );

		

		$wp_customize->add_setting( 'crafter_about_image1', array( 'default' => '', 'transport' => 'postMessage', 'sanitize_callback' => 'attachment_url_to_postid', ) );
	    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'crafter_about_image1', array(
	        'label'    => esc_attr__( 'Image 1', 'crafter' ),
	        'section'  => 'crafter_about_section',
	        'settings' => 'crafter_about_image1',
	    ) ) );

	    $wp_customize->add_setting( 'crafter_about_image2', array( 'default' => '', 'transport' => 'postMessage', 'sanitize_callback' => 'attachment_url_to_postid', ) );
	    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'crafter_about_image2', array(
	        'label'    => esc_attr__( 'Image 2', 'crafter' ),
	        'section'  => 'crafter_about_section',
	        'settings' => 'crafter_about_image2',
	    ) ) );

	    $wp_customize->add_setting( 'crafter_about_image3', array( 'default' => '', 'transport' => 'postMessage', 'sanitize_callback' => 'attachment_url_to_postid', ) );
	    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'crafter_about_image3', array(
	        'label'    => esc_attr__( 'Image 3', 'crafter' ),
	        'section'  => 'crafter_about_section',
	        'settings' => 'crafter_about_image3',
	    ) ) );

	    $wp_customize->add_setting( 'crafter_about_image4', array( 'default' => '', 'transport' => 'postMessage', 'sanitize_callback' => 'attachment_url_to_postid', ) );
	    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'crafter_about_image4', array(
	        'label'    => esc_attr__( 'Image 4', 'crafter' ),
	        'section'  => 'crafter_about_section',
	        'settings' => 'crafter_about_image4',
	    ) ) );

		$wp_customize->add_setting( 'crafter_about_enable', array( 'default' => true, 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_bool', ) );
	    $wp_customize->add_control( 'crafter_about_enable', array(
			'section' => 'crafter_about_section', // Required, core or custom.
			'label' => esc_attr__( "Use this section?", 'crafter' ),
			'type'    => 'checkbox',
		) );

		/*
    	Video
    	------------------------------ */
		$wp_customize->add_section( 'crafter_video_section', array(
			'title' => esc_attr__( 'Video', 'crafter' ),
			'description' => esc_attr__( 'Display a video from YouTube or Vimeo and text aside.', 'crafter' ),
			'panel' => 'crafter_front_page_sections',
			'priority' => $sections_sorted['crafter_video_section'],
		) );

		$wp_customize->add_setting( 'crafter_video_url', array( 'default' => 'https://vimeo.com/137643804', 'sanitize_callback' => 'crafter_sanitize_url', ) );
		$wp_customize->add_control( 'crafter_video_url', array(
			'type' => 'url',
			'section' => 'crafter_video_section', // Required, core or custom.
			'label' => esc_attr__( "Video URL", 'crafter' ),
			'description' => esc_attr__( "Must be a YouTube or Vimeo URL", 'crafter' ),
		) );

		/* translators: Lorem ipsum text, It is not strictly necessary to translate. */
		$wp_customize->add_setting( 'crafter_video_title', array( 'default' => esc_html__( 'Praesent commodo cursus magna, vel scelerisque nisl consectetur et', 'crafter' ), 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_text', ) );
		$wp_customize->add_control( 'crafter_video_title', array(
			'type' => 'text',
			'section' => 'crafter_video_section', // Required, core or custom.
			'label' => esc_attr__( "Title", 'crafter' ),
		) );

		/* translators: Lorem ipsum text, It is not strictly necessary to translate. */
		$wp_customize->add_setting( 'crafter_video_text', array( 'default' => esc_html__( 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Nullam quis risus eget urna mollis ornare vel eu leo. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Praesent commodo cursus magna.', 'crafter' ), 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_text_html', ) );
		$wp_customize->add_control( 'crafter_video_text', array(
			'type' => 'textarea',
			'section' => 'crafter_video_section', // Required, core or custom.
			'label' => esc_attr__( 'Text', 'crafter' ),
		) );

		$wp_customize->add_setting( 'crafter_video_link_title', array( 'default' => esc_html__( 'Learn More', 'crafter' ), 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_text', ) );
		$wp_customize->add_control( 'crafter_video_link_title', array(
			'type' => 'text',
			'section' => 'crafter_video_section', // Required, core or custom.
			'label' => esc_attr__( "Link Title", 'crafter' ),
		) );

		$wp_customize->add_setting( 'crafter_video_link_url', array( 'default' => '', 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_url', ) );
		$wp_customize->add_control( 'crafter_video_link_url', array(
			'type' => 'url',
			'section' => 'crafter_video_section', // Required, core or custom.
			'label' => esc_attr__( "Link URL", 'crafter' ),
		) );

		$wp_customize->add_setting( 'crafter_video_enable', array( 'default' => true, 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_bool', ) );
	    $wp_customize->add_control( 'crafter_video_enable', array(
			'section' => 'crafter_video_section', // Required, core or custom.
			'label' => esc_attr__( "Use this section?", 'crafter' ),
			'type'    => 'checkbox',
		) );


		/*
    	Bullet Points
    	------------------------------ */
		$wp_customize->add_section( 'crafter_bullet_points_section', array(
			'title' => esc_attr__( 'Bullet Points', 'crafter' ),
			'description' => esc_attr__( 'Display bullet points and information.', 'crafter' ),
			'panel' => 'crafter_front_page_sections',
			'priority' => $sections_sorted['crafter_bullet_points_section'],
		) );

		$wp_customize->add_setting( 'crafter_bullet_points_title', array( 'default' => esc_attr__( 'Impactful Projects', 'crafter' ), 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_text', ) );
		$wp_customize->add_control( 'crafter_bullet_points_title', array(
			'type' => 'text',
			'section' => 'crafter_bullet_points_section', // Required, core or custom.
			'label' => esc_attr__( 'Main Title', 'crafter' ),
		) );

		$wp_customize->add_setting( 'crafter_bullet_points_main_desc', array( 'default' => esc_html__( 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Nullam quis risus eget urna mollis ornare vel eu leo. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Praesent commodo cursus magna.', 'crafter' ), 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_textarea', ) );
		$wp_customize->add_control( 'crafter_bullet_points_main_desc', array(
			'type' => 'textarea',
			'section' => 'crafter_bullet_points_section', // Required, core or custom.
			'label' => esc_attr__( 'Main Description', 'crafter' ),
			//'description' => esc_attr__( '', 'crafter' ),
		) );

		$wp_customize->add_setting( 'crafter_bullet_points_link_title', array( 'default' => esc_html__( 'Learn More', 'crafter' ), 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_text', ) );
		$wp_customize->add_control( 'crafter_bullet_points_link_title', array(
			'type' => 'text',
			'section' => 'crafter_bullet_points_section', // Required, core or custom.
			'label' => esc_attr__( "Link Title", 'crafter' ),
		) );

		$wp_customize->add_setting( 'crafter_bullet_points_link_url', array( 'default' => '#', 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_url', ) );
		$wp_customize->add_control( 'crafter_bullet_points_link_url', array(
			'type' => 'url',
			'section' => 'crafter_bullet_points_section', // Required, core or custom.
			'label' => esc_attr__( "Link URL", 'crafter' ),
		) );

		$wp_customize->add_setting( 'crafter_bullet_points_image', array( 'default' => '', 'transport' => 'postMessage', 'sanitize_callback' => 'attachment_url_to_postid', ) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'crafter_bullet_points_image', array(
	        'label'    => esc_attr__( 'Main Image', 'crafter' ),
	        'section'  => 'crafter_bullet_points_section',
	        'settings' => 'crafter_bullet_points_image',
		) ) );

		$wp_customize->add_setting( 'crafter_bullet_points_title1', array( 'default' => esc_attr__( 'Successful Projects', 'crafter' ), 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_text', ) );
		$wp_customize->add_control( 'crafter_bullet_points_title1', array(
			'type' => 'text',
			'section' => 'crafter_bullet_points_section', // Required, core or custom.
			'label' => esc_attr__( 'Title 1', 'crafter' ),
		) );

		$wp_customize->add_setting( 'crafter_bullet_points_text1', array( 'default' => esc_html__( '- Ornare Porta Vehicula
 - Tristique Commodo
 - Fermentum Cursus Sem
- Sit Justo', 'crafter' ), 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_textarea', ) );
		$wp_customize->add_control( 'crafter_bullet_points_text1', array(
			'type' => 'textarea',
			'section' => 'crafter_bullet_points_section', // Required, core or custom.
			'label' => esc_attr__( 'Description 1', 'crafter' ),
			//'description' => esc_attr__( '', 'crafter' ),
		) );


		$wp_customize->add_setting( 'crafter_bullet_points_title2', array( 'default' => esc_attr__( 'Hard Work', 'crafter' ), 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_text', ) );
		$wp_customize->add_control( 'crafter_bullet_points_title2', array(
			'type' => 'text',
			'section' => 'crafter_bullet_points_section', // Required, core or custom.
			'label' => esc_attr__( 'Title 2', 'crafter' ),
		) );

		$wp_customize->add_setting( 'crafter_bullet_points_text2', array( 'default' => esc_html__( '- Ornare Porta Vehicula
 - Tristique Commodo
 - Fermentum Cursus Sem
- Sit Justo', 'crafter' ), 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_textarea', ) );
		$wp_customize->add_control( 'crafter_bullet_points_text2', array(
			'type' => 'textarea',
			'section' => 'crafter_bullet_points_section', // Required, core or custom.
			'label' => esc_attr__( 'Description 2', 'crafter' ),
			//'description' => esc_attr__( '', 'crafter' ),
		) );


		$wp_customize->add_setting( 'crafter_bullet_points_title3', array( 'default' => esc_attr__( 'Creative Ideas', 'crafter' ), 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_text', ) );
		$wp_customize->add_control( 'crafter_bullet_points_title3', array(
			'type' => 'text',
			'section' => 'crafter_bullet_points_section', // Required, core or custom.
			'label' => esc_attr__( 'Title 3', 'crafter' ),
		) );

		$wp_customize->add_setting( 'crafter_bullet_points_text3', array( 'default' => esc_html__( '- Ornare Porta Vehicula
 - Tristique Commodo
 - Fermentum Cursus Sem
- Sit Justo', 'crafter' ), 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_textarea', ) );
		$wp_customize->add_control( 'crafter_bullet_points_text3', array(
			'type' => 'textarea',
			'section' => 'crafter_bullet_points_section', // Required, core or custom.
			'label' => esc_attr__( 'Description 3', 'crafter' ),
			//'description' => esc_attr__( '', 'crafter' ),
		) );

		$wp_customize->add_setting( 'crafter_bullet_points_title4', array( 'default' => esc_attr__( 'Creative Ideas', 'crafter' ), 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_text', ) );
		$wp_customize->add_control( 'crafter_bullet_points_title4', array(
			'type' => 'text',
			'section' => 'crafter_bullet_points_section', // Required, core or custom.
			'label' => esc_attr__( 'Title 4', 'crafter' ),
		) );

		$wp_customize->add_setting( 'crafter_bullet_points_text4', array( 'default' => esc_html__( '- Ornare Porta Vehicula
 - Tristique Commodo
 - Fermentum Cursus Sem
- Sit Justo', 'crafter' ), 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_textarea', ) );
		$wp_customize->add_control( 'crafter_bullet_points_text4', array(
			'type' => 'textarea',
			'section' => 'crafter_bullet_points_section', // Required, core or custom.
			'label' => esc_attr__( 'Description 4', 'crafter' ),
			//'description' => esc_attr__( '', 'crafter' ),
		) );

		$wp_customize->add_setting( 'crafter_bullet_points_enable', array( 'default' => true, 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_bool', ) );
		    $wp_customize->add_control( 'crafter_bullet_points_enable', array(
				'section' => 'crafter_bullet_points_section', // Required, core or custom.
				'label' => esc_attr__( "Use this section?", 'crafter' ),
				'type'    => 'checkbox',
			) );



		/*
    	Testimonial
    	------------------------------ */
    	if ( class_exists( 'Jetpack' ) ){

			$wp_customize->add_section( 'crafter_testimonials_section', array(
				'title' => esc_attr__( 'Testimonials', 'crafter' ),
				'description' => sprintf( __( 'To create a testimonial go to your <a href="%s">Admin Panel >> Testimonials >> Add New</a>.', 'crafter' ), get_admin_url( null, 'post-new.php?post_type=jetpack-testimonial' ) ),
				'panel' => 'crafter_front_page_sections',
				'priority' => $sections_sorted['crafter_testimonials_section'],
			) );

		    $wp_customize->add_setting( 'crafter_testimonial_enable', array( 'default' => true, 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_bool', ) );
		    $wp_customize->add_control( 'crafter_testimonial_enable', array(
				'section' => 'crafter_testimonials_section', // Required, core or custom.
				'label' => esc_attr__( "Use this section?", 'crafter' ),
				'type'    => 'checkbox',
			) );

		}


		
		

		/*
    	Clients
    	------------------------------ */
		$wp_customize->add_section( 'crafter_clients_section', array(
			'title' => esc_attr__( 'Clients', 'crafter' ),
			'description' => esc_attr__( "Display client's logos.", 'crafter' ),
			'panel' => 'crafter_front_page_sections',
			'priority' => $sections_sorted['crafter_clients_section'],
		) );

		$wp_customize->add_setting( 'crafter_clients_title', array( 'default' => esc_html__( 'People Who Trust Us', 'crafter' ), 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_text', ) );
		$wp_customize->add_control( 'crafter_clients_title', array(
			'type' => 'text',
			'section' => 'crafter_clients_section', // Required, core or custom.
			'label' => esc_attr__( "Section Title", 'crafter' ),
		) );

		$wp_customize->add_setting( 'crafter_clients_text', array( 'default' => '', 'sanitize_callback' => 'crafter_sanitize_text', ) );
		$wp_customize->add_control( new crafter_Display_Text_Control( $wp_customize, 'crafter_clients_text', array(
			'section' => 'crafter_clients_section', // Required, core or custom.
			'label' => __( 'To add services go to: <br><a href="#" data-section="sidebar-widgets-clients-section">Customize -> Widgets -> Front Page - Clients Section</a>. <br>Then add the "<strong>Crafter - Client widget</strong>"', 'crafter' ),
		) ) );

		$wp_customize->add_setting( 'crafter_clients_image', array( 'default' => '', 'transport' => 'postMessage', 'sanitize_callback' => 'attachment_url_to_postid', ) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'crafter_clients_image', array(
	        'label'    => esc_attr__( 'Main Image', 'crafter' ),
	        'section'  => 'crafter_clients_section',
	        'settings' => 'crafter_clients_image',
		) ) );

		$wp_customize->add_setting( 'crafter_clients_enable', array( 'default' => true, 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_bool', ) );
	    $wp_customize->add_control( 'crafter_clients_enable', array(
			'section' => 'crafter_clients_section', // Required, core or custom.
			'label' => esc_attr__( "Use this section?", 'crafter' ),
			'type'    => 'checkbox',
		) );



		/*
    	Pricing
    	------------------------------ */
		$wp_customize->add_section( 'crafter_pricing_section', array(
			'title' => esc_attr__( 'Pricing', 'crafter' ),
			'description' => esc_attr__( "Display pricing lists.", 'crafter' ),
			'panel' => 'crafter_front_page_sections',
			'priority' => $sections_sorted['crafter_pricing_section'],
		) );

		$wp_customize->add_setting( 'crafter_pricing_title', array( 'default' => esc_html__( 'Pricing', 'crafter' ), 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_text', ) );
		$wp_customize->add_control( 'crafter_pricing_title', array(
			'type' => 'text',
			'section' => 'crafter_pricing_section', // Required, core or custom.
			'label' => esc_attr__( "Section Title", 'crafter' ),
		) );

		$wp_customize->add_setting( 'crafter_pricing_text', array( 'default' => '', 'sanitize_callback' => 'crafter_sanitize_text', ) );
		$wp_customize->add_control( new crafter_Display_Text_Control( $wp_customize, 'crafter_pricing_text', array(
			'section' => 'crafter_pricing_section', // Required, core or custom.
			'label' => __( 'To add a list go to: <br><a href="#" data-section="sidebar-widgets-pricing-section">Customize -> Widgets -> Front Page - Pricing Section</a>. <br>Then add the "<strong>Crafter - Pricing widget</strong>"', 'crafter' ),
		) ) );

		$wp_customize->add_setting( 'crafter_pricing_enable', array( 'default' => true, 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_bool', ) );
	    $wp_customize->add_control( 'crafter_pricing_enable', array(
			'section' => 'crafter_pricing_section', // Required, core or custom.
			'label' => esc_attr__( "Use this section?", 'crafter' ),
			'type'    => 'checkbox',
		) );



		/*
    	Blog
    	------------------------------ */
		$wp_customize->add_section( 'crafter_blog_section', array(
			'title' => esc_attr__( 'Blog', 'crafter' ),
			'description' => esc_attr__( "Display blog posts.", 'crafter' ),
			'panel' => 'crafter_front_page_sections',
			'priority' => $sections_sorted['crafter_blog_section'],
		) );

		$wp_customize->add_setting( 'crafter_blog_title', array( 'default' => esc_html__( 'From the blog', 'crafter' ), 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_text', ) );
		$wp_customize->add_control( 'crafter_blog_title', array(
			'type' => 'text',
			'section' => 'crafter_blog_section', // Required, core or custom.
			'label' => esc_attr__( "Section Title", 'crafter' ),
		) );

		$wp_customize->add_setting( 'crafter_blog_enable', array( 'default' => true, 'transport' => 'postMessage', 'sanitize_callback' => 'crafter_sanitize_bool', ) );
	    $wp_customize->add_control( 'crafter_blog_enable', array(
			'section' => 'crafter_blog_section', // Required, core or custom.
			'label' => esc_attr__( "Use this section?", 'crafter' ),
			'type'    => 'checkbox',
		) );


		

		






}
add_action( 'customize_register', 'crafter_customize_register' );











/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function crafter_customize_preview_js() {
	
	wp_register_script( 'crafter_customizer_preview', get_template_directory_uri() . '/js/customizer-preview.js', array( 'customize-preview' ), '20151024', true );
	wp_localize_script( 'crafter_customizer_preview', 'wp_customizer', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'theme_url' => get_template_directory_uri(),
		'site_name' => get_bloginfo( 'name' )
	));
	wp_enqueue_script( 'crafter_customizer_preview' );

}
add_action( 'customize_preview_init', 'crafter_customize_preview_js' );


/**
 * Load scripts on the Customizer not the Previewer (iframe)
 */
function crafter_customize_js() {

	wp_enqueue_script( 'crafter_customizer_top_buttons', get_template_directory_uri() . '/js/theme-customizer-top-buttons.js', array( 'jquery' ), true  );
	wp_localize_script( 'crafter_customizer_top_buttons', 'topbtns', array(
			'pro' => esc_html__( 'View PRO version', 'crafter' )
	) );

	wp_enqueue_script( 'jquery' );
	
	wp_register_script( 'crafter_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-controls', 'jquery' ), '20151024', true );
	wp_localize_script( 'crafter_customizer', 'wp_customizer_admin', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'theme_url' => get_template_directory_uri(),
		'admin_url' => get_admin_url()
	));
	wp_enqueue_script( 'crafter_customizer' );

}
add_action( 'customize_controls_enqueue_scripts', 'crafter_customize_js' );





/*
Sanitize Callbacks
*/

/**
 * Sanitize for post's categories
 */
function crafter_sanitize_categories( $value ) {
    if ( ! array_key_exists( $value, crafter_categories_ar() ) )
        $value = '';
    return $value;
}

/**
 * Sanitize return an non-negative Integer
 */
function crafter_sanitize_integer( $value ) {
    return absint( $value );
}

/**
 * Sanitize return pro version text
 */
function crafter_pro_version( $input ) {
    return $input;
}

/**
 * Sanitize Any
 */
function crafter_sanitize_any( $input ) {
    return $input;
}

/**
 * Sanitize Text
 */
function crafter_sanitize_text( $str ) {
	return sanitize_text_field( $str );
} 

/**
 * Sanitize Textarea
 */
function crafter_sanitize_textarea( $text ) {
	return esc_textarea( $text );
}

/**
 * Sanitize URL
 */
function crafter_sanitize_url( $url ) {
	return esc_url( $url );
}

/**
 * Sanitize Boolean
 */
function crafter_sanitize_bool( $string ) {
	return (bool)$string;
} 

/**
 * Sanitize Text with html
 */
function crafter_sanitize_text_html( $str ) {
	$args = array(
			    'a' => array(
			        'href' => array(),
			        'title' => array()
			    ),
			    'br' => array(),
			    'em' => array(),
			    'strong' => array(),
			    'span' => array(),
			);
	return wp_kses( $str, $args );
}

/**
 * Sanitize GPS Latitude and Longitud
 * http://stackoverflow.com/a/22007205
 */
function crafter_sanitize_lat_long( $coords ) {
	if ( preg_match( '/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?),[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/', $coords ) ) {
	    return $coords;
	} else {
	    return 'error';
	}
} 



/**
 * Create the "PRO version" buttons
 */
if ( ! function_exists( 'crafter_pro_btns' ) ){
	function crafter_pro_btns( $args ){

		$wp_customize = $args['wp_customize'];
		$title = $args['title'];
		$label = $args['label'];
		if ( isset( $args['priority'] ) || array_key_exists( 'priority', $args ) ) {
			$priority = $args['priority'];
		}else{
			$priority = 120;
		}
		if ( isset( $args['panel'] ) || array_key_exists( 'panel', $args ) ) {
			$panel = $args['panel'];
		}else{
			$panel = '';
		}

		$section_id = sanitize_title( $title );

		$wp_customize->add_section( $section_id , array(
			'title'       => $title,
			'priority'    => $priority,
			'panel' => $panel,
		) );
		$wp_customize->add_setting( $section_id, array(
			'sanitize_callback' => 'crafter_pro_version'
		) );
		$wp_customize->add_control( new crafter_Pro_Version( $wp_customize, $section_id, array(
	        'section' => $section_id,
	        'label' => $label
		   )
		) );
	}
}//end if function_exists

/**
 * Display Text Control
 * Custom Control to display text
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	class crafter_Display_Text_Control extends WP_Customize_Control {
		/**
		* Render the control's content.
		*/
		public function render_content() {

	        $wp_kses_args = array(
			    'a' => array(
			        'href' => array(),
			        'title' => array(),
			        'data-section' => array(),
			    ),
			    'br' => array(),
			    'em' => array(),
			    'strong' => array(),
			    'span' => array(),
			);
			$label = wp_kses( $this->label, $wp_kses_args );
	        ?>
			<p><?php echo $label; ?></p>		
		<?php
		}
	}
}



/*
* AJAX call to retreive an image URI by its ID
*/
add_action( 'wp_ajax_nopriv_crafter_get_image_src', 'crafter_get_image_src' );
add_action( 'wp_ajax_crafter_get_image_src', 'crafter_get_image_src' );

function crafter_get_image_src() {
	$image_id = $_POST['image_id'];
	$image = wp_get_attachment_image_src( absint( $image_id ), 'full' );
	$image = $image[0];
	echo $image;
	die();
}

/*
* AJAX call to save the order for Front Page Sections
*/
add_action( 'wp_ajax_nopriv_crafter_save_sortable', 'crafter_save_sortable' );
add_action( 'wp_ajax_crafter_save_sortable', 'crafter_save_sortable' );

function crafter_save_sortable() {
	$items = $_POST['items'];
	if ( is_array( $items ) ) {
		update_option( 'crafter_sortable_items', $items );
		wp_send_json_success();
	}else{
		wp_send_json_error();
	}
	die();
}
