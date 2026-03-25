## TSM Agency Theme – Architecture & Refactor Plan

This document explains how the current TSM Agency theme is structured, what issues were identified (especially around CSS and component structure), and a step‑by‑step plan to clean it up. You can reuse this as a blueprint when working on similar WordPress projects.

---

### 1. Project Overview

- **Tech stack**: Custom WordPress theme using:
  - PHP templates + partials
  - Advanced Custom Fields (ACF) blocks and options pages
  - Custom post types (`service`, `city`, `event`, etc.)
  - Custom CSS in `assets/css` and block‑level styles under `blocks/*/*.css`
  - GSAP/ScrollTrigger animations (`assets/js/animations.js`)
- **Entry points**:
  - `functions.php` – enqueueing styles/scripts, registering ACF blocks and field groups, REST support.
  - `style.css` – theme header only; real styling lives in `assets/css/*.css` and block CSS files.
  - Templates: `front-page.php`, `page.php`, `single-*.php`, `archive-*.php`
  - Partials under `partials/*` and ACF block templates under `blocks/*/*.php`

---

### 2. Current Structure (High Level)

- **Global CSS**
  - `assets/css/variables.css` – design tokens (colors, spacing, typography etc.).
  - `assets/css/base.css` – base/reset and global typography/layout.
  - `assets/css/header.css`, `assets/css/footer.css` – layout and navigation/footer styles.
  - Page‑specific: `service-page.css`, `city-page.css`, `event-page.css`, `page.css`, `page-form.css`, `city-page.css`.
  - Shared components: `shared-components.css`.

- **ACF Blocks**
  - Registered in `functions.php` via `acf_register_block_type`, e.g.:
    - `hero`, `cities-hero`, `trust-bar`, `why-companies`, `upcoming-events`, `find-staff`, `why-trust`, `testimonials`, `faq-accordion`, `staffing-locations`, `two-column-text`, `services-grid`, `cities-grid`, `about-page`, `contact-page`, `event-staffing-cards`, `brand-agency-boxes`, `role-service-cards`, `hire-become-services`, `what-it-takes`, `social-links`, etc.
  - Each block has a PHP render template under `blocks/<block-name>/*.php` and usually a matching CSS file under `blocks/<block-name>/*.css`.

- **Partials**
  - City: `partials/city/*` (hero, intro, role-service, benefits-service, three-boxes, etc.).
  - Service: `partials/service/*` (hero, intro, hire-service, hire-services, benefits-service, services-do, trade-service, local-trade-service, trust-bar, etc.).
  - Event: `partials/event/*` (hero, three-boxes, role-service, what-to-know, trade-show, etc.).
  - Shared: `partials/shared/*` (hero, booking-benefits-service, testimonials, faqs, trust-bar, etc.).

- **ACF JSON / Options**
  - `acf-json/*` stores field group definitions for syncing between environments.
  - Additional ACF options pages registered in `functions.php`:
    - `Hire & Become Services`
    - `Trade Service Section`
    - `Social Links`
    - `What It Takes Block` field group, etc.

---

### 3. Key Issues Identified

- **3.1 CSS foundation issues**
  - Global styles are split across many files without a strict design system.
  - Some component styling leaks across templates (e.g. generic selectors in page‑level CSS instead of scoped component classes).
  - Inconsistent naming of classes and occasional mixing of layout and component styles in the same file.
  - The base CSS is present but not always treated as the single source of truth for typography, spacing, and color tokens.

- **3.2 Duplication & overlapping components**
  - Similar concepts appear multiple times with different implementations and/or filenames:
    - City, service, and event templates share structures like hero, benefits, role/service cards, three‑column sections, etc., but are implemented separately (`partials/city/*`, `partials/service/*`, `partials/event/*`, `partials/shared/*`).
    - Some blocks and partials overlap in purpose (e.g. trust bar appears as both block and partial).
  - This leads to:
    - Harder maintenance (bug fixes must be duplicated).
    - Slightly different UI/UX for similar sections depending on template.

- **3.3 Inconsistent component boundaries**
  - Some pieces are ACF blocks, others are plain partials, even when they represent the same kind of reusable content.
  - Layout concerns (grid, spacing) and content concerns (headings, copy, CTAs) are sometimes mixed inside the same PHP and CSS structures.

- **3.4 File naming / organization**
  - Multiple files with similar names across different directories (`hero.php`, `three-boxes.php`, `role-service.php`, etc.) make it harder to see where the “source of truth” for a component lives.
  - Block CSS (`blocks/*/*.css`) and page CSS (`assets/css/*-page.css`) sometimes overlap responsibilities.

- **3.5 ACF responsibilities**
  - ACF is used very heavily for both per‑page content and global options (booking benefits, services boxes, hire & become steps, trade service content, social links, etc.).
  - Field groups are registered in multiple ways (PHP in `functions.php` and JSON export), which can be confusing if not documented.

---

### 4. Desired End State / Architecture Principles

When refactoring or building new sites with this pattern, we aim for:

- **Single source of truth for design tokens**
  - All colors, typography, spacing, breakpoints in `variables.css`.
  - Base structure (body, headings, buttons, links, grid helpers) in `base.css`.

- **Component‑first CSS**
  - Each meaningful section (hero, trust bar, cards, grids, FAQ, etc.) has:
    - A clear PHP template: either an ACF block or shared partial.
    - A dedicated stylesheet with BEM‑style class naming, imported/enqueued in a predictable way.
  - Page‑level CSS only handles layout/composition, not component internals.

- **Clear separation between layout, components, and content**
  - Layout templates (`front-page.php`, `single-*.php`, `archive-*.php`) assemble components.
  - Components (blocks/partials) are reusable building blocks.
  - Content structure and copy are managed via ACF fields (field groups/options pages).

- **Reduced duplication**
  - Shared sections (e.g. trust bar, testimonials, role/service cards, three‑column benefits) live in one shared component and are reused across cities, services, and events.

- **Consistent naming and file organization**
  - Folder/file names reflect component responsibility (e.g. `blocks/role-service-cards/*` is the single canonical implementation for role cards).

---

### 5. Refactor Strategy (Step‑By‑Step)

You can follow these steps on this project and reuse them on future WordPress builds.

#### 5.1 Map existing components

- Create an inventory of components:
  - ACF blocks and their PHP templates (`blocks/*/*.php`).
  - Partials used by city, service, and event templates (`partials/*`).
  - Shared UI patterns (hero, trust, grids, cards, FAQs, CTAs).
- For each component, note:
  - Where it’s used (which templates/CPTs).
  - Whether there is an equivalent ACF block or partial elsewhere.

#### 5.2 Normalize global design system

- Centralize **design tokens** in `assets/css/variables.css`:
  - Colors, font stacks, font sizes, line heights.
  - Spacing scale (e.g. `--space-xs/s/m/l/xl`).
  - Breakpoints.
- Clean up `assets/css/base.css` to:
  - Define base typography, headings, global layout helpers.
  - Remove component‑specific styling from base.
- Ensure all new component CSS only uses tokens from `variables.css` and standard patterns from `base.css`.

#### 5.3 Consolidate shared components

- Identify duplicated sections across:
  - `partials/city/*`
  - `partials/service/*`
  - `partials/event/*`
  - `partials/shared/*`
- For each group (e.g. trust bar, testimonials, three boxes, role/service cards):
  - Choose a **single authoritative implementation**:
    - Prefer an ACF block if editors need flexibility.
    - Otherwise, create a shared partial in `partials/shared/`.
  - Refactor city/service/event templates to use the shared block/partial instead of their own copies.

#### 5.4 Clean up CSS per component

- For each component (block or partial):
  - Ensure it has a single root class (e.g. `.local-trade-service`) and BEM‑style child classes.
  - Move all styling for that component into a dedicated CSS file:
    - Block components: `blocks/<name>/<name>.css`.
    - Shared partial components: a dedicated CSS module (or a shared `shared-components.css` with clear sections).
  - Remove duplicated or conflicting rules from page‑level CSS.

#### 5.5 Rationalize ACF configuration

- Standardize how ACF is defined:
  - Keep field group definitions either as PHP in `functions.php` or as JSON in `acf-json/`, but document the chosen approach.
  - Document each options page (e.g. Hire & Become Services, Trade Service Section, Social Links) and which components consume its fields.
- For reusable UI:
  - Prefer ACF blocks (registered with `acf_register_block_type`) so the same component can be used on multiple pages.
  - Use options pages for global content that appears site‑wide (e.g. social links, booking benefits).

#### 5.6 REST & integrations

- `functions.php` already exposes ACF fields for the `service` CPT to the REST API.
- When reusing this theme pattern on other projects:
  - Decide early which CPTs need ACF fields in REST.
  - Copy/adjust the `register_rest_field` and `rest_pre_insert_*` patterns for those CPTs.

---

### 6. Conventions for New / Cloned Projects

When applying this workflow to a different WordPress site:

- **Theme naming**
  - Update `style.css` header (theme name, URI, author).
  - Review any hardcoded URLs or brand names in templates/ACF labels.

- **Folder & file conventions**
  - Keep:
    - `assets/css/*` for global/page‑level CSS.
    - `blocks/<block-name>/*` for ACF block PHP + CSS + JS (if needed).
    - `partials/shared/*` for reusable non‑block PHP partials.
    - `partials/<context>/*` (`city`, `service`, `event`, etc.) only for composition/layout around shared components.

- **CSS conventions**
  - Use:
    - BEM‑style class names.
    - Variables from `variables.css` only (no magic values scattered in components).
    - Mobile‑first responsive CSS with consistent breakpoint tokens.

- **ACF conventions**
  - Group fields logically per component/section.
  - Keep JSON sync enabled (`acf-json/`) so field definitions can be version‑controlled and migrated.
  - For options pages, make sure each has:
    - Clear page title and menu title.
    - A documented consumer component (e.g. “Trade Service Section options are rendered by `partials/service/trade-service.php`”).

---

### 7. How This Was Approached on This Project

- **Initial audit**
  - Reviewed `functions.php` to understand assets, block registrations, options pages, and REST exposure.
  - Scanned `assets/css/*`, `blocks/*`, and `partials/*` for component patterns and duplicates.

- **Identified core issues**
  - CSS foundation not treated as a single, consistent design system.
  - Multiple implementations of the same conceptual blocks spread across different folders.
  - Inconsistent separation between layout and components.

- **Refactor direction**
  - Move towards a **design‑system‑driven**, **component‑first** structure:
    - Strong base + variables.
    - Shared components reused across CPTs.
    - ACF blocks for reusable content patterns.
    - Minimal duplication of CSS and PHP.

Use this document as a reference when explaining the current state to other developers or when porting the same ideas into a new WordPress theme. It should make the refactor strategy and design decisions explicit and repeatable.

