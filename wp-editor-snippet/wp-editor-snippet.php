<?php
/**
 * Plugin Name: WP Editor Snippet
 * Plugin URI: http://www.themevita.com
 * Description: Convert Custom post type content to shortcodes your can use Wordpress Editor, siteorigin page builder or Visual Composer for Wordpress
 * Version: 1.0.0
 * Author: Ajit Bhandari
 * Author URI: http://www.themevita.com
 * License: GPL2
 */
 
 
 // Register custom post type WP Snippet => wp_snippet
 function wp_editor_snippet() {
	register_post_type( 'wp_snippet',			
	array('labels' => array('name' => __( 'WP Snippet' ), 'singular_name' => __( 'WP Snippet' )),
				'public' => true,
				'has_archive' => true,			
				'rewrite' => array('slug' => 'wp_snippet'),
				'supports' => array('title','editor')));
	}
add_action( 'init', 'wp_editor_snippet' );


//Function to get post in shortcode with post  id

function wp_snippet_shortcode($atts){

			$param=shortcode_atts(array('id'=>''),$atts);
			$type = 'wp_snippet';
			
			$wp_snippet_query=array('post_type' => $type,
			'post_status' =>'publish',
			'p'=>$param['id'],
			);
			
			
			$wp_snippet_post = null;
			$wp_snippet_post = new WP_Query($wp_snippet_query);
			if( $wp_snippet_post->have_posts()){  
			while ($wp_snippet_post->have_posts()):$wp_snippet_post->the_post();?>
		    
	<?php the_content();?>
	<?php  endwhile;
	}
	 wp_reset_query();
	 }
?>
<?php
function _init_wp_snippet_shortcode(){
add_shortcode( 'wp_snippet', 'wp_snippet_shortcode' );
}
add_action( 'init', '_init_wp_snippet_shortcode');
 ?>
