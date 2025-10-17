# Profile Syntaxtrust - Academic Web Development Services

## 📋 Project Overview

**Profile Syntaxtrust** is a professional portfolio website for Syntaxtrust, a specialized web development service catering to **academic needs** of students and researchers. We focus on creating high-quality websites for:

- **📚 Academic Assignments** (tugas mata kuliah)
- **🔧 Website Modifications** (perbaikan dan pengembangan)
- **🎓 Thesis/Final Projects** (skripsi/tugas akhir)

## 🎯 Mission & Vision

**Mission**: Membantu mahasiswa dan peneliti mewujudkan ide akademik mereka melalui website berkualitas tinggi yang sesuai dengan rubrik penilaian.

**Vision**: Menjadi mitra terpercaya dalam pengembangan website akademik dengan fokus pada kualitas, ketepatan waktu, dan kepuasan klien.

## ✨ Key Features

### 🎨 Modern Web Technologies
- **React.js** - Modern frontend framework
- **Vite** - Fast build tool and development server
- **Tailwind CSS** - Utility-first CSS framework
- **Framer Motion** - Smooth animations and transitions
- **React Router** - Client-side routing

### 🚀 Core Functionality
- **Responsive Design** - Works perfectly on all devices
- **Interactive UI** - Smooth animations and hover effects
- **Contact Forms** - Easy client communication
- **Booking System** - Consultation scheduling
- **Portfolio Showcase** - Project galleries with case studies
- **Pricing Calculator** - Transparent pricing structure
- **FAQ System** - Comprehensive help section

### 📊 Database Integration
- **MySQL/PostgreSQL** support
- **User Management** with profile photos
- **Service Catalog** with dynamic pricing
- **Booking System** with slot management
- **Content Management** for FAQs and testimonials

## 🏗️ Project Structure

```
profile_syntaxtrust/
├── 📁 assets/                 # Static assets
│   └── 📁 css/               # Stylesheets
├── 📁 database/              # Database schemas and documentation
│   ├── schema_mysql.sql      # MySQL database schema
│   └── README_MYSQL.md       # MySQL setup guide
├── 📁 node_modules/          # Dependencies
├── 📁 partials/              # PHP partials (header, footer)
├── 📁 public/               # Public assets
├── 📁 src/                  # Source code
│   ├── 📁 components/        # React components
│   │   ├── AnimatedSection.jsx
│   │   ├── Loading.jsx
│   │   ├── PageTransition.jsx
│   │   ├── ScheduleBooking.jsx
│   │   └── ...
│   ├── 📁 pages/            # Page components
│   │   ├── ContactPage.jsx
│   │   ├── HomePage.jsx
│   │   ├── PortfolioPage.jsx
│   │   ├── PricingPage.jsx
│   │   ├── SchedulePage.jsx
│   │   └── ServicesPage.jsx
│   ├── 📁 utils/            # Utility functions
│   │   ├── animations.js
│   │   └── styles.js
│   ├── App.jsx
│   ├── main.jsx
│   └── index.css
├── 📄 contact.php           # Contact page (PHP)
├── 📄 index.php             # Main page (PHP)
├── 📄 portfolio.php         # Portfolio page (PHP)
├── 📄 pricing.php           # Pricing page (PHP)
├── 📄 schedule.php          # Schedule page (PHP)
├── 📄 services.php          # Services page (PHP)
├── 📄 package.json          # Dependencies and scripts
├── 📄 tailwind.config.js    # Tailwind configuration
└── 📄 vite.config.js        # Vite configuration
```

## 🛠️ Technology Stack

### Frontend
- **React 18** - Modern React with hooks
- **Vite** - Lightning fast build tool
- **Tailwind CSS** - Utility-first styling
- **Framer Motion** - Animation library
- **React Router DOM** - Navigation
- **React Hook Form** - Form handling

### Backend & Database
- **PHP** - Server-side scripting
- **MySQL 8.0+** - Primary database
- **PostgreSQL 13+** - Alternative database
- **XAMPP** - Local development environment

### Development Tools
- **ESLint** - Code linting
- **Prettier** - Code formatting
- **Vite Dev Server** - Hot reload development

## 📦 Installation & Setup

### Prerequisites
- **Node.js 16+** and npm
- **XAMPP** or similar local server
- **Git** for version control

### Step 1: Clone Repository
```bash
git clone <repository-url>
cd profile_syntaxtrust
```

### Step 2: Install Dependencies
```bash
npm install
```

### Step 3: Setup Database
Choose your preferred database:

#### MySQL Setup:
```bash
# Start MySQL in XAMPP
# Create database: profile_syntaxtrust
# Run the MySQL schema:
mysql -u root -p profile_syntaxtrust < database/schema_mysql.sql
```

#### PostgreSQL Setup:
```bash
# Create database: profile_syntaxtrust
createdb profile_syntaxtrust
# Run the PostgreSQL schema:
psql -d profile_syntaxtrust -f database/schema.sql
```

### Step 4: Start Development Server
```bash
npm run dev
```

### Step 5: Open in Browser
Navigate to `http://localhost:5173` (Vite dev server)

## 🌐 Available Pages

### React.js Pages (Main Application)
- **`/`** - HomePage - Landing page dengan hero section dan layanan utama
- **`/services`** - ServicesPage - Detail layanan dan paket yang tersedia
- **`/pricing`** - PricingPage - Kalkulator harga dan paket lengkap
- **`/portfolio`** - PortfolioPage - Showcase project dan studi kasus
- **`/contact`** - ContactPage - Form kontak dan informasi perusahaan
- **`/schedule`** - SchedulePage - Sistem booking konsultasi

### PHP Pages (Alternative/Backup)
- **`/index.php`** - Homepage versi PHP
- **`/services.php`** - Layanan versi PHP
- **`/pricing.php`** - Harga versi PHP
- **`/portfolio.php`** - Portfolio versi PHP
- **`/contact.php`** - Kontak versi PHP
- **`/schedule.php`** - Jadwal versi PHP

## 🎨 Design System

### Color Palette
- **Primary**: `#3B82F6` (Blue)
- **Secondary**: `#10B981` (Green)
- **Accent**: `#F59E0B` (Amber)
- **Neutral**: `#6B7280` (Gray)

### Typography
- **Headings**: Inter (Semibold)
- **Body**: Inter (Regular)
- **Accent**: JetBrains Mono (for code)

### Components
- **Consistent spacing** menggunakan Tailwind scale
- **Smooth animations** dengan Framer Motion
- **Accessible design** dengan proper ARIA labels
- **Responsive breakpoints** untuk semua device

## 🚀 Features Overview

### 🏠 Homepage Features
- Hero section dengan call-to-action
- Layanan utama dengan ikon dan deskripsi
- Testimonial carousel
- Quick links ke halaman penting

### 📋 Services Features
- Kategorisasi layanan akademik
- Detail paket dan harga
- Proses kerja step-by-step
- FAQ section interaktif

### 💰 Pricing Features
- Kalkulator harga dinamis
- Paket dengan fitur berbeda
- Form konsultasi dengan validasi
- Estimasi waktu pengerjaan

### 💼 Portfolio Features
- Gallery project dengan filter
- Case study detail
- Testimonial klien
- Link demo project

### 📞 Contact Features
- Form kontak dengan validasi
- Multiple contact methods
- Map integration
- Quick response promise

### 📅 Schedule Features
- Booking system dengan slot waktu
- Calendar integration
- Reminder system
- Meeting link generation

## 🔧 Development Guidelines

### Code Style
- **ESLint** configuration aktif
- **Prettier** untuk formatting
- **Component-based** architecture
- **Custom hooks** untuk logic reuse

### Git Workflow
```bash
# Feature branch
git checkout -b feature/new-component

# Regular commits
git add .
git commit -m "Add new component with proper styling"

# Push and merge
git push origin feature/new-component
```

### Database Management
- **Migration files** untuk schema changes
- **Seed data** untuk development
- **Backup strategy** sebelum production

## 🚀 Deployment

### Build for Production
```bash
npm run build
```

### Environment Variables
Create `.env` file:
```env
VITE_API_URL=https://api.syntaxtrust.com
VITE_APP_TITLE="Profile Syntaxtrust"
DATABASE_URL=mysql://user:pass@localhost/profile_syntaxtrust
```

### Server Requirements
- **Node.js 16+**
- **MySQL 8.0+** or **PostgreSQL 13+**
- **SSL Certificate** untuk production

## 📞 Contact & Support

**Syntaxtrust**
- 🌐 Website: https://syntaxtrust.com
- 📧 Email: hello@syntaxtrust.com
- 📱 WhatsApp: +62 812-3456-7890
- 🕒 Jam Kerja: Senin-Jumat, 09:00-18:00 WIB

## 📄 License

© 2024 Syntaxtrust. All rights reserved.

---

*"Mewujudkan ide akademik melalui website berkualitas"*
