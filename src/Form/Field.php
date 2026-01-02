<?php

namespace TechSpokes\WPTools\HTML\Form;

use TechSpokes\WPTools\HTML\HTML;
use TechSpokes\WPTools\HTML\Utils\Sanitizer;
use TechSpokes\WPTools\HTML\Utils\Warning;

/**
 * Class Field
 *
 * Represents a form field in an HTML form.
 *
 * @package TechSpokes\WPTools\HTML\Form
 * @since 0.0.2
 */
final class Field {

	/**
	 * Generates a complete form field with label, input control, and optional description.
	 *
	 * @param array $attributes Associative array of attributes for the input element.
	 * @param mixed $current The current value for the input element.
	 * @param string|null $label The label text for the form field.
	 * @param string|null $description Optional description text for the form field.
	 * @param array $wrapper_attributes Optional associative array of attributes for the wrapper div element.
	 *
	 * @return string The generated HTML for the complete form field.
	 */
	public static function input(
		array $attributes,
		mixed $current = null,
		?string $label = null,
		?string $description = null,
		array $wrapper_attributes = []
	): string {
		// Sanitize attributes array (convert values to strings, remove nulls, non-string keys).
		$attributes = Sanitizer::sanitize_html_attributes_array( $attributes, __METHOD__ );
		// Make sure we have type, default to text with warning.
		$type = Sanitizer::sanitize_input_html_attribute_type( $attributes, __METHOD__ );

		if ( Sanitizer::is_empty_or_not_string( $label ) ) {
			Warning::doing_it_wrong(
				__METHOD__,
				'Form field is missing a label, which is important for accessibility. If intentional, please ensure proper ARIA attributes are used or consider using the Control::input() method directly.'
			);
			$label = '';
		} else {
			$label = HTML::label(
				$label,
				// null values will be skipped
				[
					'for' => $attributes['id'] ?? null,
					'class' => 'form_field_label',
				]
			);
		}

		$control = in_array( $type, [ 'checkbox', 'radio' ], true ) ?
			sprintf( '%s %s', Control::input( $attributes, $current ), $label )
			: sprintf( '%s%s', $label, Control::input( $attributes, $current ) );

		$description = Sanitizer::is_empty_or_not_string( $description ) ?
			''
			: HTML::p(
				$description,
				[
					'class' => 'form_field_description',
				]
			);

		return HTML::div(
			trim( trim( $control ) . PHP_EOL . $description ),
			wp_parse_args(
				$wrapper_attributes,
				[
					'class' => sprintf( 'form_field form_field_%s', sanitize_html_class( $type ) ),
				]
			)
		);
	}
}
