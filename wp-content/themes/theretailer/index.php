<?php get_header(); ?>
   
    <div class="global_content_wrapper">
    
    <div class="container_12">
    
    	<div class="grid_8">

            <div id="primary" class="content-area page-blog">
                <div id="content" class="site-content" role="main">
    
                    <?php
                    $temp = $wp_query;
                    $wp_query= null;
                    $wp_query = new WP_Query();
					$wp_query->query('posts_per_page='.get_option('posts_per_page').'&paged='.$paged);				
                    while ($wp_query->have_posts()) : $wp_query->the_post();
                    ?>
                        
                        <?php get_template_part( 'content', get_post_format() ); ?>				
                    
                    <?php endwhile; ?>
                
                    <?php 
                    if (function_exists("emm_paginate")) {
                        emm_paginate();
                    }				
                    ?>
                    
                    <?php $wp_query = null; $wp_query = $temp; ?>
    
                </div><!-- #content .site-content -->
            </div><!-- #primary .content-area -->
            
            
            
        </div>
    
        <div class="grid_4">
        
            <div class="gbtr_aside_column">
                <?php 
                get_sidebar();
                ?>
            </div>
            
        </div>
        
	</div>
    
    </div>

<?php get_template_part("light_footer"); ?>

<?php get_template_part("dark_footer"); ?>

<?php get_footer(); ?>