<?php
/**
 * Recent posts class.
 *
 */
class PF_Recent_Posts extends WP_Widget {
	
	// Recent Posts
	function PF_Recent_Posts() {
		/* Widget settings. */
		$widget_ops = array('classname' => 'widget_recent_posts', 'description' => 'An advanced list of the most recent posts on your site');

		/* Widget control settings. */
		$control_ops = array('id_base' => 'pf-recent-posts');

		/* Create the widget. */
		$this->WP_Widget('pf-recent-posts', 'Advanced Recent Posts', $widget_ops, $control_ops);
	}
	
	// Widget Output
	function widget($args, $instance) {
		
		extract($args);

		/* User settings. */
		$title 			= apply_filters('widget_title', $instance['title']);
		$category 		= $instance['category'];
		$show_count 	= $instance['show_count'];
		$show_date 		= $instance['show_date'] ? true : false;
		$show_thumb 	= $instance['show_thumb'] ? true : false;
		$show_excerpt 	= $instance['show_excerpt'] ? true : false;
		$excerpt_length = $instance['excerpt_length'];
		$show_title 	= $instance['hide_title'] ? false : true;

		echo $before_widget;
		
		if($title) {
			echo $before_title.$title.$after_title;
		}
		
		echo '<ul class="pf-recent-posts">';
		
		$query_filters = apply_filters('user_settings', array(
			'posts_per_page' => $show_count,
			'post_type' => 'post'
		));
		if($category) { $query_filters['cat'] = $category; }
		
		query_posts($query_filters);			
		
		if(have_posts()) {
			while (have_posts()) {
				the_post();
				$post_classes = get_post_class('', $post->ID);

					echo '<li class="clearfix '.$post_classes[4].'">';	
						
						if(has_post_format('video') || has_post_format('audio') || has_post_format('image') || has_post_format('gallery')) {
							if($show_title) {
								echo '<h4><a href="'.get_permalink().'" class="pf-recent-posts-title">'.get_the_title().'</a></h4>';
							}
							
							if($show_date) {
								printf(__('<time title="%1$s" datetime="%2$s" pubdate>%3$s</time><br />', PF_THEME_FILE),
									esc_attr(get_the_time('g:ia e')),
									esc_attr(get_the_date('c')),
									esc_html(get_the_date())
								);
							}
							the_content();
						} else {
							if($show_thumb) {
								if(has_post_thumbnail()) {
									$image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), array($instance['thumb_width'], $instance['thumb_height']), false); ?>
									<a title="<?php the_title() ?>" href="<?php the_permalink() ?>">
										<img class="pf-recent-posts-thumb" src="<?php echo $image_url[0] ?>" width="<?php echo $image_url[1] ?>" height="<?php echo $image_url[2] ?>" alt="<?php the_title() ?>" /></a>	
							<?php } 
							}
							if($show_title) {
								echo '<h4><a href="'.get_permalink().'" class="pf-recent-posts-title">'.get_the_title().'</a></h4>';
							}
							
							if($show_date) {
								printf(__('<time title="%1$s" datetime="%2$s" pubdate>%3$s</time><br />', PF_THEME_FILE),
									esc_attr(get_the_time('g:ia e')),
									esc_attr(get_the_date('c')),
									esc_html(get_the_date())
								);
							}
							if($show_excerpt) {
								$the_excerpt = get_the_excerpt();
								
								// Trim to character limit
								$the_excerpt = substr($the_excerpt, 0, $excerpt_length);
								
								// Trim to last space
								$the_excerpt = substr($the_excerpt, 0, strrpos($the_excerpt, ' '));
								
								$the_excerpt .= ' [&hellip;]';
								
								echo '<p class="pf-recent-posts-excerpt">'.$the_excerpt.'</p>';
							}
						}
					echo '</li>';
				}
			}
			
			// Reset query_posts
			wp_reset_query();			
		echo '</ul>';

		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	
	//Update Widget Settings
	function update($new_instance, $old_instance) {
		$instance = $old_instance;

		/* Strip tags and update the widget settings. */
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['category'] = $new_instance['category'];
		$instance['show_count'] = $new_instance['show_count'];
		$instance['show_date'] = $new_instance['show_date'];
		$instance['show_thumb'] = $new_instance['show_thumb'];
		$instance['show_excerpt'] = $new_instance['show_excerpt'];
		$instance['hide_title'] = $new_instance['hide_title'];
		$instance['thumb_width'] = $new_instance['thumb_width'];
		$instance['thumb_height'] = $new_instance['thumb_height'];
		$instance['excerpt_length'] = $new_instance['excerpt_length'];

		return $instance;
	}
	
	// Widget Form
	function form($instance) {

		/* Set up default widget settings. */
		$defaults = array('title' => 'Recent Posts', 'category' => 0, 'show_count' => 5, 'show_date' => false, 'show_thumb' => false, 'show_excerpt' => false, 'hide_title' => false, 'thumb_width' => 50, 'thumb_height' => 50, 'excerpt_length' => 55);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label><br />
			<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" width="100%" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('category'); ?>">Category:</label>
			<select id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>">
				<option value="0" <?php if(!$instance['category']) echo 'selected="selected"'; ?>>All</option>
				<?php
				$categories = get_categories(array('type' => 'post'));
				
				foreach($categories as $cat) {
					echo '<option value="'.$cat->cat_ID.'"';
					
					if($cat->cat_ID == $instance['category']) echo ' selected="selected"';
					
					echo '>'.$cat->cat_name.' (' .$cat->category_count.')';
					
					echo '</option>';
				}
				?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('show_count'); ?>">Show:</label>
			<input type="text" id="<?php echo $this->get_field_id('show_count'); ?>" name="<?php echo $this->get_field_name('show_count'); ?>" value="<?php echo $instance['show_count']; ?>" size="2" /> posts
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['hide_title'], 'on'); ?> id="<?php echo $this->get_field_id('hide_title'); ?>" name="<?php echo $this->get_field_name('hide_title'); ?>" />
			<label for="<?php echo $this->get_field_id('hide_title'); ?>">Hide post title</label>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_date'], 'on'); ?> id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>" />
			<label for="<?php echo $this->get_field_id('show_date'); ?>">Display post date</label>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_thumb'], 'on'); ?> id="<?php echo $this->get_field_id('show_thumb'); ?>" name="<?php echo $this->get_field_name('show_thumb'); ?>" />
			<label for="<?php echo $this->get_field_id('show_thumb'); ?>">Display post thumbnail</label>
		</p>
		
		<?php
		// only allow thumbnail dimensions if GD library supported
		if(function_exists('imagecreatetruecolor')) {
		?>
		<p>
		   <label for="<?php echo $this->get_field_id('thumb_width'); ?>">Thumbnail size</label> <input type="text" id="<?php echo $this->get_field_id('thumb_width'); ?>" name="<?php echo $this->get_field_name('thumb_width'); ?>" value="<?php echo $instance['thumb_width']; ?>" size="3" /> x <input type="text" id="<?php echo $this->get_field_id('thumb_height'); ?>" name="<?php echo $this->get_field_name('thumb_height'); ?>" value="<?php echo $instance['thumb_height']; ?>" size="3" />
		</p>
		<?php
		}
		?>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_excerpt'], 'on'); ?> id="<?php echo $this->get_field_id('show_excerpt'); ?>" name="<?php echo $this->get_field_name('show_excerpt'); ?>" />
			<label for="<?php echo $this->get_field_id('show_excerpt'); ?>">Display post excerpt</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('excerpt_length'); ?>">Excerpt character limit:</label>
			<input type="text" id="<?php echo $this->get_field_id('excerpt_length'); ?>" name="<?php echo $this->get_field_name('excerpt_length'); ?>" value="<?php echo $instance['excerpt_length']; ?>" size="3" />
		</p>
		
		<?php
	}
}