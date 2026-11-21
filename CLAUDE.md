# Dr. Praveen Gupta website — working notes

PHP 8 + Tailwind (CDN) site with a file-based CMS under `/cms`. No database: every
piece of content lives in JSON under `/data`. The site is deployed to plain PHP
hosting (Apache); saving in the CMS is live immediately — there is no build step.

## Content model (one rule)

**Every section of every page is a typed block rendered from the page's flow.**
A template is just `header → hero → cms_render_page_flow('slug') → footer`.

| Where | What |
|---|---|
| `data/pages_catalog.json` | list of pages (slug, file, title, category). Pages created in the CMS have `file: "page.php"` and `created_in_cms: true` and are served by `page.php` through the `.htaccess` fallback. |
| `data/pages/{slug}.json` | per-page copy: `hero_*`, SEO (`meta_*`, `canonical`, `robots_noindex`, `og_image`, `breadcrumb_label/parent`, `hero_icon`), `blocks` (overrides of block defaults), `layout` (order/hidden/added sections), `ctas` (button overrides), legacy `section1_*` / `custom_sections`. |
| `data/page-blocks.json` | block **defaults** per slug (`_flow: true` marks flow pages) plus `_shared` stubs. Block = `{type, label, badge, title, description, text, items[], options{}, wrap{}, …}`. `nested: true` blocks are printed by a parent (e.g. `split-panel` `options.aside_key`); `placement: "hero"` blocks print inside the banner. |
| `data/page-ctas.json` | button registry: `defaults` + `pages[slug]` (blank text = no button). |
| `data/collections/*.json` | gallery, awards, media_coverage, videos, reels, case_studies (schemas in `cms/includes/collections.php`). |
| `data/settings.json` | globals → `SITE_*` constants in `includes/config.php`; also Site Text (`cms_text()`), stats tokens, organisation/schema data. |
| `data/navigation.json` | header menu, footer links, mobile bar, 404 links. |

## Block engine

* `includes/page-blocks.php` — core: `cms_page_blocks()`, `cms_page_layout()`, `cms_render_page_flow()`, `cms_render_page_block()` (dispatches to `cms_render_block_{type}`), legacy service-page types (cards, steps, facts, symptoms, treatments, why-choose, related, doctor, cta, notice, links), `cms_block_type_catalog()` / `cms_block_blank()` (+ `_extra` hooks).
* `includes/page-blocks-ext.php` — homepage/about types (banner-slider, services-grid, slideshow, stats, text-media, feature-split, strip, team-grid, testimonials, blog-grid, collection-grid, reels, hero-list, split-panel, quote, cta-simple), catalog entries for all new types, shared helpers (`cms_render_pill_header`, `cms_block_button`, `cms_resolve_stat_tokens`).
* `includes/page-blocks-media.php` — `cms_render_page_hero()` (shared banner), collection-grid variants (`cms_collection_variant_*`), testimonial variants (`cms_testimonials_variant_*`).
* `includes/page-blocks-contact.php` — contact-form, map, message-hero, blog-grid variants `all` / `list`.
* `includes/page-blocks-patient.php` — checklist, form-card, alert-banner, richtext.

Adding a block type = one renderer function + one catalog entry (`fields`, `item_fields`,
`item_hints`, `no_items`, `block_image`, `block_panel`, `help`) + optional `cms_block_blank_extra`
defaults. The editor (`cms/page-edit.php`) builds its form from the catalog; per-type JSON
`options` are editable under “Advanced layout options”.

Text tokens: `{phone} {email} {address} {hours_weekdays} {hours_sunday} {stroke-helpline} {site} {year} {stats_*}`.
URL tokens (`cms_nav_href` / `cms_cta_href`): `{phone} {stroke-helpline} {whatsapp} {email} {youtube} {instagram} {facebook} {linkedin} {twitter}`.

## Forms & leads

All public forms post to `api/save-lead.php` (stores `data/leads.json`, forwards to Formester,
optional email, uploads to `data/lead-uploads/`). CMS → Leads lists them.

## Conventions

* Files are CRLF in git; `php -l` every edited PHP file.
* Verify template/engine changes by rendering pages locally (`php -S 127.0.0.1:8089`) before and
  after and diffing visible text/images/links — markup may change, content must not unless intended.
* Verify editor changes with a “save without changes” round-trip: `git diff data/` must stay empty
  (other than first-save copies of block defaults into `data/pages/*.json`).
* Never hard-code copy in templates or renderers: add a field (block, Site Text key or setting).

## Compliance (DPDP Act 2023 + NMC advertising rules, Nov 2026)

* `includes/compliance.php` (loaded by `cms-load.php`) holds the code-level guards, so they apply to
  live data too: retired pages `cms_retired_pages()` (testimonials, reviews, success stories, case
  studies → 301), retired section types `cms_block_is_retired()` (`testimonials`, `video-testimonials`,
  case-study `collection-grid`) skipped by `cms_render_page_block()`, nav links to retired pages dropped
  in `cms_navigation()`, footer disclaimers + legal links, and the cookie banner.
* GTM / GA4 / Meta Pixel and Instagram embeds load only after cookie consent (`cms_render_consent_loader()`
  in `<head>`, `window.dpgConsent.onAccept(fn)` for anything else non-essential). Never add a tracker
  that loads unconditionally. YouTube embeds use `youtube-nocookie.com`.
* Every lead form must call `cms_consent_fields($uid, $theme, $purpose)` before its submit button;
  `api/save-lead.php` rejects posts without `consent=yes` and stores `consent_at` / `consent_version`.
  Bump `CMS_CONSENT_VERSION` when the consent wording or tracker list changes.
* Copy rules: no patient testimonials, reviews, recovery stories or inducements (discounts, offers,
  "free consultation"). Clinical claims, "first-in" milestones, statistics and ratings are kept as
  the owner wrote them (owner decision, 21 Nov 2026) — do not rewrite them without being asked.
  Disclaimer / consent / cookie copy lives in Site Text group "Compliance & consent".
* After deploying + `scripts/merge-live-data.php`, run `php scripts/compliance-dpdp-nmc.php` once
  (idempotent; `--dry-run` first). It removes retired sections/links, installs the Privacy Policy
  and Medical Disclaimer, and lists any testimonial wording it could not remove.
