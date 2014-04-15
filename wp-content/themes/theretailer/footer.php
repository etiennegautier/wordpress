<?php
global $theretailer_theme_options;
global $woocommerce;
?>

<script type="text/javascript">
jQuery(document).ready(function($) {
	
	"use strict";
	
	<?php if ( ($theretailer_theme_options['let_it_snow']) && ($theretailer_theme_options['let_it_snow'] == 1) ) { ?>
		if ( $(window).width() > 1024 ) {
			$(window).snowfall({
				
				<?php 
				if ( ($theretailer_theme_options['snow_flakes']) && ($theretailer_theme_options['snow_flakes'] != "") ) {
					$snow_flakes = $theretailer_theme_options['snow_flakes'];
				} else {
					$snow_flakes = 100;
				}
				?>
				
				flakeCount: <?php echo $snow_flakes; ?>,
				flakeColor : '#ffffff',
				flakeIndex: 999999,
				minSize : 1,
				maxSize : 3,
				//minSpeed : 2,
				//maxSpeed : 10,
				//round : false,
				shadow: true,
				
			});
		}
	<?php } ?>
	
	<?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) : ?>
		favicon.badge(<?php echo $woocommerce->cart->cart_contents_count; ?>);
	<?php endif; ?>
	
});
</script>
    
    <div class="gbtr_footer_wrapper">
        
        <div class="container_12">
            <div class="grid_12 bottom_wrapper">
                <div class="gbtr_footer_widget_credit_cards">
                
				<?php
                if ( !$theretailer_theme_options['footer_logos'] ) {
					
					if (is_ssl()) {
						$footer_logos_img = str_replace("http://", "https://", get_template_directory_uri() . "/images/payment_cards.png");		
					} else {
						$footer_logos_img = get_template_directory_uri() . "/images/payment_cards.png";	
					}
					
				} else {
					
					if (is_ssl()) {
						$footer_logos_img = str_replace("http://", "https://", $theretailer_theme_options['footer_logos']);		
					} else {
						$footer_logos_img = $theretailer_theme_options['footer_logos'];
					}
				}
				?>
                
                <img src="<?php echo $footer_logos_img; ?>" alt="" />
                </div>
                <div class="gbtr_footer_widget_copyrights"><?php echo $theretailer_theme_options['copyright_text']; ?></div>
                <div class="clr"></div>
            </div>
        </div>
        
    </div>
    
    </div><!-- /global_wrapper -->
    
    <div id="review_form_wrapper_overlay">
    	<div id="review_form_wrapper_overlay_close"><i class="fa fa-times"></i></div>
    </div>
    
    <!--
    <div id="mobile_menu_overlay">
    <div id="mobile_menu_overlay_inside">
    	
        <?php
        /*wp_nav_menu(array(
			'theme_location' => 'primary',
			'fallback_cb' => false
		));
		
		wp_nav_menu(array(
			'theme_location' => 'secondary',
			'fallback_cb' => false
		));*/
		?>
        
        <div id="mobile_menu_overlay_close"><i class="fa fa-times"></i></div>
    </div>
    </div>
    -->

    <!-- ******************************************************************** -->
    <!-- *********************** Custom Javascript ************************** -->
    <!-- ******************************************************************** -->
    
    <?php if ( (isset($theretailer_theme_options['custom_js_footer'])) && ($theretailer_theme_options['custom_js_footer'] != "") ) : ?>
		<?php echo $theretailer_theme_options['custom_js_footer']; ?>
    <?php endif; ?>
    
    <!-- ******************************************************************** -->
    <!-- ************************ WP Footer() ******************************* -->
    <!-- ******************************************************************** -->
	
<?php wp_footer(); ?>
</body>
</html>