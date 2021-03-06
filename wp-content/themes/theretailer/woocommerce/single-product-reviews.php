<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
global $woocommerce;
?>
<?php if ( comments_open() ) : ?><div id="reviews"><?php

	echo '<div id="comments">';

	$count = $wpdb->get_var("
		SELECT COUNT(meta_value) FROM $wpdb->commentmeta
		LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
		WHERE meta_key = 'rating'
		AND comment_post_ID = $post->ID
		AND comment_approved = '1'
		AND meta_value > 0
	");

	$rating = $wpdb->get_var("
		SELECT SUM(meta_value) FROM $wpdb->commentmeta
		LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
		WHERE meta_key = 'rating'
		AND comment_post_ID = $post->ID
		AND comment_approved = '1'
	");

	if ( $count > 0 ) :

		$average = number_format($rating / $count, 2);

		echo '<div class="average-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';

		//echo '<div class="star-rating" title="'.sprintf(__('Rated %s out of 5', 'theretailer'), $average).'"><span style="width:'.($average*16).'px"><span itemprop="ratingValue" class="rating">'.$average.'</span> '.__('out of 5', 'theretailer').'</span></div>';

		echo '<h2>'.sprintf( _n('%s review for %s', '%s reviews for %s', $count, 'theretailer'), '<span itemprop="ratingCount" class="count">'.$count.'</span>', wptexturize($post->post_title) ).'</h2>';

		echo '</div><div class="clr"></div>';

	else :

		echo '<h2>'.__('Reviews', 'theretailer').'</h2>';

	endif;

	$title_reply = '';

	if ( have_comments() ) :

		echo '<ol class="commentlist">';

		wp_list_comments( array( 'callback' => 'woocommerce_comments' ) );

		echo '</ol>';

		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Previous', 'theretailer' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Next <span class="meta-nav">&rarr;</span>', 'theretailer' ) ); ?></div>
			</div>
		<?php endif;

		if (get_option( 'woocommerce_enable_lightbox' ) == "yes") {
			echo '<p class="add_review"><a href="#" class="inline //show_review_form custom_show_review_form  button">'.__('Add Review', 'theretailer').'</a></p>';
		}
		
		$title_reply = __('Add a review', 'theretailer');

	else :

		$title_reply = "<span>".__('Be the first to review', 'theretailer').'</span><br />&ldquo;'.$post->post_title.'&rdquo;';

		if (get_option( 'woocommerce_enable_lightbox' ) == "yes") {
			echo '<p>'.__('There are no reviews yet, would you like to <a href="#" class="inline //show_review_form custom_show_review_form">submit yours</a>?', 'theretailer').'</p>';
		}

	endif;

	$commenter = wp_get_current_commenter();

	echo '</div><div id="review_form_wrapper">';
	
	echo '<div id="review_form">';
	
	echo '<div class="review_form_thumb">';
	if ( has_post_thumbnail() ) {
		the_post_thumbnail('review_thumb');
	}
	echo '</div>';

	$comment_form = array(
		'title_reply' => $title_reply,
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'fields' => array(
			'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'theretailer' ) . '</label> ' . '<span class="required">*</span>' .
			            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
			'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'theretailer' ) . '</label> ' . '<span class="required">*</span>' .
			            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
		),
		'label_submit' => __('Submit Review', 'theretailer'),
		'logged_in_as' => '',
		'comment_field' => ''
	);

	if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {

		$comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . __('Rating', 'theretailer') .'</label><select name="rating" id="rating">
			<option value="">'.__('Rate&hellip;', 'theretailer').'</option>
			<option value="5">'.__('Perfect', 'theretailer').'</option>
			<option value="4">'.__('Good', 'theretailer').'</option>
			<option value="3">'.__('Average', 'theretailer').'</option>
			<option value="2">'.__('Not that bad', 'theretailer').'</option>
			<option value="1">'.__('Very Poor', 'theretailer').'</option>
		</select></p>';

	}

	$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . __( 'Your Review', 'theretailer' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>' . $woocommerce->nonce_field('comment_rating', true, false);

	comment_form( $comment_form );

	echo '</div></div>';

?><div class="clear"></div></div>
<?php endif; ?>

<?php if (get_option( 'woocommerce_enable_lightbox' ) == "yes") : ?>
<script>
jQuery(document).ready(function($) {
	
	"use strict";
	
	
	$("#review_form_wrapper").prependTo("#review_form_wrapper_overlay");
	
});
</script>
<?php endif; ?>