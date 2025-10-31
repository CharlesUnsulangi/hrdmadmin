# Environment Information (HRD Laravel Project)

## System
- **OS**: Windows
- **Default Shell**: Windows PowerShell v5.1
- **Current Date**: October 31, 2025

## Laravel Project
- **Laravel Version**: 11
- **PHP Version**: (see .env or `php -v`)
- **Database**: SQL Server (see .env for connection details)
- **Frontend**: Vite, Tailwind CSS, Livewire, Blade, Alpine.js
- **Authentication**: Laravel Breeze (customized, login temporarily disabled for dev)
- **Testing**: Pest/PHPUnit 11
- **Version Control**: Git, GitHub (branch: docs/erd-database-schema)

## Key Directories
- `app/Models/` — Eloquent models
- `app/Http/Controllers/` — Controllers
- `app/Livewire/` — Livewire components
- `database/migrations/` — Migrations
- `resources/views/` — Blade views
- `docs/` — Documentation, ERD, guidelines

## Notable Configuration
- **Non-destructive migrations only** (no migrate:fresh/drop)
- **All table/model structure follows AI_SAFETY_GUIDELINES.md and actual SQL Server schema**
- **Documentation and ERD versioned in Git**

## How to Update
- Update this file if environment, stack, or project structure changes.
- For sensitive info (DB passwords, etc.), use `.env` and do not commit.

---
_Last updated: October 31, 2025_
