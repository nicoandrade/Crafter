<?php
$crafter_enable_section = get_theme_mod( 'crafter_services_enable', true );
if ( $crafter_enable_section || is_customize_preview() ) :
?>
<div id="services-section"class="services-section"  <?php if( false == $crafter_enable_section ): echo 'style="display: none;"'; endif ?>>
	<h2 class="section-title"><?php echo esc_html( get_theme_mod( 'crafter_services_title', esc_html__( 'What We Do', 'crafter' ) ) ); ?></h2>


			<?php
			if ( is_active_sidebar( 'services-section' ) ){

				dynamic_sidebar( 'services-section' );

			}else{

				$widget_args = array(
					'title' => 'Start Up Projects',
					'text' => 'Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.',
					'category' => 'Success',
					'link_title' => 'Learn More', 
					'link' => '#', 
					'image_uri' => get_template_directory_uri() . '/images/0629-cube.png', 
					);
				the_widget( 'crafter_Service', $widget_args, array( 'before_widget' => '<div class="widget %s service wow fadeInUp">', 'after_widget' => '</div>' ) );


				$widget_args = array(
					'title' => 'Marketing Strategy',
					'text' => 'Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.',
					'category' => 'Economy',
					'link_title' => 'Learn More', 
					'link' => '#', 
					'image_uri' => get_template_directory_uri() . '/images/0119-hammer-wrench.png', 
					);
				the_widget( 'crafter_Service', $widget_args, array( 'before_widget' => '<div class="widget %s service wow fadeInUp">', 'after_widget' => '</div>' ) );


				$widget_args = array(
					'title' => 'Creative Campaigns',
					'text' => 'Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.',
					'category' => 'Inspiring',
					'link_title' => 'Learn More', 
					'link' => '#', 
					'image_uri' => get_template_directory_uri() . '/images/0431-laptop-phone.png', 
					);
				the_widget( 'crafter_Service', $widget_args, array( 'before_widget' => '<div class="widget %s service wow fadeInUp">', 'after_widget' => '</div>' ) );


				$widget_args = array(
					'title' => 'Innovative Ideas',
					'text' => 'Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.',
					'category' => 'Creative',
					'link_title' => 'Learn More', 
					'link' => '#', 
					'image_uri' => get_template_directory_uri() . '/images/pencil-ruler.png', 
					);
				the_widget( 'crafter_Service', $widget_args, array( 'before_widget' => '<div class="widget %s service wow fadeInUp">', 'after_widget' => '</div>' ) );

			};
			?>
    
</div><!-- services-section -->
<?php endif ?>