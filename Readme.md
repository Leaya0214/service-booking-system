===========================================
Laravel API Project - Service Booking System
===========================================

Overview:
---------
This is a Laravel-based RESTful API for a Service Booking System. It provides:

- Customer registration and login
- Admin login (via seeded credentials)
- API authentication using Laravel Sanctum
- Service management (CRUD) by admin
- Service browsing and booking by customers

Technologies Used:
------------------
- Laravel 12+
- Sanctum (for API authentication)
- MySQL
- Postman (for API testing)

Installation Instructions:
--------------------------
1. Clone the repository:
   git clone https://github.com/Leaya0214/service-booking-system.git

2. Navigate to the project directory:
   cd service-booking-system

3. Install dependencies:
   composer install

4. Copy `.env.example` to `.env` and configure your database:
   cp .env.example .env

5. Generate application key:
   php artisan key:generate

6. Run migrations and seed the database:
   php artisan migrate --seed

7. Publish Sanctum configuration:
   php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

8. Serve the application:
   php artisan serve

Authentication:
---------------
- Sanctum is used for token-based API authentication.
- To log in, send a POST request to `/api/login` with valid credentials.
- Use the returned token as a **Bearer Token** in the `Authorization` header for future requests.

Example Login Request:
----------------------
POST /api/login

Body:
{
    "email": "admin@gmail.com",
    "password": "12345678"
}

Routes:
-------
Public:
- POST   /api/register             → Customer registration
- POST   /api/login                → Login (admin/customer)

Authenticated (Customer):
- GET    /api/services             → List all available services
- POST   /api/bookings             → Book a service
- GET    /api/bookings             → List logged-in user's bookings

Authenticated (Admin):
- POST   /api/services             → Create a new service
- PUT    /api/services/{id}        → Update a service
- DELETE /api/services/{id}        → Delete a service
- GET    /api/admin/bookings       → View all bookings

Example PUT Request (via Postman):
----------------------------------
- Method: PUT
- URL: http://localhost:8000/api/services/1
- Headers:
    - Authorization: Bearer <token>
    - Accept: application/json
    - Content-Type: application/json
- Body (raw JSON):
{
    "name": "Home Decorating",
    "description": "Professional home decoration service",
    "price": 12.00
}

Service Validation Rules:
-------------------------
- name: string, max 255 chars, required when creating, optional when updating
- description: string, required when creating, optional when updating
- price: numeric, min 0, required when creating, optional when updating

Booking Validation Rules:
-------------------------
- service_id: required, must exist in services table
- booking_date: required, must be a valid date, **must not be in the past** (`after_or_equal:today`)

Troubleshooting:
----------------
- Ensure you are sending `Accept: application/json` in headers.
- Ensure you're using a valid Bearer token for authenticated routes.
- Admin-only routes will return `403 Forbidden` if accessed without admin rights.
- Use `php artisan db:seed` to populate admin credentials and sample data.

Postman Collection:
-------------------
Location: `docs/Service Booking System.json`

Author:
-------
Leaya Sultana  
Email: you@example.com

