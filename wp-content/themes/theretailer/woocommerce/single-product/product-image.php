<?php
        
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;

$attachment_ids = $product->get_gallery_attachment_ids();

?>

<?php 
/**
* Check if Cloud Zoom is active
**/
if ( in_array( 'cloud-zoom-for-woocommerce/index.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
?>
        
        <div class="images">
        
            <?php
                if ( has_post_thumbnail() ) {
        
                    $image       		= get_the_post_thumbnail( $post->ID, 'shop_single' );
                    $image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
                    $image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
                    $attachment_count   = count( $product->get_gallery_attachment_ids() );
        
                    if ( $attachment_count > 0 ) {
                        $gallery = '[product-gallery]';
                    } else {
                        $gallery = '';
                    }
        
                    echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s"  rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_title, $image ), $post->ID );
        
                } else {
        
                    echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ), $post->ID );
        
                }
            ?>
        
            <?php do_action( 'woocommerce_product_thumbnails' ); ?>
        
        </div>

<?php } else { ?>
            
            <?php
            // get the width and height of shop_single thumb
			
			$tn_id = get_post_thumbnail_id( $post->ID );

			$img = wp_get_attachment_image_src( $tn_id, 'shop_single' );
			$width = $img[1];
			$height = $img[2];
			?>
            
            <style>
			.doubleSlider-1 {
				height: <?php echo $height; ?>px;
			}
			</style>
            
            <div class="images gbtr_images">
                
                <script type="text/javascript">
                
                    (function($){
                       $(window).load(function(){
                           $('.doubleSlider-1').iosSlider({
                                scrollbar: true,
                                snapToChildren: true,
                                desktopClickDrag: true,
                                infiniteSlider: false,
                                navPrevSelector: $('.product_single_slider_previous'),
                                navNextSelector: $('.product_single_slider_next'),
                                scrollbarHeight: '2',
                                scrollbarBorderRadius: '0',
                                scrollbarOpacity: '0.5',
                                onSliderLoaded: doubleSlider2Load,
                                onSlideChange: doubleSlider2Load,
                                onSliderResize: doubleSlider2Load
                            });
                            
                            $('.doubleSlider-2 .button').each(function(i) {				
                                $(this).bind('click', function() {
                                    $('.doubleSlider-1').iosSlider('goToSlide', i+1);						
                                });				
                            });
                            
            
                            $('.doubleSlider-2').iosSlider({
                                desktopClickDrag: true,
                                snapToChildren: true,
                                snapSlideCenter: false,
                                infiniteSlider: false
                            });
                            
                            function doubleSlider2Load(args) {
                                
                                currentSlide = args.currentSlideNumber;
                                $('.doubleSlider-2').iosSlider('goToSlide', args.currentSlideNumber);
                                
                                /* update indicator */
                                $('.doubleSlider-2 .button').removeClass('selected');
                                $('.doubleSlider-2 .button:eq(' + (args.currentSlideNumber-1) + ')').addClass('selected');
                                
                                /* update height of the first slider */
        
                                setTimeout(function() {
                                    var setHeight = $('.doubleSlider-1 .item:eq(' + (args.currentSlideNumber-1) + ')').outerHeight(true);
									
									$( ".doubleSlider-1" ).animate({
										height: setHeight
									}, 300, function() {
										$('.product_single_slider_previous').css({
											visibility: "visible"
										});
										$('.product_single_slider_next').css({
											visibility: "visible"
										});
									});

                                },0);
                                
                            }
                       })
                    })(jQuery);
        
                </script>
            
            
                <div class='doubleSlider-1'>
                
                    <div class='slider'>
                    
                        <?php if ( has_post_thumbnail() ) : ?>
                        
                        <?php
                            //Get the Thumbnail URL
                            $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), false, '' );
                            
                            $attachment_count   = count( get_children( array( 'post_parent' => $post->ID, 'post_mime_type' => 'image', 'post_type' => 'attachment' ) ) );
                    
                        ?>
                        
                        <div class="item">
                            <a href="<?php echo $src[0] ?>" 
                            <?php if (get_option( 'woocommerce_enable_lightbox' ) == "yes") : ?>
                            class="fresco" 
                            <?php endif; ?>
                            data-fresco-group="product-gallery" data-fresco-options="fit: 'width'"><span itemprop="image"><?php echo get_the_post_thumbnail( $post->ID, 'shop_single' ) ?></span>
                            <span class="theretailer_zoom"></span></a>
                        </div>
                        
                        <?php endif; ?>	
                        
                        <?php
        
                            if ( $attachment_ids ) {
                        
                                $loop = 0;
                                $columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );						
                                
                                foreach ( $attachment_ids as $attachment_id ) {
        
                                    $classes = array( 'zoom' );
                        
                                    if ( $loop == 0 || $loop % $columns == 0 )
                                        $classes[] = 'first';
                        
                                    if ( ( $loop + 1 ) % $columns == 0 )
                                        $classes[] = 'last';
                        
                                    $image_link = wp_get_attachment_url( $attachment_id );
                        
                                    if ( ! $image_link )
                                        continue;
                        
                                    $image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
                                    $image_class = esc_attr( implode( ' ', $classes ) );
                                    $image_title = esc_attr( get_the_title( $attachment_id ) );

									if (get_option( 'woocommerce_enable_lightbox' ) == "yes") {
										printf( '<div class="item"><a href="%s" class="fresco" data-fresco-group="product-gallery" data-fresco-options="fit: \'width\'"><span>%s</span><span class="theretailer_zoom"></span></a></div>', wp_get_attachment_url( $attachment_id ), wp_get_attachment_image( $attachment_id, 'shop_single' ) );
									} else {
										printf( '<div class="item"><a href="%s" data-fresco-group="product-gallery" data-fresco-options="fit: \'width\'"><span>%s</span><span class="theretailer_zoom"></span></a></div>', wp_get_attachment_url( $attachment_id ), wp_get_attachment_image( $attachment_id, 'shop_single' ) );
									}
									
                                    $loop++;
                                }
                                
                                
                        
                            }
                        ?>
                    
                    </div>
                    
                    <?php if ( $attachment_count != 1 ) { ?>
                    <div class='product_single_slider_previous'></div>
                    <div class='product_single_slider_next'></div>
                    <?php } ?>
                    
                </div>
                
                <link rel="image_src" href="<?php echo $src[0] ?>" />
                
                <?php 
        
                if ( $attachment_ids ) {
                
                ?>
                
                <div class = 'doubleSlider-2'>
                    
                    <div class = 'slider'>
                                
                                <?php if ( has_post_thumbnail() ) : ?>
                                <div class="button"><div itemprop="image"><?php echo get_the_post_thumbnail( $post->ID, 'shop_thumbnail' ) ?></div></div>
                                <?php endif; ?>
                                
                                <?php
                        
                                $loop = 0;
                                $columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
                                
                                foreach ( $attachment_ids as $attachment_id ) {
        
                                    $classes = array( 'zoom' );
                        
                                    if ( $loop == 0 || $loop % $columns == 0 )
                                        $classes[] = 'first';
                        
                                    if ( ( $loop + 1 ) % $columns == 0 )
                                        $classes[] = 'last';
                        
                                    $image_link = wp_get_attachment_url( $attachment_id );
                        
                                    if ( ! $image_link )
                                        continue;
                        
                                    $image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
                                    $image_class = esc_attr( implode( ' ', $classes ) );
                                    $image_title = esc_attr( get_the_title( $attachment_id ) );
                                    
                                    echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<div class="button">%s</div>', $image ), $attachment_id, $post->ID, $image_class );
                                    
                                    $loop++;
                                }
                                
                                if ($loop < 4) {
                                    for ($i=1; $i<(4-$loop); $i++) {
                                    ?>
                                        <div class="button"><!-- empty placeholder --></div>
                                    <?php
                                    }
                                }
                                ?>
                    
                    </div>
                
                </div>
                
                <?php } ?>
            
            </div>
    
<?php } ?>