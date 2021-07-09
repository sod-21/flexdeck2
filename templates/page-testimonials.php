<?php
/**
 * Template Name: Testimonials Page
 */

get_header();
?>

	<main id="primary" class="site-main">
		
			<?php
			while ( have_posts() ) :
				the_post();

                
                ?>
                <div data-section="1">
                    <div class="container">
                        <div class=" column is-10 is-offset-1">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>                

                <div data-section class="customer-testimonials">
                    <div class="container">
                        <div class="columns is-multiline">
                            <?php 
                                
                                $customers = get_field("testimonal_list");
                                // $testimonial_shortcode = get_field("testimonial_shortcode");
                                
                                    $posts = get_posts(
                                        array(
                                            "post_type" => "testimonial",            
                                            'post_status' => "publish",
                                            'numberposts' => -1,
                                            // 'post__in' => $customers
                                        )
                                    );

                                    foreach ( $posts as $post ) {
                                        // setup_postdata($post);
                                        $pid = $post->ID;
                                        $rate = get_field("rate", $pid);
                                        $customer = get_field("customer", $pid );
                            
                                        if (!$customer ||  $customer == $customers):

                                    ?>
                                    <div class="column is-10  is-offset-1">
                                        <div class="testimonial-item">
                                            <div class="testimonial-content">
                                                <!-- <h3><?php echo $post->post_title; ?></h3> -->
                                                <q class="quote"><?php echo $post->post_content; ?></q>
                                                <div class="customers">
                                                    -<span class="name"><?php echo $customer;?></span>,
                                                    <span class="caption"><?php echo get_field("caption", $pid );?></span>
                                                </div>

                                                <div class="star-rating">
                                                    <?php for ($i = 0; $i < 5; $i++): 
                                                        if ($i < $rate) { ?>
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-star <?php echo $className; ?>"><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" class=""></path></svg>
                                                    <?php } else {
                                                        ?>                    
                                                    <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-star "><path d="M528.1 171.5L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6zM388.6 312.3l23.7 138.4L288 385.4l-124.3 65.3 23.7-138.4-100.6-98 139-20.2 62.2-126 62.2 126 139 20.2-100.6 98z" ></path></svg>                    
                                                    <?php } ?>
                                                    <?php endfor; ?>
                                                </div>
                                            </div>
                                            <div class="t-item-border"></div>
                                        </div>
                                    </div>

                                <?php
                                    endif;
                                }
                                
                            ?>
                            
                        </div>
                    </div>
                </div>

                <?php
				// If comments are open or we have at least one comment, load up the comment template.
				// if ( comments_open() || get_comments_number() ) :
				// 	comments_template();
				// endif;

			endwhile; // End of the loop.
			?>
		
	</main><!-- #main -->

<?php
get_footer();