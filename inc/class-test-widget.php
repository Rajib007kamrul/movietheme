<?php
 
/**
 * Adds Foo_Widget widget.
 */
class Foo_Widget extends WP_Widget {
 
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'foo_widget', // Base ID
            'Foo_Widget', // Name
            array( 'description' => __( 'Latest Product', 'text_domain' ), ) // Args
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
    public function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );
 
        echo $before_widget;
        if ( ! empty( $title ) ) {
            echo $before_title . $title . $after_title;
        }
        
        echo $instance['des'] . $name;

        
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => $instance[ 'number_post' ]
        );
// The Query
$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) { $the_query->the_post();
			get_template_part( 'template-parts/content', 'product');
    }
 } else {
      // no posts found
      }
      /* Restore original Post Data */
      wp_reset_postdata();

        echo $after_widget;
    }
 
    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'text_domain' );
        }

        if ( isset( $instance[ 'des' ] ) ) {
            $des = $instance[ 'des' ];
        }
        else {
            $des = __( 'New des', 'text_domain' );
        }

        if ( isset( $instance[ 'number_post' ] ) ) {
            $number_post = $instance[ 'number_post' ];
        }
        else {
            $number_post = 5;
        }



        
        ?>
<p>
  <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
  <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
    name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>

<p>
  <label for="<?php echo $this->get_field_name( 'des' ); ?>"><?php _e( 'des:' ); ?></label>
  <input class="widefat" id="<?php echo $this->get_field_id( 'des' ); ?>"
    name="<?php echo $this->get_field_name( 'des' ); ?>" type="text" value="<?php echo esc_attr( $des ); ?>" />
</p>

<p>
  <label for="<?php echo $this->get_field_name( 'number_post' ); ?>"><?php _e( 'number_post:' ); ?></label>
  <input class="widefat" id="<?php echo $this->get_field_id( 'number_post' ); ?>"
    name="<?php echo $this->get_field_name( 'number_post' ); ?>" type="number"
    value="<?php echo esc_attr( $number_post ); ?>" />
</p>
<?php
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
        $instance = array();
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['des'] = ( !empty( $new_instance['des'] ) ) ? strip_tags( $new_instance['des'] ) : '';
        $instance['number_post'] = ( !empty( $new_instance['number_post'] ) ) ? strip_tags( $new_instance['number_post'] ) : '';
 
        return $instance;
    }
 
} 

// class Foo_Widget
// Register Foo_Widget widget
add_action( 'widgets_init', 'register_foo' );
     
function register_foo() { 
    register_widget( 'Foo_Widget' ); 
}


?>