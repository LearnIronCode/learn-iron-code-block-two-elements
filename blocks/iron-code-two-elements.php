<?php
/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package learn-iron-code-block-two-elements
 */

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * @see https://wordpress.org/gutenberg/handbook/blocks/writing-your-first-block-type/#enqueuing-block-scripts
 */
function iron_code_two_elements_block_init() {

	// Until Gutenberg is merged into WordPress core, register_block_type()
	// will only exist when the Gutenberg plugin is installed and activated.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}

	$dir = dirname( __FILE__ );

	$index_js = 'iron-code-two-elements/index.js';
	wp_register_script(
		'iron-code-two-elements-block-editor',
		plugins_url( $index_js, __FILE__ ),
		array(
			'wp-blocks',
			'wp-i18n',
			'wp-element',
		),
		filemtime( "$dir/$index_js" )
	);

	$editor_css = 'iron-code-two-elements/editor.css';
	wp_register_style(
		'iron-code-two-elements-block-editor',
		plugins_url( $editor_css, __FILE__ ),
		array(
			'wp-blocks',
		),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'iron-code-two-elements/style.css';
	wp_register_style(
		'iron-code-two-elements-block',
		plugins_url( $style_css, __FILE__ ),
		array(
			'wp-blocks',
		),
		filemtime( "$dir/$style_css" )
	);

	/**
	 * Attributes are the editable variables in our block.
	 * Here we create one attribute called "heading" (we could use any name here).
	 *
	 * When the editor is loaded, the attributes are populated by parsing the
	 * block as it is stored in the database and extracting the values.
	 * We control how the block is stored using our "save:" method in index.js
	 * The "selector" indicates what element in our block contains the value.
	 * The "source" indicates what part of the selected element to extract,
	 * the most common is text (the content of the tag), however other parts of
	 * the tag can be used (e.g. id, class, rel, href, src, alt).
	 */
	$attributes = array(
		'heading' => array(
			'type'     => 'string',
			'selector' => 'h2',
			'source'   => 'text',
		),
	);

	register_block_type( 'learn-iron-code-block-two-elements/iron-code-two-elements', array(
		'editor_script' => 'iron-code-two-elements-block-editor',
		'editor_style'  => 'iron-code-two-elements-block-editor',
		'style'         => 'iron-code-two-elements-block',
		'attributes'    => $attributes,
	) );
}
add_action( 'init', 'iron_code_two_elements_block_init' );
