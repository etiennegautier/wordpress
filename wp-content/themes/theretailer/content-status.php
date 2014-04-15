<?php
/**
 * @package theretailer
 * @since theretailer 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
    <div class="entry-content">
		<?php global $more; $more = 0; the_content(__( 'Continue reading &raquo;', 'theretailer' )); ?>
        <div class="clr"></div>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'theretailer' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
    
    <footer class="entry-meta">
		<span class="date-meta"><i class="fa fa-calendar-o"></i>&nbsp;&nbsp;<?php _e( 'Status on', 'theretailer' )?> <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_time() ); ?>" rel="bookmark" class="entry-date"><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></a></span>

		<?php edit_post_link( __( 'Edit', 'theretailer' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->    
    
</article><!-- #post-<?php the_ID(); ?> -->
