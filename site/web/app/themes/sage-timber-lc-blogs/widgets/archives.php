<?php
// Creating the widget 
class archive_widget extends WP_Widget {

	function __construct()
	{
		parent::__construct(
			// Base ID of your widget
			'archive_widget', 

			// Widget name will appear in UI
			__('LC Archives Widget', 'archive_widget_domain'), 

			// Widget description
			array( 'description' => __( 'Widget that displays archive links, uses timber for tpl', 'archive_widget_domain' ), ) 
		);

	}

	// Creating widget front-end
	// This is where the action happensß
	public function widget( $args, $instance )
	{
		echo $args['before_widget'];
		
		if ( ! empty( $instance['title'] ) ):
			$title = apply_filters( 'widget_title', $instance['title'] );
		
			// before and after widget arguments are defined by themes
			if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
		endif;


		
		//$archive_str = wp_get_archives('post_type=blog&type=monthly&show_post_count=1&echo=0&format=option');

		//print_html_r( htmlspecialchars( $archive_str ) );

		$archives_options = (array) wp_get_archives( 'post_type=blog&type=monthly&show_post_count=1&echo=0&format=option' );

		//print_html_r( $archives_options );

		$context = array( 'archive_options' => $archives_options );

		?>

	<?php

		Timber::render('templates/widget-archives.twig', $context); 

		echo $args['after_widget'];

	}
			
	// Widget Backend 
	public function form( $instance )
	{
		if ( isset( $instance[ 'title' ] ) ) {
		$title = $instance[ 'title' ];
		}
		else {
		$title = __( 'Archive', 'archive_widget_domain' );
		}
		// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php 
	}
		
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) 
	{
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}

} // Class archive_widget ends here

// Register and load the widget
function load_archive_widget() {
	register_widget( 'archive_widget' );
}

add_action( 'widgets_init', 'load_archive_widget' );