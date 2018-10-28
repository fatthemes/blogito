<?php
/**
 * Searchform template
 *
 * @package blogito
 */

?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
	<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'blogito' ); ?></span>
	<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Type and hit enter', 'blogito' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php esc_attr_e( 'Search for:', 'blogito' ); ?>" />
	</label>
	<input type="submit" class="search-submit" value="<?php esc_attr_e( 'Search', 'blogito' ); ?>" />
</form>
