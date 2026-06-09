---
name: laravel_incremental_upgrade
description: Procedure for incrementally upgrading Laravel from version 8 to 13, handling composer.json edits and dependency conflicts
source: auto-skill
extracted_at: '2026-06-09T09:30:00.000Z'
---

## Overview
This skill captures the step‑by‑step workflow used to upgrade a Laravel 8 project to Laravel 13 while preserving a working codebase. It includes creating a dedicated git branch, checking the current version, performing compatibility dry‑runs, editing `composer.json` to update framework and dependent package constraints, cleaning up malformed JSON, and iteratively running Composer updates for each major Laravel version.

## Detailed Procedure
1. **Initial diagnostics**
   - Run `php artisan --version` to confirm the current Laravel version.
   - Use `composer outdated` to list outdated dependencies.
   - Run `composer why-not laravel/framework ^9` (or the next target) to identify blocking packages.
2. **Create an upgrade branch**
   - `git checkout -b upgrade/laravel-9` (or the appropriate target version).
3. **Edit `composer.json`**
   - Update the `laravel/framework` constraint to the next major version (`^9.0`, `^10.0`, …).
   - Update dependent packages to versions that support the target Laravel version (e.g., `facade/ignition`, `realrashid/sweet-alert`, `spatie/laravel-permission`).
   - Adjust other packages such as `fruitcake/laravel-cors` if they are abandoned.
4. **Ensure JSON validity**
   - Remove duplicate entries and stray lines left over from previous edits.
   - Verify that each block ends with a trailing comma where required and that the overall file is valid JSON.
5. **Run Composer update**
   - Use `composer require laravel/framework:^X --with-all-dependencies --no-interaction` where `X` is the target major version.
   - If Composer reports strict constraints, iterate by narrowing version specs or adding missing dev‑dependency flags.
6. **Test after each upgrade**
   - Run the project’s test suite (`php artisan test` or `vendor/bin/phpunit`).
   - Fix any breaking changes introduced by the new framework version.
   - Commit the changes on the upgrade branch before proceeding to the next major version.
7. **Repeat**
   - Incrementally repeat steps 2‑6 for Laravel 10, 11, 12, and finally 13.
8. **Final cleanup**
   - Update documentation, CI configuration, and any environment files to reflect the new Laravel version.
   - Merge the upgrade branch back into the main branch after all tests pass.

## Why this approach
- **Safety**: Incremental upgrades isolate potential breakages, making it easier to locate and fix issues.
- **Traceability**: Each major version upgrade lives on its own git branch, providing a clear history.
- **Automation‑friendly**: The workflow can be scripted because each step has deterministic commands and checks.

## How to apply
Whenever a project needs a major Laravel upgrade, follow the steps above. Adjust package versions based on the project’s specific dependencies; the core idea is to modify `composer.json` cleanly, validate the file, and run Composer with `--with-all-dependencies` to let it resolve compatible versions.
