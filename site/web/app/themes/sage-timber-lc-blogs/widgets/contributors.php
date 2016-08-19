<?php
// Creating the widget 
class contributors_widget extends WP_Widget {

	function __construct()
	{
		parent::__construct(
			// Base ID of your widget
			'contributors_widget', 

			// Widget name will appear in UI
			__('Contributors Widget', 'contributors_widget_domain'), 

			// Widget description
			array( 'description' => __( 'Widget that lists contributors, uses timber for tpls', 'contributors_widget_domain' ), ) 
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
			if ( ! empty( $title ) ) :
				echo $args['before_title'] . $title . $args['after_title'];
			endif;
		endif;

		// This is where you run the code and display the output

		$context['name'] = "testing name";
		$context['image'] = "testing image";

		//$user_query = new WP_User_Query( array( 'who' => 'subscriber' ) );
		

		//$subscribers_plus = $user_query->get_results();


		$subscribers_plus = get_users( array( 'who' => 'subscriber' )  );


		$subscribers = array( );

		$x = 0;
		$valid = false;

		foreach ( $subscribers_plus as $user ) :



			if( isset( $user->caps['subscriber'] ) ) :
				if( $user->caps['subscriber'] ) :
					$valid = true;
				endif;
			endif;


			if( isset( $user->caps['author'] ) ) :
				if( $user->caps['author'] ) :
					$valid = true;
				endif;
			endif;

			if( isset( $user->caps['editor'] ) ) :
				if( $user->caps['editor'] ) :
					$valid = true;
				endif;
			endif;


			if( $valid ) :


				$usermeta = get_user_meta( $user->ID );

				$subscribers[$x]['url'] = get_author_posts_url( $user->ID, $user->user_nicename ); 
				//$subscribers[$x]['url'] = $user->display_name #missing;
				$subscribers[$x]['name'] = $user->display_name;
				$subscribers[$x]['image_id'] = $usermeta['_cmb_user_options_user_profile_image_id'][0];
				$img = wp_get_attachment_image( $subscribers[$x]['image_id'], 'thumbnail', "", array( "class" => "", "alt" => $user->display_name, "title" => $user->display_name ) );
				$subscribers[$x]['image'] = $img;

				$x++;

			endif;
		endforeach;

		$context['subscribers'] = $subscribers;
		

		Timber::render('templates/widget-contributors.twig', $context); 

		echo $args['after_widget'];

	}
			
	// Widget Backend 
	public function form( $instance )
	{
		if ( isset( $instance[ 'title' ] ) ) {
		$title = $instance[ 'title' ];
		}
		else {
		$title = __( 'Contributors', 'contributors_widget_domain' );
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

} // Class contributors_widget ends here

// Register and load the widget
function load_contributors_widget() {
	register_widget( 'contributors_widget' );
}

add_action( 'widgets_init', 'load_contributors_widget' );