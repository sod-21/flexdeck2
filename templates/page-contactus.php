<?php
/**
 * Template Name: Contact Us Page
 */

get_header();
?>

	<main id="primary" class="site-main contact-page">
		
			<?php
			while ( have_posts() ) :
				the_post();

                $left = get_field("left");
                $right = get_field("right");
            ?>
            <div data-section="1">
                <div class="container">
                    <div class="columns">
                        <div class="column">
                            <div class="content">
                                <?php the_content(); ?> 
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <div data-section>
                <div class="container">
                    <div class="columns">
                        <?php if ($left): ?>
                            <div class="column">
                            <div class="content">
                                <?php echo $left; ?>
                        </div>
                            </div>
                        <?php endif; ?>
                         <?php if ($right): ?>
                            <div class="column">
                            <div class="content">
                                <?php echo $right; ?>
                         </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>   
            <?php
			
			endwhile; // End of the loop.
			?>
		
	</main><!-- #main -->

<?php
get_footer();