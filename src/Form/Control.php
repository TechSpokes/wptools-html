<?php

namespace TechSpokes\WPTools\HTML\Form;

use TechSpokes\WPTools\HTML\HTML;
use TechSpokes\WPTools\HTML\Utils\Sanitizer;
use TechSpokes\WPTools\HTML\Utils\Warning;

/**
 * Final class for form controls.
 *
 * @package TechSpokes\WPTools\HTML\Form
 * @since 0.0.1
 */
final class Control {

	/**
	 * Generates a `<textarea>` form control.
	 *
	 * Validation:
	 * - Warns if a `value` attribute is provided, as it is not used on `<textarea>`.
	 * - If `value` is provided but current value/content is null, it uses the `value` content as the textarea content with a warning.
	 *
	 * @param array $attributes Associative array of attributes for the textarea element.
	 * @param string|null $current The current value/content of the textarea.
	 *
	 * @return string The generated textarea HTML element as a string.
	 */
	public static function textarea( array $attributes = [], ?string $current = null ): string {
		// Sanitize attributes array.
		$attributes = Sanitizer::sanitize_html_attributes_array( $attributes, __METHOD__ );

		// If caller passed a "value" attribute, it's not used on <textarea>.
		if ( array_key_exists( 'value', $attributes ) ) {
			// If current value is null and "value" attribute is non-empty, use it as content with warning.
			if ( ( null === $current ) && Sanitizer::is_not_empty_string( $attributes['value'] ) ) {
				Warning::doing_it_wrong(
					__METHOD__,
					'HTML tag <textarea> has a "value" attribute but no content. Replacing content with the "value" attribute content.'
				);
				// Use the value attribute as content, default to null if conversion fails.
				$current = Sanitizer::to_string_or_default(
					$attributes['value'],
					__METHOD__,
					'textarea',
					'Content for HTML tag <%s> of type "%s" could not be converted to string: %s. Using null as default.'
				);
			} else {
				Warning::doing_it_wrong(
					__METHOD__,
					'HTML tag <textarea> does not support a "value" attribute. Removing "value" attribute.'
				);
			}

			// Unset the value attribute as it's not valid for textarea.
			unset( $attributes['value'] );
		}

		// Normalize content to string, defaulting to null (default behavior) if the conversion fails.
		$current = Sanitizer::to_string_or_default(
			$current,
			__METHOD__,
			'textarea',
			'Content for HTML tag <%s> of type "%s" could not be converted to string: %s. Using null as default.'
		);

		return HTML::textarea( $current, $attributes );
	}


	/**
	 * Generates an `<input />` form control.
	 *
	 * Defaults and validation:
	 * - If the `type` attribute is missing/empty, it defaults to `'text'` and triggers a `_doing_it_wrong()` notice.
	 * - If `value` is present and is a non-scalar, it is coerced to a string (or `''` if string-casting fails), with a notice.
	 *
	 * Type-specific notes:
	 * - `checkbox` / `radio`: warns when `value` is omitted (browsers submit `'on'` when checked).
	 * - `submit` / `button` / `reset`: warns when `value` is missing or empty, since it typically defines the label/value.
	 *
	 * Cleanup:
	 * - Removes `value=""` for input types where an empty value is redundant/ignored.
	 *
	 * @param array $attributes Associative array of attributes for the input element.
	 * @param mixed|null $current The current value for the input element.
	 *
	 * @return string The generated input HTML element as a string.
	 */
	public static function input( array $attributes = [], mixed $current = null ): string {
		// Sanitize attributes array (convert values to strings, remove nulls, non-string keys).
		$attributes = Sanitizer::sanitize_html_attributes_array( $attributes, __METHOD__ );

		// Make sure we have type, default to text with warning.
		if ( Sanitizer::is_empty_or_not_string( $attributes['type'] ?? null ) ) {
			Warning::doing_it_wrong(
				__METHOD__,
				'HTML <input> attribute "type" is missing or empty, defaulting to "text".'
			);
			$attributes['type'] = 'text';
		}
		// Cast type to lowercase string (it is a string from the check before).
		$attributes['type'] = strtolower( $attributes['type'] );
		// Safe to use now.
		$type = $attributes['type'];

		// Normalize the current value to an array of strings. Can potentially contain empty strings.
		$current = Sanitizer::sanitize_current_values(
			$current,
			__METHOD__,
			'Current <input> value (index: "%s") of type "%s" could not be converted to string: %s. Skipping this value.'
		);

		// Remove empty current values and reindex the array.
		$current = array_values( array_filter( $current, [ Sanitizer::class, 'is_not_empty_string' ] ) );

		// Do we have current values?
		$has_current = ( 0 < count( $current ) );

		// Do we have a value attribute?
		$has_value      = array_key_exists( 'value', $attributes );
		$value          = $has_value ? $attributes['value'] : null;
		$value_is_empty = Sanitizer::is_empty_or_not_string( $value );

		// Type-specific handling and warnings.
		switch ( $type ) {
			case 'checkbox':
			case 'radio':
				// Warn if checkbox/radio are missing "value" (browser defaults to "on" when checked).
				if ( ! $has_value ) {
					Warning::doing_it_wrong(
						__METHOD__,
						'HTML <input> type "%s" missing "value" attribute. If omitted, browsers submit "on" when checked. Provide "value" attribute explicitly if you need a different submitted value.',
						$type
					);
				}
				// Handle the "checked" attribute based on current values if not already set.
				if ( $has_current && ! array_key_exists( 'checked', $attributes ) ) {
					if ( $has_value ) {
						if ( in_array( (string) $value, $current, true ) ) {
							$attributes['checked'] = 'checked';
						}
					} else {
						// No value attribute, browser defaults to "on".
						if ( in_array( 'on', $current, true ) ) {
							$attributes['checked'] = 'checked';
						}
					}
				}
				break;

			case 'submit':
			case 'button':
			case 'reset':
				// Warn if button-like types are missing/empty "value" (defines label/value explicitly).
				if ( ! $has_value ) {
					Warning::doing_it_wrong(
						__METHOD__,
						'HTML <input> type "%s" missing "value" attribute. Consider providing it to define the button label/value explicitly.',
						$type
					);
				} elseif ( $value_is_empty ) {
					Warning::doing_it_wrong(
						__METHOD__,
						'HTML <input> type "%s" has empty "value" attribute. Consider providing a non-empty "value" attribute to define the button label/value explicitly.',
						$type
					);
				}
				// if current is provided, but value is empty, set value to first current.
				if ( $value_is_empty && $has_current ) {
					$attributes['value'] = $current[0];
				}
				break;

			case 'file':
				// Warn if file input has a preset value (browsers ignore it for security reasons).
				if ( $has_value ) {
					Warning::doing_it_wrong(
						__METHOD__,
						'Input type "file" cannot have a preset value; browsers ignore it for security reasons. Removing "value" attribute.'
					);
					unset( $attributes['value'] );
				}
				break;

			case 'password':
				// Warn if password input has a preset value (not recommended for security reasons).
				if ( $has_value ) {
					Warning::doing_it_wrong(
						__METHOD__,
						'Setting a preset value for input type "password" is not recommended for security reasons. Try to avoid it if possible.'
					);
				}
				break;

			default:
				// For other types, if value is empty and current is provided, set value to first current.
				if ( $value_is_empty && $has_current ) {
					$attributes['value'] = $current[0];
				}
				break;
		}

		// Do we still have a value attribute?
		$has_value      = array_key_exists( 'value', $attributes );
		$value          = $has_value ? $attributes['value'] : null;
		$value_is_empty = Sanitizer::is_empty_or_not_string( $value );

		/**
		 * Drop empty value="" only where it is redundant/ignored.
		 * IMPORTANT: do NOT drop for hidden/checkbox/radio/buttons/image.
		 */
		$drop_empty_value = [
			'text',
			'email',
			'password',
			'search',
			'url',
			'tel',
			'number',
			'range',
			'date',
			'time',
			'datetime-local',
			'month',
			'week',
			'color',
		];

		if ( $has_value && $value_is_empty && in_array( $type, $drop_empty_value, true ) ) {
			Warning::doing_it_wrong(
				__METHOD__,
				'HTML <input> type "%s" has an empty "value" attribute which is redundant/ignored here. Removing "value" attribute.',
				$type
			);

			// Unset the value attribute.
			unset( $attributes['value'] );
		}

		return HTML::input( $attributes );
	}


	/**
	 * Generates an `<option>` element for a `<select>` dropdown.
	 *
	 * Validation:
	 * - Warns if the `value` attribute is missing (fragile submission semantics).
	 * - Requires either non-empty text content or a `label` attribute; warns if both are missing/empty.
	 *
	 * @param mixed $content The text content of the option element.
	 * @param array $attributes Associative array of attributes for the option element.
	 *
	 * @return string The generated option HTML element as a string.
	 * @noinspection PhpSameParameterValueInspection
	 */
	private static function option( mixed $content = null, array $attributes = [] ): string {
		// Sanitize attributes array.
		$attributes = Sanitizer::sanitize_html_attributes_array( $attributes, __METHOD__ );

		// Normalize content to string, defaulting to empty string if fails.
		$content = Sanitizer::to_string_or_default(
			$content,
			__METHOD__,
			'option',
			'Content for HTML tag <%s> of type "%s" could not be converted to string: %s. Using empty string as default.',
			''
		);

		// Warn if value is missing (fragile submission semantics).
		if ( ! array_key_exists( 'value', $attributes ) ) {
			Warning::doing_it_wrong(
				__METHOD__,
				'HTML tag <option> missing "value" attribute. The submitted value will default to the option text, which is fragile and locale-dependent.'
			);
		}

		$has_content = Sanitizer::is_not_empty_string( $content );
		$has_label   = Sanitizer::is_not_empty_string( $attributes['label'] ?? null );

		// Option must have a label (content or label attr).
		if ( ! $has_content && ! $has_label ) {
			Warning::doing_it_wrong(
				__METHOD__,
				'HTML tag <option> requires either non-empty text content or a "label" attribute.'
			);
		}

		return HTML::option( $content, $attributes );
	}
}
