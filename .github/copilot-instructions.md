# K-Tech Valves Backend System - Copilot Instructions

<!-- Use this file to provide workspace-specific custom instructions to Copilot. For more details, visit https://code.visualstudio.com/docs/copilot/copilot-customization#_use-a-githubcopilotinstructionsmd-file -->

## Project Overview
This is a comprehensive Laravel 11 backend system for a valve manufacturing company (K-Tech Valves) with modern Laravel Cloud-style UI/UX.

## Architecture & Guidelines

### Backend Structure
- **Framework**: Laravel 11
- **Database**: MySQL/MariaDB
- **Authentication**: Laravel's built-in authentication with role-based permissions
- **File Storage**: Laravel's filesystem with public disk for uploads
- **UI Framework**: Tailwind CSS with Alpine.js for interactivity

### Models & Relationships
- **Users** → **Roles** (belongsTo)
- **Categories** → **Products** (hasMany)
- **Products** → **Inquiries** (hasMany)
- All content models support: active/inactive states, sorting, SEO metadata

### Admin Panel Features
- Modern Laravel Cloud-inspired UI with Tailwind CSS
- Role-based permission system (Super Admin, Admin)
- CRUD operations for all content types
- File upload handling for images and PDFs
- Real-time status toggling
- Comprehensive dashboard with statistics

### Content Management
- **Products**: Full product catalog with categories, technical specs, features, gallery images
- **Categories**: Organized product classification
- **Pages**: Dynamic page content management
- **Banners**: Homepage sliders and promotional content
- **Gallery**: Image management for company showcase
- **Industries**: Industry-specific content
- **Certifications**: Company certifications with validity tracking
- **Clients**: Client logo showcase
- **Inquiries**: Customer inquiry management system

### Frontend Structure
- Clean, responsive design for public website
- Product catalog with filtering and search
- Industry-specific pages
- Gallery and certification showcases
- Contact/inquiry forms

### Security & Permissions
- Middleware-protected admin routes
- Role-based access control
- CSRF protection on all forms
- File upload validation
- XSS protection

### File Organization
```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/          # Admin panel controllers
│   │   └── Frontend/       # Public website controllers
│   ├── Middleware/
│   └── Requests/           # Form validation requests
├── Models/                 # Eloquent models with relationships
resources/
├── views/
│   ├── admin/             # Admin panel views (Laravel Cloud UI style)
│   └── frontend/          # Public website views
routes/
├── web.php                # All application routes
```

### Development Standards
- Follow Laravel conventions and best practices
- Use Eloquent relationships and query scopes
- Implement proper validation using Form Requests
- Handle file uploads securely
- Use meaningful variable names and comments
- Follow PSR-12 coding standards

### Database Design
- Migration files for all tables with proper foreign key constraints
- Seeders for initial data (roles, categories, admin users)
- JSON columns for flexible metadata storage
- Proper indexing for performance

### UI/UX Guidelines
- Admin panel uses Laravel Cloud-inspired design patterns
- Responsive design with mobile-first approach
- Consistent color scheme and typography
- Intuitive navigation and user flows
- Loading states and user feedback
- Accessible design principles

When generating code for this project, ensure:
1. Maintain consistency with existing patterns
2. Use proper Laravel conventions
3. Include appropriate error handling
4. Follow the established UI/UX patterns
5. Implement proper security measures
6. Use meaningful comments and documentation
