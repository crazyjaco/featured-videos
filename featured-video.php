<?php
/*
Plugin Name: Featured Videos
Plugin Author: Bradley Jacobs
*/

/*

Copyright (C) 2013 Bradley Jacobs

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

*/

function powet_feature_add_meta_box($post_type, $post) {
	add_meta_box('powet-featured-video', "Featured Video", 'powet_feature_meta_box', 'post', 'normal', 'high');

}

add_action('add_meta_boxes', 'powet_feature_add_meta_box', 10, 2);


/**
 * Render admin meta box.
 * @param object $post
 * @param array $box (unused)
 */
function powet_feature_meta_box($post, $box) {
	$feature = get_post_meta($post->ID, '_bu_feature', true);

	//$post_id = empty($feature['post_id']) ? '' : $feature['post_id'];
	//$title = empty($feature['title']) ? '' : $feature['title']

	include('interface/meta-box.php');
}

/**
 * Save featured url when the post is saved.
 *
 * @param int $post_id
 * @param object $post
 */
function powet_featured_video_save_post_handler($post_id, $post) {

	if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || (defined('DOING_AJAX') && DOING_AJAX)) {
		return;
	}

	//if (!is_array($_POST['powet-featured-video'])) {
//		return;
//	}

	if (!wp_verify_nonce($_POST['powet_featured_video_nonce'], 'powet_featured_video')) {
		return;
	}

	$video_url = strip_tags( $_POST['powet-featured-video'] );
	// url validation goes here


	// post_exists() check
	update_post_meta($post_id, '_powet_featured_video', $video_url);

	// delete check

}

add_action('save_post', 'powet_featured_video_save_post_handler', 10, 2);