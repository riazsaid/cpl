## Custom Phenolic Labels – Atomic Design Theme

This project is a new WordPress site for **Custom Phenolic Labels (CPL)**, built as a custom theme called `atomic-design`. It is designed around:

- **Gutenberg (Block Editor)** as the primary editor
- **ACF Pro** for custom fields and block-based components
- An **atomic design** approach (atoms → molecules → organisms → templates → pages)
- Local development via **DDEV** (to be wired up on this folder)

---

### 1. Project Layout (High Level)

- `public/`
  - Future WordPress document root (when DDEV is configured).
  - `public/wp-content/themes/atomic-design/` – custom theme for this site.
- `CPL 2026 Website - URLs.csv` – sitemap / URL plan from the client.
- `Light TN - Deve notes.md` – legacy notes from another project (reference only).
- `README-ARCHITECTURE-REFACTOR.md` – reference architecture from a previous theme (TSM Agency).

Once WordPress is installed (via DDEV or manually), `public/` should contain:

- `wp-admin/`, `wp-includes/`, `wp-content/` etc.
- Only the **theme** and configuration are committed to git; core files and uploads are ignored via `.gitignore`.

---

### 2. Theme: `atomic-design`

The custom theme lives in `public/wp-content/themes/atomic-design/` and is responsible for:

- Registering theme support (Gutenberg, menus, thumbnails, etc.).
- Enqueuing CSS/JS assets.
- Registering **ACF blocks** that map to atomic components.
- Providing template files for pages, archives, singles, and custom templates.

Key design principles:

- **Component-first**: sections like hero, trust bar, feature grids, FAQs, CTAs are built as reusable components (often ACF blocks).
- **Design tokens**: shared variables for colors, spacing, typography.
- **Minimal page templates**: templates mostly assemble components rather than owning all markup.

See `README-ARCHITECTURE-CPL.md` (below) for a deeper architecture description specific to this site.

---

### 3. Local Development (DDEV)

> DDEV configuration is not yet committed here, but this folder is intended to be used as a DDEV project root.

Typical workflow (once configured):

```bash
ddev config        # run once to initialize the project
ddev start
ddev launch        # open the site in the browser
```

You can then install WordPress into the `public/` folder and activate the `atomic-design` theme from the admin.

---

### 4. Git Workflow

This folder is a git repository. Recommended flow:

- Create feature branches for new components or larger refactors.
- Commit only:
  - Theme code (`public/wp-content/themes/atomic-design/**`)
  - Configuration (`.ddev/**`, `.gitignore`, docs)
  - ACF JSON exports (once added).
- Avoid committing:
  - WordPress core
  - Uploads
  - Local environment or log files

---

### 5. Next Steps

Planned next steps for this project:

1. Configure DDEV and install WordPress into `public/`.
2. Scaffold the `atomic-design` theme:
   - `style.css` with theme header and base styles
   - `functions.php` with theme setup + ACF integration
   - `assets/` structure for CSS/JS (tokens, base, components)
   - Basic templates (`front-page.php`, `page.php`, etc.).
3. Define initial ACF field groups and blocks for key components.
4. Map URLs from `CPL 2026 Website - URLs.csv` to templates and content types.

