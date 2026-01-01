<?php

namespace TechSpokes\WPTools\HTML;

/**
 * Final class for generating HTML tags.
 *
 * @package TechSpokes\WPTools\HTML
 * @since 0.0.1
 */
final class HTML extends Tag {

	/**
	 * Generates an anchor `<a>` tag.
	 *
	 * If the `href` attribute is not provided, it defaults to `'#'` and sets the `role` attribute to `'button'`.
	 * If the content is not provided, it defaults to the value of the `href` attribute.
	 *
	 * @param string|null $content The content inside the `<a>` tag. Defaults to the `href` value if null.
	 * @param array $attributes Associative array of attributes for the `<a>` tag.
	 *
	 * @return string The generated `<a>` tag as a string.
	 */
	public static function a( ?string $content = null, array $attributes = [] ): string {
		if ( empty( $attributes['href'] ) ) {
			$attributes['href'] = '#';
			$attributes['role'] = $attributes['role'] ?? 'button';
		}
		if ( is_null( $content ) ) {
			$content = $attributes['href'];
		}

		return self::tag( 'a', $content, $attributes );
	}

	/**
	 * Generates an `<abbr>` tag.
	 *
	 * @param string|null $content The content inside the `<abbr>` tag.
	 * @param array $attributes Associative array of attributes for the `<abbr>` tag.
	 *
	 * @return string The generated `<abbr>` tag as a string.
	 */
	public static function abbr( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'abbr', $content, $attributes );
	}

	/**
	 * Generates an `<address>` tag.
	 *
	 * @param string|null $content The content inside the `<address>` tag.
	 * @param array $attributes Associative array of attributes for the `<address>` tag.
	 *
	 * @return string The generated `<address>` tag as a string.
	 */
	public static function address( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'address', $content, $attributes );
	}

	/**
	 * Generates an `<area />` tag.
	 *
	 * @param array $attributes Associative array of attributes for the `<area />` tag.
	 *
	 * @return string The generated `<area />` tag as a string.
	 */
	public static function area( array $attributes = [] ): string {
		return self::tag( 'area', null, $attributes, true );
	}

	/**
	 * Generates an `<article>` tag.
	 *
	 * @param string|null $content The content inside the `<article>` tag.
	 * @param array $attributes Associative array of attributes for the `<article>` tag.
	 *
	 * @return string The generated `<article>` tag as a string.
	 */
	public static function article( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'article', $content, $attributes );
	}

	/**
	 * Generates an `<aside>` tag.
	 *
	 * @param string|null $content The content inside the `<aside>` tag.
	 * @param array $attributes Associative array of attributes for the `<aside>` tag.
	 *
	 * @return string The generated `<aside>` tag as a string.
	 */
	public static function aside( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'aside', $content, $attributes );
	}

	/**
	 * Generates an `<audio>` tag.
	 *
	 * @param string|null $content The content inside the `<audio>` tag.
	 * @param array $attributes Associative array of attributes for the `<audio>` tag.
	 *
	 * @return string The generated `<audio>` tag as a string.
	 */
	public static function audio( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'audio', $content, $attributes );
	}

	/**
	 * Generates a `<b>` tag.
	 *
	 * @param string|null $content The content inside the `<b>` tag.
	 * @param array $attributes Associative array of attributes for the `<b>` tag.
	 *
	 * @return string The generated `<b>` tag as a string.
	 */
	public static function b( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'b', $content, $attributes );
	}

	/**
	 * Generates a `<base />` tag.
	 *
	 * @param array $attributes Associative array of attributes for the `<base />` tag.
	 *
	 * @return string The generated `<base />` tag as a string.
	 */
	public static function base( array $attributes = [] ): string {
		return self::tag( 'base', null, $attributes, true );
	}

	/**
	 * Generates a `<bdi>` tag.
	 *
	 * @param string|null $content The content inside the `<bdi>` tag.
	 * @param array $attributes Associative array of attributes for the `<bdi>` tag.
	 *
	 * @return string The generated `<bdi>` tag as a string.
	 */
	public static function bdi( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'bdi', $content, $attributes );
	}

	/**
	 * Generates a `<bdo>` tag.
	 *
	 * @param string|null $content The content inside the `<bdo>` tag.
	 * @param array $attributes Associative array of attributes for the `<bdo>` tag.
	 *
	 * @return string The generated `<bdo>` tag as a string.
	 */
	public static function bdo( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'bdo', $content, $attributes );
	}

	/**
	 * Generates a `<blockquote>` tag.
	 *
	 * @param string|null $content The content inside the `<blockquote>` tag.
	 * @param array $attributes Associative array of attributes for the `<blockquote>` tag.
	 *
	 * @return string The generated `<blockquote>` tag as a string.
	 */
	public static function blockquote( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'blockquote', $content, $attributes );
	}

	/**
	 * Generates a `<body>` tag.
	 *
	 * @param string|null $content The content inside the `<body>` tag.
	 * @param array $attributes Associative array of attributes for the `<body>` tag.
	 *
	 * @return string The generated `<body>` tag as a string.
	 */
	public static function body( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'body', $content, $attributes );
	}

	/**
	 * Generates a `<br />` tag.
	 *
	 * @param array $attributes Associative array of attributes for the `<br />` tag.
	 *
	 * @return string The generated `<br />` tag as a string.
	 */
	public static function br( array $attributes = [] ): string {
		return self::tag( 'br', null, $attributes, true );
	}

	/**
	 * Generates a `<button>` tag.
	 *
	 * @param string|null $content The content inside the `<button>` tag.
	 * @param array $attributes Associative array of attributes for the `<button>` tag.
	 *
	 * @return string The generated `<button>` tag as a string.
	 */
	public static function button( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'button', $content, $attributes );
	}

	/**
	 * Generates a `<caption>` tag.
	 *
	 * @param string|null $content The content inside the `<caption>` tag.
	 * @param array $attributes Associative array of attributes for the `<caption>` tag.
	 *
	 * @return string The generated `<caption>` tag as a string.
	 */
	public static function caption( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'caption', $content, $attributes );
	}

	/**
	 * Generates a `<cite>` tag.
	 *
	 * @param string|null $content The content inside the `<cite>` tag.
	 * @param array $attributes Associative array of attributes for the `<cite>` tag.
	 *
	 * @return string The generated `<cite>` tag as a string.
	 */
	public static function cite( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'cite', $content, $attributes );
	}

	/**
	 * Generates a `<code>` tag.
	 *
	 * @param string|null $content The content inside the `<code>` tag.
	 * @param array $attributes Associative array of attributes for the `<code>` tag.
	 *
	 * @return string The generated `<code>` tag as a string.
	 */
	public static function code( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'code', $content, $attributes );
	}

	/**
	 * Generates a `<col />` tag.
	 *
	 * @param array $attributes Associative array of attributes for the `<col />` tag.
	 *
	 * @return string The generated `<col />` tag as a string.
	 */
	public static function col( array $attributes = [] ): string {
		return self::tag( 'col', null, $attributes, true );
	}

	/**
	 * Generates a `<colgroup>` tag.
	 *
	 * @param string|null $content The content inside the `<colgroup>` tag.
	 * @param array $attributes Associative array of attributes for the `<colgroup>` tag.
	 *
	 * @return string The generated `<colgroup>` tag as a string.
	 */
	public static function colgroup( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'colgroup', $content, $attributes );
	}

	/**
	 * Generates a `<data>` tag.
	 *
	 * @param string|null $content The content inside the `<data>` tag.
	 * @param array $attributes Associative array of attributes for the `<data>` tag.
	 *
	 * @return string The generated `<data>` tag as a string.
	 */
	public static function data( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'data', $content, $attributes );
	}

	/**
	 * Generates a `<datalist>` tag.
	 *
	 * @param string|null $content The content inside the `<datalist>` tag.
	 * @param array $attributes Associative array of attributes for the `<datalist>` tag.
	 *
	 * @return string The generated `<datalist>` tag as a string.
	 */
	public static function datalist( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'datalist', $content, $attributes );
	}

	/**
	 * Generates a `<del>` tag.
	 *
	 * @param string|null $content The content inside the `<del>` tag.
	 * @param array $attributes Associative array of attributes for the `<del>` tag.
	 *
	 * @return string The generated `<del>` tag as a string.
	 */
	public static function del( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'del', $content, $attributes );
	}

	/**
	 * Generates a `<details>` tag.
	 *
	 * @param string|null $content The content inside the `<details>` tag.
	 * @param array $attributes Associative array of attributes for the `<details>` tag.
	 *
	 * @return string The generated `<details>` tag as a string.
	 */
	public static function details( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'details', $content, $attributes );
	}

	/**
	 * Generates a `<dfn>` tag.
	 *
	 * @param string|null $content The content inside the `<dfn>` tag.
	 * @param array $attributes Associative array of attributes for the `<dfn>` tag.
	 *
	 * @return string The generated `<dfn>` tag as a string.
	 */
	public static function dfn( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'dfn', $content, $attributes );
	}

	/**
	 * Generates a `<dialog>` tag.
	 *
	 * @param string|null $content The content inside the `<dialog>` tag.
	 * @param array $attributes Associative array of attributes for the `<dialog>` tag.
	 *
	 * @return string The generated `<dialog>` tag as a string.
	 */
	public static function dialog( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'dialog', $content, $attributes );
	}

	/**
	 * Generates a `<figcaption>` tag.
	 *
	 * @param string|null $content The content inside the `<figcaption>` tag.
	 * @param array $attributes Associative array of attributes for the `<figcaption>` tag.
	 *
	 * @return string The generated `<figcaption>` tag as a string.
	 */
	public static function figcaption( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'figcaption', $content, $attributes );
	}

	/**
	 * Generates a `<figure>` tag.
	 *
	 * @param string|null $content The content inside the `<figure>` tag.
	 * @param array $attributes Associative array of attributes for the `<figure>` tag.
	 *
	 * @return string The generated `<figure>` tag as a string.
	 */
	public static function figure( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'figure', $content, $attributes );
	}

	/**
	 * Generates a `<footer>` tag.
	 *
	 * @param string|null $content The content inside the `<footer>` tag.
	 * @param array $attributes Associative array of attributes for the `<footer>` tag.
	 *
	 * @return string The generated `<footer>` tag as a string.
	 */
	public static function footer( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'footer', $content, $attributes );
	}

	/**
	 * Generates a `<form>` tag.
	 *
	 * @param string|null $content The content inside the `<form>` tag.
	 * @param array $attributes Associative array of attributes for the `<form>` tag.
	 *
	 * @return string The generated `<form>` tag as a string.
	 */
	public static function form( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'form', $content, $attributes );
	}

	/**
	 * Generates a `<h1>` tag.
	 *
	 * @param string|null $content The content inside the `<h1>` tag.
	 * @param array $attributes Associative array of attributes for the `<h1>` tag.
	 *
	 * @return string The generated `<h1>` tag as a string.
	 */
	public static function h1( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'h1', $content, $attributes );
	}

	/**
	 * Generates a heading `<h2>` tag.
	 *
	 * @param string|null $content The content inside the `<h2>` tag.
	 * @param array $attributes Associative array of attributes for the `<h2>` tag.
	 *
	 * @return string The generated `<h2>` tag as a string.
	 */
	public static function h2( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'h2', $content, $attributes );
	}

	/**
	 * Generates a heading `<h3>` tag.
	 *
	 * @param string|null $content The content inside the `<h3>` tag.
	 * @param array $attributes Associative array of attributes for the `<h3>` tag.
	 *
	 * @return string The generated `<h3>` tag as a string.
	 */
	public static function h3( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'h3', $content, $attributes );
	}

	/**
	 * Generates a heading `<h4>` tag.
	 *
	 * @param string|null $content The content inside the `<h4>` tag.
	 * @param array $attributes Associative array of attributes for the `<h4>` tag.
	 *
	 * @return string The generated `<h4>` tag as a string.
	 */
	public static function h4( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'h4', $content, $attributes );
	}

	/**
	 * Generates a heading `<h5>` tag.
	 *
	 * @param string|null $content The content inside the `<h5>` tag.
	 * @param array $attributes Associative array of attributes for the `<h5>` tag.
	 *
	 * @return string The generated `<h5>` tag as a string.
	 */
	public static function h5( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'h5', $content, $attributes );
	}

	/**
	 * Generates a heading `<h6>` tag.
	 *
	 * @param string|null $content The content inside the `<h6>` tag.
	 * @param array $attributes Associative array of attributes for the `<h6>` tag.
	 *
	 * @return string The generated `<h6>` tag as a string.
	 */
	public static function h6( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'h6', $content, $attributes );
	}

	/**
	 * Generates a `<header>` tag.
	 *
	 * @param string|null $content The content inside the `<header>` tag.
	 * @param array $attributes Associative array of attributes for the `<header>` tag.
	 *
	 * @return string The generated `<header>` tag as a string.
	 */
	public static function header( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'header', $content, $attributes );
	}

	/**
	 * Generates a horizontal rule `<hr />` tag.
	 *
	 * @param array $attributes Associative array of attributes for the `<hr />` tag.
	 *
	 * @return string The generated `<hr />` tag as a string.
	 */
	public static function hr( array $attributes = [] ): string {
		return self::tag( 'hr', null, $attributes, true );
	}

	/**
	 * Generates an italic `<i>` tag.
	 *
	 * @param string|null $content The content inside the `<i>` tag.
	 * @param array $attributes Associative array of attributes for the `<i>` tag.
	 *
	 * @return string The generated `<i>` tag as a string.
	 */
	public static function i( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'i', $content, $attributes );
	}

	/**
	 * Generates an `<iframe>` tag.
	 *
	 * @param string|null $content The content inside the `<iframe>` tag.
	 * @param array $attributes Associative array of attributes for the `<iframe>` tag.
	 *
	 * @return string The generated `<iframe>` tag as a string.
	 */
	public static function iframe( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'iframe', $content, $attributes );
	}

	/**
	 * Generates an `<input />` tag.
	 *
	 * @param array $attributes Associative array of attributes for the `<input />` tag.
	 *
	 * @return string The generated `<input />` tag as a string.
	 */
	public static function input( array $attributes = [] ): string {
		return self::tag( 'input', null, $attributes, true );
	}

	/**
	 * Generates an `<ins>` tag.
	 *
	 * @param string|null $content The content inside the `<ins>` tag.
	 * @param array $attributes Associative array of attributes for the `<ins>` tag.
	 *
	 * @return string The generated `<ins>` tag as a string.
	 */
	public static function ins( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'ins', $content, $attributes );
	}

	/**
	 * Generates a `<kbd>` tag.
	 *
	 * @param string|null $content The content inside the `<kbd>` tag.
	 * @param array $attributes Associative array of attributes for the `<kbd>` tag.
	 *
	 * @return string The generated `<kbd>` tag as a string.
	 */
	public static function kbd( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'kbd', $content, $attributes );
	}

	/**
	 * Generates a `<legend>` tag.
	 *
	 * @param string|null $content The content inside the `<legend>` tag.
	 * @param array $attributes Associative array of attributes for the `<legend>` tag.
	 *
	 * @return string The generated `<legend>` tag as a string.
	 */
	public static function legend( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'legend', $content, $attributes );
	}

	/**
	 * Generates a `<link />` tag.
	 *
	 * @param array $attributes Associative array of attributes for the `<link />` tag.
	 *
	 * @return string The generated `<link />` tag as a string.
	 */
	public static function link( array $attributes = [] ): string {
		return self::tag( 'link', null, $attributes, true );
	}

	/**
	 * Generates a `<map>` tag.
	 *
	 * @param string|null $content The content inside the `<map>` tag.
	 * @param array $attributes Associative array of attributes for the `<map>` tag.
	 *
	 * @return string The generated `<map>` tag as a string.
	 */
	public static function map( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'map', $content, $attributes );
	}

	/**
	 * Generates a `<mark>` tag.
	 *
	 * @param string|null $content The content inside the `<mark>` tag.
	 * @param array $attributes Associative array of attributes for the `<mark>` tag.
	 *
	 * @return string The generated `<mark>` tag as a string.
	 */
	public static function mark( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'mark', $content, $attributes );
	}

	/**
	 * Generates a `<menu>` tag.
	 *
	 * @param string|null $content The content inside the `<menu>` tag.
	 * @param array $attributes Associative array of attributes for the `<menu>` tag.
	 *
	 * @return string The generated `<menu>` tag as a string.
	 */
	public static function menu( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'menu', $content, $attributes );
	}

	/**
	 * Generates a `<meta />` tag.
	 *
	 * @param array $attributes Associative array of attributes for the `<meta />` tag.
	 *
	 * @return string The generated `<meta />` tag as a string.
	 */
	public static function meta( array $attributes = [] ): string {
		return self::tag( 'meta', null, $attributes, true );
	}

	/**
	 * Generates a `<meter>` tag.
	 *
	 * @param string|null $content The content inside the `<meter>` tag.
	 * @param array $attributes Associative array of attributes for the `<meter>` tag.
	 *
	 * @return string The generated `<meter>` tag as a string.
	 */
	public static function meter( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'meter', $content, $attributes );
	}

	/**
	 * Generates a `<noscript>` tag.
	 *
	 * @param string|null $content The content inside the `<noscript>` tag.
	 * @param array $attributes Associative array of attributes for the `<noscript>` tag.
	 *
	 * @return string The generated `<noscript>` tag as a string.
	 */
	public static function noscript( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'noscript', $content, $attributes );
	}

	/**
	 * Generates an `<object>` tag.
	 *
	 * @param string|null $content The content inside the `<object>` tag.
	 * @param array $attributes Associative array of attributes for the `<object>` tag.
	 *
	 * @return string The generated `<object>` tag as a string.
	 */
	public static function object( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'object', $content, $attributes );
	}

	/**
	 * Generates an `<optgroup>` tag.
	 *
	 * @param string|null $content The content inside the `<optgroup>` tag.
	 * @param array $attributes Associative array of attributes for the `<optgroup>` tag.
	 *
	 * @return string The generated `<optgroup>` tag as a string.
	 */
	public static function optgroup( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'optgroup', $content, $attributes );
	}

	/**
	 * Generates an `<option>` tag.
	 *
	 * @param string|null $content The content inside the `<option>` tag.
	 * @param array $attributes Associative array of attributes for the `<option>` tag.
	 *
	 * @return string The generated `<option>` tag as a string.
	 */
	public static function option( ?string $content, array $attributes = [] ): string {
		return self::tag( 'option', $content, $attributes );
	}

	/**
	 * Generates an `<output>` tag.
	 *
	 * @param string|null $content The content inside the `<output>` tag.
	 * @param array $attributes Associative array of attributes for the `<output>` tag.
	 *
	 * @return string The generated `<output>` tag as a string.
	 */
	public static function output( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'output', $content, $attributes );
	}

	/**
	 * Generates a `<param />` tag.
	 *
	 * @param array $attributes Associative array of attributes for the `<param />` tag.
	 *
	 * @return string The generated `<param />` tag as a string.
	 */
	public static function param( array $attributes = [] ): string {
		return self::tag( 'param', null, $attributes, true );
	}

	/**
	 * Generates a `<picture>` tag.
	 *
	 * @param string|null $content The content inside the `<picture>` tag.
	 * @param array $attributes Associative array of attributes for the `<picture>` tag.
	 *
	 * @return string The generated `<picture>` tag as a string.
	 */
	public static function picture( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'picture', $content, $attributes );
	}

	/**
	 * Generates a `<pre>` tag.
	 *
	 * @param string|null $content The content inside the `<pre>` tag.
	 * @param array $attributes Associative array of attributes for the `<pre>` tag.
	 *
	 * @return string The generated `<pre>` tag as a string.
	 */
	public static function pre( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'pre', $content, $attributes );
	}

	/**
	 * Generates a `<progress>` tag.
	 *
	 * @param string|null $content The content inside the `<progress>` tag.
	 * @param array $attributes Associative array of attributes for the `<progress>` tag.
	 *
	 * @return string The generated `<progress>` tag as a string.
	 */
	public static function progress( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'progress', $content, $attributes );
	}

	/**
	 * Generates a `<q>` tag.
	 *
	 * @param string|null $content The content inside the `<q>` tag.
	 * @param array $attributes Associative array of attributes for the `<q>` tag.
	 *
	 * @return string The generated `<q>` tag as a string.
	 */
	public static function q( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'q', $content, $attributes );
	}

	/**
	 * Generates a `<rp>` tag.
	 *
	 * @param string|null $content The content inside the `<rp>` tag.
	 * @param array $attributes Associative array of attributes for the `<rp>` tag.
	 *
	 * @return string The generated `<rp>` tag as a string.
	 */
	public static function rp( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'rp', $content, $attributes );
	}

	/**
	 * Generates a `<rt>` tag.
	 *
	 * @param string|null $content The content inside the `<rt>` tag.
	 * @param array $attributes Associative array of attributes for the `<rt>` tag.
	 *
	 * @return string The generated `<rt>` tag as a string.
	 */
	public static function rt( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'rt', $content, $attributes );
	}

	/**
	 * Generates a `<ruby>` tag.
	 *
	 * @param string|null $content The content inside the `<ruby>` tag.
	 * @param array $attributes Associative array of attributes for the `<ruby>` tag.
	 *
	 * @return string The generated `<ruby>` tag as a string.
	 */
	public static function ruby( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'ruby', $content, $attributes );
	}

	/**
	 * Generates a `<s>` tag.
	 *
	 * @param string|null $content The content inside the `<s>` tag.
	 * @param array $attributes Associative array of attributes for the `<s>` tag.
	 *
	 * @return string The generated `<s>` tag as a string.
	 */
	public static function s( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 's', $content, $attributes );
	}

	/**
	 * Generates a `<samp>` tag.
	 *
	 * @param string|null $content The content inside the `<samp>` tag.
	 * @param array $attributes Associative array of attributes for the `<samp>` tag.
	 *
	 * @return string The generated `<samp>` tag as a string.
	 */
	public static function samp( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'samp', $content, $attributes );
	}

	/**
	 * Generates a `<script>` tag.
	 *
	 * @param string|null $content The content inside the `<script>` tag.
	 * @param array $attributes Associative array of attributes for the `<script>` tag.
	 *
	 * @return string The generated `<script>` tag as a string.
	 */
	public static function script( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'script', $content, $attributes );
	}

	/**
	 * Generates a `<search>` tag.
	 *
	 * @param string|null $content The content inside the `<search>` tag.
	 * @param array $attributes Associative array of attributes for the `<search>` tag.
	 *
	 * @return string The generated `<search>` tag as a string.
	 */
	public static function search( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'search', $content, $attributes );
	}

	/**
	 * Generates a `<select>` tag.
	 *
	 * @param string|null $content The content inside the `<select>` tag.
	 * @param array $attributes Associative array of attributes for the `<select>` tag.
	 *
	 * @return string The generated `<select>` tag as a string.
	 */
	public static function select( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'select', $content, $attributes );
	}

	/**
	 * Generates a `<source />` tag.
	 *
	 * @param array $attributes Associative array of attributes for the `<source />` tag.
	 *
	 * @return string The generated `<source />` tag as a string.
	 */
	public static function source( array $attributes = [] ): string {
		return self::tag( 'source', null, $attributes, true );
	}

	/**
	 * Generates a `<span>` tag.
	 *
	 * @param string|null $content The content inside the `<span>` tag.
	 * @param array $attributes Associative array of attributes for the `<span>` tag.
	 *
	 * @return string The generated `<span>` tag as a string.
	 */
	public static function span( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'span', $content, $attributes );
	}

	/**
	 * Generates a `<strong>` tag.
	 *
	 * @param string|null $content The content inside the `<strong>` tag.
	 * @param array $attributes Associative array of attributes for the `<strong>` tag.
	 *
	 * @return string The generated `<strong>` tag as a string.
	 */
	public static function strong( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'strong', $content, $attributes );
	}

	/**
	 * Generates an emphasis `<em>` tag.
	 *
	 * @param string|null $content The content inside the `<em>` tag.
	 * @param array $attributes Associative array of attributes for the `<em>` tag.
	 *
	 * @return string The generated `<em>` tag as a string.
	 */
	public static function em( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'em', $content, $attributes );
	}

	/**
	 * Generates a `<small>` tag.
	 *
	 * @param string|null $content The content inside the `<small>` tag.
	 * @param array $attributes Associative array of attributes for the `<small>` tag.
	 *
	 * @return string The generated `<small>` tag as a string.
	 */
	public static function small( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'small', $content, $attributes );
	}

	/**
	 * Generates a `<table>` tag.
	 *
	 * @param string|null $content The content inside the `<table>` tag.
	 * @param array $attributes Associative array of attributes for the `<table>` tag.
	 *
	 * @return string The generated `<table>` tag as a string.
	 */
	public static function table( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'table', $content, $attributes );
	}

	/**
	 * Generates a `<tbody>` tag.
	 *
	 * @param string|null $content The content inside the `<tbody>` tag.
	 * @param array $attributes Associative array of attributes for the `<tbody>` tag.
	 *
	 * @return string The generated `<tbody>` tag as a string.
	 */
	public static function tbody( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'tbody', $content, $attributes );
	}

	/**
	 * Generates a `<tfoot>` tag.
	 *
	 * @param string|null $content The content inside the `<tfoot>` tag.
	 * @param array $attributes Associative array of attributes for the `<tfoot>` tag.
	 *
	 * @return string The generated `<tfoot>` tag as a string.
	 */
	public static function tfoot( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'tfoot', $content, $attributes );
	}

	/**
	 * Generates a `<textarea>` tag.
	 *
	 * @param string|null $content The content inside the `<textarea>` tag.
	 * @param array $attributes Associative array of attributes for the `<textarea>` tag.
	 *
	 * @return string The generated `<textarea>` tag as a string.
	 */
	public static function textarea( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'textarea', esc_textarea( $content ), $attributes );
	}

	/**
	 * Generates a table header cell `<th>` tag.
	 *
	 * @param string|null $content The content inside the `<th>` tag.
	 * @param array $attributes Associative array of attributes for the `<th>` tag.
	 *
	 * @return string The generated `<th>` tag as a string.
	 */
	public static function th( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'th', $content, $attributes );
	}

	/**
	 * Generates a table row `<tr>` tag.
	 *
	 * @param string|null $content The content inside the `<tr>` tag.
	 * @param array $attributes Associative array of attributes for the `<tr>` tag.
	 *
	 * @return string The generated `<tr>` tag as a string.
	 */
	public static function tr( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'tr', $content, $attributes );
	}

	/**
	 * Generates a `<u>` tag.
	 *
	 * @param string|null $content The content inside the `<u>` tag.
	 * @param array $attributes Associative array of attributes for the `<u>` tag.
	 *
	 * @return string The generated `<u>` tag as a string.
	 */
	public static function u( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'u', $content, $attributes );
	}

	/**
	 * Generates a `<var>` tag.
	 *
	 * @param string|null $content The content inside the `<var>` tag.
	 * @param array $attributes Associative array of attributes for the `<var>` tag.
	 *
	 * @return string The generated `<var>` tag as a string.
	 */
	public static function var( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'var', $content, $attributes );
	}

	/**
	 * Generates a `<video>` tag.
	 *
	 * @param string|null $content The content inside the `<video>` tag.
	 * @param array $attributes Associative array of attributes for the `<video>` tag.
	 *
	 * @return string The generated `<video>` tag as a string.
	 */
	public static function video( ?string $content = null, array $attributes = [] ): string {
		return self::tag( 'video', $content, $attributes );
	}

	/**
	 * Generates a `<wbr />` tag.
	 *
	 * @param array $attributes Associative array of attributes for the `<wbr />` tag.
	 *
	 * @return string The generated `<wbr />` tag as a string.
	 */
	public static function wbr( array $attributes = [] ): string {
		return self::tag( 'wbr', null, $attributes, true );
	}
}
