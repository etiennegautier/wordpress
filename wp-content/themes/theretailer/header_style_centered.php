<div class="menu_centered_style">
    <div class="gbtr_header_wrapper">
        <div class="container_12">
            
            <div class="grid_12 gbtr_logo_wrapper_centered">
                <a href="<?php echo home_url(); ?>" class="gbtr_logo">
                <img src="<?php if ( !$theretailer_theme_options['site_logo'] ) { ?><?php echo get_template_directory_uri(); ?>/images/logo.png
                <?php } else echo $theretailer_theme_options['site_logo']; ?>" alt="" />
                </a>
            </div>
            
            <script type="text/javascript">
			//<![CDATA[
				
				// Set pixelRatio to 1 if the browser doesn't offer it up.
				var pixelRatio = !!window.devicePixelRatio ? window.devicePixelRatio : 1;
				
				logo_image = new Image();
				
				(function($){
					$(window).load(function(){
						
						if (pixelRatio > 1) {
							$('.gbtr_logo img').each(function() {
								
								var logo_image_width = $(this).width();
								var logo_image_height = $(this).height();
								
								$(this).css("width", logo_image_width);
								$(this).css("height", logo_image_height);
								<?php if ( !$theretailer_theme_options['site_logo'] ) { ?>
									$(this).attr('src', '<?php echo get_template_directory_uri(); ?>/images/logo@2x.png');
								<?php } else if ($theretailer_theme_options['site_logo_retina']) { ?>
									$(this).attr('src', '<?php echo $theretailer_theme_options['site_logo_retina'] ?>');
								<?php } ?>
							});
						}
					
					})
				})(jQuery);
				
			//]]>
			</script>
            
            <div class="grid_12">
                
            <div class="grid_12">
                <div class="menus_wrapper
                    <?php if (($theretailer_theme_options['shopping_bag_style']) && ($theretailer_theme_options['shopping_bag_style'] == "style2")) { ?>
                        menus_wrapper_shopping_bag_mobile_style
                    <?php } ?>
                    <?php if ((!$theretailer_theme_options['shopping_bag_in_header']) || ($theretailer_theme_options['shopping_bag_in_header'] == "0")) { ?>
                        menus_wrapper_no_shopping_bag_in_header
                    <?php } ?>
                    " <?php if ( ($theretailer_theme_options['catalog_mode']) && ($theretailer_theme_options['catalog_mode'] == 1) ) { ?>style="margin:0"<?php } ?>>
                    <div class="gbtr_first_menu">
                        <div class="gbtr_first_menu_inside">
                            
                            <?php
                                if ( in_array( 'ubermenu/ubermenu.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
                            ?>
                                <ul>
                            <?php
                                } else {
                            ?>
                                <ul id="menu" class="sf-menu">
                            <?php
                                }
                            ?>
                            
                                <?php if ( has_nav_menu( 'primary' ) ) : ?>
                                <?php  
                                wp_nav_menu(array(
                                    'theme_location' => 'primary',
                                    'container' =>false,
                                    'menu_class' => '',
                                    'echo' => true,
                                    'items_wrap'      => '%3$s',
                                    'before' => '',
                                    'after' => '',
                                    'link_before' => '',
                                    'link_after' => '',
                                    'depth' => 0,
                                    'fallback_cb' => false,
                                ));
                                ?>
                                <?php else: ?>
                                    <a>Define your primary navigation.</a>
                                <?php endif; ?>
                                
                                <?php if (($theretailer_theme_options['shopping_bag_in_header']) && ($theretailer_theme_options['shopping_bag_in_header'] == "1")) { ?>
                    
                                <?php if ( (!$theretailer_theme_options['catalog_mode']) || ($theretailer_theme_options['catalog_mode'] == 0) ) { ?>
                                
                                <?php 
                                /**
                                * Check if WooCommerce is active
                                **/
                                if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
                                
                                ?>
                                
                                <!---->
                                
                                <li class="shopping_bag_centered_style">                       
                                    
                                    <?php _e('Shopping Bag', 'theretailer'); ?> <span class="items_number"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
                                
                                    <div class="gbtr_minicart_wrapper">
                                    <div class="gbtr_minicart">
                                    <?php                                    
                                    echo '<ul class="cart_list">';                                        
                                        if (sizeof($woocommerce->cart->cart_contents)>0) : foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) :
                                        
                                            $_product = $cart_item['data'];                                            
                                            if ($_product->exists() && $cart_item['quantity']>0) :                                            
                                                echo '<li class="cart_list_product">';                                                
                                                    echo '<a class="cart_list_product_img" href="'.get_permalink($cart_item['product_id']).'">' . $_product->get_image().'</a>';                                                    
                                                    echo '<div class="cart_list_product_title">';
                                                        $gbtr_product_title = $_product->get_title();
                                                        //$gbtr_short_product_title = (strlen($gbtr_product_title) > 28) ? substr($gbtr_product_title, 0, 25) . '...' : $gbtr_product_title;
                                                        echo '<a href="'.get_permalink($cart_item['product_id']).'">' . apply_filters('woocommerce_cart_widget_product_title', $gbtr_product_title, $_product) . '</a>';
                                                        echo '<div class="cart_list_product_quantity">'.__('Quantity:', 'theretailer').' '.$cart_item['quantity'].'</div>';
                                                    echo '</div>';
                                                    echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'theretailer') ), $cart_item_key );
                                                    echo '<div class="cart_list_product_price">'.woocommerce_price($_product->get_price()).'</div>';
                                                    echo '<div class="clr"></div>';                                                
                                                echo '</li>';                                         
                                            endif;                                        
                                        endforeach;
                                        ?>
                                                
                                        <div class="minicart_total_checkout">                                        
                                            <?php _e('Cart subtotal', 'theretailer'); ?><span><?php echo $woocommerce->cart->get_cart_total(); ?></span>                                   
                                        </div>
                                        
                                        <a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="button gbtr_minicart_cart_but"><?php _e('View Shopping Bag', 'theretailer'); ?></a>   
                                        
                                        <a href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>" class="button gbtr_minicart_checkout_but"><?php _e('Proceed to Checkout', 'theretailer'); ?></a>
                                        
                                        <?php                                        
                                        else: echo '<li class="empty">'.__('No products in the shopping bag.','theretailer').'</li>'; endif;                                    
                                    echo '</ul>';                                    
                                    ?>                                                                        
                    
                                    </div>
                                    </div>
                                    
                                    <script type="text/javascript">// <![CDATA[
                                    jQuery(function(){
                                      jQuery(".cart_list_product_title a").each(function(i){
                                        len=jQuery(this).text().length;
                                        if(len>25)
                                        {
                                          jQuery(this).text(jQuery(this).text().substr(0,25)+'...');
                                        }
                                      });
                                    });
                                    // ]]></script>
                                    
                                </li>
                                
                                <!---->
                                
                                <?php } ?>
                                    
                                <?php } ?>
                                
                                <?php } ?>
                                
                            </ul>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="gbtr_second_menu">
                        <ul>
                            <?php if ( has_nav_menu( 'secondary' ) ) : ?>
                            <?php  
                            wp_nav_menu(array(
                                'theme_location' => 'secondary',
                                'container' =>false,
                                'menu_class' => '',
                                'echo' => true,
                                'items_wrap'      => '%3$s',
                                'before' => '',
                                'after' => '',
                                'link_before' => '',
                                'link_after' => '',
                                'depth' => 0,
                                'fallback_cb' => false,
                            ));
                            ?>
                            <?php else: ?>
                            <style>
                            .gbtr_first_menu {
                                border-top: 1px solid #ccc;
                                padding:8px 0 0 0;
                            }
                            .gbtr_first_menu_inside {
                                border-bottom: 0;
                            }
                            </style>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                
                <div class="
					<?php if ((!$theretailer_theme_options['shopping_bag_in_header']) || ($theretailer_theme_options['shopping_bag_in_header'] == "0")) { ?>
                        menus_wrapper_no_shopping_bag_in_header
                    <?php } ?> mobiles_menus_wrapper">
                        <div class="gbtr_menu_mobiles">
                        <div class="gbtr_menu_mobiles_inside
                        <?php if ( ($theretailer_theme_options['catalog_mode']) && ($theretailer_theme_options['catalog_mode'] == 1) ) { ?>
                        gbtr_menu_mobiles_inside_catalog_mode
                        <?php } ?>
                        ">
                            <select>
                                <option selected><?php _e('Navigation', 'theretailer'); ?></option>
                                <?php
                                class Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu{
                                    function start_lvl(&$output, $depth){
                                      $indent = str_repeat("\t", $depth); // don't output children opening tag (`<ul>`)
                                    }
                                
                                    function end_lvl(&$output, $depth){
                                      $indent = str_repeat("\t", $depth); // don't output children closing tag
                                    }
                                
                                    function start_el(&$output, $item, $depth, $args){
                                      
                                      // add spacing to the title based on the depth
                                      $item->title = str_repeat("—", $depth). " " . $item->title;
                                
                                      parent::start_el($output, $item, $depth, $args);
                                      
                                      $output = preg_replace( '/ title="[^"]*"/', '', $output );
                                      
                                      $output = str_replace("<li", "\n<option", $output);
                                      
                                      $output = str_replace('><a href=', ' value=', $output);
                                      $output = str_replace('</a></option>', '</option>', $output);
                                      $output = str_replace('</option></option>', '</option>', $output);
                                      $output = str_replace("</a>", "</option>\n", $output);
                                    }
                                
                                    function end_el(&$output, $item, $depth){
                                    }
                                }
                                
                                wp_nav_menu(array(
                                    'theme_location' => 'primary',
                                    'container' =>false,
                                    'menu_class' => '',
                                    'echo' => true,
                                    'items_wrap'      => '%3$s',
                                    'before' => '',
                                    'after' => '',
                                    'link_before' => '',
                                    'link_after' => '',
                                    'depth' => 0,
                                    'fallback_cb' => false,
                                    'walker' => new Walker_Nav_Menu_Dropdown()
                                ));
                                
                                wp_nav_menu(array(
                                    'theme_location' => 'secondary',
                                    'container' =>false,
                                    'menu_class' => '',
                                    'echo' => true,
                                    'items_wrap'      => '%3$s',
                                    'before' => '',
                                    'after' => '',
                                    'link_before' => '',
                                    'link_after' => '',
                                    'depth' => 0,
                                    'fallback_cb' => false,
                                    'walker' => new Walker_Nav_Menu_Dropdown(),
                                ));
                                
                                ?>
                            </select>            
                        </div>
                        
                        </div>
                        
                        <?php if ( (!$theretailer_theme_options['catalog_mode']) || ($theretailer_theme_options['catalog_mode'] == 0) ) { ?>
                        <?php if ( ($theretailer_theme_options['shopping_bag_in_header']) && ($theretailer_theme_options['shopping_bag_in_header'] == 1) ) { ?>
                        <a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="gbtr_little_shopping_bag_wrapper_mobiles"><span><?php echo $woocommerce->cart->cart_contents_count; ?></span></a>
                        <?php } ?>
                        <?php } ?>
                        
                        <div class="clr"></div>
                    
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>
</div>