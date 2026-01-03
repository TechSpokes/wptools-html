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

		// get type base
		$type_base = sanitize_html_class( $type, 'text' );

		// Determine control ID.
		$control_id = Sanitizer::is_not_string_or_empty( $attributes['id'] ?? null ) ?
			null :
			trim( $attributes['id'] );

		// Generate ID base if needed.
		$id_base = $control_id;
		// If no ID provided, generate base from name if possible or fallback to null.
		if ( null === $id_base ) {
			// If name is provided, grab the base for IDs generation.
			$id_base = Sanitizer::is_string_and_not_empty( $attributes['name'] ?? null ) ?
				// trim underscores from ends
				trim(
					'_',
					// collapse multiple underscores
					preg_replace(
						'/_{2,}/',
						'_',
						// normalize to underscores for easy copy-paste
						preg_replace( '/[^a-z0-9_]/i', '_', trim( $attributes['name'] ) )
					)
				)
				: null;
		}

		// Inject ID and class into attributes.
		$attributes = wp_parse_args( $attributes, [
			'id'    => $id_base ? sprintf( '%s_control', $id_base ) : null,
			'class' => sprintf( 'form_field__control form_field__control_type_%s', $type_base ),
		] );

		// Generate label.
		if ( Sanitizer::is_not_string_or_empty( $label ) ) {
			Warning::doing_it_wrong(
				__METHOD__,
				'Form field is missing a label, which is important for accessibility. If intentional, please ensure proper ARIA attributes are used or consider using the Control::input() method directly.'
			);
			$label = '';
		} else {
			// Create label ID.
			$label_id = $id_base ? sprintf( '%s_label', $id_base ) : null;
			// Create label element.
			$label = HTML::label(
				$label,
				// null values will be skipped
				[
					'id'    => $label_id,
					'for'   => $attributes['id'] ?? null,
					'class' => 'form_field__label',
				]
			);
			// Add aria-labelledby if no for attribute.
			if ( Sanitizer::is_not_string_or_empty( $attributes['aria-labelledby'] ) && ! ( null === $label_id ) ) {
				$attributes['aria-labelledby'] = $label_id;
			}
		}

		// Make sure description is trimmed string or empty.
		$description = Sanitizer::is_not_string_or_empty( $description ) ? '' : trim( $description );
		// Generate description if provided.
		if ( Sanitizer::is_string_and_not_empty( $description ) ) {
			// Create description ID.
			$description_id = $id_base ? sprintf( '%s_description', $id_base ) : null;
			// Create description element. NOTE: code expects text or inline HTML only! If block elements passed, may break layout.
			$description = HTML::p(
				$description,
				[
					'id'    => $description_id,
					'class' => 'description form_field__description',
				]
			);
			// Add aria-describedby if no aria-describedby attribute.
			if ( Sanitizer::is_not_string_or_empty( $attributes['aria-describedby'] ?? null ) && ! ( null === $description_id ) ) {
				$attributes['aria-describedby'] = $description_id;
			}
		}

		// Generate control HTML.
		$control = in_array( $type, [ 'checkbox', 'radio' ], true ) ?
			sprintf( '%s %s', Control::input( $attributes, $current ), $label )
			: sprintf( '%s%s', $label, Control::input( $attributes, $current ) );

		// Wrap everything in a div and return.
		return HTML::div(
			trim( trim( $control ) . PHP_EOL . $description ),
			wp_parse_args(
				$wrapper_attributes,
				[
					'id'    => $id_base ? sprintf( '%s_field', $id_base ) : null,
					'class' => sprintf( 'form_field form_field__type_%s', sanitize_html_class( $type ) ),
				]
			)
		);
	}
}
