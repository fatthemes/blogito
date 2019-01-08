<?php
/**
 * AMP support
 *
 * @package blogito
 */

add_action( 'amp_post_template_css', 'blogito_amp_additional_css_styles' );

/**
 * Custom CSS for AMP.
 *
 * @param type $amp_template amp plugin template.
 */
function blogito_amp_additional_css_styles( $amp_template ) {
	?>
	body, .amp-wp-title, .amp-wp-meta, .amp-wp-header div, .wp-caption-text, .amp-wp-tax-category, .amp-wp-tax-tag, .amp-wp-comments-link, .amp-wp-footer p, .back-to-top {
		font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	}
	a, a:visited {
		color: #000;
	}
	.amp-wp-article,
	.amp-wp-header div,
	.amp-wp-footer div {
		max-width: 720px;
	}
	.amp-wp-header {
		background-color: #fff;
		border-bottom: 1px solid #ddd;
		box-shadow: 0 1px 4px #ddd;
	}
	.amp-wp-header a {
		color: #000;
	}
	.amp-wp-header .amp-wp-site-icon {
		background-color: #ccc;
	}
	.amp-wp-article-header {
		margin-bottom: 1.5em;
	}
	.amp-wp-article-header .amp-wp-meta {
		margin: 0;
	}
	.amp-wp-article-header .amp-wp-byline {
		display: inline-block;
	}
	.amp-wp-article-header .amp-wp-meta.amp-wp-posted-on {
		
		text-align: right;
	}
	.amp-wp-comments-link a {
		border-color: #000;
		border-width: 1px;
		border-radius: 0;
		color: #000;
		font-weight: normal;
	}
	<?php
}
