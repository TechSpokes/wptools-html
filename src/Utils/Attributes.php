<?php

namespace TechSpokes\WPTools\HTML\Utils;

/**
 * Marker interface for attribute-related utilities.
 *
 * @package TechSpokes\WPTools\HTML\Utils
 * @since 0.0.1
 */
trait Attributes {

	/**
	 * Converts an associative array of attributes into a string suitable for HTML tags.
	 *
	 * @param array $attributes Associative array of attributes.
	 *
	 * @return string Formatted string of HTML attributes.
	 */
	protected static function sprint_attributes( array $attributes = [] ): string {
		if ( 0 === count( $attributes ) ) {
			return '';
		}

		$attr = '';

		// Skip sanitization if marked as already sanitized.
		if ( empty( $attributes[ Sanitizer::SANITIZED_KEY ] ) ) {
			// Sanitize the attributes array keys and values.
			$attributes = Sanitizer::sanitize_html_attributes_array( $attributes, __METHOD__ );
		}

		// Remove the marker key to avoid outputting it.
		unset( $attributes[ Sanitizer::SANITIZED_KEY ] );

		// Build the attribute string.
		foreach ( $attributes as $key => $value ) {
			$attr .= sprintf( ' %s="%s"', esc_attr( $key ), esc_attr( $value ) );
		}

		return $attr;
	}
}
