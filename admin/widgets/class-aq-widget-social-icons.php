<?php
/**
 * Custom Twitter Widget
 *
 * @package Basic
 */

class AQ_Widget_Social_Icons extends WP_Widget {
	
	var $social_icons;

	/**
	 * Constructor
	 */
	function aq_widget_social_icons() {
	
		// Widget settings
		$widget_ops = array(
			'classname' => 'aq_widget_social_icons',
			'description' => __('Display Social Icons.', 'a10e')
		);
	
		// Widget control settings
		$control_ops = array(
			'width'   => '350',
			'id_base' => 'aq_widget_social_icons'
		);
		
		// Create the widget
		$this->WP_Widget( 'aq_widget_social_icons', __('Social Icons', 'a10e'), $widget_ops, $control_ops );

		$this->social_icons = array(
			'twitter'     => 'Twitter',
			'facebook'    => 'Facebook',
			'linkedin'    => 'LinkedIn',
			'google_plus' => 'Google Plus',
			'pinterest'   => 'Pinterest'
		);
		
	}

	/**
	 * Display Widget
	 */
	function widget( $args, $instance ) {

		extract( $args );
	
		// Our variables from the widget settings
		$title 			= apply_filters('widget_title', $instance['title'] );

		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;
		
		foreach($this->social_icons as $id => $social) {

			if($instance[$id]) {
				if($id == 'google_plus'): $icon = 'icon-google-plus'; else: $icon = 'icon-' . $id; endif;
				echo '<a href="'.$instance[$id].'"><button class="'.$id.'"><i class="'.$icon.'"></i></button></a>&nbsp; ';
			}

		}

		echo $after_widget;
		
	}


	/*-----------------------------------------------------------------------------------*/
	/*	Update Widget
	/*-----------------------------------------------------------------------------------*/
		
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
	
		// Strip tags to remove HTML (important for text inputs)
		$instance['title'] 			= strip_tags( $new_instance['title'] );

		foreach($this->social_icons as $id => $social) {
			$instance[$id] = esc_url($new_instance[$id]);
		}
		
		return $instance;

	}


	/*-----------------------------------------------------------------------------------*/
	/*	Widget Settings (Displays the widget settings controls on the widget panel)
	/*-----------------------------------------------------------------------------------*/
		 
	function form( $instance ) {
	
		// Set up some default widget settings
		$defaults = array(
			'title' 		=> '',
		);

		foreach($this->social_icons as $id => $social) {
			$defaults[$id] = '';
		}
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'a10e') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
	
		<!-- Social icons URL: Text Input -->

		<?php foreach($this->social_icons as $id => $social) { ?>
		<p>
			<label for="<?php echo $this->get_field_id($id); ?>"><?php echo $social .' URL'; ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id($id); ?>" name="<?php echo $this->get_field_name( $id ); ?>" value="<?php echo $instance[$id]; ?>" />
		</p>
		<?php
		}
	}
	  
}