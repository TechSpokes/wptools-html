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
	protected static function sprint_attributes( array $attributes ): string {
		$attr = '';
		foreach ( $attributes as $key => $value ) {
			// skip null values
			if ( is_null( $value ) ) {
				continue;
			}
			// make sure value is scalar or skip it with a warning
			if ( ! is_scalar( $value ) ) {
				_doing_it_wrong(
					__METHOD__,
					sprintf(
						'Attribute "%s" has non-scalar value of type "%s", skipping.',
						$key,
						gettype( $value )
					),
					'1.0.0'
				);
				continue;
			}
			$value = (string) $value;
			$attr  .= sprintf( ' %s="%s"', esc_attr( $key ), esc_attr( $value ) );
		}

		return $attr;
	}
}
