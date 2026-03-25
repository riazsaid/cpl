## CPL Atomic Design Theme – Architecture

This document describes the architecture for the **Custom Phenolic Labels (CPL)** WordPress theme, named `atomic-design`. It combines:

- **Gutenberg (Block Editor)** as the editor used by content authors.
- **ACF Pro** for structured fields and block rendering.
- An **atomic design** hierarchy (atoms → molecules → organisms → templates → pages).

Use this as the single source of truth when building or refactoring the theme.

---

### 1. High-Level Goals

- **Editor experience**: Content editors work primarily inside the **Block Editor**, using a curated library of:
  - Core blocks (paragraphs, headings, images, lists, buttons).
  - Custom **ACF blocks** that represent CPL-specific components (heros, product grids, CTAs, FAQs, etc.).
- **Design consistency**: All pages and components derive from:
  - Shared design tokens (colors, typography, spacing, breakpoints).
  - Reusable component classes with predictable naming.
- **Performance and maintainability**:
  - No heavy page builders (no Elementor).
  - Lean markup and CSS, minimal redundancy.
  - Clear separation between layout (templates), components (blocks/partials), and content (ACF fields).

---

### 2. Theme Structure

The theme lives under:

- `public/wp-content/themes/atomic-design/`

Planned internal structure:

- `style.css` – theme header; imports core CSS bundle.
- `functions.php` – theme setup and hooks:
  - Theme supports (Gutenberg, post thumbnails, menus, etc.).
  - Script/style enqueueing.
  - Navigation/menu registration.
  - ACF integration (options pages, block registration, JSON path).
- `assets/`
  - `assets/css/variables.css` – design tokens (colors, fonts, spacing, breakpoints).
  - `assets/css/base.css` – reset, typography, basic layout helpers.
  - `assets/css/layout.css` – site-wide layout scaffolding (header, footer, grids).
  - `assets/css/components/` – component-level styles (accordions, cards, badges, etc.).
  - `assets/js/main.js` – global JS (navigation toggles, simple interactions).
  - `assets/js/components/` – per-component enhancements if needed.
- `blocks/`
  - One folder per ACF block:
    - `blocks/hero/hero.php`, `hero.css`
    - `blocks/feature-grid/feature-grid.php`, `feature-grid.css`
    - `blocks/faq/faq.php`, `faq.css`
    - etc.
- `templates/`
  - Optional custom page templates:
    - `templates/page-contact.php`
    - `templates/page-resources.php`
    - etc., depending on sitemap needs.
- Root-level templates:
  - `front-page.php` – homepage layout.
  - `page.php` – default page layout.
  - `single.php` / `single-{cpt}.php` – single posts or custom post types (if used).
  - `archive.php` / `archive-{cpt}.php` – archives (e.g. products, resources).
  - `header.php`, `footer.php`, `sidebar.php` (if a sidebar is used).

---

### 3. Atomic Design Mapping

We treat theme pieces at five levels:

- **Atoms** (smallest pieces)
  - Buttons, links, icons, labels, badges.
  - Form elements, typographic styles (heading variants, body text).
  - CSS-only building blocks, usually defined in `variables.css`, `base.css`, and small component files.

- **Molecules**
  - Small combinations of atoms:
    - Card with icon + title + text + CTA.
    - Input + label + helper text.
    - Logo list item, stat item, etc.
  - Implemented as:
    - Reusable markup fragments (within blocks/partials).
    - Reusable CSS classes with BEM naming.

- **Organisms**
  - Larger sections composed of molecules:
    - Hero section (headline, subcopy, background image, CTA).
    - Product/feature grid.
    - FAQ accordion.
    - Testimonial carousel or grid.
  - Each organism is usually an **ACF block** with:
    - A defined field group (titles, body text, images, links).
    - A render template in `blocks/<block-name>/<block-name>.php`.
    - A matching CSS file for styling only that section.

- **Templates**
  - Page-level layouts that arrange organisms:
    - Homepage template assembling sections in a fixed or flexible order.
    - Product-type landing page template (if needed).
    - Resource or FAQ hub page.
  - Implemented as:
    - `front-page.php` / `page.php` / `templates/*.php` files.
    - Use loops of ACF blocks or block patterns in Gutenberg.

- **Pages**
  - Real content instances editors see:
    - “Home”, “About”, “Industries”, “Products”, “Contact”, etc.
  - Editors manage:
    - Content values inside ACF fields.
    - The ordering of blocks in the editor (within allowed options).

---

### 4. Gutenberg + ACF Integration

- **Editor of choice**: Gutenberg (Block Editor).
- **Custom blocks**: Registered via `acf_register_block_type()` in `functions.php`.
  - Each block:
    - Has a unique `name` and `title`.
    - Points to a `render_template` under `blocks/<block-name>/<block-name>.php`.
    - Is assigned a category (e.g. `cpl-sections`) to group it in the block inserter.
    - Optionally supports `align`, `mode`, `multiple` and other options.
- **Field groups**:
  - Stored under `acf-json/` for version control.
  - One field group per block or logical group of fields.
  - Fields use clear names and instructions for editors.

Editing experience:

- Editors build pages by:
  - Adding ACF blocks (hero, feature grids, FAQs, CTAs).
  - Filling in field values.
  - Reordering sections as needed.
- Optional:
  - Restrict core blocks to a curated set for consistency.
  - Provide prebuilt **patterns** combining multiple blocks for common layouts.

---

### 5. URL / Template Mapping (From CSV)

The file `CPL 2026 Website - URLs.csv` defines the site’s planned URLs. Use it to:

- Group pages into:
  - Top-level navigation items.
  - Subpages under each section.
  - Special pages (e.g. product details, resources, FAQs).
- Decide per URL:
  - **Standard page** using Gutenberg + blocks.
  - **Custom template** if layout or behavior is significantly different.
  - **Archive/single** for future custom post types (if repeated structured content is needed).

Implementation guidelines:

- For one-off marketing pages:
  - Use the default `page.php` layout and build content entirely via blocks.
- For repeated structured pages (e.g. a catalog of similar items):
  - Consider:
    - A custom post type (CPT).
    - Dedicated templates (`single-{cpt}.php`, `archive-{cpt}.php`).
    - Shared blocks that render CPT data.

---

### 6. CSS & Naming Conventions

- **Design tokens**:
  - All colors, spacing, font sizes, and breakpoints live in `assets/css/variables.css`.
  - Components reference tokens via CSS variables, not hardcoded values.
- **Base styles**:
  - `assets/css/base.css` defines:
    - Reset/normalize.
    - Body typography.
    - Headings (`.heading-xl`, `.heading-l`, etc. if using utility classes).
    - Links, buttons, basic layout helpers.
- **Component styles**:
  - Each significant organism/block has its own CSS file:
    - `blocks/hero/hero.css`
    - `blocks/feature-grid/feature-grid.css`
    - etc.
  - Use BEM-like naming:
    - `.hero`, `.hero__title`, `.hero__subtitle`, `.hero__cta`.
- **Page-level CSS**:
  - Kept to a minimum.
  - Focus on layout composition, not component internals.

---

### 7. ACF Conventions

- **Field naming**:
  - Use clear prefixes per block: e.g. `hero_title`, `hero_subtitle`, `hero_cta_label`.
  - Avoid generic names like `title` or `content` inside complex blocks.
- **Field groups**:
  - One group per block or logical section.
  - Exported to `acf-json/` and committed to git.
- **Options pages** (if needed for CPL):
  - For site-wide content (e.g. contact details, social links, default CTAs).
  - Document which components use which options fields.

---

### 8. Extending the Theme

When adding new features or sections:

1. **Decide level**:
   - Is it an organism (block), template change, or just a molecule inside an existing block?
2. **Define fields**:
   - Create or update an ACF field group.
   - Keep naming consistent and scoped to the component.
3. **Create templates**:
   - Add or update the relevant `blocks/<block-name>/*.php` and CSS files.
4. **Wire up in `functions.php`**:
   - Register new ACF block or template hooks.
5. **Update documentation**:
   - If the change affects site-wide patterns, update this document briefly.

---

This architecture is meant to stay close to the TSM Agency pattern, but simplified and tailored for CPL and Gutenberg from the start. Use it as a reference for future CPL changes and for similar atomic-design WordPress builds.

