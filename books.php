<?php
/**
 *  Template Name: books
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
			//set find parameters
			$params = array( 'limit' => 4 );

			//get pods object
			$pods = pods( 'books', $params );

			if ( $pods->total() > 0 ) {
				while ( $pods->fetch() ) {
					//Put field values into variables
					$title     = $pods->display( 'name' );
					$permalink = site_url( 'books/' . $pods->field( 'permalink' ) );
					?>
					<article>
						<header class="entry-header">
							<div class="list-group">
								<a href="<?php echo $permalink; ?>" class="list-group-item"
								   rel="bookmark"><?php echo $title; ?></a>
							</div>
						</header>
					</article>

					<?php
				} ?>
				<ul class="pagination">
					<?php echo $pods->pagination( array( 'type' => 'simple',
						'next_text' => '<button class="btn-default btn">'. esc_html__('Next', 'bootstrap-theme'). '<span class="glyphicon glyphicon-chevron-right"></span></button>',
						'prev_text' => '<button class="btn-default btn"><span class="glyphicon glyphicon-chevron-left"></span>'. esc_html__('Previous', 'bootstrap-theme'). '</button>',)); ?>
				</ul>
				<?php
			}
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
