<?php 
	wp_nonce_field('powet_featured_video', 'powet_featured_video_nonce', false); 
	$video_url = get_post_meta($post->ID, '_powet_featured_video', true);

?>
<div class="post-selector first" id="bu_feature">
URL of Featured Video:<br/>
<input type="text" size="80" name="powet-featured-video" value="<?php echo $video_url; ?>"/>

</div>