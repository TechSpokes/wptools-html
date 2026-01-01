# WPTools HTML Builder

Handy PHP utilities for building HTML in WordPress themes and plugins.

This package exists to make server-side HTML generation **less repetitive**, **more readable**, and **harder to get wrong** than manual string concatenation—especially in WordPress codebases where you frequently build small UI fragments.

## What this library is

- A small, Composer-friendly helper library for **constructing HTML markup from PHP**.
- A set of utilities that encourage **consistent handling of attributes, text, and safe output**.
- A good fit for WordPress **admin pages**, **settings screens**, **shortcodes**, **widgets**, and **server-side rendered blocks**.

## What this library is not

- Not a full templating engine.
- Not a front-end framework.
- Not a substitute for sanitizing untrusted HTML (you still need a sanitization/whitelist step when you allow HTML input).

## Design goals

- **WordPress-friendly**: intended for use inside themes/plugins and integrates well with WordPress escaping/sanitization practices.
- **Ergonomic HTML building**: create tags, attributes, and nested markup with less boilerplate.
- **Predictable output**: deterministic string output suitable for `echo`/`return`.
- **Small surface area**: lightweight and dependency-minimal.

## Requirements

- PHP: see `composer.json`
- WordPress: designed to be used in a WordPress runtime (themes/plugins). If your project is not running under WordPress, you’ll need equivalent escaping/sanitization functions.

## Installation

Install with Composer:

```powershell
composer require techspokes/wptools-html
```

Autoloading is handled by Composer. In a typical plugin/theme setup, just make sure Composer’s autoloader is loaded (for example via your plugin bootstrap).

## Usage (conceptual)

This library is intentionally small and focuses on a few common patterns:

- **Build an element** (tag name + attributes)
- **Add content** (plain text or nested markup)
- **Render** to a string and output (`echo`) or return (shortcodes)

Example scenarios:

### Theme template / partial
- Build a reusable “component” (e.g., a card, badge, notice) as a PHP function.
- Return the generated HTML string.
- Output it where appropriate in the template.

### Shortcode
- Validate and normalize shortcode attributes.
- Build markup.
- Return a string (shortcodes should return, not echo).

### Admin UI (settings pages, meta boxes)
- Build form fields with consistent attribute handling.
- Keep markup readable and avoid a maze of concatenated strings.

## Escaping, sanitization, and safety

A helper library can make escaping easier, but it can’t decide what is “safe” for your project. A good rule of thumb for WordPress:

- **Escape output for the correct context**:
  - Text node content: `esc_html()`
  - Attribute values: `esc_attr()`
  - URLs: `esc_url()`
- **Sanitize/whitelist HTML** if you accept HTML input:
  - Use `wp_kses()` / `wp_kses_post()` (or a custom allowed-tags set) when you want to permit limited HTML.
- **Avoid double escaping**: decide whether you pass already-escaped content into the builder, or whether escaping happens at render time, and be consistent.

This project aims to make the *safe path* the easiest path, but you’re still responsible for choosing the right escaping/sanitization strategy for your use case.

## Versioning

This project intends to follow Semantic Versioning (SemVer): breaking changes will only be introduced in major releases.

## Contributing

Issues and pull requests are welcome.

If you’re proposing a behavioral change, please include:

- the motivation / use case
- before/after examples of expected HTML output
- tests (when applicable)

## License

See `LICENSE`.
