<?php
/**
 *  Template Name: books
 */

get_header(); ?>

	<div id="primary" class="content-area" xmlns="http://www.w3.org/1999/html">
		<main id="main" class="site-main" role="main">
			<header class="entry-header">
				<h2 class="entry-title"><?php esc_html_e( 'Books list', 'bootstrap-theme' ); ?></h2><br>
				</header>
			<?php
			//set find parameters
			$params = array( 'limit' => 4 );

			//get pods object
			$pods = pods( 'books', $params );

			if ( $pods->total() > 0 ) { ?>
				<div class="list-group">
					<?php
					while ( $pods->fetch() ) {
						//Put field values into variables
						$title     = $pods->display( 'name' );
						$permalink = site_url( 'books/' . $pods->field( 'permalink' ) );
						?>
						<a href="<?php echo $permalink; ?>" class="list-group-item"
						   rel="bookmark"><?php echo $title; ?></a>
						<?php
					} ?>
				</div>
					<ul class="pagination">
					<?php echo $pods->pagination( array(
						'type'      => 'simple',
						'next_text' => '<button class="btn-default btn">' . esc_html__( 'Next', 'bootstrap-theme' ) . '<span class="glyphicon glyphicon-chevron-right"></span></button>',
						'prev_text' => '<button class="btn-default btn"><span class="glyphicon glyphicon-chevron-left"></span>' . esc_html__( 'Previous', 'bootstrap-theme' ) . '</button>',
					) ); ?>
				</ul>
				<?php
			}
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
