<?php get_header(); ?>

<?php if(get_field("slider_type") != "Fanxybox"): ?>
<div class="project-slider left-space">
    <div class="slider-arrows">
        <a href="#" class="next-slide"><i class="icon-angle-right"></i></a>
        <a href="#" class="prev-slide"><i class="icon-angle-left"></i></a>
    </div>
    <div class="slider-holder">
        <ul>
            <?php while(has_sub_field("slider")): ?>
                <?php if(get_row_layout() == "image"): $image = get_sub_field("image"); ?>
                    <li><img src="<?php echo $image["sizes"]["work_post_large"]; ?>" alt="<?php echo $image["alt"]; ?>"></li>
                <?php elseif(get_row_layout() == "video"): ?>
                    <li><?php echo getVideoEmbed(get_sub_field("video_url"),"100%","100%"); ?></li>
                <?php endif; ?>
            <?php endwhile; ?>
        </ul>
    </div>
</div>
<?php endif; ?>

<div class="container single-work left-space">

    <?php if(get_field("slider_type") == "Fanxybox"): ?>
        <div class="project_thumb row">
			<?php while(has_sub_field("slider")): ?>

				<?php if(get_row_layout() == "image"): $image = get_sub_field("image"); ?>
				<div class="col-sm-3 col-xs-12">
					<a rel="fancybox_gallery" href="<?php echo $image["url"]; ?>">
						<img src="<?php echo $image["sizes"]["work_post_medium"]; ?>" alt="<?php echo $image["alt"]; ?>">
					</a>
				</div>
				<?php elseif(get_row_layout() == "video"): ?>
					<!--<a rel="fancybox_gallery" href="<?php echo get_sub_field("video_url"); ?>">
						<img src="<?php echo $image["sizes"]["work_post_medium"]; ?>" alt="<?php echo $image["alt"]; ?>">
					</a>-->
				<?php endif; ?>

			<?php endwhile; ?>
        </div>
    <?php endif; ?>

	<div class="row project-content-top">
		<div class="col-sm-7">
			<h2><?php the_title(); ?></h2>
            <?php
            $terms = wp_get_post_terms( $post->ID,"portfolio_category" );
            $terms_html_array = array();
            foreach($terms as $t){
                $term_name = $t->name;
                $term_link = get_term_link($t->slug,$t->taxonomy);
                array_push($terms_html_array,"<li><a href='{$term_link}'>{$term_name}</a></li>");
            }
            $terms_html_array = implode("",$terms_html_array);
            if($terms_html_array):
            ?>
			<ul class="portfolio_categories">
				<?php echo $terms_html_array; ?>
			</ul>
            <?php endif; ?>
		</div>
		<div class="project-buttons col-sm-5">
			<ul>
				<li>
					<i class="icon-time"></i><br>
                    <p><?php echo get_the_date("d M"); ?></p>
				</li>
				<li>
					<i class="icon-user"></i><br>
                    <p><?php the_author_meta( "display_name" , $post->post_author ); ?></p>
				</li>
				<li>
                    <?php
                        $coockie_offset = 'um_liked_'.$post->ID;
                        $liked = isset($_COOKIE[$coockie_offset]) && $_COOKIE[$coockie_offset] ? "liked" : "";
                    ?>
                    <a href="#" class="like <?php echo $liked; ?>" data-postid="<?php echo $post->ID; ?>">
						<i class="icon-heart"></i><br>
                        <p><?php echo get_likes(); ?></p>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="row project-content">
		<div class="col-sm-12">
            <?php
                global $post;
                setup_postdata($post);
                the_content();
            ?>
		</div>
	</div>

    <?php
        $related_posts = get_field("related_projects");
        $custom_query;
        if(!$related_posts){
            $args = array();
            $args["post_not_in"] = $post->ID;
            $args["posts_per_page"] = 4;
            $args["post_type"] = "portfolio";
            $args["tax_query"] = array('relation' => 'OR');

            /*Tags And Category*/
            $category = wp_get_post_terms( $post->ID,"portfolio_category" );
            $category_array = array();
            if($category){
                foreach($category as $tag){
                    array_push($category_array,$tag->slug);
                }
                array_push($args["tax_query"],array(
                    'taxonomy' => 'portfolio_category',
                    'field' => 'slug',
                    'terms' => $category_array
                ));
            }
            /*Tags And Category*/

            $custom_query = new WP_Query($args);
        }
        if($related_posts || $custom_query->have_posts()):
    ?>
	<div class="row related-work">
		<div class="col-sm-12">
			<h5 class="section-title"><?php _e("Related projects","um_lang"); ?></h5>
		</div>
        <?php
            if($related_posts):
                foreach($related_posts as $post):
                    setup_postdata($post);
                    get_template_part("content","related-post");
                endforeach;
            else:
                while ( $custom_query->have_posts() ) :  $custom_query->the_post();
                    setup_postdata($post);
                    get_template_part("content","related-post");
                endwhile;
            endif;
            wp_reset_postdata();
        ?>
	</div>
    <?php endif; ?>

    <script type="text/javascript">
        function init_jquery_swipe(){
            /*If there are no slides, hide slider*/
            if(!jQuery(".project-slider").find("li").length){
                jQuery(".project-slider").hide();
                return true;
            }
            /*If there are no slides, hide slider*/

            jQuery(".project-slider,.project-slider *").removeAttr("style");

            var projectWidth = jQuery('.project-content-top').width();
            //jQuery('.project-slider ul li').css('width', projectWidth);

            /*var imagesHeight = jQuery('.project-slider ul li').find('img').height();
            jQuery('.project-slider').css('height', imagesHeight);*/
            var img_height = [];
            jQuery('.project-slider ul li').find('img').each(function(el){
                img_height.push(parseInt(jQuery(this).height()));
            });
            img_height = Math.min.apply(null,img_height);
            //jQuery('.project-slider').css('height', img_height+"px");

            var slideWidth = jQuery('.project-slider ul li').width();
            var currentSlide = 0;
            var maxSlides =  jQuery('.project-slider ul li').length;
            var speed = 500;

            var slides;
            slides = jQuery(".project-slider ul");
            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                slides.swipe( {
                    triggerOnTouchEnd : true,
                    swipeStatus : swipeStatus,
                    allowPageScroll:"vertical",
                    threshold:75
                } );
                jQuery(".slider-arrows").hide();
            }
			
            function swipeStatus(event, phase, direction, distance) {
                if( phase=="move" && (direction=="left" || direction=="right") )
                {
                    if(direction=="left" || direction=="right"){
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    var duration=0;

                    if (direction == "left")
                        scrollImages((slideWidth * currentSlide) + distance, duration);

                    else if (direction == "right")
                        scrollImages((slideWidth * currentSlide) - distance, duration);

                }

                else if ( phase == "cancel")
                {
                    scrollImages(slideWidth * currentSlide, speed);
                }

                else if ( phase =="end" )
                {
                    if (direction == "right")
                        previousImage()
                    else if (direction == "left")
                        nextImage()
                }
            }

            function previousImage()
            {
                currentSlide = Math.max(currentSlide-1, 0);
                scrollImages( slideWidth * currentSlide, speed);
                jQuery('.project-slider ul li').eq(currentSlide).find('img').css('opacity', 1);
                jQuery('.project-slider ul li').eq(currentSlide).next().find('img').css('opacity', 0.3);
            }

            function nextImage()
            {
                currentSlide = Math.min(currentSlide+1, maxSlides-1);
                scrollImages( slideWidth * currentSlide, speed);
                jQuery('.project-slider ul li').eq(currentSlide).find('img').css('opacity', 1);
                jQuery('.project-slider ul li').eq(currentSlide).prev().find('img').css('opacity', 0.3);
            }

            function scrollImages(distance, duration){

                slides.css("-webkit-transition-duration", (duration/1000).toFixed(1) + "s");
                slides.css("-moz-transition-duration", (duration/1000).toFixed(1) + "s");
                slides.css("-o-transition-duration", (duration/1000).toFixed(1) + "s");
                slides.css("-ms-transition-duration", (duration/1000).toFixed(1) + "s");

                var value = (distance<0 ? "" : "-") + Math.abs(distance).toString();
                slides.css("-webkit-transform", "translate3d("+value +"px,0px,0px)");
                slides.css("-moz-transform", "translate3d("+value +"px,0px,0px)");
                slides.css("-o-transform", "translate3d("+value +"px,0px,0px)");
                slides.css("-ms-transform", "translate3d("+value +"px,0px,0px)");
                if(!Modernizr.csstransforms3d){
                    jQuery(".slider-holder").scrollLeft(Math.abs(value));
                }
            }

            /*var projectWidth = jQuery('.project-content-top').width();
            jQuery('.project-slider ul li').css('width', projectWidth);
            jQuery('.project-slider ul li').css('height', img_height - 65);

            jQuery('.project-slider').css('height', img_height);
            jQuery('.slider-holder').css('height', img_height - 65);*/

            var sliderImgHeight = jQuery('.project-slider').height();
            //jQuery('.project-slider ul').find('li iframe').css('height', sliderImgHeight);
            //jQuery('.slider-holder .slider-arrows a.next-slide').css('left', projectWidth - 44);

            jQuery('body').on('click', '.slider-arrows a.next-slide', function(e){
                e.preventDefault();
                nextImage();
            });

            jQuery('body').on('click', '.slider-arrows a.prev-slide', function(e){
                e.preventDefault();
                previousImage();
            });

            jQuery('.project-slider ul li img').imgscale({
                scale : 'fit',
                center : true
            });
            center_image();
            function center_image(){
                jQuery('.project-slider ul li').find('img').each(function(){
                    var this_img = jQuery(this);

                    var parent_width = parseInt(this_img.parent().width() / 2);
                    var this_img_width = parseInt(this_img.width() / 2);

                    var parent_height = parseInt(this_img.parent().height() / 2);
                    var this_img_height = parseInt(this_img.height() / 2);

                    this_img.css("margin-left",(parent_width - this_img_width) + "px");
                    this_img.css("margin-top",(parent_height - this_img_height) + "px");
                });
            }
        }

        jQuery('#inner-content').waitForImages( function() {
            jQuery(".project-slider ul").swipe("destroy");
            init_jquery_swipe();
            jQuery("a[rel='fancybox_gallery']").fancybox();
        });

        jQuery(window).resize(function() {
            jQuery(".project-slider ul").swipe("destroy");
            init_jquery_swipe();
        });
		
		jQuery(document).ready(function($){
			$('.accordion li:first-child').find('a').addClass('active').find('i').removeClass('icon-plus-sign').addClass('icon-minus-sign');
			$('.accordion li:first-child').find('.section_content').show();

			$('.tabs .tab_buttons > li:first-child').find('a').addClass('active');
			$('.tabs .tab_content li:first-child').show();
		});
		
		
    </script>
</div>

<?php get_footer(); ?>