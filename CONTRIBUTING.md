# Contributing

Thank you for contributing to this project.

## Before You Start

- use a separate branch for each change
- keep commits focused and small
- do not commit `.env`, secrets, generated credentials, or local machine config
- update documentation when behavior or setup changes

## Development Setup

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed --force
php artisan storage:link
composer run dev
```

## Branching

Recommended branch naming:

- `feature/<short-description>`
- `fix/<short-description>`
- `docs/<short-description>`

Examples:

- `feature/stripe-checkout`
- `fix/cart-quantity-update`
- `docs/readme-cleanup`

## Coding Expectations

- follow the existing Laravel project structure
- keep controllers thin when possible
- prefer services for cross-cutting business logic
- preserve existing UI patterns unless intentionally redesigning
- avoid unrelated refactors in the same change

## Pull Request Checklist

Before opening a pull request:

- verify the app still boots
- run migrations if your change adds schema updates
- check changed PHP files for syntax errors
- test the affected user flow manually
- update `.env.example` when new environment variables are introduced
- update `README.md` if setup or deployment steps changed

## Suggested Verification

```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan test
```

If frontend assets changed:

```bash
npm run build
```

## Reporting Bugs

When reporting a bug, include:

- expected behavior
- actual behavior
- steps to reproduce
- screenshots if UI-related
- relevant log output if available

## Security

Please do not open a public issue for sensitive security problems.

See [SECURITY.md](./SECURITY.md).
