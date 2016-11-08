<?php
/**
 * bootstrap-theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package bootstrap-theme
 */

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

if ( ! function_exists( 'bootstrap_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function bootstrap_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on bootstrap-theme, use a find and replace
		 * to change 'bootstrap-theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'bootstrap-theme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'bootstrap-theme' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'bootstrap_theme_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
	}
endif;
add_action( 'after_setup_theme', 'bootstrap_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bootstrap_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bootstrap_theme_content_width', 640 );
}

add_action( 'after_setup_theme', 'bootstrap_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bootstrap_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'bootstrap-theme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'bootstrap-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

add_action( 'widgets_init', 'bootstrap_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
if ( ! function_exists( 'bootstrap_theme_scripts' ) ) :
	function bootstrap_theme_scripts() {
		wp_enqueue_style( 'bootstrap-theme-style', get_stylesheet_uri() );

		wp_enqueue_script( 'bootstrap-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

		wp_enqueue_script( 'bootstrap-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
endif;

add_action( 'wp_enqueue_scripts', 'bootstrap_theme_scripts' );

/**
 * Replacing active li element (for the nav menu) css class here
 */
add_filter( 'nav_menu_css_class', 'special_nav_class', 10 );

if ( ! function_exists( 'special_nav_class' ) ) :
	function special_nav_class( $classes ) {
		if ( in_array( 'current-menu-item', $classes ) ) {
			$classes[] = 'active ';
		}

		return $classes;
	}
endif;

/**
 * Adding custom format for the comments.
 */
if ( ! function_exists( 'custom_comment_format' ) ) :
	function custom_comment_format( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;

		?>

		<article id="comment-<?php comment_ID(); ?>" class="comment-content">
			<div class="media-body">

				<footer class="comment-meta">
					<div class="comment-meta pull-left">  <?php echo get_avatar( $comment, 48 ); ?> </div>
					<div class="comment-author vcard">
						<?php printf( __( '%s <span class="says sr-only">says:</span>' ), sprintf( '<b class="media-heading fn">%s</b>', get_comment_author_link( $comment ) ) ); ?>
					</div><!-- /.comment-author -->

					<div class="comment-metadata">
						<a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
							<time datetime="<?php comment_time( 'c' ); ?>">
								<?php
								/* translators: 1: comment date, 2: comment time */
								printf( __( '%1$s at %2$s' ), get_comment_date( '', $comment ), get_comment_time() );
								?>
							</time>
						</a>
						<?php edit_comment_link( '<span class="glyphicon glyphicon-pencil"></span>' ); ?>
					</div><!-- /.comment-metadata -->

					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></p>
					<?php endif; ?>
				</footer><!-- /.comment-meta -->

				<div class="comment-content">
					<?php comment_text(); ?>
				</div><!-- /.comment-content -->

				<?php comment_reply_link( array_merge( $args, array(
					'reply_text' => __( '<button class="btn btn-default" type="button">Reply</button>' ),
					'depth'      => $depth,
					'max_depth'  => $args['max_depth']
				) ) ); ?> 
		</article>

		<?php
	}
endif;

/**
 * Changing class of avatar image to use Bootstrap's class
 */
add_filter( 'get_avatar', 'add_gravatar_class' );
if ( ! function_exists( 'add_gravatar_class' ) ) :
	function add_gravatar_class( $class ) {
		$class = str_replace( "class='avatar", "class='img-rounded", $class );

		return $class;
	}
endif;

