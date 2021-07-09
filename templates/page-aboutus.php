<?php
/**
 * Template Name: About Us Page
 */

get_header();
?>

	<main id="primary" class="site-main aboutus-page">
		
			<?php
			while ( have_posts() ) :
				the_post();

                $has_sidebar = get_field( 'has_sidebar' );

            ?>
                <div data-section="1">
                    <div class="container">
                        <div class="columns">
            <?php
                if ( $has_sidebar ) {
            ?>
                            <div class="sidebar column is-3">
                                <?php the_field('left_sidebar'); ?>
                            </div>
            <?php                    
                }
            ?>
                            <div class="main-content column <?php echo $has_sidebar?'is-9':'is-12';?>">
                                <?php the_content(); ?>
                            <?php
                                if( have_rows('pdf_files') ):
                            ?>
                                <div  data-section="2" class="columns is-multiline">
                            <?php
                                    $index = 0;
                                    while( have_rows('pdf_files') ) : the_row();
                                        $pdf_title = get_sub_field( 'pdf_title' );
                                        $pdf_thumbnail = get_sub_field( 'pdf_thumbnail' );
                                        $pdf_url = get_sub_field( 'pdf_url' );
                                        if ( $index % 4  == 0 ) {
                                            echo '<hr>';
                                        }
                                        $index++ ;
                            ?>
                                    <div class="pdf-container column is-one-quarter-tablet">
                                        <div class="pdf_thumbnail">
                                            <img src="<?php echo $pdf_thumbnail;?>"/>
                                        </div>
                                        <div class="pdf_title"><?php echo $pdf_title;?></div>
                                        <div class="pdf_button">
                                            <a class="button" href="<?php echo $pdf_url;?>" target="_blank">Download</a>
                                        </div>
                                    </div>
                            <?php
                                    endwhile;
                            ?>
                                </div>
                            <?php
                                endif;
                            ?>
                            </div>
                        </div>
                    </div>
                </div>                

                
            <?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
		
	</main><!-- #main -->

<?php
get_footer();