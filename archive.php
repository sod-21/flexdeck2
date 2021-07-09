<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */

get_header();

?>

	<main id="primary" class="site-main">
        <div data-section>
                <div class="container">
                    <div class="columns is-multiline">
        <?php
        while ( have_posts() ) :
            the_post();
            ?>
    
                <div class="column is-one-third-tablet">
                    <div class="industy-thumnail">
                        <div class="thumbnail">
                            <?php 
                            $url = get_field("thumbnail_image");

                            if ($url) {
                                echo "<a class='image-overlay' href='" . get_the_permalink() . "'>";
                                sod_generate_image_tag( $url );
                                echo "</a>";
                            }
                            ?>
                        </div>
                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    </div>
                </div>
                       
            <?php
            

        endwhile; // End of the loop.
        ?>
        
        </div>
                </div>
            </div>

    
    </main><!-- #main -->

<?php
get_footer();
