<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bootstrap-theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

			the_post_navigation( array(
				'next_text' => '<button type="button" class="btn btn-default">' .
					'<span class="post-title">%title</span>' .
					'<span class="glyphicon glyphicon-chevron-right"></span>' .
					'</button>',
				'prev_text' => '<button type="button" class="btn btn-default">' .
					'<span class="glyphicon glyphicon-chevron-left"></span>' .
					'<span class="post-title">%title</span>' .
					'</button>',
			) );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
