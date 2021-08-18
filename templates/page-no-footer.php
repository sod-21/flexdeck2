<?php
/**
 * Template Name: No Footer Page
 */

get_header();
?>

	<main id="primary" class="site-main contact-page">		
        <?php
        while ( have_posts() ) :
            the_post();
        ?>
        <div data-section="1" style="padding-bottom: 0;">
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
        <?php
			
			endwhile; // End of the loop.
			?>
	</main><!-- #main -->
<?php
get_footer();
?>