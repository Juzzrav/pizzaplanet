# PizzaPlanet (CloudBridge Technical Task)

A Laravel 12 (PHP 8.4) pizza ordering app focused on business logic:
- Signature pizzas + “Make Your Own” pizza (up to 4 toppings)
- Session-based cart (many items per order)
- Checkout with mocked payments (Card / PayPal) using Strategy pattern
- Orders persisted to MySQL
- Payment method logged to `storage/logs/payments.log`

## Requirements
- PHP 8.4
- Composer
- MySQL (for running the app)
- Node is optional (no frontend framework used)

## Setup (Local)
1) Install dependencies:
```bash
composer install
