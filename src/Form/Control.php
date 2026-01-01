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
	 * Generates an `<input type="text" />` form control.
	 *
	 * @param array $attributes Associative array of attributes for the input element.
	 *
	 * @return string The generated input HTML element as a string.
	 */
	public static function input_text( array $attributes = [] ): string {
		$attributes['type'] = 'text';

		return self::input( $attributes );
	}

	/**
	 * Generates an `<input type="email" />` form control.
	 *
	 * @param array $attributes Associative array of attributes for the input element.
	 *
	 * @return string The generated input HTML element as a string.
	 */
	public static function input_email( array $attributes = [] ): string {
		$attributes['type'] = 'email';

		return self::input( $attributes );
	}

	/**
	 * Generates an `<input type="url" />` form control.
	 *
	 * @param array $attributes Associative array of attributes for the input element.
	 *
	 * @return string The generated input HTML element as a string.
	 */
	public static function input_url( array $attributes = [] ): string {
		$attributes['type'] = 'url';

		return self::input( $attributes );
	}

	/**
	 * Generates an `<input type="tel" />` form control.
	 *
	 * @param array $attributes Associative array of attributes for the input element.
	 *
	 * @return string The generated input HTML element as a string.
	 */
	public static function input_tel( array $attributes = [] ): string {
		$attributes['type'] = 'tel';

		return self::input( $attributes );
	}

	/**
	 * Generates an `<input type="search" />` form control.
	 *
	 * @param array $attributes Associative array of attributes for the input element.
	 *
	 * @return string The generated input HTML element as a string.
	 */
	public static function input_search( array $attributes = [] ): string {
		$attributes['type'] = 'search';

		return self::input( $attributes );
	}

	/**
	 * Generates an `<input type="password" />` form control.
	 *
	 * Note: Setting a preset value for password inputs is discouraged for security reasons.
	 *
	 * @param array $attributes Associative array of attributes for the input element.
	 *
	 * @return string The generated input HTML element as a string.
	 */
	public static function input_password( array $attributes = [] ): string {
		$attributes['type'] = 'password';
		if ( isset( $attributes['value'] ) ) {
			Warning::doing_it_wrong(
				__METHOD__,
				'Setting a preset value for input type "password" is not recommended for security reasons. Try to avoid it if possible.'
			);
		}

		return self::input( $attributes );
	}

	/**
	 * Generates an `<input type="image" />` form control.
	 *
	 * @param array $attributes Associative array of attributes for the input element.
	 *
	 * @return string The generated input HTML element as a string.
	 */
	public static function input_image( array $attributes = [] ): string {
		$attributes['type'] = 'image';

		return self::input( $attributes );
	}

	/**
	 * Generates an `<input type="file" />` form control.
	 *
	 * Note: The `value` attribute is removed if provided, as browsers ignore it for security reasons.
	 *
	 * @param array $attributes Associative array of attributes for the input element.
	 *
	 * @return string The generated input HTML element as a string.
	 */
	public static function input_file( array $attributes = [] ): string {
		$attributes['type'] = 'file';
		if ( isset( $attributes['value'] ) ) {
			Warning::doing_it_wrong(
				__METHOD__,
				'Input type "file" cannot have a preset value; browsers ignore it for security reasons. Removing "value" attribute.'
			);
			unset( $attributes['value'] );
		}

		return self::input( $attributes );
	}

	/**
	 * Generates an `<input type="number" />` form control.
	 *
	 * @param array $attributes Associative array of attributes for the input element.
	 *
	 * @return string The generated input HTML element as a string.
	 */
	public static function input_number( array $attributes = [] ): string {
		$attributes['type'] = 'number';

		return self::input( $attributes );
	}

	/**
	 * Generates an `<input type="range" />` form control.
	 *
	 * @param array $attributes Associative array of attributes for the input element.
	 *
	 * @return string The generated input HTML element as a string.
	 */
	public static function input_range( array $attributes = [] ): string {
		$attributes['type'] = 'range';

		return self::input( $attributes );
	}

	/**
	 * Generates an `<input type="date" />` form control.
	 *
	 * @param array $attributes Associative array of attributes for the input element.
	 *
	 * @return string The generated input HTML element as a string.
	 */
	public static function input_date( array $attributes = [] ): string {
		$attributes['type'] = 'date';

		return self::input( $attributes );
	}

	/**
	 * Generates an `<input type="time" />` form control.
	 *
	 * @param array $attributes Associative array of attributes for the input element.
	 *
	 * @return string The generated input HTML element as a string.
	 */
	public static function input_time( array $attributes = [] ): string {
		$attributes['type'] = 'time';

		return self::input( $attributes );
	}

	/**
	 * Generates an `<input type="datetime-local" />` form control.
	 *
	 * @param array $attributes Associative array of attributes for the input element.
	 *
	 * @return string The generated input HTML element as a string.
	 */
	public static function input_datetime_local( array $attributes = [] ): string {
		$attributes['type'] = 'datetime-local';

		return self::input( $attributes );
	}

	/**
	 * Generates an `<input type="month" />` form control.
	 *
	 * @param array $attributes Associative array of attributes for the input element.
	 *
	 * @return string The generated input HTML element as a string.
	 */
	public static function input_month( array $attributes = [] ): string {
		$attributes['type'] = 'month';

		return self::input( $attributes );
	}

	/**
	 * Generates an `<input type="week" />` form control.
	 *
	 * @param array $attributes Associative array of attributes for the input element.
	 *
	 * @return string The generated input HTML element as a string.
	 */
	public static function input_week( array $attributes = [] ): string {
		$attributes['type'] = 'week';

		return self::input( $attributes );
	}

	/**
	 * Generates an `<input type="color" />` form control.
	 *
	 * @param array $attributes Associative array of attributes for the input element.
	 *
	 * @return string The generated input HTML element as a string.
	 */
	public static function input_color( array $attributes = [] ): string {
		$attributes['type'] = 'color';

		return self::input( $attributes );
	}

	/**
	 * Generates an `<input type="hidden" />` form control.
	 *
	 * @param array $attributes Associative array of attributes for the input element.
	 *
	 * @return string The generated input HTML element as a string.
	 */
	public static function input_hidden( array $attributes = [] ): string {
		$attributes['type'] = 'hidden';

		return self::input( $attributes );
	}

	/**
	 * Generates an `<input type="checkbox" />` form control.
	 *
	 * Note: If the `value` attribute is omitted, browsers submit "on" when checked.
	 *
	 * @param array $attributes Associative array of attributes for the input element.
	 *
	 * @return string The generated input HTML element as a string.
	 */
	public static function input_checkbox( array $attributes = [] ): string {
		$attributes['type'] = 'checkbox';

		return self::input( $attributes );
	}

	/**
	 * Generates an `<input type="radio" />` form control.
	 *
	 * Note: If the `value` attribute is omitted, browsers submit "on" when checked.
	 *
	 * @param array $attributes Associative array of attributes for the input element.
	 *
	 * @return string The generated input HTML element as a string.
	 */
	public static function input_radio( array $attributes = [] ): string {
		$attributes['type'] = 'radio';

		return self::input( $attributes );
	}

	/**
	 * Generates an `<input type="submit" />` form control.
	 *
	 * Note: The `value` attribute defines the button label/value.
	 *
	 * @param array $attributes Associative array of attributes for the input element.
	 *
	 * @return string The generated input HTML element as a string.
	 */
	public static function input_submit( array $attributes = [] ): string {
		$attributes['type'] = 'submit';

		return self::input( $attributes );
	}

	/**
	 * Generates an `<input type="button" />` form control.
	 *
	 * Note: The `value` attribute defines the button label/value.
	 *
	 * @param array $attributes Associative array of attributes for the input element.
	 *
	 * @return string The generated input HTML element as a string.
	 */
	public static function input_button( array $attributes = [] ): string {
		$attributes['type'] = 'button';

		return self::input( $attributes );
	}

	/**
	 * Generates an `<input type="reset" />` form control.
	 *
	 * Note: The `value` attribute defines the button label/value.
	 *
	 * @param array $attributes Associative array of attributes for the input element.
	 *
	 * @return string The generated input HTML element as a string.
	 */
	public static function input_reset( array $attributes = [] ): string {
		$attributes['type'] = 'reset';

		return self::input( $attributes );
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
	 */
	public static function option( mixed $content = null, array $attributes = [] ): string {
		// Sanitize attributes array.
		$attributes = Sanitizer::sanitize_html_attributes_array( $attributes, __METHOD__ );

		// Normalize content.
		$content = Sanitizer::to_string(
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
	 * - Removes `value=""` only for input types where an empty value is redundant/ignored.
	 *
	 * @param array $attributes Associative array of attributes for the input element.
	 *
	 * @return string The generated input HTML element as a string.
	 */
	private static function input( array $attributes = [] ): string {
		// Sanitize attributes array.
		$attributes = Sanitizer::sanitize_html_attributes_array( $attributes, __METHOD__, [ 'type' => 'text' ] );

		// Make sure we have type, default to text with warning.
		if ( Sanitizer::is_empty_or_not_string( $attributes['type'] ?? null ) ) {
			Warning::doing_it_wrong(
				__METHOD__,
				'HTML <input> attribute "type" is missing or empty, defaulting to "text".'
			);
			$attributes['type'] = 'text';
		}

		// Safe to use now.
		$type = $attributes['type'];

		// Recompute after potential coercion.
		$has_value             = array_key_exists( 'value', $attributes );
		$value_is_empty_string = Sanitizer::is_empty_or_not_string( $attributes['value'] ?? null );

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
				} elseif ( $value_is_empty_string ) {
					Warning::doing_it_wrong(
						__METHOD__,
						'HTML <input> type "%s" has empty "value" attribute. Consider providing a non-empty "value" attribute to define the button label/value explicitly.',
						$type
					);
				}
				break;
		}

		/**
		 * Drop empty value="" only where it is redundant/ignored.
		 * IMPORTANT: do NOT drop for hidden/checkbox/radio/buttons/image.
		 */
		$drop_empty_value = [
			'file',
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

		if ( in_array( $type, $drop_empty_value, true ) && $has_value && $value_is_empty_string ) {
			Warning::doing_it_wrong(
				__METHOD__,
				'HTML <input> type "%s" has an empty "value" attribute which is redundant/ignored here. Removing "value" attribute.',
				$type
			);
			unset( $attributes['value'] );
		}

		return HTML::input( $attributes );
	}
}
