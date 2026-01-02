<?php

namespace TechSpokes\WPTools\HTML;

use TechSpokes\WPTools\HTML\Utils\Attributes;
use TechSpokes\WPTools\HTML\Utils\Sanitizer;

/**
 * Abstract base class for generating HTML tags with attributes and content.
 *
 * @package TechSpokes\WPTools\HTML
 * @since 0.0.1
 */
abstract class Tag {

	// Include attribute utilities
	use Attributes;

	/**
	 * Generates an HTML tag with given attributes and content.
	 *
	 * @param string $tag The HTML tag name.
	 * @param string|null $content The content inside the tag. Null for self-closing tags.
	 * @param array $attributes Associative array of attributes for the tag.
	 * @param bool $self_closing Whether the tag is self-closing.
	 *
	 * @return string The generated HTML tag as a string.
	 */
	protected static function tag(
		string $tag,
		?string $content = null,
		array $attributes = [],
		bool $self_closing = false
	): string {
		if ( $self_closing ) {
			return sprintf(
				'<%1$s%2$s />',
				esc_html( $tag ),
				self::sprint_attributes( $attributes )
			);
		}

		// Convert content to string, defaulting to empty string if fails.
		$content = Sanitizer::to_string_or_default(
			$content,
			__METHOD__,
			$tag,
			'Content for HTML tag <%s> of type "%s" could not be converted to string: %s. Using empty string as default.',
			''
		);

		return sprintf(
			'<%1$s%2$s>%3$s</%1$s>',
			esc_html( $tag ),
			self::sprint_attributes( $attributes ),
			$content
		);
	}
}