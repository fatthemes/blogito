<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package blogito
 */

if ( ! function_exists( 'blogito_posted_on' ) ) :

	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function blogito_posted_on() {

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	if ( is_single() ) {

			$time_string = sprintf(
			$time_string, esc_attr( get_the_date( 'c' ) ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) )
				);

				$posted_on = sprintf( /* translators: link to post date */
				esc_html_x( '%s ago', 'post date', 'blogito' ), '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
				);

				$byline = sprintf( /* translators: link to author page */
				esc_html_x( ' by %s', 'post author', 'blogito' ), '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
				);

				echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
	} else {

			$time_string = sprintf( $time_string, esc_attr( get_the_date( 'c' ) ), esc_attr( get_the_date() ) );

			$posted_on = sprintf( /* translators: link to post date */
			esc_html_x( '%s ', 'post date', 'blogito' ), '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
			);

			echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
	}
	}

endif;

if ( ! function_exists( 'blogito_entry_footer' ) ) :

	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function blogito_entry_footer() {

	blogito_jetpack_sharing();

	// Hide category and tag text for pages.
	if ( is_single() && 'post' === get_post_type() ) {

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'blogito' ) );
			if ( $tags_list ) { /* translators: related tag list */
			printf( '<span class="tags-links">' . esc_html__( 'Tagged: %1$s', 'blogito' ) . '</span>', $tags_list ); // WPCS: XSS OK.
				}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( '<span><svg width="18" height="18"><path d="M14.143 7.714q0 1.396-0.944 2.581t-2.576 1.873-3.551 0.688q-0.864 0-1.768-0.161-1.246 0.884-2.792 1.286-0.362 0.090-0.864 0.161h-0.030q-0.11 0-0.206-0.080t-0.116-0.211q-0.010-0.030-0.010-0.065t0.005-0.065 0.020-0.060l0.025-0.050t0.035-0.055 0.040-0.050 0.045-0.050 0.040-0.045q0.050-0.060 0.231-0.251t0.261-0.296 0.226-0.291 0.251-0.387 0.206-0.442q-1.246-0.723-1.959-1.778t-0.713-2.25q0-1.396 0.944-2.581t2.576-1.873 3.551-0.688 3.551 0.688 2.576 1.873 0.944 2.581zM18 10.286q0 1.205-0.713 2.255t-1.959 1.773q0.1 0.241 0.206 0.442t0.251 0.387 0.226 0.291 0.261 0.296 0.231 0.251q0.010 0.010 0.040 0.045t0.045 0.050 0.040 0.050 0.035 0.055l0.025 0.050t0.020 0.060 0.005 0.065-0.010 0.065q-0.030 0.141-0.131 0.221t-0.221 0.070q-0.502-0.070-0.864-0.161-1.547-0.402-2.792-1.286-0.904 0.161-1.768 0.161-2.722 0-4.741-1.326 0.583 0.040 0.884 0.040 1.617 0 3.104-0.452t2.652-1.296q1.256-0.924 1.929-2.129t0.673-2.551q0-0.773-0.231-1.527 1.296 0.713 2.049 1.788t0.753 2.31z"></path></svg></span>', '<span><svg width="18" height="18"><path d="M14.143 7.714q0 1.396-0.944 2.581t-2.576 1.873-3.551 0.688q-0.864 0-1.768-0.161-1.246 0.884-2.792 1.286-0.362 0.090-0.864 0.161h-0.030q-0.11 0-0.206-0.080t-0.116-0.211q-0.010-0.030-0.010-0.065t0.005-0.065 0.020-0.060l0.025-0.050t0.035-0.055 0.040-0.050 0.045-0.050 0.040-0.045q0.050-0.060 0.231-0.251t0.261-0.296 0.226-0.291 0.251-0.387 0.206-0.442q-1.246-0.723-1.959-1.778t-0.713-2.25q0-1.396 0.944-2.581t2.576-1.873 3.551-0.688 3.551 0.688 2.576 1.873 0.944 2.581zM18 10.286q0 1.205-0.713 2.255t-1.959 1.773q0.1 0.241 0.206 0.442t0.251 0.387 0.226 0.291 0.261 0.296 0.231 0.251q0.010 0.010 0.040 0.045t0.045 0.050 0.040 0.050 0.035 0.055l0.025 0.050t0.020 0.060 0.005 0.065-0.010 0.065q-0.030 0.141-0.131 0.221t-0.221 0.070q-0.502-0.070-0.864-0.161-1.547-0.402-2.792-1.286-0.904 0.161-1.768 0.161-2.722 0-4.741-1.326 0.583 0.040 0.884 0.040 1.617 0 3.104-0.452t2.652-1.296q1.256-0.924 1.929-2.129t0.673-2.551q0-0.773-0.231-1.527 1.296 0.713 2.049 1.788t0.753 2.31z"></path></svg></span><span class="comments-number"> 1</span>', '<span><svg width="18" height="18"><path d="M14.143 7.714q0 1.396-0.944 2.581t-2.576 1.873-3.551 0.688q-0.864 0-1.768-0.161-1.246 0.884-2.792 1.286-0.362 0.090-0.864 0.161h-0.030q-0.11 0-0.206-0.080t-0.116-0.211q-0.010-0.030-0.010-0.065t0.005-0.065 0.020-0.060l0.025-0.050t0.035-0.055 0.040-0.050 0.045-0.050 0.040-0.045q0.050-0.060 0.231-0.251t0.261-0.296 0.226-0.291 0.251-0.387 0.206-0.442q-1.246-0.723-1.959-1.778t-0.713-2.25q0-1.396 0.944-2.581t2.576-1.873 3.551-0.688 3.551 0.688 2.576 1.873 0.944 2.581zM18 10.286q0 1.205-0.713 2.255t-1.959 1.773q0.1 0.241 0.206 0.442t0.251 0.387 0.226 0.291 0.261 0.296 0.231 0.251q0.010 0.010 0.040 0.045t0.045 0.050 0.040 0.050 0.035 0.055l0.025 0.050t0.020 0.060 0.005 0.065-0.010 0.065q-0.030 0.141-0.131 0.221t-0.221 0.070q-0.502-0.070-0.864-0.161-1.547-0.402-2.792-1.286-0.904 0.161-1.768 0.161-2.722 0-4.741-1.326 0.583 0.040 0.884 0.040 1.617 0 3.104-0.452t2.652-1.296q1.256-0.924 1.929-2.129t0.673-2.551q0-0.773-0.231-1.527 1.296 0.713 2.049 1.788t0.753 2.31z"></path></svg></span><span class="comments-number">' . esc_html__( ' %', 'blogito' ) ) . '</span>';
			echo '</span>';
	}

	edit_post_link( esc_html__( 'Edit', 'blogito' ), '<span class="edit-link">', '</span>' );
	}

endif;

if ( ! function_exists( 'blogito_categorized_blog' ) ) :

	/**
	 * Returns true if a blog has more than 1 category.
	 *
	 * @return bool
	 */
	function blogito_categorized_blog() {
	$all_the_cool_cats = get_transient( 'blogito_categories' );
	if ( ! $all_the_cool_cats ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories(
			array(
				'fields' => 'ids',
				'hide_empty' => 1,
				// We only need to know if there is more than one category.
				'number' => 2,
			)
				);

				// Count the number of categories that are attached to the posts.
				$all_the_cool_cats = count( $all_the_cool_cats );

				set_transient( 'blogito_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so blogito_categorized_blog should return true.
			return true;
	} else {
			// This blog has only 1 category so blogito_categorized_blog should return false.
			return false;
	}
	}

endif;

/**
 * Flush out the transients used in blogito_categorized_blog.
 */
function blogito_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
	return;
	}
	// Like, beat it. Dig?
	delete_transient( 'blogito_categories' );
}

add_action( 'edit_category', 'blogito_category_transient_flusher' );
add_action( 'save_post', 'blogito_category_transient_flusher' );

if ( ! function_exists( 'blogito_comment' ) ) :

	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since blogito 1.0
	 * @param type $comment comment.
	 * @param type $args comment args.
	 * @param type $depth comments depth.
	 */
	function blogito_comment( $comment, $args, $depth ) {
	// $GLOBALS['comment'] = $comment;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
		<footer>
			<div class="comment-author vcard">
			<?php $avatar = get_avatar( $comment, $args['avatar_size'] ); ?>
			<?php if ( ! empty( $avatar ) ) : ?>
				<div class="comments-avatar">
				<?php echo wp_kses_post( $avatar ); ?>
				</div>
			<?php endif; ?>
			<div class="comment-meta commentmetadata">
				<?php printf( sprintf( '<cite class="fn"><b>%s</b></cite>', get_comment_author_link() ) ); ?>
				<br />
				<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php comment_time( 'c' ); ?>">
					<?php
					/* translators: 1: date, 2: time */
					printf( esc_html__( '%s ago', 'blogito' ), esc_html( human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ) );
					?>
				</time></a>
				<span class="reply">
				<?php
				comment_reply_link(
					array_merge(
						$args, array(
							'depth' => $depth,
							'max_depth' => $args['max_depth'],
							'reply_text' => 'REPLY',
							'before' => ' &#8901; ',
						)
					)
				);
				?>
				</span><!-- .reply -->
				<?php
				edit_comment_link( __( 'Edit', 'blogito' ), ' &#8901; ' );
				?>
			</div><!-- .comment-meta .commentmetadata -->
			</div><!-- .comment-author .vcard -->
			<?php if ( '0' === $comment->comment_approved ) : ?>
				<em><?php esc_html_e( 'Your comment is awaiting moderation.', 'blogito' ); ?></em>
				<br />
			<?php endif; ?>

		</footer>

		<div class="comment-content"><?php comment_text(); ?></div>

		</article><!-- #comment-## -->
		<?php
	}

	endif; // Ends check for blogito_comment().

	if ( ! function_exists( 'blogito_comments_fields' ) ) :

	/**
	 * Customized comment form
	 *
	 * @param array $fields comment form fields.
	 * @return string
	 */
	function blogito_comments_fields( $fields ) {

		$commenter = wp_get_current_commenter();
		// $user = wp_get_current_user();
		// $user_identity = $user->exists() ? $user->display_name : '';
		if ( ! isset( $args['format'] ) ) {
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
		}

		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? ' aria-required="true"' : '' );
		$html_req = ( $req ? ' required="required"' : '' );
		$html5 = 'html5' === $args['format'];

		$fields = array(
			'author' => '<div class="comment-fields"><p class="comment-form-author"><label for="author">' . esc_html__( 'Name', 'blogito' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
			'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . $html_req . ' placeholder="' . esc_html__( 'Name', 'blogito' ) . '" /></p>',
			'email' => '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'blogito' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
			'<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '"' . $aria_req . $html_req . ' placeholder="' . esc_html__( 'Email', 'blogito' ) . '" /></p>',
			'url' => '<p class="comment-form-ur"><label for="url">' . esc_html__( 'Website', 'blogito' ) . '</label> ' .
			'<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . esc_html__( 'Website', 'blogito' ) . '" /></p></div>',
		);

		return $fields;
	}

	add_filter( 'comment_form_default_fields', 'blogito_comments_fields' );
	endif;

	/**
	 * Gets the excerpt using the post ID outside the loop.
	 *
	 * @author      Withers David
	 * @link        http://uplifted.net/programming/wordpress-get-the-excerpt-automatically-using-the-post-id-outside-of-the-loop/
	 * @param       int $post_id WP post ID.
	 * @return      string
	 */
	function blogito_get_excerpt_by_id( $post_id ) {
	$the_post = get_post( $post_id ); // Gets post ID.
	$the_excerpt = $the_post->post_content; // Gets post_content to be used as a basis for the excerpt.
	$excerpt_length = 35; // Sets excerpt length by word count.
	$the_excerpt = strip_tags( strip_shortcodes( $the_excerpt ) ); // Strips tags and images.
	$words = explode( ' ', $the_excerpt, $excerpt_length + 1 );

	if ( count( $words ) > $excerpt_length ) :
		array_pop( $words );
		array_push( $words, '...' );
		$the_excerpt = implode( ' ', $words );
	endif;

	$the_excerpt = '<p>' . $the_excerpt . '</p>';
	return $the_excerpt;
	}

	if ( ! function_exists( 'blogito_custom_popular_posts_html_list' ) ) :

	/**
	 * Builds custom HTML
	 *
	 * With this function, I can alter WPP's HTML output from my theme's functions.php.
	 * This way, the modification is permanent even if the plugin gets updated.
	 *
	 * @param   array $mostpopular WPP mostpopular.
	 * @param   array $instance WPP instance.
	 * @return  string
	 */
	function blogito_custom_popular_posts_html_list( $mostpopular, $instance ) {
		$output = '<ul class="fat-wpp-list">';

		// Loop the array of popular posts objects.
		foreach ( $mostpopular as $popular ) {

		// $post_cat = get_the_category_list( esc_html__( '<span> &#124; </span>', 'blogito' ), '', $popular->id );
		$post_cat = wp_kses(
			get_the_category_list( __( '<span>&#124;</span>', 'blogito' ), '', $popular->id ), array(
				'a' => array(
					'href' => array(),
				),
				'span' => '',
			)
		);

		$thumb = get_the_post_thumbnail( $popular->id, 'medium' );

		$output .= '<li>';
		$output .= ( ! empty( $thumb ) ) ? '<div class="fat-wpp-image"><a href="' . esc_url( get_the_permalink( $popular->id ) ) . '" title="' . esc_attr( $popular->title ) . '">' /* . blogito_post_format_icon( $popular->id ) */ . $thumb . '</a>' : '';
		$output .= blogito_post_format_icon( $popular->id );
		$output .= ( ! empty( $post_cat ) ) ? '<div class="fat-wpp-image-cat">' . $post_cat . '</div>' : '';
		$output .= ( ! empty( $thumb ) ) ? '</div>' : '';
		$output .= '<h2 class="entry-title"><a href="' . esc_url( get_the_permalink( $popular->id ) ) . '" title="' . esc_attr( $popular->title ) . '">' . $popular->title . '</a></h2>';
		// $output .= ( ! empty ($stats)) ? $stats : "";
		// $output .= $excerpt;
		$output .= '</li>';
		}

		$output .= '</ul>';

		return $output;
	}

	add_filter( 'wpp_custom_html', 'blogito_custom_popular_posts_html_list', 10, 2 );
	endif;

	if ( ! function_exists( 'blogito_content' ) ) :

	/**
	 * Template for displaying content in different post formats.
	 *
	 * @since blogito 1.0
	 */
	function blogito_content() {

		$format = get_post_format();

		if ( 'audio' === $format ) {
		return blogito_media_content();
		} elseif ( 'video' === $format ) {
		return blogito_media_content();
		} elseif ( 'gallery' === $format ) {
		return blogito_gallery_content();
		} else {
		$content = get_the_content( sprintf( '<button>%s' . the_title( '<span class="screen-reader-text">"', '"</span>', false ) . '</button>', esc_html__( 'Read more', 'blogito' ) ) );
		$content = apply_filters( 'the_content', $content );
		$content = str_replace( ']]>', ']]&gt;', $content );
		echo $content; // WPCS: XSS OK.
		}
	}

	endif;

	if ( ! function_exists( 'blogito_gallery_content' ) ) :

	/**
	 * Template for cutting images from gallery post format.
	 *
	 * @since blogito 1.0
	 */
	function blogito_gallery_content() {

		// $content = get_the_content( sprintf( __( '<button>Read more %s</button>', 'blogito' ), the_title( '<span class="screen-reader-text">"', '"</span>', false ) ) );
		$content = get_the_content( sprintf( '<button>%s' . the_title( '<span class="screen-reader-text">"', '"</span>', false ) . '</button>', esc_html__( 'Read more', 'blogito' ) ) );
		$pattern = '#\[gallery[^\]]*\]#';
		$replacement = '';

		$newcontent = preg_replace( $pattern, $replacement, $content, 1 );
		$newcontent = apply_filters( 'the_content', $newcontent );
		$newcontent = str_replace( ']]>', ']]&gt;', $newcontent );
		echo $newcontent; // WPCS: XSS OK.
	}

	endif;

	if ( ! function_exists( 'blogito_media_content' ) ) :

	/**
	 * Template for cutting media from audio/video post formats.
	 *
	 * @since blogito 1.0
	 */
	function blogito_media_content() {
		// $content = get_the_content( sprintf( __( '<button>Read more %s</button>', 'blogito' ), the_title( '<span class="screen-reader-text">"', '"</span>', false ) ) );
		$content = get_the_content( sprintf( '<button>%s' . the_title( '<span class="screen-reader-text">"', '"</span>', false ) . '</button>', esc_html__( 'Read more', 'blogito' ) ) );
		$content = apply_filters( 'the_content', $content );
		$content = str_replace( ']]>', ']]&gt;', $content );

		$tags = 'audio|video|object|embed|iframe';

		$replacement = '';

		$newcontent = preg_replace( '#<(?P<tag>' . $tags . ')[^<]*?(?:>[\s\S]*?<\/(?P=tag)>|\s*\/>)#', $replacement, $content, 1 );

		echo $newcontent; // WPCS: XSS OK.
	}

	endif;

	if ( ! function_exists( 'blogito_gallery_shortcode' ) ) :

	/**
	 * Custom gallery shortcode output.
	 *
	 * @param type  $output gellery shortcode output.
	 * @param array $atts gellery shortcode atts.
	 * @param type  $instance gellery shortcode instance.
	 * @return type
	 */
	function blogito_gallery_shortcode( $output = '', $atts, $instance ) {
		$return = $output; // Fallback.

		$atts = array(
			'size' => 'medium',
		);

		return $output;
	}

	add_filter( 'post_gallery', 'blogito_gallery_shortcode', 10, 3 );
	endif;

	if ( ! function_exists( 'blogito_post_format_icon' ) ) :

	/**
	 * Function for getting post format icon.
	 *
	 * @param type $post_id WP post ID.
	 * @return string
	 */
	function blogito_post_format_icon( $post_id ) {

		if ( empty( $post_id ) ) {
		return;
		}

		$format = get_post_format( $post_id );

		if ( ! $format ) {

		return;
		} else {

		if ( 'audio' === $format ) {
				return '<div class="blogito-post-format-icon"><svg viewBox="0 0 24 24"><path d="M17.297 11.016h1.688q0 2.531-1.758 4.43t-4.242 2.273v3.281h-1.969v-3.281q-2.484-0.375-4.242-2.273t-1.758-4.43h1.688q0 2.203 1.57 3.633t3.727 1.43 3.727-1.43 1.57-3.633zM10.781 4.922v6.188q0 0.469 0.352 0.82t0.867 0.352q0.469 0 0.82-0.328t0.352-0.844l0.047-6.188q0-0.516-0.375-0.867t-0.844-0.352-0.844 0.352-0.375 0.867zM12 14.016q-1.219 0-2.109-0.891t-0.891-2.109v-6q0-1.219 0.891-2.109t2.109-0.891 2.109 0.891 0.891 2.109v6q0 1.219-0.891 2.109t-2.109 0.891z"></path></svg></div>';
		} elseif ( 'video' === $format ) {
				return '<div class="blogito-post-format-icon"><svg viewBox="0 0 24 24"><path d="M9 9.984l6.984 4.031-6.984 3.984v-8.016zM21 20.016v-12h-18v12h18zM21 6q0.797 0 1.406 0.586t0.609 1.43v12q0 0.797-0.609 1.383t-1.406 0.586h-18q-0.797 0-1.406-0.586t-0.609-1.383v-12q0-0.844 0.609-1.43t1.406-0.586h7.594l-3.281-3.281 0.703-0.703 3.984 3.984 3.984-3.984 0.703 0.703-3.281 3.281h7.594z"></path></svg></div>';
		} elseif ( 'gallery' === $format ) {
				return '<div class="blogito-post-format-icon"><svg viewBox="0 0 24 24"><path d="M3.984 12.984v7.031h7.031v1.969h-7.031q-0.797 0-1.383-0.586t-0.586-1.383v-7.031h1.969zM20.016 20.016v-7.031h1.969v7.031q0 0.797-0.586 1.383t-1.383 0.586h-7.031v-1.969h7.031zM20.016 2.016q0.797 0 1.383 0.586t0.586 1.383v7.031h-1.969v-7.031h-7.031v-1.969h7.031zM17.016 8.484q0 0.609-0.445 1.055t-1.055 0.445-1.055-0.445-0.445-1.055 0.445-1.055 1.055-0.445 1.055 0.445 0.445 1.055zM9.984 12.984l3 3.703 2.016-2.672 3 3.984h-12zM3.984 3.984v7.031h-1.969v-7.031q0-0.797 0.586-1.383t1.383-0.586h7.031v1.969h-7.031z"></path></svg></div>';
		}
		}
	}

	endif;

	/*
     * CSS output from customizer settings
     */
	if ( ! function_exists( 'blogito_customize_css' ) ) :

	/**
	 * Custom css header output
	 */
	function blogito_customize_css() {
		$hide_title_on_home_archive = get_theme_mod( 'hide_title_on_home_archive', 0 );
		$hide_meta_on_home_archive = get_theme_mod( 'hide_meta_on_home_archive', 0 );
		?>
		<style type="text/css">
	<?php if ( 'front' === get_theme_mod( 'header_display', 'front' ) ) { ?>
			body:not(.home) .site-content {margin-top: 6.5rem;}
	<?php } elseif ( '' === get_theme_mod( 'header_display', 'front' ) ) { ?>
			.site-content {margin-top: 6.5rem;}
	<?php } ?>
	<?php if ( 'blank' !== get_header_textcolor() ) : ?>
		.site-title a, .site-description {color: #<?php header_textcolor(); ?>;}
	<?php endif; ?>
		.blogito-featured-slider, .blogito-featured-slider .featured-image, .blogito-featured-slider .no-featured-image {height:<?php echo ( absint( get_theme_mod( 'home_page_slider_height', 500 ) ) * 0.6 ); ?>px;}
		#secondary .widget:nth-of-type(3n+1), #secondary .widget:nth-of-type(3n+1) .widget-title span {background-color:<?php echo esc_attr( get_theme_mod( 'sidebar_bg_color_1', '#ffffff' ) ); ?>;}
		#secondary .widget:nth-of-type(3n+2), #secondary .widget:nth-of-type(3n+2) .widget-title span {background-color:<?php echo esc_attr( get_theme_mod( 'sidebar_bg_color_2', '#ffffff' ) ); ?>;}
		#secondary .widget:nth-of-type(3n+3), #secondary .widget:nth-of-type(3n+3) .widget-title span {background-color:<?php echo esc_attr( get_theme_mod( 'sidebar_bg_color_3', '#ffffff' ) ); ?>;}
		.home, .archive, .search, .home .slick-prev:after, .home .slick-next:after, .home #secondary .widget_social_media_icons_widget_by_fat li, .archive #secondary .widget_social_media_icons_widget_by_fat li, .search #secondary .widget_social_media_icons_widget_by_fat li, .home #secondary .widget.widget_mc4wp_form_widget, .home #secondary .widget.widget_mc4wp_form_widget .widget-title span, .home #bottom-widget .widget-title span, .home #top-widget .widget-title span, .archive #secondary .widget.widget_mc4wp_form_widget, .archive #secondary .widget.widget_mc4wp_form_widget .widget-title span, .archive #bottom-widget .widget-title span, .archive #top-widget .widget-title span, .search #secondary .widget.widget_mc4wp_form_widget, .search #secondary .widget.widget_mc4wp_form_widget .widget-title span, .search #bottom-widget .widget-title span, .search #top-widget .widget-title span {background-color: <?php echo esc_attr( get_theme_mod( 'home_page_bg_color', '#f5f5f5' ) ); ?>;}
	<?php if ( $hide_title_on_home_archive ) : ?>
			.blog .content-area .entry-title, .archive .content-area .entry-title, .search .content-area .entry-title {display:none;}
	<?php endif; ?>
	<?php if ( $hide_meta_on_home_archive ) : ?>
			.blog .content-area .entry-meta, .archive .content-area .entry-meta, .search .content-area .entry-meta {display:none;}
			.blog .masonry .entry-content, .archive .masonry .entry-content, .search .masonry .entry-content {padding-bottom: 2rem;}
	<?php endif; ?>
		svg:hover,a svg:hover,.blogito-author-social-icons a:hover svg {fill: <?php echo esc_attr( get_theme_mod( 'button_color', '#a0946b' ) ); ?>;}
		button,input[type="button"],input[type="reset"],input[type="submit"],.navbar-navigation .current_page_item > a:after,.navbar-navigation .current-menu-item > a:after,.navbar-navigation .current_page_ancestor > a:after,.navbar-navigation .current-menu-ancestor > a:after {border: 1px solid <?php echo esc_attr( get_theme_mod( 'button_color', '#a0946b' ) ); ?>;}
		button:hover,input[type="button"]:hover,input[type="reset"]:hover,input[type="submit"]:hover,a:hover,a:focus,a:active,.navbar-navigation a:hover,.main-navigation ul .current_page_item > a,
		.main-navigation ul .current-menu-item > a,.main-navigation ul .current_page_ancestor > a,.main-navigation ul .current-menu-ancestor > a,.main-navigation ul .current_page_item > .expand-submenu,.main-navigation ul .current-menu-item > .expand-submenu,.main-navigation ul .current_page_ancestor > .expand-submenu,.main-navigation ul .current-menu-ancestor > .expand-submenu,.widget_nav_menu ul .current_page_item > a,.widget_nav_menu ul .current-menu-item > a,.widget_nav_menu ul .current_page_ancestor > a,.widget_nav_menu ul .current-menu-ancestor > a,.widget_nav_menu ul .current_page_item > .expand-submenu,.widget_nav_menu ul .current-menu-item > .expand-submenu,.widget_nav_menu ul .current_page_ancestor > .expand-submenu,.widget_nav_menu ul .current-menu-ancestor > .expand-submenu,.nav-links a:hover > .blogito-next-article-title,.nav-links a:hover > .blogito-previous-article-title,.nav-links a:hover > .blogito-next-article,.nav-links a:hover > .blogito-previous-article,.main-navigation .expand-submenu:hover,.widget_nav_menu .expand-submenu:hover,.main-navigation a:hover,.widget_nav_menu a:hover,.nav-social a:hover svg,.left-nav-social a:hover svg {color: <?php echo esc_attr( get_theme_mod( 'button_color', '#a0946b' ) ); ?>;}
		.blogito-search-panel .blogito-search-panel-close:hover,
		.menu-toggle:hover,
		.search-toggle:hover,
		button,
		input[type="button"],
		input[type="reset"],
		input[type="submit"] {background-color: <?php echo esc_attr( get_theme_mod( 'button_color', '#a0946b' ) ); ?>;}
		.left-sidebar-close:hover svg line {stroke: <?php echo esc_attr( get_theme_mod( 'button_color', '#a0946b' ) ); ?>;}
		@media screen and (min-width: <?php echo absint( get_theme_mod( 'show_top_menu_width', 978 ) ); ?>px )  {
			.menu-logo {float:left;}
			.navbar-navigation ul, .nav-social {display:block;}
			.blogito-featured-slider, .blogito-featured-slider .featured-image, .blogito-featured-slider .no-featured-image {height:<?php echo absint( get_theme_mod( 'home_page_slider_height', 500 ) ); ?>px;}
		}
		</style>
		<?php
	}

	add_action( 'wp_head', 'blogito_customize_css' );

	endif;

	/**
	 * Months with translations for js.
	 *
	 * @return type
	 */
	function blogito_months() {

	$months = array();

	$jan = esc_html__( 'January', 'blogito' );
	$feb = esc_html__( 'February', 'blogito' );
	$mar = esc_html__( 'March', 'blogito' );
	$apr = esc_html__( 'April', 'blogito' );
	$may = esc_html__( 'May', 'blogito' );
	$jun = esc_html__( 'June', 'blogito' );
	$jul = esc_html__( 'July', 'blogito' );
	$aug = esc_html__( 'August', 'blogito' );
	$sep = esc_html__( 'September', 'blogito' );
	$oct = esc_html__( 'October', 'blogito' );
	$nov = esc_html__( 'November', 'blogito' );
	$dec = esc_html__( 'December', 'blogito' );

	$months = array( $jan, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec );

	return $months;
	}

	/**
	 * Days with translations for js.
	 *
	 * @return type
	 */
	function blogito_days() {

	$days = array();

	$sun = esc_html__( 'Sunday', 'blogito' );
	$mon = esc_html__( 'Monday', 'blogito' );
	$tue = esc_html__( 'Tuesday', 'blogito' );
	$wed = esc_html__( 'Wednesday', 'blogito' );
	$thu = esc_html__( 'Thursday', 'blogito' );
	$fri = esc_html__( 'Friday', 'blogito' );
	$sat = esc_html__( 'Saturday', 'blogito' );

	$days = array( $sun, $mon, $tue, $wed, $thu, $fri, $sat );

	return $days;
	}

	/**
	 * Function add span to menu elements which has children.
	 *
	 * @param string $item_output html output.
	 * @param type   $item menu element object.
	 * @param type   $depth menu depth level.
	 * @param type   $args nwv walker args.
	 * @return string
	 */
	function blogito_submenu_span( $item_output, $item, $depth, $args ) {

	$needle1 = 'menu-item-has-children';
	$needle2 = 'page_item_has_children';
	$haystack = $item->classes;
	if ( in_array( $needle1, $haystack, true ) || in_array( $needle2, $haystack, true ) ) {
		$item_output = $item_output . '<span class="expand-submenu" title="' . esc_attr__( 'Expand', 'blogito' ) . '">&#43;</span>';
	}

	return $item_output;
	}

	add_filter( 'walker_nav_menu_start_el', 'blogito_submenu_span', 10, 4 );

	/**
	 * Function for displaying related posts on single post.
	 */
	function blogito_related_posts() {
	$show_related = get_theme_mod( 'single_page_related_posts_show', 1 );

	if ( $show_related ) {

		$by_cat = get_theme_mod( 'single_page_related_posts_by_tag_or_cat', 1 );
		$taxonomy = ( $by_cat ? 'category' : 'post_tag' );

		if ( $by_cat ) {
		$terms = wp_get_post_categories( get_the_ID() );
		} else {
		$terms = wp_get_post_tags(
			get_the_ID(), array(
				'fields' => 'ids',
			)
		);
		}

		$args = array(
			'posts_per_page' => 3,
			'post__not_in' => array( get_the_ID() ),
			'post_type' => 'post',
			'tax_query' => array(
				'relation' => 'OR',
				array(
					'taxonomy' => $taxonomy,
					'terms' => $terms,
				),
			),
		);
		$the_query = new WP_Query( $args );

		if ( $the_query->have_posts() ) :
		?>
			<div class="blogito-related-posts col-md-12">
			<h3><span><?php echo esc_html( get_theme_mod( 'single_page_related_posts_title', __( 'You May Also Like', 'blogito' ) ) ); ?></span></h3>
			<div class="row">
			<?php
			while ( $the_query->have_posts() ) :
				$the_query->the_post();
				?>
				<div class="col-xs-12 col-md-4">
				<?php if ( has_post_thumbnail() ) : ?>
					<a class="related-posts-thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" style="background: url( <?php the_post_thumbnail_url( 'medium' ); ?> ) center no-repeat;background-size: cover;"></a>
				<?php endif; ?>
				<p><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></p>
				</div>
				<?php
			endwhile;
			wp_reset_postdata();
			?>
			</div>
			</div>
		<?php
		endif;
	}// End if().
	}

	/**
	 * Displays Jetpack sharing buttons.
	 */
	function blogito_jetpack_sharing() {
	if ( function_exists( 'sharing_display' ) ) {
		$options = get_option( 'sharing-options' );
		$display_options = $options['global']['show'];

		if ( ! is_feed() ) {
		if ( is_singular() && in_array( get_post_type(), $display_options, true ) ) {
				echo '<div class="blogito-jp-sharing">' . wp_kses_post( sharing_display( '', false ) ) . '</div>';
		} elseif ( in_array( 'index', $display_options, true ) && ( is_home() || is_front_page() || is_archive() || is_search() || in_array( get_post_type(), $display_options, true ) ) ) {
				echo '<button class="blogito-jp-sharing-toggle"><span><svg width="12" height="14"><path d="M9.5 8q1.039 0 1.77 0.73t0.73 1.77-0.73 1.77-1.77 0.73-1.77-0.73-0.73-1.77q0-0.094 0.016-0.266l-2.812-1.406q-0.719 0.672-1.703 0.672-1.039 0-1.77-0.73t-0.73-1.77 0.73-1.77 1.77-0.73q0.984 0 1.703 0.672l2.812-1.406q-0.016-0.172-0.016-0.266 0-1.039 0.73-1.77t1.77-0.73 1.77 0.73 0.73 1.77-0.73 1.77-1.77 0.73q-0.984 0-1.703-0.672l-2.812 1.406q0.016 0.172 0.016 0.266t-0.016 0.266l2.812 1.406q0.719-0.672 1.703-0.672z"></path></svg></span></button><div class="blogito-jp-sharing">' . wp_kses_post( sharing_display( '', false ) ) . '</div><button class="blogito-jp-sharing-close"><span><svg width="14" height="14"><svg><line stroke-miterlimit="10" x1="0.354" y1="0.354" x2="14.354" y2="14.354"/><line stroke-miterlimit="10" x1="14.354" y1="0.354" x2="0.354" y2="14.354"/></svg></svg></span></button>';
		}
		}
	}
	}

	/**
	 * Remove Jetpack sharing filters.
	 */
	function blogito_jetpack_sharing_remove_filters() {
	if ( function_exists( 'sharing_display' ) ) {
		remove_filter( 'the_content', 'sharing_display', 19 );
		remove_filter( 'the_excerpt', 'sharing_display', 19 );
	}
	}

	add_action( 'init', 'blogito_jetpack_sharing_remove_filters' );

	/**
	 * Site branding header section.
	 */
	function blogito_the_site_branding() {
	$output = '';
	if ( 'always' === get_theme_mod( 'header_display', 'front' ) ) {
		if ( is_front_page() && is_home() ) {
			$output .= '<div class="site-branding">';
			$output .= '<h1 class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">';
			if ( get_header_image() ) {
				$output .= '<img src="' . get_header_image() . '" alt="' . get_bloginfo( 'name' ) . '" >';
				} elseif ( 'blank' !== get_header_textcolor() ) {
				$output .= get_bloginfo( 'name' );
				}
			$output .= '</a></h1>';
			if ( ! get_header_image() && 'blank' !== get_header_textcolor() ) {
				$output .= '<p class="site-description">' . get_bloginfo( 'description' ) . '</p>';
				}
			$output .= '</div><!-- .site-branding -->';
			} else {
			$output = '<div class="site-branding">';
			$output .= '<p class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">';
			if ( get_header_image() ) {
				$output .= '<img src="' . get_header_image() . '" alt="' . get_bloginfo( 'name' ) . '" >';
				} elseif ( 'blank' !== get_header_textcolor() ) {
				$output .= get_bloginfo( 'name' );
				}
			$output .= '</a></p>';
			if ( ! get_header_image() && 'blank' !== get_header_textcolor() ) {
				$output .= '<p class="site-description">' . get_bloginfo( 'description' ) . '</p>';
				}
			$output .= '</div><!-- .site-branding -->';
			}
	} elseif ( 'front' === get_theme_mod( 'header_display', 'front' ) && is_front_page() && is_home() ) {
		$output .= '<div class="site-branding">';
		$output .= '<h1 class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">';
		if ( get_header_image() ) {
			$output .= '<img src="' . get_header_image() . '" alt="' . get_bloginfo( 'name' ) . '" >';
			} elseif ( 'blank' !== get_header_textcolor() ) {
			$output .= get_bloginfo( 'name' );
			}
		$output .= '</a></h1>';
		if ( ! get_header_image() && 'blank' !== get_header_textcolor() ) {
			$output .= '<p class="site-description">' . get_bloginfo( 'description' ) . '</p>';
			}
		$output .= '</div><!-- .site-branding -->';
		}
	echo $output; // WPCS: XSS OK.
	}

