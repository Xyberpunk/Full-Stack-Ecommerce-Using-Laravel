# Rural Ecommerce T-Shirts

A Laravel 12 ecommerce project for a t-shirt store with a customer storefront, account area, cart and checkout flow, blog, and admin dashboard.

## Overview

This project includes:

- storefront pages for home, shop, product detail, blog, cart, checkout, and account
- role-based access for `admin` and `user`
- admin dashboard for products, categories, coupons, orders, users, and blog posts
- SQL-backed cart, wishlist, addresses, and orders
- coupon handling, shipping/tax calculation, invoice numbers, and order emails
- Stripe checkout session and webhook scaffolding for production deployment

## Tech Stack

- PHP 8.2+
- Laravel 12
- MySQL
- Blade templates
- jQuery + static frontend JS
- Bootstrap-based UI
- Vite for asset build

## Main Features

### Storefront

- featured and trending products from the database
- shop listing with pagination, search, and category filtering
- dynamic blog listing and blog detail pages
- cart and checkout flow with SQL-backed persistence
- wishlist add/remove from multiple product surfaces

### Account

- login and registration
- profile update
- profile photo upload
- saved addresses
- saved payment and shipping preference
- wishlist page
- order history and order detail
- cancellation request from the customer side

### Admin

- dashboard metrics and sales summaries
- product CRUD with image upload
- category CRUD
- coupon CRUD
- blog CRUD
- order management with status and payment updates
- tracking number support
- low-stock visibility and inventory movement foundation

## Project Structure

```text
app/
  Http/
  Mail/
  Models/
  Services/
config/
database/
  migrations/
  seeders/
public/
resources/
  views/
routes/
```

## Local Setup

### 1. Install dependencies

```bash
composer install
npm install
```

### 2. Create environment file

```bash
cp .env.example .env
php artisan key:generate
```

### 3. Configure database

Update `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce_tshirt
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Run migrations and seeders

```bash
php artisan migrate
php artisan db:seed --force
php artisan storage:link
```

### 5. Start development

```bash
composer run dev
```

Or run separately:

```bash
php artisan serve
npm run dev
```

## Environment Variables

Important application values:

```env
APP_URL=http://localhost:8000
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
FILESYSTEM_DISK=local
```

Stripe placeholders:

```env
STRIPE_KEY=
STRIPE_SECRET=
STRIPE_WEBHOOK_SECRET=
STRIPE_CURRENCY=usd
```

Mail defaults can remain `log` for local development.

## Important Routes

### Public

- `/`
- `/about-us`
- `/shop`
- `/blog`
- `/cart`
- `/checkout`
- `/my-account`

### Authenticated User

- `/wishlist`
- `/order-tracking`
- `/order-tracking/{order}`

### Admin

- `/admin`
- `/admin/products`
- `/admin/categories`
- `/admin/coupons`
- `/admin/orders`
- `/admin/blog`

### API

- `/api/cart`
- `/api/checkout`
- `/api/coupons/apply`
- `/api/stripe/webhook`

## Stripe Notes

Stripe is prepared at the application level, but production use still requires:

- valid Stripe keys in `.env`
- a public deployed URL
- webhook configuration pointing to:

```text
https://your-domain.com/api/stripe/webhook
```

For local testing, Stripe CLI is recommended:

```bash
stripe listen --forward-to localhost:8000/api/stripe/webhook
```

## Deployment Notes

Before deployment:

- set production `.env` values
- run migrations on the production database
- run `php artisan storage:link`
- set `APP_URL` to the deployed domain
- rotate any previously exposed secret keys before going live

## GitHub Checklist

Before pushing:

- keep `.env` out of Git
- only commit `.env.example`
- rotate exposed secrets if they were ever shared
- confirm `vendor/`, `node_modules/`, logs, and build outputs are ignored

## Current Status

Implemented:

- database-driven storefront
- account system
- admin CRUD sections
- order management
- coupon flow
- shipping/tax calculation
- Stripe integration scaffolding

Still good next steps:

- PDF invoice download
- richer return/refund flow
- shipment and delivery emails
- final shared-layout cleanup for remaining duplicated pages

## License

This project is built on Laravel and follows the MIT license model unless you choose a different license for your repository.
