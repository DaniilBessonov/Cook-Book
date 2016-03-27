<?php
/**
 * The front page template file.
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear. Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Canape
 */

if ( 'posts' == get_option( 'show_on_front' ) ) :

	get_template_part( 'index' );

else :

?>

	<?php get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<div id="primary" class="content-area front-page-content-area">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="hero" id="hero" style="background-image: url( '<?php echo esc_url( wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' )[0] ); ?>' );">
						<?php the_post_thumbnail( 'canape-hero-thumbnail' ); ?>
					</div>
				<?php endif; ?>

				<div class="hero-container-outer">
					<div class="hero-container-inner">
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header class="entry-header">
								<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
							</header><!-- .entry-header -->

							<div class="entry-content">
								<?php the_content(); ?>
							</div><!-- .entry-content -->
							<?php edit_post_link( __( 'Edit', 'canape' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
						</article><!-- #post-## -->
					</div>
				</div>

		</div><!-- #primary -->
	<?php endwhile; ?>

	<?php get_template_part( 'template-parts/content', 'front-menu' ); ?>

<!-- start dabe -->
    <div class="content-wrapper full-width <?php echo esc_attr( canape_additional_class() ); ?>">
        <div id="primary" class="content-area">
            <div id="content" class="site-main" role="main">
                <?php

                $loop = new WP_Query( array( 'post_type' => 'nova_menu_item' ) );

                if ( post_type_exists( 'nova_menu_item' ) && $loop -> have_posts() ) :

                    while ( $loop->have_posts() ) : $loop->the_post();
                        get_template_part( 'template-parts/content', 'menu' );
                    endwhile; // end of the Menu Item Loop
                    wp_reset_postdata();
                endif;
                ?>
            </div><!-- #content .site-main -->
        </div><!-- #primary .content-area -->
    </div><!-- .content-wrapper -->
<!-- end dabe -->



	<?php
		if ( 1 == get_theme_mod( 'canape_front_testimonials', 1 ) ) {
			get_template_part( 'template-parts/content', 'front-testimonial' );
		}
	?>

	<?php get_sidebar( 'front-page' ); ?>

<?php endif; ?>

<?php get_footer(); ?>
