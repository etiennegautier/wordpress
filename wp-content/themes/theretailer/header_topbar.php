<div class="gbtr_tools_wrapper">
    <div class="container_12">
        <div class="grid_4">
            <div class="gbtr_tools_info"><?php echo $theretailer_theme_options['topbar_text']; ?></div>
        </div>
        <div class="grid_8">
            <div class="gbtr_tools_search">
                <form method="get" action="<?php echo home_url(); ?>">
                    <input class="gbtr_tools_search_inputtext" type="text" value="<?php echo esc_html($s, 1); ?>" name="s" id="s" />
                    <input class="gbtr_tools_search_inputbutton" type="submit" value="Search" />
                    <?php 
                    /**
                    * Check if WooCommerce is active
                    **/
                    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
                    ?>
                    <input type="hidden" name="post_type" value="product">
                    <?php } ?>
                </form>
            </div>
            <div class="gbtr_tools_account">
                <ul>
                    <?php if ( has_nav_menu( 'tools' ) ) : ?>
                    <?php  
                    wp_nav_menu(array(
                        'theme_location' => 'tools',
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
                        Define your top bar navigation.
                    <?php endif; ?>
                </ul>
            </div>               
        </div>
    </div>
</div>