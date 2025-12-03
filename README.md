# Car Rental Management System

A comprehensive web-based car rental management system with multi-role authentication (Admin & User) and Content Management System (CMS) for dynamic content updates without modifying source code.

## Features

### User Role Capabilities
- User registration and authentication
- Browse available vehicle inventory
- Online booking system with detailed form
- Booking history tracking
- Login activity logs
- Automatic price estimation based on rental duration

### Administrator Role Capabilities
- Complete user role functionality
- Booking management (Approve/Reject/Complete)
- Vehicle CRUD operations with image upload
- Article/News CRUD operations with image upload
- Content Management System (CMS)
  - Homepage content editing (title, subtitle, description)
  - About page content management
  - Vision & Mission statement management
  - Contact information updates (address, phone, WhatsApp, email)
  - Gallery management (add/remove images)

## Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher / MariaDB 10.3 or higher
- Apache Web Server (XAMPP, WAMP, or similar)
- Web browser (Chrome, Firefox, Edge, Safari)

### Step 1: Database Setup
1. Open phpMyAdmin or MySQL command line
2. Execute `database_schema.sql` to create database structure and default data
   ```sql
   mysql -u root -p < database_schema.sql
   ```
3. Verify that `rental_db2` database has been created with all tables

### Step 2: Database Configuration
Edit `config/database.php` if necessary:
```php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'rental_db2';
```

### Step 3: Web Server Configuration
1. Place project files in web server document root (e.g., `htdocs/rental_mobil`)
2. Ensure Apache and MySQL services are running
3. Access the application via web browser: `http://localhost/rental_mobil`

### Step 4: Default Credentials

**Administrator Account:**
- Username: `admin`
- Password: `admin`

**User Demo Account:**
- Username: `user`
- Password: `user`

**Important:** Change default passwords after first login for security purposes.

## Project Structure

```
rental_mobil/
├── assets/
│   ├── img/           # Gambar default (logo, slider, dll)
│   └── style.css      # Custom CSS
├── config/
│   └── database.php   # Konfigurasi database
├── includes/
│   ├── header.php     # Header website
│   ├── footer.php     # Footer website
│   ├── sidebar.php    # Sidebar dengan login form
│   └── functions.php  # Helper functions untuk CMS
├── pages/
│   ├── home.php       # Halaman utama
│   ├── about.php      # Tentang perusahaan
│   ├── visi.php       # Visi & Misi
│   ├── produk.php     # Daftar mobil
│   ├── gallery.php    # Gallery event
│   ├── kontak.php     # Kontak
│   ├── klien.php      # Klien terpercaya
│   ├── artikel.php    # Detail artikel
│   ├── admin.php      # Dashboard admin
│   ├── content_manager.php  # CMS untuk edit konten
│   ├── booking.php    # Form booking
│   ├── history.php    # Riwayat & log user
│   └── register.php   # Registrasi user baru
├── process/
│   ├── login.php      # Proses login
│   ├── logout.php     # Proses logout
│   ├── register_process.php  # Proses registrasi
│   ├── tambah_mobil.php      # Tambah mobil
│   ├── edit_mobil.php        # Edit mobil
│   ├── hapus_mobil.php       # Hapus mobil
│   ├── tambah_artikel.php    # Tambah artikel
│   ├── hapus_artikel.php     # Hapus artikel
│   ├── booking_process.php   # Proses booking
│   ├── update_booking.php    # Update status booking
│   ├── update_content.php    # Update konten CMS
│   ├── add_gallery.php       # Tambah gambar gallery
│   └── delete_gallery.php    # Hapus gambar gallery
├── uploads/           # Folder upload gambar
├── index.php          # Main entry point
└── database_schema.sql  # SQL schema lengkap
```

## Content Management System Usage

### Administrator Guide

#### 1. Login as Administrator
- Navigate to the website homepage
- Use credentials: Username `admin`, Password `admin`
- After successful login, administrator panel will be accessible

#### 2. Accessing Content Manager
- Click "Edit Konten" menu item in the sidebar
- Alternative: Navigate from Admin Panel using Quick Access button

#### 3. Content Editing
- **Home Tab:** Edit homepage welcome title, subtitle, and description
- **About Tab:** Manage company history and background information
- **Vision & Mission Tab:** Update organizational vision and mission statements (separate multiple missions with `|` character)
- **Contact Tab:** Update contact information including office address, phone number, WhatsApp, and email
- **Gallery Tab:** Add or remove gallery images

#### 4. Booking Management
- Navigate to Admin Panel, select "Kelola Pesanan" tab
- Review pending booking requests
- Approve, reject, or mark bookings as completed

#### 5. Vehicle and Article Management
- **Vehicle Management:**
  - View all vehicles in "Data Mobil" tab
  - Edit or delete existing vehicles
  - Add new vehicles via "Tambah Mobil" tab with image upload
- **Article Management:**
  - Browse articles in "Data Artikel" tab
  - Delete outdated articles
  - Publish new articles via "Tambah Artikel" tab

## Security Features

- Session-based authentication system
- Role-based access control (RBAC)
- SQL injection protection using `mysqli_real_escape_string()`
- File upload validation (images only)
- Password hashing with MD5 (bcrypt upgrade recommended for production)
- Page whitelist to prevent directory traversal attacks
- Protected upload directory with .htaccess configuration

## Database Schema

The system uses 7 main database tables:

1. **users** - User accounts with role assignment (admin/user)
2. **cars** - Vehicle inventory and specifications
3. **articles** - News and article publications
4. **bookings** - Rental booking records with status tracking
5. **login_logs** - User login activity tracking with IP addresses
6. **content_pages** - Dynamic website content managed via CMS
7. **gallery_images** - Image gallery collection

## Technology Stack

**Frontend:**
- Bootstrap 5.3 - Responsive UI framework
- Font Awesome 6.4 - Icon library
- Custom CSS with gradient theme (purple-blue palette)
- Vanilla JavaScript for dynamic interactions

**Backend:**
- PHP 7.4+ (Native)
- MySQLi extension for database operations

**Database:**
- MySQL 5.7+ / MariaDB 10.3+

## System Requirements

- PHP 7.4 or higher
- MySQL 5.7+ or MariaDB 10.3+
- Apache 2.4+ with mod_rewrite enabled
- Minimum 128MB PHP memory limit
- File upload support enabled in php.ini
- GD Library for image processing

## Configuration Notes

- Uploaded images are stored in `uploads/` directory
- Default images are located in `assets/img/` directory
- Website content is retrieved from `content_pages` database table
- If content is not available in database, default fallback values are used
- Image display uses 3-tier fallback system: uploads → assets/img/specific → assets/img/default

## Upgrade Guide

### Migrating from Previous Version

1. Backup existing database:
   ```sql
   mysqldump -u root -p rental_db2 > backup_$(date +%Y%m%d).sql
   ```

2. Review `database_schema.sql` for structural changes

3. Execute upgrade script or manually apply schema modifications

4. Test all functionality after upgrade

5. Clear browser cache and session data

## API Integration

The system includes WhatsApp integration for booking notifications:
- Booking details are automatically formatted for WhatsApp messages
- Redirects to WhatsApp Web/App after successful booking submission
- Configure WhatsApp number in `process/booking_process.php`

## Troubleshooting

**Common Issues:**

1. **Database Connection Failed**
   - Verify credentials in `config/database.php`
   - Ensure MySQL service is running
   - Check database exists and user has proper permissions

2. **Images Not Displaying**
   - Verify file permissions on `uploads/` directory (755 or 777)
   - Check image file extensions (jpg, jpeg, png, webp only)
   - Ensure images exist in specified paths

3. **Login Issues**
   - Clear browser cookies and session data
   - Verify user credentials in database
   - Check session configuration in php.ini

4. **Upload Failures**
   - Check `upload_max_filesize` and `post_max_size` in php.ini
   - Verify `uploads/` directory is writable
   - Ensure file validation passes (image types only)

## Contributing

Contributions are welcome. Please follow these guidelines:
- Follow PSR-12 coding standards for PHP
- Comment complex logic and functions
- Test thoroughly before submitting changes
- Update documentation for new features

## License

This project is proprietary software. All rights reserved.

## Support

For technical support, bug reports, or feature requests, please contact the development team.

## Changelog

### Version 1.0.0
- Initial release with multi-role authentication
- Complete CMS implementation
- Booking management system
- Vehicle and article CRUD operations
- Login activity tracking
- WhatsApp integration
