<?php

function load_style_script(){
	
	wp_enqueue_script('jquery-1', get_template_directory_uri() . '/js/jquery-1.js');
	wp_enqueue_script('jquery00', get_template_directory_uri() . '/js/jquery00.js');
	wp_enqueue_script('init0000', get_template_directory_uri() . '/js/init0000.js');

	wp_enqueue_style('style', get_template_directory_uri() . '/style.css');


}

add_action( 'wp_enqueue_scripts', 'load_style_script' );

add_theme_support('post-thumbnails');

register_nav_menu( 'menu', 'Меню' );

register_sidebar(array(
	'name' => 'Виджеты сайдбара',
	'id' => 'sidebar',
	'description' => 'Здесь размещайте виджеты сайдбара',
	'before_widget' => '<div class="vidget">',
	'after_widget' => '</div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>'
));

register_sidebar(array(
	'name' => 'Виджеты футера',
	'id' => 'footer',
	'description' => 'Здесь размещайте виджеты футера',
	'before_widget' => '<div class="menu-foot">',
	'after_widget' => '</div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>'
));

function twentytwelve_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback':
			case 'trackback':
				// Display trackbacks differently than normal comments.
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'twentytwelve' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
				break;
			default:
				// Proceed with normal comments.
				global $post;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf(
						'<cite><b class="fn">%1$s</b> %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'twentytwelve' ) . '</span>' : ''
					);
					printf(
						'<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'twentytwelve' ), get_comment_date(), get_comment_time() )
					);
					?>
				</header><!-- .comment-meta -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentytwelve' ); ?></p>
			<?php endif; ?>

				<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'twentytwelve' ), '<p class="edit-link">', '</p>' ); ?>
				</section><!-- .comment-content -->

				<div class="reply">
				<?php
				comment_reply_link(
					array_merge(
						$args, array(
							'reply_text' => __( 'Reply', 'twentytwelve' ),
							'after'      => ' <span>&darr;</span>',
							'depth'      => $depth,
							'max_depth'  => $args['max_depth'],
						)
					)
				);
?>
				</div><!-- .reply -->
			</article><!-- #comment-## -->
		<?php
				break;
		endswitch; // end comment_type check
	}


	// Слайдер

add_action('init', 'slider');
function slider(){
	register_post_type('slider', array(
		'public' => true,
		'supports' => array('title', 'thumbnail'),
		'menu_icon'   => 'dashicons-format-gallery',
		'labels' => array(
			'name' => 'Слайдер',
			'all_items' => 'Все слайды',
			'add_new' => 'Добавить новый',
			'add_new_item' => 'Добавление слайда',
		)
	));
}