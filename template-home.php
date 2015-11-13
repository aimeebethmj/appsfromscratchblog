<?php
/**
Template Name: Home Page
 *
 * @package luna
 */

get_header(); ?>


	<?php if ( get_theme_mod( 'luna_home_bg_image' ) ) : ?>
		<section id="home-hero" style="background-image: url('<?php echo esc_url( get_theme_mod( 'luna_home_bg_image' )); ?>');"> 
    <?php else: ?>
    	<section id="home-hero">
    <?php endif; ?>
	
    		<div class="grid grid-pad">
    			<div class="col-1-1">
        	
            		<?php if ( get_theme_mod( 'luna_home_title' ) ) : ?>
        				<h1><?php echo wp_kses_post( get_theme_mod( 'luna_home_title' )); ?></h1>
            		<?php endif; ?>
                    
            		<?php if ( get_theme_mod( 'luna_home_text' ) ) : ?>
        				<p><?php echo wp_kses_post( get_theme_mod( 'luna_home_text' )); ?></p> 
            		<?php endif; ?>
            		
                    <?php if ( get_theme_mod( 'luna_home_button_url' ) ) : ?>
             			<a href="<?php echo esc_url( get_page_link( get_theme_mod('luna_home_button_url'))) ?>" class="featured-link"> 
            		<?php endif; ?>
            
            		<?php if ( get_theme_mod( 'luna_home_button_text' ) ) : ?> 
                		<button>
                        	<?php echo esc_html( get_theme_mod( 'luna_home_button_text' )); ?> 
                    	</button>
                	<?php endif; ?>
                
            		<?php if ( get_theme_mod( 'luna_home_button_url' ) ) : ?>
            			</a> 
            		<?php endif; ?> 
                    
        	
            	</div>
    		</div>
    
	<?php if ( get_theme_mod( 'luna_home_bg_image' ) ) : ?>
		</section>
    <?php else: ?>
    	</section>
    <?php endif; ?>


<!-- PULL IN POSTS -->

<section id="page-content-container" class="blog-post-archive">
        

    <?php 

        // let's grab the banner image before we run the query for cat=8
        // bloody WordPress queries LOL...

        $bannerImage = get_field('banner_image');
        $bannerTitle = get_field('banner_title');
        $bannerSubtitle = get_field('banner_subtitle');
        $bannerLink  = get_field('banner_link');
        $buttonLabel = get_field('banner_button_label');

        // showMeTheGoods($bannerImage);

    ?>
    
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">



        <!-- INTRO -->


             
        <div class="grid grid-pad">
            <div class="col-1-1">
               <div class="content">
                    <div class="intro">
                        <div class="grid grid-pad">        
                            <div class="col-1-1">
                                <h1><?php echo get_field('intro_greeting');?></h1>
                                <h3><?php echo get_field('intro_blurb'); ?></h3>
                                <!-- <a href="<?php echo $bannerLink; ?>" class="featured-link"><button><?php echo $buttonLabel; ?></button></a> -->
                            </div>
                        </div>
                    </div>
               </div>
            </div>
        </div>



        <!-- INFO PANELS -->


        <div class="info-panels">

            <?php if( have_rows('info_panel') ): ?>

            <?php 

                $rowIndex = 0;
                
                while( have_rows('info_panel') ): the_row(); 

                $isEven = $rowIndex % 2;
                $infoPanelImage = get_sub_field('info_panel_image');

            ?>

                <div class="grid grid-pad single-info-panel">

                    <?php if ($isEven) { ?>

                        <!-- I'm in an even row -->
                        <div class="col-1-2">
                            <div class="info-panel-blurb">
                                <?php echo get_sub_field('info_panel_text');?>
                            </div>
                        </div>
                        <div class="col-1-2">
                            <div class="info-panel-image" style="background-image: url('<?php echo $infoPanelImage['url'] ?>');">
                            </div>
                        </div>

                    <?php } else { ?>

                        <!-- I'm in an odd row -->
                        <div class="col-1-2">
                            <div class="info-panel-image" style="background-image: url('<?php echo $infoPanelImage['url'] ?>');">
                            </div>
                        </div>
                        <div class="col-1-2">
                            <div class="info-panel-blurb">
                                <?php echo get_sub_field('info_panel_text');?>
                            </div>
                        </div>

                    <?php } ?>

                </div>

            <?php 
                $rowIndex++;
                endwhile;  
            ?>

            <?php endif; ?>



        </div>



        <!-- BLOG -->

        <div class="grid grid-pad">        
            <div class="col-1-1">
                <div class="section-intro">
                    <h1><?php echo get_field('section_heading');?></h1>
                    <h3><?php echo get_field('section_blurb'); ?></h3>
                    <!-- <a href="<?php echo $bannerLink; ?>" class="featured-link"><button><?php echo $buttonLabel; ?></button></a> -->
                </div>
            </div>
        </div>

        <?php 

            /* get all the posts which category id is 8 */
            query_posts('cat=8&posts_per_page=2'); 

        ?>

        <?php

        if ( have_posts() ) : ?>


            <?php while ( have_posts() ) : the_post(); ?>

                <?php
                    /* Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
                    get_template_part( 'content', get_post_format() );
                ?>

            <?php endwhile; ?>


        <?php else : ?>

            <?php get_template_part( 'content', 'none' ); ?>

        <?php endif; ?>

        <?php 

            // Reset Query
            wp_reset_query();

        ?>    

        <!-- WORKSHEETS FEATURE -->
        
        <div class="grid grid-pad">
            <div class="col-1-1">
               <div class="content">
                    <div class="banner-image" style="background-image: url('<?php echo $bannerImage['url']; ?>');">
                        <div class="grid grid-pad">        
                            <div class="col-1-1">
                                <h1><?php echo $bannerTitle; ?></h1>
                                <h2><?php echo $bannerSubtitle; ?></h2>
                                <a href="<?php echo $bannerLink; ?>" class="featured-link"><button><?php echo $buttonLabel; ?></button></a>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
        </div>



        <?php 

            /* get all the posts which category id is 3 */
            query_posts('cat=3&posts_per_page=2'); 

        ?>

        <?php

        if ( have_posts() ) : ?>


            <?php while ( have_posts() ) : the_post(); ?>

                <?php
                    /* Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
                    get_template_part( 'content', get_post_format() );
                ?>

            <?php endwhile; ?>


        <?php else : ?>

            <?php get_template_part( 'content', 'none' ); ?>

        <?php endif; ?>

        <?php 

            // Reset Query
            wp_reset_query();

        ?> 

        </main><!-- #main -->
    </div><!-- #primary -->

</section>

<?php get_footer(); ?>
