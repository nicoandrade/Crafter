<?php
$crafter_enable_section = get_theme_mod( 'crafter_bullet_points_enable', true );
if ( $crafter_enable_section || is_customize_preview() ) :
?>
<div id="bullet-points-section" class="bullet-points-section" <?php if( false == $crafter_enable_section ): echo 'style="display: none;"'; endif ?>>
   <div class="bullet-points-wrap wow fadeInLeft">
                
                <div class="bullet-point bullet-point1 wow fadeInUp" data-wow-offset="0" data-wow-delay="0ms">
                    <div class="bullet-point-number">01.</div>
                    
                    <div class="bullet-point-text">
                        <h4><?php echo esc_html( get_theme_mod( 'crafter_bullet_points_title1', esc_html__( 'Team Work', 'crafter' ) ) ); ?></h4>
                        <div><?php echo nl2br( esc_html( get_theme_mod( 'crafter_bullet_points_text1', esc_html__( '- Ornare Porta Vehicula
                            - Tristique Commodo
                            - Fermentum Cursus Sem
                            - Sit Justo', 'crafter' ) ) ) ); ?>
                        </div>
                    </div>
                </div><!-- bullet-point -->

                <div class="bullet-point bullet-point2 wow fadeInUp" data-wow-offset="0" data-wow-delay="200ms">
                    <div class="bullet-point-number">02.</div>
                    
                    <div class="bullet-point-text">
                        <h4><?php echo esc_html( get_theme_mod( 'crafter_bullet_points_title2', esc_html__( 'Strategy', 'crafter' ) ) ); ?></h4>
                        <div><?php echo nl2br( esc_html( get_theme_mod( 'crafter_bullet_points_text2', esc_html__( '- Ornare Porta Vehicula
                            - Tristique Commodo
                            - Fermentum Cursus Sem
                            - Sit Justo', 'crafter' ) ) ) ); ?>
                        </div>
                    </div>
                </div><!-- bullet-point -->

                <div class="bullet-point bullet-point3 wow fadeInUp" data-wow-offset="0" data-wow-delay="400ms">
                    <div class="bullet-point-number">03.</div>
                    
                    <div class="bullet-point-text">
                        <h4><?php echo esc_html( get_theme_mod( 'crafter_bullet_points_title3', esc_html__( 'Lidership', 'crafter' ) ) ); ?></h4>
                        <div><?php echo nl2br( esc_html( get_theme_mod( 'crafter_bullet_points_text3', esc_html__( '- Ornare Porta Vehicula
                            - Tristique Commodo
                            - Fermentum Cursus Sem
                            - Sit Justo', 'crafter' ) ) ) ); ?>
                        </div>
                    </div>
                </div><!-- bullet-point -->

                <div class="bullet-point bullet-point4 wow fadeInUp" data-wow-offset="0" data-wow-delay="600ms">
                    <div class="bullet-point-number">04.</div>
                    
                    <div class="bullet-point-text">
                        <h4><?php echo esc_html( get_theme_mod( 'crafter_bullet_points_title4', esc_html__( 'Marketing', 'crafter' ) ) ); ?></h4>
                        <div><?php echo nl2br( esc_html( get_theme_mod( 'crafter_bullet_points_text4', esc_html__( '- Ornare Porta Vehicula
                            - Tristique Commodo
                            - Fermentum Cursus Sem
                            - Sit Justo', 'crafter' ) ) ) ); ?>
                        </div>
                    </div>
                </div><!-- bullet-point -->

            <?php
            $bullet_points_image = wp_get_attachment_image_src( absint( get_theme_mod( 'crafter_bullet_points_image' ) ), 'full' );
            $bullet_points_image = $bullet_points_image[0];
            if ( empty( $bullet_points_image ) ) {
                $bullet_points_image = get_template_directory_uri() . '/images/bullet-points.jpeg';
            }
            ?>
            </div><div class="bullet-points-image wow fadeInRight" data-wow-delay="300ms" style="background-image: url(<?php echo esc_url( $bullet_points_image ) ?>);">
                <h3 class="bullet-points-title"><?php  echo esc_html( get_theme_mod( 'crafter_bullet_points_title', __( 'Impactful Projects', 'crafter' ) ) ); ?></h3>

                <?php
                $wp_kses_args = array(
                    'a' => array(
                        'href' => array(),
                        'title' => array()
                    ),
                    'br' => array(),
                    'em' => array(),
                    'strong' => array(),
                    'span' => array(),
                );
                /* translators: Lorem ipsum text, It is not strictly necessary to translate. */
                $main_text = wp_kses( get_theme_mod( 'crafter_bullet_points_main_desc', __( 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Nullam quis risus eget urna mollis ornare vel eu leo. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Praesent commodo cursus magna.', 'crafter' ) ), $wp_kses_args );
                ?>
                <p><?php echo $main_text; ?></p>
                <?php $crafter_bullet_points_link_title = get_theme_mod( 'crafter_bullet_points_link_title', esc_html__( 'Learn More', 'crafter' ) ); ?>
                <?php if ( !empty( $crafter_bullet_points_link_title ) || is_customize_preview() ) { ?>
                <a href="<?php echo esc_url( get_theme_mod( 'crafter_bullet_points_link_url', '#' ) ); ?>" class="btn-ql"><?php echo esc_html( $crafter_bullet_points_link_title ); ?></a>
                <?php } ?>
                
            </div>     
</div><!-- bullet-points-section -->
<?php endif ?>