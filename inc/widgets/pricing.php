<?php

class crafter_Pricing extends WP_Widget{

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'pricing-widget', // Base ID
            esc_attr__( 'Crafter - Pricing widget', 'crafter' ), // Name
            array( 
                'description' => esc_attr__( 'Display a pricing list.', 'crafter' ),
            )
        );
    }



    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ){


        echo $args['before_widget'];

        ?>
        <div class="pricing-table wow fadeInUp <?php if( $instance['featured'] == 'on' ){ echo 'featured'; } ?>">

            <h3><?php if( !empty( $instance['title'] ) ): echo esc_html( $instance['title'] ); endif; ?></h3>

            <span class="pricing-price"><?php if( !empty( $instance['currency'] ) ): ?><span class="cd-currency"><?php echo esc_html( $instance['currency'] ); ?></span><?php endif; ?>
                <?php if( !empty( $instance['price'] ) ): ?><span class="cd-value"><?php  echo esc_html( $instance['price'] ); ?></span><?php endif; ?>
                <?php if( !empty( $instance['duration'] ) ): ?><span class="cd-duration"><?php echo esc_html( $instance['duration'] ); ?></span><?php endif; ?>
            </span>

            <ul>
                <?php 
                if( !empty( $instance['features'] ) ){
                    $features = $instance['features'];
                    $features = explode( PHP_EOL, $features );

                    $wp_kses_args = array(
                        'em' => array(),
                    );
                    if ( $features ) {
                        foreach ( $features as $key => $value ) {
                            echo '<li>' . wp_kses( html_entity_decode( $value ), $wp_kses_args ) . '</li>';
                        }
                    }
                }
                ?>
            </ul>

            <a class="btn-ql" href="<?php if( !empty( $instance['link'] ) ): echo esc_url( $instance['link'] ); endif; ?>"><?php if( !empty( $instance['link_title'] ) ): echo esc_html( $instance['link_title'] ); endif; ?></a>
            <span class="lines"></span>
        </div><!-- pricing-table -->

        <?php

        echo $args['after_widget'];


    }





    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['currency'] = strip_tags( $new_instance['currency'] );
        $instance['price'] = strip_tags( $new_instance['price'] );
        $instance['duration'] = strip_tags( $new_instance['duration'] );

        $instance['link_title'] = strip_tags( $new_instance['link_title'] );
        $instance['link'] = strip_tags( $new_instance['link'] );

        $instance['features'] = esc_html( $new_instance['features'] );

        $instance['featured'] = $new_instance['featured'];

        $instance['title'] = strip_tags($new_instance['title']);


        return $instance;

    }






    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {

        //$defaults = array( 'featured' => 'false' );
        //$instance = wp_parse_args( (array) $instance, $defaults ); 
        ?>
        <p>

            <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title', 'crafter' ); ?></label><br/>

            <input type="text" name="<?php echo $this->get_field_name('title'); ?>"
                   id="<?php echo $this->get_field_id('title'); ?>" value="<?php if( !empty( $instance['title'] ) ): echo $instance['title']; endif; ?>"
                   class="widefat"/>

        </p>

        <p>

            <label for="<?php echo $this->get_field_id('currency'); ?>"><?php esc_html_e( 'Currency', 'crafter' ); ?> <small><?php esc_html_e( 'Example: $', 'crafter' ); ?></small></label><br/>

            <input type="text" name="<?php echo $this->get_field_name('currency'); ?>"
                   id="<?php echo $this->get_field_id( 'currency' ); ?>" value="<?php if( !empty( $instance['currency'] ) ): echo $instance['currency']; endif; ?>"
                   class="widefat"/>

        </p>
        <p>
            <label for="<?php echo $this->get_field_id('price'); ?>"><?php esc_html_e( 'Price', 'crafter' ); ?></label><br/>

            <input type="text" name="<?php echo $this->get_field_name('price'); ?>"
                   id="<?php echo $this->get_field_id( 'price' ); ?>" value="<?php if( !empty( $instance['price'] ) ): echo $instance['price']; endif; ?>"
                   class="widefat"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('duration'); ?>"><?php esc_html_e( 'Duration', 'crafter' ); ?> <small><?php esc_html_e( 'Example: mo', 'crafter' ); ?></small></label><br/>
            <input type="text" name="<?php echo $this->get_field_name('duration'); ?>"
                   id="<?php echo $this->get_field_id( 'duration' ); ?>" value="<?php if( !empty( $instance['duration'] ) ): echo $instance['duration']; endif; ?>"
                   class="widefat"/>
        </p>
        <br><br>

        <p>

            <label for="<?php echo $this->get_field_id('features'); ?>"><?php esc_html_e( 'Features List', 'crafter' ); ?></label><br/>
            <small>One per line. Example: <br/>&lt;em&gt;256MB&lt;/em&gt; Memory <br/>&lt;em&gt;1&lt;/em&gt; User</small>
            <br/>

            <textarea class="widefat" rows="8" cols="20" name="<?php echo $this->get_field_name( 'features' ); ?>"
                      id="<?php echo $this->get_field_id('features'); ?>"><?php
                        if( !empty( $instance['features'] ) ): echo esc_html( $instance['features'] ); endif;
            ?></textarea>

        </p>

        <br><br>

        <p>
            <label for="<?php echo $this->get_field_id('link_title'); ?>"><?php esc_html_e( 'Link title', 'crafter' ); ?></label><br/>
            <input type="text" name="<?php echo $this->get_field_name('link_title'); ?>"
                   id="<?php echo $this->get_field_id( 'link_title' ); ?>" value="<?php if( !empty( $instance['link_title'] ) ): echo $instance['link_title']; endif; ?>"
                   class="widefat"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('link'); ?>"><?php esc_html_e( 'Link URL', 'crafter' ); ?></label><br/>
            <input type="text" name="<?php echo $this->get_field_name('link'); ?>"
                   id="<?php echo $this->get_field_id( 'link' ); ?>" value="<?php if( !empty( $instance['link'] ) ): echo $instance['link']; endif; ?>"
                   class="widefat"/>
        </p>

        <p>
        <?php 
        echo '<pre>';
print_r( $instance['featured'] );
echo '</pre>';
        ?>
            <label for="<?php echo $this->get_field_id('featured'); ?>"><?php esc_html_e( 'Featured?', 'crafter' ); ?></label><br/>
            <input class="checkbox" type="checkbox" <?php checked( $instance['featured'], 'on' ); ?> id="<?php echo $this->get_field_id('featured'); ?>" name="<?php echo $this->get_field_name('featured'); ?>" />
        </p>
		




    <?php

    }

}


register_widget( 'crafter_Pricing' );
