<p align="center">
  <img src="./public/fawry.jpeg" alt="Fawry Logo" width="200"/>
</p>

# Fawry Quantum Internship Challenge – E-Commerce Full Stack System

A fully functional **E-Commerce system** developed as part of the **Fawry Quantum Internship Challenge**.  
This project simulates a real-world platform where customers can browse and purchase products, manage their cart, and place orders — with proper validation, stock checks, shippable flags, and expiration handling.

> **Live Demo** (video): [Watch on Drive](https://drive.google.com/file/d/1qwAuVCG-_7t_2X7wet-5HrVFhjkgBPzF/view?usp=sharing)  
> **Frontend Repo (Angular 18 + Signals):** [GitHub Link](https://github.com/abdelrahmanabdelsamie7/fawry-ui)

---

## Features

-  **Customer Panel**
  - Add product to cart
  - Quantity checks (against stock)
  - View cart summary and delete items or entire cart
  - Checkout system with subtotal, shipping, and total paid
  - Printable styled **receipt view** using media print (`monospace` format)

- **Smart Handling**
  - Expirable products
  - Shippable vs Non-shippable logic
  - Weight calculations
  - Orders stored with full product snapshot

- **Order Receipt**
  - Shipment Notice (weight & quantities)
  - Checkout Receipt (pricing breakdown)
  - Styled print version via `window.print()`

---

## Tech Stack

| Layer       | Tech Used                             |
|-------------|----------------------------------------|
| Frontend    | Angular 18 + Signals + Bootstrap       |
| Backend     | Laravel 10                             |
| Database    | MySQL + UUID Primary Keys              |
| Styling     | Bootstrap 5 + Custom CSS               |
| Print View  | HTML `@media print` + Monospace layout |

---

## Architecture Notes

### BaseService Pattern

All controller logic relies on service classes that **extend a custom `BaseService`**, which provides:
- `getAll()`, `findById()`, `create()`, `update()`, `delete()` boilerplate
- Centralized error handling
- Dependency injection of models

```php
class ProductService extends BaseService
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }
}

###  Traits for Logic Reuse

Because PHP does not support multi-inheritance, we used custom traits to:
- UsesUuid: Automatically assigns UUIDs to models instead of auto-incrementing IDs.
- ResponseJsonTrait: A unified structure for all API responses (success, errors, validation messages, etc).
- HandlesCartLogic: Shared logic between cart and order systems.

----


## Database Mapping

<img src="./public/Fawry - Mapping DB.png" alt="Database Mapping" width="800"/>

- Tables include: products, carts, cart_items, orders, order_items, customers
