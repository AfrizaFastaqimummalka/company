# NexusCo — Company Profile Website

Modern, professional company profile website built with **Laravel 11**, **Blade**, **Tailwind CSS**, and **PostgreSQL (Neon DB)**.

---

## 🗂️ Project Structure

```
company-profile/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Admin/
│   │       │   ├── AuthController.php
│   │       │   ├── ContactController.php
│   │       │   ├── DashboardController.php
│   │       │   ├── GalleryController.php
│   │       │   └── ServiceController.php
│   │       └── Public/
│   │           ├── AboutController.php
│   │           ├── ContactController.php
│   │           ├── GalleryController.php
│   │           ├── HomeController.php
│   │           └── ServiceController.php
│   └── Models/
│       ├── Contact.php
│       ├── Gallery.php
│       ├── Service.php
│       └── User.php
├── database/
│   ├── migrations/           # 4 migration files
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   ├── css/app.css           # Tailwind + Google Fonts
│   ├── js/app.js             # Animations, lightbox, counter
│   └── views/
│       ├── components/
│       │   ├── footer.blade.php
│       │   ├── icon.blade.php    # Heroicons SVG component
│       │   └── navbar.blade.php
│       ├── layouts/
│       │   ├── admin.blade.php
│       │   └── app.blade.php
│       ├── pages/admin/
│       │   ├── auth/login.blade.php
│       │   ├── contacts/{index,show}.blade.php
│       │   ├── dashboard.blade.php
│       │   ├── gallery/{index,form}.blade.php
│       │   └── services/{index,form}.blade.php
│       └── public/
│           ├── about.blade.php
│           ├── contact.blade.php
│           ├── gallery.blade.php
│           ├── home.blade.php
│           ├── service-detail.blade.php
│           └── services.blade.php
├── routes/web.php
├── tailwind.config.js
├── vite.config.js
└── .env.example
```

---

## ⚡ Quick Setup (Step by Step)

### 1. Create Laravel Project

```bash
composer create-project laravel/laravel company-profile
cd company-profile
```

### 2. Copy Project Files

Copy all files from this repository into your Laravel project, replacing existing ones.

### 3. Configure Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` with your **Neon DB** credentials:

```env
DB_CONNECTION=pgsql
DB_HOST=your-project.neon.tech
DB_PORT=5432
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
DB_SSLMODE=require
```

### 4. Install PHP Dependencies

```bash
composer require laravel/framework
```

### 5. Install Node Dependencies & Build Assets

```bash
npm install
npm run build
```

For development with hot reload:
```bash
npm run dev
```

### 6. Run Migrations & Seed Database

```bash
php artisan migrate
php artisan db:seed
```

### 7. Create Storage Link

```bash
php artisan storage:link
```

### 8. Start Development Server

```bash
php artisan serve
```

Visit: **http://localhost:8000**

---

## 🔐 Admin Access

After seeding, login at `/admin/login`:

| Field    | Value                      |
|----------|----------------------------|
| Email    | admin@companyprofile.com   |
| Password | password                   |

> ⚠️ **Change the password immediately** in production!

---

## 📋 Public Pages

| Route        | URL              | Description                    |
|--------------|------------------|--------------------------------|
| `home`       | `/`              | Hero, stats, services, CTA     |
| `about`      | `/about`         | Team, values, timeline         |
| `services`   | `/services`      | All services listing           |
| `services.show` | `/services/{slug}` | Service detail             |
| `gallery`    | `/gallery`       | Filterable image gallery       |
| `contact`    | `/contact`       | Contact form with validation   |

## 🛠️ Admin Pages

| Route                    | URL                         | Description             |
|--------------------------|------------------------------|-------------------------|
| `admin.login`            | `/admin/login`              | Admin login             |
| `admin.dashboard`        | `/admin/dashboard`          | Stats & recent messages |
| `admin.services.index`   | `/admin/services`           | List all services       |
| `admin.services.create`  | `/admin/services/create`    | Add new service         |
| `admin.services.edit`    | `/admin/services/{id}/edit` | Edit service            |
| `admin.gallery.index`    | `/admin/gallery`            | Gallery grid            |
| `admin.gallery.create`   | `/admin/gallery/create`     | Upload image            |
| `admin.contacts.index`   | `/admin/contacts`           | All messages (filtered) |
| `admin.contacts.show`    | `/admin/contacts/{id}`      | Message detail          |

---

## 🗄️ Database Schema

### `users`
| Column    | Type      | Notes               |
|-----------|-----------|---------------------|
| id        | bigint    | Primary key         |
| name      | string    |                     |
| email     | string    | Unique              |
| password  | string    | Hashed              |
| role      | enum      | admin / editor      |

### `services`
| Column      | Type     | Notes                   |
|-------------|----------|-------------------------|
| id          | bigint   |                         |
| title       | string   |                         |
| slug        | string   | Unique, auto-generated  |
| excerpt     | text     | Short description       |
| description | longtext | Full detail page content|
| icon        | string   | Heroicon name           |
| image       | string   | Storage path            |
| is_featured | boolean  | Shown on homepage       |
| sort_order  | integer  | Display order           |
| is_active   | boolean  |                         |

### `galleries`
| Column     | Type    | Notes           |
|------------|---------|-----------------|
| id         | bigint  |                 |
| title      | string  |                 |
| category   | string  | For filtering   |
| image      | string  | Storage path    |
| caption    | text    | Optional        |
| sort_order | integer |                 |
| is_active  | boolean |                 |

### `contacts`
| Column      | Type     | Notes                         |
|-------------|----------|-------------------------------|
| id          | bigint   |                               |
| name        | string   |                               |
| email       | string   |                               |
| phone       | string   | Optional                      |
| subject     | string   | Optional                      |
| message     | text     |                               |
| status      | enum     | unread / read / replied       |
| admin_notes | text     | Internal notes                |
| read_at     | timestamp| When first opened by admin    |

---

## 🎨 Design System

### Color Palette
- **Brand (Green):** `#38927a` — Soft, professional green
- **Stone (Neutral):** `#78716c` — Warm grays for text
- **Background:** `#fafaf9` — Warm off-white

### Typography
- **Display:** Playfair Display (headings, hero text)
- **Body:** DM Sans (all UI text)
- **Mono:** DM Mono (code, labels)

### Components
All reusable classes are defined in `resources/css/app.css`:
- `.btn-primary` / `.btn-secondary` / `.btn-ghost`
- `.card` / `.card-hover`
- `.form-input` / `.form-label` / `.form-error`
- `.section` / `.section-label`
- `.heading-xl` / `.heading-lg` / `.heading-md`
- `.section-label` (pill label above section headings)
- `.badge` / `.badge-success` / `.badge-warning` / `.badge-info`

---

## 🌐 Neon DB (PostgreSQL) Notes

1. Create a project at [neon.tech](https://neon.tech)
2. Get your connection string from the dashboard
3. Set `DB_SSLMODE=require` in your `.env`
4. Neon supports connection pooling — use the pooled endpoint for production

---

## 🚀 Production Deployment

```bash
# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# Build assets
npm run build

# Ensure storage is linked
php artisan storage:link
```

### Key Production .env Changes
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
SESSION_DRIVER=database
CACHE_DRIVER=redis  # or database
```

---

## ✅ Features Checklist

- [x] Responsive mobile-first design
- [x] Modern hero with animated elements
- [x] Scroll-triggered animations
- [x] Counter animation on stats
- [x] Client marquee ticker
- [x] Gallery with filter tabs + lightbox
- [x] Contact form with PostgreSQL storage
- [x] Full admin panel with login
- [x] CRUD for Services (with image upload)
- [x] CRUD for Gallery (with image upload)
- [x] Contact messages view + status management
- [x] Unread message badge on sidebar
- [x] Auto-dismiss flash messages
- [x] Blade component architecture
- [x] Reusable SVG icon component
- [x] Custom Tailwind design tokens
- [x] Google Fonts (DM Sans + Playfair Display)
- [x] Neon DB (PostgreSQL) compatible

---

## 📝 License

MIT — Free to use and modify.
