# Team Sync Snapshot

This folder contains a tracked WordPress team sync snapshot for this project.

Files:

- `cpl-db-20260325-192613.sql.gz`
- `cpl-uploads-20260325-192613.tar.gz`

## Restore

From the project root:

```bash
ddev start
ddev import-db --file=team-sync/20260325-192613/cpl-db-20260325-192613.sql.gz
tar -xzf team-sync/20260325-192613/cpl-uploads-20260325-192613.tar.gz -C public/wp-content
```

## Notes

- This snapshot is committed intentionally so team members can sync through GitHub.
- Regular local backups should still be created in `.ddev/backups/`.
