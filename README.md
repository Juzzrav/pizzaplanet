# PizzaPlanet 🍕

A Laravel 12 (PHP 8.4) pizza ordering application focused on **clean business logic and architecture**.

The app supports:
- Signature pizzas and a **“Make Your Own” pizza** (up to 4 toppings)
- Session-based cart (multiple pizzas per order)
- Checkout with mocked payments (Card / PayPal) using the **Strategy pattern**
- Orders persisted to MySQL
- Payment method logging (no real payment integration)

---

## Features
- Predefined pizzas with fixed prices
- Custom pizza pricing: base price + per-topping cost
- Currency-aware pricing
- Cart stored in session
- Checkout flow with order persistence
- Mocked payment gateways (Card, PayPal)
- Feature & Unit tests using Laravel testing tools

---

## Tech Stack
- **Laravel 12**
- **PHP 8.4**
- MySQL
- Blade templates (no frontend framework)

---

## Requirements
- PHP 8.4
- Composer
- MySQL
- Node.js (optional – not required for core functionality)

---

## Setup (Local)

### 1) Clone the repository
```bash
git clone <your-repo-url>
cd pizzaplanet

2) Install dependencies
composer install

3) Environment setup
cp .env.example .env
php artisan key:generate

Configure your database in .env:
DB_DATABASE=pizzaplanet
DB_USERNAME=root
DB_PASSWORD=

4) Run migrations and seeders
php artisan migrate --seed

5) Start the application
php artisan serve

http://127.0.0.1:8000


Mocked Payments

Payments are not real.
The selected payment method is logged to:
storage/logs/payments.log


Running Tests

This project includes Unit and Feature tests covering:
Homepage availability
Cart behavior
Currency validation
Checkout flow
Run all tests:

php artisan test

Tests run using a dedicated testing database and do not affect production data.

Architecture Notes
Payment handling uses the Strategy pattern
Controllers remain thin; business logic is delegated
Laravel factories are used for test data
Database state is isolated in tests using RefreshDatabase