# WPTools HTML Builder

Handy PHP utilities for building HTML in WordPress themes and plugins.

This package exists to make server-side HTML generation **less repetitive**, **more readable**, and **harder to get wrong** than manual string concatenation—especially in WordPress codebases where you frequently build small UI fragments.

It’s also WP_DEBUG-friendly: when you omit attributes that are easy to forget, the library will often trigger `_doing_it_wrong()` notices so you catch issues early.

## At a glance

- **Primary API:** `TechSpokes\WPTools\HTML\HTML` (static helpers for HTML tags)
- **Form helpers:** `TechSpokes\WPTools\HTML\Form\Control` and `TechSpokes\WPTools\HTML\Form\Field`
- **WordPress runtime:** uses core functions like `esc_html()`, `esc_attr()`, `_doing_it_wrong()`, `wp_parse_args()`, `sanitize_html_class()`

## Quick start

```php
<?php

use TechSpokes\WPTools\HTML\HTML;

echo HTML::a('Docs', [
    'href'  => 'https://example.com/docs',
    'class' => 'button button-primary',
]);
```

Build nested markup by composing strings:

```php
<?php

use TechSpokes\WPTools\HTML\HTML;

$badge = HTML::span('New', ['class' => 'badge badge--new']);

echo HTML::div(
    HTML::h3('Plugin Settings') . $badge,
    ['class' => 'settings-header']
);
```

### Form controls

`Control::input()` adds WordPress-style validation and helpful `_doing_it_wrong()` notices.

Important: while the library may “do the right thing” with defaults, **WP_DEBUG will still warn** in a lot of cases (by design). In production this typically doesn’t matter, but during development it helps catch fragile markup.

```php
<?php

use TechSpokes\WPTools\HTML\Form\Control;

// Recommended: pass type explicitly (omitting it defaults to "text" but triggers _doing_it_wrong() in WP_DEBUG).
echo Control::input([
    'type'  => 'text',
    'id'    => 'my_option',
    'name'  => 'my_option',
    'class' => 'regular-text',
], get_option('my_option'));
```

A full field wrapper with label + optional description:

```php
<?php

use TechSpokes\WPTools\HTML\Form\Field;

echo Field::input(
    [
        'id'   => 'site_tagline',
        'name' => 'site_tagline',
        'type' => 'text',
    ],
    get_option('site_tagline'),
    'Tagline',
    'Shown in some themes and browser titles.'
);
```

## What this library is

- A small, Composer-friendly helper library for **constructing HTML markup from PHP**.
- A set of utilities that encourage **consistent handling of attributes and predictable output**.
- A good fit for WordPress **admin pages**, **settings screens**, **shortcodes**, **widgets**, and **server-side rendered blocks**.

## What this library is not

- Not a templating engine.
- Not a front-end framework.
- Not a substitute for sanitizing untrusted HTML (you still need a sanitization/whitelist step when you allow HTML input).

## Requirements

- PHP: see `composer.json`
- WordPress: designed to be used in a WordPress runtime (themes/plugins)

### WordPress runtime dependency

This library directly calls WordPress functions such as:

- Escaping: `esc_html()`, `esc_attr()`
- Warnings: `_doing_it_wrong()`
- Utilities: `wp_parse_args()`, `sanitize_html_class()`

If your project isn’t running under WordPress, you’ll need compatible replacements.

## Installation

Install with Composer:

```powershell
composer require techspokes/wptools-html
```

Autoloading is handled by Composer. In a typical plugin/theme setup, make sure Composer’s autoloader is loaded (for example via your plugin bootstrap).

## API overview (current source)

### `TechSpokes\WPTools\HTML\HTML`

- Provides static helpers for many HTML tags (for example: `HTML::div()`, `HTML::span()`, `HTML::label()`, `HTML::input()`, `HTML::textarea()`, `HTML::a()` …).
- All tag methods ultimately format markup through the shared `Tag` base class.

Notable behavior:

- `HTML::a(?string $content = null, array $attributes = [])`
  - If `href` is missing/empty, it defaults to `'#'` and sets `role="button"` (unless already set).
  - If `$content` is `null`, it defaults to the `href` value.

### `TechSpokes\WPTools\HTML\Form\Control`

- `Control::input(array $attributes = [], mixed $current = null): string`
  - Sanitizes/normalizes the attributes array.
  - Ensures `<input>` has a `type` (**defaults to `text` and warns**).
  - Normalizes `$current` to an array of strings and uses it as a source of truth for state.
  - Handles common type-specific gotchas:
    - `checkbox`/`radio`: warns when `value` is missing; can set `checked` based on `$current`.
    - `submit`/`button`/`reset`: warns when `value` is missing/empty.
    - `file`: removes preset `value` (browsers ignore it).
    - `password`: warns when a preset `value` is provided.
  - May remove redundant `value=""` for certain text-like input types.

- `Control::textarea(array $attributes = [], ?string $current = null): string`
  - `<textarea>` does not support a `value` attribute.
  - If you pass `value`, the library will warn and remove it.
  - If `value` is present and `$current` is `null`, it may (with a warning) use `value` as the textarea content.

### `TechSpokes\WPTools\HTML\Form\Field`

- `Field::input(...)` renders a wrapper `<div>` containing:
  - a `<label>` (**warns if missing**, because accessibility)
  - a control from `Control::input()`
  - an optional description paragraph

Notes:
- For `checkbox`/`radio`, output order is `input` then `label`.
- If you want the label to be associated with the control, always provide an `id` attribute (used for the label’s `for`).

## Defaults & `_doing_it_wrong()` warnings (WP_DEBUG)

The library is intentionally “noisy” in debug mode for cases that are easy to miss but can cause fragile HTML.

### Common cases for `Control::input()`

- Missing/empty `type`
  - **What happens:** defaults to `type="text"` and triggers `_doing_it_wrong()`.
  - **What to do:** pass `'type' => 'text'` (or your intended type) explicitly.

- `checkbox` / `radio` without `value`
  - **What happens:** triggers `_doing_it_wrong()`.
  - **Why:** browsers submit `"on"` by default when checked.
  - **What to do:** always provide an explicit `'value' => '1'` (or your preferred stored value).

- `submit` / `button` / `reset` without a useful `value`
  - **What happens:** triggers `_doing_it_wrong()`; if you pass `$current` it may use that as the value.
  - **What to do:** provide a non-empty `'value' => 'Save'` (or similar).

- `type="file"` with a preset `value`
  - **What happens:** triggers `_doing_it_wrong()` and removes `value`.
  - **What to do:** don’t set `value` for file inputs.

- `type="password"` with a preset `value`
  - **What happens:** triggers `_doing_it_wrong()`.
  - **What to do:** avoid preset password values when possible.

### Common cases for `Field::input()`

- Missing/empty label
  - **What happens:** triggers `_doing_it_wrong()`.
  - **What to do:** pass `$label`, or if you truly want no visual label use `Control::input()` directly and add appropriate ARIA attributes (`aria-label`, `aria-labelledby`).

- Missing `id`
  - **What happens:** no warning, but the `<label for="...">` can’t link to the control.
  - **What to do:** always pass an `id` when using `Field::input()`.

### Common cases for `Control::textarea()`

- Passing a `value` attribute
  - **What happens:** triggers `_doing_it_wrong()` and removes `value`.
  - **What to do:** pass the current value as the second argument (`$current`) so it becomes the textarea content.

## Usage (practical patterns)

### Theme template / partial

- Build a reusable “component” (card, badge, notice) as a PHP function.
- Return the generated HTML string.
- Output it where appropriate in the template.

### Shortcode

- Validate and normalize shortcode attributes.
- Build markup.
- Return a string (shortcodes should return, not echo).

### Admin UI (settings pages, meta boxes)

- Build form fields with consistent attribute handling.
- Keep markup readable and avoid a maze of concatenated strings.

#### Recipe: Meta box checkbox with label + description

This pattern avoids common WP_DEBUG warnings (explicit `type`, explicit `value`, proper `id`, label + description):

```php
<?php

use TechSpokes\WPTools\HTML\Form\Field;
use WP_Post;

/**
 * Render the meta box for ticket meta fieldset.
 *
 * @param WP_Post $post The current post object.
 *
 * @return void
 */
public function render_meta_box( WP_Post $post ): void {
	// add nonce field for security
	wp_nonce_field( PostMeta::TS_ETPA_IAC_UPDATE_META, PostMeta::TS_ETPA_IAC_UPDATE_META_NONCE );
	// echo checkbox for setting this fieldset as default
	echo Field::input(
		[
			'type'  => 'checkbox',
			'name'  => PostMeta::META_KEY_TICKET_META_FIELDSET_IS_DEFAULT,
			'id'    => PostMeta::META_KEY_TICKET_META_FIELDSET_IS_DEFAULT . '_field',
			'value' => '1',
		],
		(string) absint( get_post_meta( $post->ID, PostMeta::META_KEY_TICKET_META_FIELDSET_IS_DEFAULT, true ) ),
		__(
			'Use as default fieldset for all tickets?',
			'event-tickets-plus-iac-fields'
		),
		__(
			'If checked, this fieldset will be used as the default for all tickets.',
			'event-tickets-plus-iac-fields'
		)
	);
}
```

Notes:
- For `checkbox`/`radio`, `Control::input()` sets `checked="checked"` when the current value matches the `value` attribute.
- If you omit `value` for a checkbox, the submitted value becomes `"on"` (and the library warns about it).

## Escaping, sanitization, and safety

A helper library can make escaping easier, but it can’t decide what is “safe” for your project.

### Attributes

Attributes are normalized/sanitized as an array (keys validated, nulls removed, values coerced to strings) and output with WordPress escaping (`esc_attr()`).

### Content

Tag content is coerced to a string when possible, but it is **not automatically escaped**. That’s intentional: sometimes you’re composing nested markup strings.

Rule of thumb in WordPress:

- **Escape for the correct context**:
  - Text node content: `esc_html()`
  - Attribute values: `esc_attr()`
  - URLs: `esc_url()`
- **Sanitize/whitelist HTML** if you accept HTML input:
  - Use `wp_kses()` / `wp_kses_post()` when you want to permit limited HTML.

Avoid double escaping by deciding whether you pass already-escaped text into the builder or you escape at the point you generate text.

## Versioning

This project intends to follow Semantic Versioning (SemVer): breaking changes will only be introduced in major releases.

Note: the codebase currently contains `@since 0.0.x` annotations, so treat the API as still settling until a `1.0.0` release.

## Contributing

Issues and pull requests are welcome.

If you’re proposing a behavioral change, please include:

- the motivation / use case
- before/after examples of expected HTML output
- tests (when applicable)

## License

See `LICENSE`.
