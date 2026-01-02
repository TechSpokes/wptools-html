<?php

namespace TechSpokes\WPTools\HTML\Utils;

use Throwable;

/**
 * Marker class for sanitization-related utilities.
 *
 * @package TechSpokes\WPTools\HTML\Utils
 * @since 0.0.1
 */
final class Sanitizer {

	// Marker constant to indicate sanitized attributes array.
	public const SANITIZED_KEY = '__sanitized';

	/**
	 * Convert a value to string, with error handling.
	 *
	 * @param mixed $value The value to convert.
	 * @param string $method The method name for warning context.
	 * @param string $key The key associated with the value (for context in warnings).
	 * @param string $message_template The message template for warnings. Must have three %s placeholders: one for key, one for type, one for error message.
	 * @param string|null $default The default value to return if conversion fails. Optional. Defaults to null.
	 *
	 * @return string|null The converted string. Return the default value provided or null if conversion fails.
	 * @noinspection PhpUnusedParameterInspection
	 */
	public static function to_string_or_default(
		mixed $value,
		string $method,
		string $key,
		string $message_template,
		?string $default = null
	): ?string {
		if ( is_string( $value ) ) {
			return $value;
		}
		try {
			return (string) $value;
		} catch ( Throwable $e ) {
			// Log a warning if conversion fails: key, type, error message
			Warning::doing_it_wrong( $method, $message_template, $key, gettype( $value ), $e->getMessage() );
		}

		return $default;
	}

	/**
	 * Map an array of values to strings using to_string method.
	 *
	 * @param array $values The array of values to convert.
	 * @param string $method The method name for warning context.
	 * @param string $message_template The message template for warnings. Must have three %s placeholders: one for key, one for type, one for error message.
	 * @param array $defaults An associative array of default values for each key if conversion fails. Optional. Defaults to empty array.
	 *
	 * @return array The array with values converted to strings or their respective defaults.
	 */
	public static function map_to_strings(
		array $values,
		string $method,
		string $message_template,
		array $defaults = []
	): array {
		$result = [];
		foreach ( $values as $key => $value ) {
			$default = $defaults[ $key ] ?? null;
			$result[ $key ] = self::to_string_or_default( $value, $method, (string) $key, $message_template, $default );
		}

		return $result;
	}

	/**
	 * Remove non-string keys from an array, with optional warning.
	 *
	 * @param array $input The input array.
	 * @param string|null $method The method name for warning context. Optional. If null, no warnings will be issued.
	 * @param string|null $message_template The message template for warnings. Must have one %s placeholder for the type of the key. Optional.
	 *
	 * @return array The array with only string keys.
	 */
	public static function remove_non_string_keys_from_array(
		array $input,
		?string $method = null,
		?string $message_template = null
	): array {
		if ( 0 === count( $input ) ) {
			return $input;
		}
		if ( ! is_null( $method ) && ! is_string( $message_template ) ) {
			$message_template = 'Array key of type "%s" is not a string and will be skipped.';
		}
		$result = [];
		foreach ( $input as $key => $value ) {
			if ( is_string( $key ) ) {
				$result[ $key ] = $value;
			} else {
				if ( null !== $method ) {
					Warning::doing_it_wrong( $method, $message_template, gettype( $key ) );
				}
			}
		}

		return $result;
	}

	/**
	 * Remove empty string keys from an array, with optional warning.
	 *
	 * @param array $input The input array.
	 * @param string|null $method The method name for warning context. Optional. If null, no warnings will be issued.
	 * @param string|null $message_template The message template for warnings. Must have one %s placeholder for the index of the key. Optional.
	 *
	 * @return array The array with empty string keys removed.
	 */
	public static function remove_empty_string_keys_from_array(
		array $input,
		?string $method = null,
		?string $message_template = null
	): array {
		if ( 0 === count( $input ) ) {
			return $input;
		}
		if ( ! is_null( $method ) && ! is_string( $message_template ) ) {
			$message_template = 'Array key is an empty string and will be skipped. Index: "%s".';
		}
		$result = [];
		$index  = 0;
		foreach ( $input as $key => $value ) {
			if ( self::is_not_empty_string( $key ) ) {
				$result[ $key ] = $value;
			} else {
				if ( null !== $method ) {
					Warning::doing_it_wrong( $method, $message_template, (string) $index );
				}
			}
		}

		return $result;
	}

	/**
	 * Remove null values from an array.
	 *
	 * @param array $input The input array.
	 *
	 * @return array The array with null values removed.
	 */
	public static function remove_null_values_from_array( array $input = [] ): array {
		return array_filter(
			$input,
			[ self::class, 'not_null' ]
		);
	}

	/**
	 * Check if a value is not null.
	 *
	 * @param mixed $value The value to check.
	 *
	 * @return bool True if the value is not null, false otherwise.
	 */
	public static function not_null( mixed $value ): bool {
		return ! is_null( $value );
	}

	/**
	 * Check if a value is a non-empty string.
	 *
	 * @param mixed $value The value to check.
	 *
	 * @return bool True if the value is a non-empty string, false otherwise.
	 */
	public static function is_not_empty_string( mixed $value ): bool {
		return is_string( $value ) && '' !== $value;
	}

	/**
	 * Check if a value is an empty string or not a string.
	 *
	 * @param mixed $value The value to check.
	 *
	 * @return bool True if the value is an empty string or not a string, false otherwise.
	 */
	public static function is_empty_or_not_string( mixed $value ): bool {
		return ! self::is_not_empty_string( $value );
	}

	/**
	 * Sanitize an associative array of HTML attributes.
	 *
	 * @param array $attributes The associative array of attributes to sanitize.
	 * @param string $method The method name for warning context.
	 * @param array $defaults
	 * @param bool $add_sanitized Whether to add a self::SANITIZED_KEY flag to the result to prevent redundant processing. Default true.
	 *
	 * @return array The sanitized associative array of attributes.
	 */
	public static function sanitize_html_attributes_array(
		array $attributes,
		string $method,
		array $defaults = [],
		bool $add_sanitized = true
	): array {
		if ( 0 === count( $attributes ) || ! empty( $attributes[ self::SANITIZED_KEY ] ) ) {
			return $attributes;
		}
		// Remove non-string keys from the attributes array with warnings.
		$attributes = self::remove_non_string_keys_from_array(
			$attributes,
			$method,
			'Attribute key of type "%s" was found, but only string keys are allowed. Skipping this attribute.'
		);

		// Remove any empty string keys from the attributes array with warnings.
		$attributes = self::remove_empty_string_keys_from_array(
			$attributes,
			$method,
			'Attribute with an empty string key was found (index: %s). Skipping this attribute.'
		);

		// Remove any null values from the attributes array.
		$attributes = self::remove_null_values_from_array( $attributes );

		// Convert all attribute values to strings, logging warnings for any that fail.
		$attributes = self::map_to_strings(
			$attributes,
			$method,
			'Attribute "%s" has non-scalar value of type "%s", and could not be converted to string: %s. Skipping the attribute.',
			$defaults
		);

		// Remove any attributes that failed to convert (i.e., are null).
		$attributes = self::remove_null_values_from_array( $attributes );

		// Mark the attributes as sanitized to prevent redundant processing.
		if ( $add_sanitized ) {
			$attributes[ self::SANITIZED_KEY ] = true;
		}

		return $attributes;
	}

	/**
	 * Sanitize current values for form controls.
	 *
	 * @param mixed|null $current The current value(s) to sanitize.
	 * @param string $method The method name for warning context.
	 * @param string $message_template The message template for warnings. Must have three %s placeholders: one for index, one for type, one for error message.
	 *
	 * @return array<int,string> The sanitized array of current values. Note: can contain empty strings.
	 */
	public static function sanitize_current_values( mixed $current, string $method, string $message_template ): array {
		// Normalize the current value to an array of values if provided.
		if ( null === $current ) {
			// Nothing to do, return empty array.
			return [];
		} elseif ( ! is_array( $current ) ) {
			$current = [ $current ];
		}
		if ( 0 < count( $current ) ) {
			// Mar current values to strings with null as default.
			$current = Sanitizer::map_to_strings(
				$current,
				$method,
				$message_template
			);
			// Remove null values.
			$current = Sanitizer::remove_null_values_from_array( $current );
		} else {
			// No values after normalization, return empty array.
			return [];
		}

		// Return re-indexed array of current values.
		return ( 0 < count( $current ) ) ? array_values( array_unique( $current ) ) : [];
	}
}
