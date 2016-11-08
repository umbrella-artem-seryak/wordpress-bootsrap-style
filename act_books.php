<?php
/**
 *  Template Name: act_books
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<h3>The list of the ACT Books is below:</h3>
			<?php
			//set find parameters
			$params = array( 'limit' => 4 );

			//get pods object
			$pods = pods( 'act_books', $params );

			if ( $pods->total() > 0 ) {
				while ( $pods->fetch() ) {
					//Put field values into variables
					$title     = $pods->display( 'name' );
					$permalink = site_url( 'act_books/' . $pods->field( 'permalink' ) );
					?>
					<article>
						<header class="entry-header">
							<h4 class="entry-title">
								<a href="<?php echo $permalink; ?>" rel="bookmark"><li><?php echo $title; ?></li></a>
							</h4>
						</header>
					</article>

					<?php
				}
			}
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
