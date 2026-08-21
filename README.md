# vicunav-theme-core

Shared WordPress block theme and presentation layer for the Vicunav ecosystem. It
provides reusable design tokens, templates, template parts, and patterns without
owning business logic.

## Current status

Version `0.1.0` contains the complete foundation planned for the first theme milestone:

- WordPress 6.6 and PHP 8.1 minimum compatibility.
- Public color, spacing, typography, and font-size tokens in `theme.json`.
- A selectable Bonasera style variation with self-hosted OFL fonts and WCAG AA
  contrast evidence, without replacing the global defaults.
- General templates for front page, pages, single content, archives, and fallback
  rendering.
- Default and contact-first headers.
- Full and minimal footers.
- Restaurant home/inner headers and full/minimal footers with responsive, accessible
  core Navigation behavior.
- Centered and split-image heroes, a simple CTA, testimonials, FAQ accordion, and
  contact-information patterns.
- Reusable editorial-story and linked-card-grid patterns for content-led verticals.
- Optional integration with shared settings and content types from the future
  `vicunav-plugin-core` package.

All planned issues through #29 are closed. The remaining visual work is to replace the
placeholder palette with the final Vicunav brand identity when that decision is ready.

## Architectural boundary

This repository owns presentation only. It does not register business post types,
process payments, manage orders or reservations, or read another package's private
data. Patterns that consume shared content degrade gracefully when the responsible
plugin is not active.

The versioned integration surface is documented in the
[public contract](docs/contrato-publico.md). Vertical plugins own their default block
templates; the [vertical template guide](docs/plantillas-verticales.md) explains the
registration and override rules.

## Setup

Clone the repository with its standards submodule:

```bash
git clone --recurse-submodules https://github.com/vicunav/vicunav-theme-core.git
cd vicunav-theme-core
```

If it was cloned without submodules, initialize them afterward:

```bash
git submodule update --init --recursive
```

The ecosystem's cross-cutting rules are available in
[`docs/standards/`](docs/standards/).

## Validation

PHP files are linted with WordPress Coding Standards in CI. Declarative files and block
markup are validated through syntax checks, rendering, and manual inspection according
to the shared [testing standard](docs/standards/docs/testing.md).

## Roadmap

The theme foundation is ready for integration. Ecosystem-wide sequencing lives in
[`vicunav-hub`](https://github.com/vicunav/vicunav-hub); the next package is
`vicunav-plugin-core`, followed by payments and the restaurant vertical.
