# Team Database Sync

This project is a WordPress site running in `ddev`. Code is shared through Git, but the WordPress database and uploaded media should be shared separately.

## What To Commit

- Theme code in `public/wp-content/themes/atomic-design/`
- Custom plugin code
- ACF JSON
- `ddev` configuration
- Project documentation

## What Not To Commit

- Database dumps
- Upload archives
- WordPress core
- Cache, logs, and machine-specific files

Backups created for team sync are stored locally in `.ddev/backups/` and are ignored by Git.

## Create A Fresh Backup

From the project root:

```bash
mkdir -p .ddev/backups
STAMP=$(date +%Y%m%d-%H%M%S)
ddev export-db --file=.ddev/backups/cpl-db-$STAMP.sql.gz
tar -czf .ddev/backups/cpl-uploads-$STAMP.tar.gz -C public/wp-content uploads
```

This creates:

- a database dump
- an archive of `public/wp-content/uploads`

## Restore A Team Backup

Place the shared backup files in `.ddev/backups/`, then run:

```bash
ddev start
ddev import-db --file=.ddev/backups/cpl-db-YYYYMMDD-HHMMSS.sql.gz
tar -xzf .ddev/backups/cpl-uploads-YYYYMMDD-HHMMSS.tar.gz -C public/wp-content
```

## Local Site URL

This project uses the local URL:

```bash
https://cpl.ddev.site
```

If imported content contains another environment URL, run a search-replace:

```bash
ddev wp --path=public search-replace 'https://old-site-url.example' 'https://cpl.ddev.site'
```

## Recommended Team Workflow

- Keep code changes in GitHub.
- Share database and uploads through a private shared folder, not through Git.
- Pull a fresh database before content-heavy work or QA.
- Re-export a new backup when content or settings change significantly.
