# Dr. Praveen Gupta - Official Website

A modern, aesthetic, and professional PHP website for Dr. Praveen Gupta, built with Tailwind CSS.

## 🎨 Color Palette

| Color | Hex Code | Usage |
|-------|----------|-------|
| Electric Blue | `#2563EB` | Primary actions, links |
| Cyan | `#06B6D4` | Accents, highlights |
| Deep Indigo | `#1E1B4B` | Headings, dark sections |
| Soft Cyan | `#ECFEFF` | Light backgrounds |
| White | `#FFFFFF` | Main background |
| Silver Grey | `#E5E7EB` | Borders, dividers |
| Dark Grey | `#111827` | Body text |

## 📁 Project Structure

```
dr-praveen/
├── index.php              # Homepage
├── includes/
│   ├── config.php         # Site configuration & data
│   ├── header.php         # Reusable header
│   └── footer.php         # Reusable footer
├── assets/                # Images, icons (create as needed)
├── .htaccess             # URL rewriting & security
└── README.md             # This file
```

## 🚀 Features

- ✨ **Modern Design** - Clean, professional aesthetic
- 📱 **Fully Responsive** - Mobile, tablet, and desktop optimized
- 🎭 **Smooth Animations** - Fade-in, slide, and hover effects
- 🎨 **Custom Color System** - Tailwind config with your brand colors
- 🔍 **SEO Optimized** - Meta tags and semantic HTML
- ♿ **Accessible** - ARIA labels and semantic structure
- ⚡ **Fast Loading** - Optimized assets and caching
- 📝 **Lead Forms** - Every form lands in CMS → Leads (and Formester)
- 💬 **Testimonials** - Patient reviews section
- 📊 **Statistics** - Numbers edited once in Settings, used site-wide
- 🧩 **File-based CMS** - Every page section, image, menu and text is editable at /cms

## 🛠️ Setup

1. **Requirements**: PHP 7.4+ and a web server (Apache/Nginx)
2. **Upload files** to your web server (e.g., htdocs for XAMPP)
3. **Access** via `http://localhost/dr-praveen/` or your domain

### Local Development (XAMPP/WAMP):
```
Place the folder in: C:/xampp/htdocs/dr-praveen/
Visit: http://localhost/dr-praveen/
```

## 📞 Contact Information

- **Phone**: +91-87969-77903
- **Email**: contact@drpraveengupta.com
- **Website**: https://drpraveengupta.com

## 🧩 Content Management (CMS)

Everything visible on the site is edited at `/cms` (login required). Saving is live immediately — the site runs on plain PHP hosting, there is no publish/build step.

| Screen | What it controls |
|---|---|
| **All Pages → Edit Content** | Every page: banner copy & photo, SEO (title, description, keywords, canonical, noindex, share image, breadcrumb), buttons, and every section of the page — drag to reorder, hide, remove or **add new sections** (cards, stats, text + photo, forms, maps, galleries, testimonials, FAQ…). Each section has an "Advanced layout options" JSON box for design settings. |
| **All Pages → New page** | Create a brand-new page (blank or a copy of an existing page's sections). It goes live at `/your-slug` through `page.php`, joins the sitemap and can be linked from Navigation. Pages created here can also be deleted. |
| **Hero Banners, Brain & Spine Cards, Our Medical Team, Testimonials, Blog Posts, FAQs** | The homepage slider, service cards, doctors (with every popup section), reviews / success stories / video testimonials, articles and per-page FAQs. |
| **Photo Gallery, Awards & Honours, Media Coverage, Education Videos, Instagram Reels, Case Studies** | Collections used by the gallery, awards, press, video and case-study pages and the homepage. |
| **Media Library** | Upload, browse, pick and delete images; every photo field has a "Choose from library" picker. |
| **Navigation** | Header menu (with dropdowns), header button, footer links, mobile bar, 404 links. |
| **Header, Footer & Shared Text** | Footer call-to-action, footer columns, floating buttons, shared video / "Watch & Learn" / FAQ wording, 404 copy, blog-article labels and doctor card, SEO defaults. |
| **Settings** | Site name, phone numbers, email, address, hours, social links, statistics, analytics IDs, custom scripts, logo / favicon / share image, organisation details for schema.org, gallery & video categories, Formester URL and lead notification email. |
| **Leads & Inquiries** | Every form submission (contact, newsletter, call-back, consultation, second-opinion, online booking) with status, notes and report downloads. |

### How content is stored

- `data/pages_catalog.json` — page list; `data/pages/{slug}.json` — per-page copy, SEO, section overrides and order.
- `data/page-blocks.json` — default sections ("blocks") per page; `data/page-ctas.json` — buttons.
- `data/collections/*.json`, `data/*.json` — collections, doctors, testimonials, blogs, FAQs, navigation, settings.
- Public templates are only `header → hero → cms_render_page_flow('slug') → footer`; section renderers live in `includes/page-blocks*.php`. See `CLAUDE.md` for the engine conventions.

### Text tokens

Use these inside any text field and they print the live value from Settings: `{phone}`, `{email}`, `{address}`, `{hours_weekdays}`, `{hours_sunday}`, `{stroke-helpline}`, `{site}`, `{year}`, `{stats_patients}`, `{stats_awards}`, `{stats_experience}`, `{stats_rating}`, `{stats_success}`. In button/link fields: a page slug, `#anchor`, `https://…`, `{phone}`, `{whatsapp}`, `{email}`, `{youtube}`, `{instagram}`.

## 📄 License

© 2026 Dr. Praveen Gupta. All rights reserved.
