<?php
/**
 * Custom Twitter Widget
 *
 * @package Basic
 */

class AQ_Widget_Twitter extends WP_Widget {
	
	/**
	 * Constructor
	 */
	function aq_widget_twitter() {
	
		// Widget settings
		$widget_ops = array(
			'classname' => 'AQ_Widget_Twitter',
			'description' => __('Display Twitter streams.', 'a10e')
		);
	
		// Widget control settings
		$control_ops = array(
			'id_base' => 'aq_widget_twitter'
		);
		
		// Create the widget
		$this->WP_Widget( 'aq_widget_twitter', __('Twitter streams', 'a10e'), $widget_ops, $control_ops );
		
	}

	/**
	 * Display Widget
	 */
	function widget( $args, $instance ) {
		extract( $args );
	
		// Our variables from the widget settings
		$title 			= apply_filters('widget_title', $instance['title'] );
		$twitter_id 	= @$instance['twitter_id'];
		$tweet_counts 	= intval(@$instance['tweet_counts']) ? $instance['tweet_counts'] : 2;
		$loading_text 	= @$instance['loading_text'];

		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;
		?>
			
		<div class="tweet"></div>
		
		<?php if(!empty($twitter_id)) : ?>
		<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".tweet").tweet({
			    username: "<?php echo $twitter_id ?>", 
			    // Change your Twitter username here
			    join_text: "auto",
			    avatar_size: 0,
			    count: <?php echo $tweet_counts; ?>,
			    template: "{text} {time}",
			    auto_join_text_default: "", 
			    auto_join_text_ed: "",
			    auto_join_text_ing: "",
			    auto_join_text_reply: "",
			    auto_join_text_url: "",
			    loading_text: "<?php echo $loading_text ?>"
			});
		});
		</script>
		<?php endif;

		echo $after_widget;
		
	}


	/*-----------------------------------------------------------------------------------*/
	/*	Update Widget
	/*-----------------------------------------------------------------------------------*/
		
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
	
		// Strip tags to remove HTML (important for text inputs)
		$instance['title'] 			= strip_tags( $new_instance['title'] );
		$instance['twitter_id'] 	= strip_tags( $new_instance['twitter_id'] );
		$instance['tweet_counts'] 	= intval($new_instance['tweet_counts']);
		$instance['loading_text'] = $new_instance['loading_text'];
		
		return $instance;
	}


	/*-----------------------------------------------------------------------------------*/
	/*	Widget Settings (Displays the widget settings controls on the widget panel)
	/*-----------------------------------------------------------------------------------*/
		 
	function form( $instance ) {
	
		// Set up some default widget settings
		$defaults = array(
			'title' 		=> '',
			'twitter_id' 	=> 'envato',
			'tweet_counts' 	=> '2',
			'loading_text' 	=> 'Loading tweets...',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'a10e') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
	
		<!-- Twitter ID: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter_id' ); ?>"><?php _e('Twitter ID:', 'a10e') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'twitter_id' ); ?>" name="<?php echo $this->get_field_name( 'twitter_id' ); ?>" value="<?php echo $instance['twitter_id']; ?>" />
		</p>
		
		<!-- Tweet counts: Select Box -->
		<p>
			<label for="<?php echo $this->get_field_id( 'tweet_counts' ); ?>"><?php _e('Number of tweets:', 'a10e') ?></label>
			<select id="<?php echo $this->get_field_id( 'tweet_counts' ); ?>" name="<?php echo $this->get_field_name( 'tweet_counts' ); ?>">
			<?php for ( $i = 2; $i <= 10; $i += 1) { ?>
				<option value="<?php echo $i; ?>" <?php selected( $instance['tweet_counts'], $i ); ?>><?php echo $i; ?></option>
			<?php } ?>
			</select>
		</p>
		
		<!-- Loading text: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'loading_text' ); ?>"><?php _e('Custom loading text:', 'a10e') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'loading_text' ); ?>" name="<?php echo $this->get_field_name( 'loading_text' ); ?>" value="<?php echo $instance['loading_text']; ?>" />
		</p>
		<?php
	}
	  
}