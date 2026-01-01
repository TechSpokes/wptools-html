<?php

namespace TechSpokes\WPTools\HTML\Utils;

use Throwable;

/**
 * Marker class for warning-related utilities.
 *
 * @package TechSpokes\WPTools\HTML\Utils
 * @since 0.0.1
 */
final class Warning {
	public const VERSION = '1.0.0';

	/**
	 * Wrapper for _doing_it_wrong with message formatting.
	 *
	 * @param string $method The method where the warning occurred.
	 * @param string $message_template The message template with placeholders.
	 * @param string ...$replacements The values to replace in the message template.
	 *
	 * @return void
	 */
	public static function doing_it_wrong(
		string $method,
		string $message_template,
		string ...$replacements
	): void {
		try {
			_doing_it_wrong(
				$method,
				$replacements ? sprintf( $message_template, ...$replacements ) : $message_template,
				self::VERSION
			);
		} catch ( Throwable $e ) {
			_doing_it_wrong(
				$method,
				sprintf(
					'An error occurred while formatting the warning message from %s: %s',
					$method,
					$e->getMessage()
				),
				self::VERSION
			);
		}
	}

}