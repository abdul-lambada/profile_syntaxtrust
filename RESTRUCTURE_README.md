# Profile Syntaxtrust - Restructured Architecture

This project has been restructured to separate the backend (PHP) and frontend (React) components for better maintainability and scalability.

## 🏗️ Project Structure

```
profile_syntaxtrust/
├── backend/                 # PHP Backend & Admin Interface
│   ├── app/
│   │   ├── controllers/     # MVC Controllers
│   │   ├── core/           # Core classes (Database, Router, etc.)
│   │   ├── models/         # Data models
│   │   └── views/          # Admin interface views
│   ├── assets/             # CSS, JS, images for admin
│   ├── database/           # Database setup files
│   ├── config.php          # Backend configuration
│   ├── index.php           # Backend entry point
│   └── composer.json       # PHP dependencies
│
├── frontend/               # React Frontend Application
│   ├── src/
│   │   ├── components/     # React components
│   │   ├── pages/         # Page components
│   │   ├── utils/         # Utility functions (API calls)
│   │   └── App.jsx        # Main React app
│   ├── dist/              # Built React application
│   ├── package.json       # Node.js dependencies
│   └── vite.config.js     # Vite configuration
│
├── index.php              # Main entry point (routes to frontend/backend)
├── .htaccess             # URL rewriting rules
└── README.md             # This file
```

## 🚀 Quick Start

### Backend Setup (PHP)

1. **Database Setup:**
   ```bash
   cd backend
   # Import the database schema from backend/database/schema_mysql.sql
   ```

2. **Access Admin Panel:**
   - Go to `http://localhost/profile_syntaxtrust/admin/login`
   - Default admin credentials should be in your database setup

### Frontend Setup (React)

1. **Install Dependencies:**
   ```bash
   cd frontend
   npm install
   ```

2. **Development Mode:**
   ```bash
   npm run dev
   ```
   - Opens React dev server at `http://localhost:3000`

3. **Production Build:**
   ```bash
   npm run build
   ```

## 🔗 API Integration

The React frontend communicates with the PHP backend through REST API endpoints:

### Available API Endpoints

- `GET /api/services` - Get all services
- `GET /api/services/{id}` - Get specific service with pricing packages
- `GET /api/portfolio` - Get portfolio items
- `GET /api/testimonials` - Get featured testimonials
- `GET /api/categories` - Get service categories
- `GET /api/available-slots?service_id=X&date=YYYY-MM-DD` - Get available booking slots
- `POST /api/contact` - Submit contact form
- `POST /api/booking` - Submit booking form

### API Usage in React

```javascript
import api from './utils/api';

// Get services
const services = await api.getServices();

// Submit contact form
await api.submitContact({
  name: 'John Doe',
  email: 'john@example.com',
  message: 'Hello!'
});
```

## 🔧 Development Workflow

### Working with Backend (PHP)

1. **Admin Interface:** Access via `/admin/*` routes
2. **API Development:** Add new endpoints in `backend/controllers/ApiController.php`
3. **Database Changes:** Update models in `backend/app/models/`

### Working with Frontend (React)

1. **Component Development:** Edit files in `frontend/src/`
2. **API Integration:** Use the `api` utility from `frontend/src/utils/api.js`
3. **Styling:** Uses Tailwind CSS (configured in `frontend/`)

### Building for Production

1. **Build Frontend:**
   ```bash
   cd frontend
   npm run build
   ```

2. **Deploy:** Upload all files to your web server
   - The `index.php` handles routing between frontend and backend
   - Static files are served from `frontend/dist/`

## 🔒 Security Features

- **Admin Authentication:** Protected admin routes with session management
- **Input Validation:** Both frontend and backend validate user input
- **CSRF Protection:** Configured in backend
- **SQL Injection Prevention:** PDO prepared statements
- **XSS Protection:** Input sanitization and output escaping

## 📝 Notes

- **URL Structure:**
  - Public site: `http://localhost/profile_syntaxtrust/`
  - Admin panel: `http://localhost/profile_syntaxtrust/admin/*`
  - API endpoints: `http://localhost/profile_syntaxtrust/api/*`

- **File Paths:** All paths in PHP code have been updated to work from the `backend/` directory

- **Assets:** Admin assets are in `backend/assets/`, public assets in `frontend/dist/assets/`

## 🛠️ Troubleshooting

### Common Issues

1. **React app not loading:**
   - Ensure `frontend/dist/` contains built files
   - Run `npm run build` in frontend directory

2. **API not working:**
   - Check that backend PHP files are in `backend/` directory
   - Verify database connection in `backend/config.php`

3. **Admin panel not accessible:**
   - Check admin routes in `backend/index.php`
   - Verify admin user exists in database

### Development Servers

For development, you can run:

```bash
# Frontend only (if you have a separate backend server)
cd frontend && npm run dev

# Or use the main entry point which handles both
# Access via http://localhost/profile_syntaxtrust/
```
