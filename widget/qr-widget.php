<?php 

// Creating the widget 
class qrs_widget extends WP_Widget {
 
    // The construct part  
    function __construct() {
        parent::__construct(
  
            // Base ID of your widget
            'qrs_widget', 
              
            // Widget name will appear in UI
            __('QR Code Widget', 'qrs_widget_domain'), 
              
            // Widget description
            array( 'description' => __( 'QR Generator Widget', 'qrs_widget_domain' ), ) 
        );
    }
      
    // Creating widget front-end
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $url = $instance['url'];
        $size = $instance['size'];
        $color = $instance['color'];
        $bgcolor = $instance['bgcolor'];
  
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];
          
        // This is where you run the code and display the output
        echo __( '<a href="'.$url.'" Title="'.$title.'" target="_blank" />', 'qrs_widget_domain' );
        echo __( '<img src="//api.qrserver.com/v1/create-qr-code/?data='.$url.'&amp;size='.$size.'x'.$size.'&amp;color='.$color.'&amp;bgcolor='.$bgcolor.'" alt="'.$title.'" />', 'qrs_widget_domain' );
        echo __( '<a/>', 'qrs_widget_domain' );
        echo $args['after_widget'];
    }
              
    // Creating widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        if ( isset( $instance[ 'url' ] ) ) {
            $url = $instance[ 'url' ];
        }
        if ( isset( $instance[ 'size' ] ) ) {
            $size = $instance[ 'size' ];
        }
        if ( isset( $instance[ 'color' ] ) ) {
            $color = $instance[ 'color' ];
        }
        if ( isset( $instance[ 'bgcolor' ] ) ) {
            $bgcolor = $instance[ 'bgcolor' ];
        }
        else {
        $title = __( 'New title', 'qrs_widget_domain' );
        $url = __( 'https://bit.ly/3voiMUy', 'qrs_widget_domain' );
        $size = __( '200', 'qrs_widget_domain' );
        $color = __( '000000', 'qrs_widget_domain' );
        $bgcolor = __( 'ffffff', 'qrs_widget_domain' );
        }
            // Widget admin form
        ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>
            <p>    
                <label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'URL:' ); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'size' ); ?>"><?php _e( 'Size:' ); ?></label> 
                <input id="<?php echo $this->get_field_id( 'size' ); ?>" name="<?php echo $this->get_field_name( 'size' ); ?>" type="number" value="<?php echo esc_attr( $size ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'color' ); ?>"><?php _e( 'Color (in Hex values):' ); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id( 'color' ); ?>" name="<?php echo $this->get_field_name( 'color' ); ?>" type="text" value="<?php echo esc_attr( $color ); ?>" placeholder="000000" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'bgcolor' ); ?>"><?php _e( 'Background Color: (in Hex values)' ); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id( 'color' ); ?>" name="<?php echo $this->get_field_name( 'bgcolor' ); ?>" type="text" value="<?php echo esc_attr( $bgcolor ); ?>" placeholder="ffffff" />
            </p>
        <?php 
    }
          
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['url'] = ( ! empty( $new_instance['url'] ) ) ? strip_tags( $new_instance['url'] ) : '';
        $instance['size'] = ( ! empty( $new_instance['size'] ) ) ? strip_tags( $new_instance['size'] ) : '';
        $instance['color'] = ( ! empty( $new_instance['color'] ) ) ? strip_tags( $new_instance['color'] ) : '';
        $instance['bgcolor'] = ( ! empty( $new_instance['bgcolor'] ) ) ? strip_tags( $new_instance['bgcolor'] ) : '';
        return $instance;
    }
     
    // Class qrs_widget ends here
    } 

    function qrs_load_widget() {
        register_widget( 'qrs_widget' );
    }
    add_action( 'widgets_init', 'qrs_load_widget' );