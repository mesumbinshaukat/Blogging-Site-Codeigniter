# Blog Site (CodeIgniter 4)

A lightweight, fully‑featured blog built with **CodeIgniter 4**. Features:
- Admin dashboard with login (username: `hanzala`, password: `admin123`)
- CRUD for posts with optional random dog image (dog.ceo API)
- Public blog front‑end with responsive Bootstrap styling
- JSON API endpoint (`/api/posts`) returning all published posts
- Secure production configuration (HTTPS, mod_rewrite, .env settings)

## Quick Start (Local Development)
1. **Clone / copy** the project into `f:/Projects/blog-site`.
2. Install dependencies:
   ```bash
   composer install
   ```
3. Create the database (MySQL) and import `database_setup.sql` or run migrations:
   ```bash
   php spark migrate
   ```
4. Seed the admin user (already provided in `seed_admin.php`):
   ```bash
   php seed_admin.php
   ```
5. Adjust the base URL in `.env` if needed (default: `http://localhost:8080/`).
6. Run the development server:
   ```bash
   php spark serve --port 8080
   ```
7. Open your browser:
   - Blog homepage: `http://localhost:8080/`
   - Admin login: `http://localhost:8080/admin/login`

## Production Deployment
See **PRODUCTION.md** for a step‑by‑step guide on configuring Apache/Nginx, setting up HTTPS, database migration, and security hardening.

## Directory Structure (key folders)
- `app/Controllers` – Admin, Dashboard, Blog, API controllers
- `app/Models` – `UserModel`, `PostModel`
- `app/Views` – Admin UI (`login.php`, `dashboard.php`, `post_form.php`) and public blog UI (`index.php`, `single.php`)
- `public/` – Public entry point (`index.php`) and `.htaccess`
- `writable/` – Logs, cache, session files (write‑able by the web server)

## Environment Variables (`.env`)
```ini
CI_ENVIRONMENT = development   # set to production on live server
app.baseURL = 'http://localhost:8080/'   # change to your domain

database.default.hostname = localhost
database.default.database = blog_site
database.default.username = root
database.default.password =
```
Adjust these values for your production database and domain.

## License
This project is provided as‑is for demonstration purposes. Feel free to adapt, extend, or use it in your own applications.
