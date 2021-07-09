<?php
/**
 * Template Name: Careers Page
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

                <?php 

                $careers = get_field("careers");

                if (!empty($careers)):
                ?>
                <div data-section class="collapse-section">
                    <div class="container">
                        <div class=" column is-10 is-offset-1">
                            <ul class="collapse-wrapper">
                                <?php
                                foreach ($careers as $c):
                                    $title = $c["title"] ? $c["title"] : "";
                                    $content = $c["content"] ? $c["content"] : "";
                                ?>
                                <li>
                                    <div class="col-header">
                                        <?php echo $title; ?>

                                        <div class="icon">
                                            <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="svg-inline--fa fa-plus fa-w-12 fa-3x"><path fill="#0079c2" d="M376 232H216V72c0-4.42-3.58-8-8-8h-32c-4.42 0-8 3.58-8 8v160H8c-4.42 0-8 3.58-8 8v32c0 4.42 3.58 8 8 8h160v160c0 4.42 3.58 8 8 8h32c4.42 0 8-3.58 8-8V280h160c4.42 0 8-3.58 8-8v-32c0-4.42-3.58-8-8-8z" class=""></path></svg>
                                            <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="minus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="svg-inline--fa fa-minus fa-w-12 fa-3x"><path fill="#0079c2" d="M376 232H8c-4.42 0-8 3.58-8 8v32c0 4.42 3.58 8 8 8h368c4.42 0 8-3.58 8-8v-32c0-4.42-3.58-8-8-8z" class=""></path></svg>
                                        </div>
                                    </div>
                                    <div class="col-content">
                                        <?php echo $content; ?>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php
                 endif;
                    $buttons = get_field("button");

                    $b_title = isset($buttons["title"]) ? $buttons["title"]: "";
                    $b_link = isset($buttons["link"]) ? $buttons["link"]: "";

                    if ($b_title && $b_link):
                ?>
                <div data-section>
                    <div class="container">
                        <div class="button-wrapper text-center">
                            <a href="<?php echo $b_link;?>" class="s-btn  s-btn-border-radius"><?php echo $b_title; ?></a>
                        </div>
                    </div>
                </div>
                <?php
                endif;
				// If comments are open or we have at least one comment, load up the comment template.
				// if ( comments_open() || get_comments_number() ) :
				// 	comments_template();
				// endif;

			endwhile; // End of the loop.
			?>
		
	</main><!-- #main -->

<?php
get_footer();
