<?php
/**
 *  Template Name: act_books Single
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php
		//get current url
		$slug = pods_v( 'last', 'url' );
		//get pod name
		$pod_name = pods_v( 0, 'url');
		//get pods object for current item
		$pods = pods( $pod_name, $slug );
		?>
		<article>
			<?php
			//Output template of the same name as Pod, if such a template exists.
			$temp = $pods->template($pod_name);
			if ( isset($temp)  ) {
				echo $temp;
			}
			?>
		</article><!-- #post -->
	</main>
</div>


<?php
get_sidebar();
get_footer();
