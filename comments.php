<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bootstrap-theme
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h4 class="comments-title">
			<?php
			printf( // WPCS: XSS OK.
				esc_html( _nx( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'bootstrap-theme' ) ),
				number_format_i18n( get_comments_number() ),
				'<span>' . get_the_title() . '</span>'
			);
			?>
		</h4>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'bootstrap-theme' ); ?></h2>
				<div class="nav-links">

					<div
						class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'bootstrap-theme' ) ); ?></div>
					<div
						class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'bootstrap-theme' ) ); ?></div>

				</div><!-- .nav-links -->
			</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
				'callback'   => 'custom_comment_format',
			) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'bootstrap-theme' ); ?></h2>
				<div class="nav-links">

					<div
						class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'bootstrap-theme' ) ); ?></div>
					<div
						class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'bootstrap-theme' ) ); ?></div>

				</div><!-- .nav-links -->
			</nav><!-- #comment-nav-below -->
			<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'bootstrap-theme' ); ?></p>
		<?php
	endif;

	//changing default parameters of comment form
	$comments_args = array(
		// change the title of send button
		'class_submit'        => 'btn btn-success',
		// change the title of the reply section
		'title_reply'         => '<h3>Write a Reply or Comment</h3>',
		// remove "Text or HTML to be displayed after the set of comment fields"
		'comment_notes_after' => '',
		// bootstrap class of the form
		'class_form'          => 'form-group',
		// replacing standard fields for an anonymous comment here
		'fields'              => apply_filters( 'comment_form_default_fields', array(

			'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . '</label> ' . ( $req ? '<span>*</span>' : '' ) .

			            '<input id="author" name="author" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' /></p>',

			'email' => '<p class="comment-form-email">' .

			           '<label for="email">' . __( 'Email' ) . '</label> ' .

			           ( $req ? '<span>*</span>' : '' ) .

			           '<input id="email" name="email" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" ' . $aria_req . ' />' . '</p>',

			'url' => ''
		) ),
		// redefine your own textarea (the comment body)
		'comment_field'       => '<p class="comment-form-comment">
									<label for="comment">' . _x( 'Comment', 'noun' ) . '</label>
									<br />
									<textarea id="comment" name="comment" aria-required="true" class="form-control"></textarea>
								  </p>',
	);

	comment_form( $comments_args );
	?>

</div><!-- #comments -->
