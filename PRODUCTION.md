# Production Deployment Guide

## Prerequisites

- Apache/Nginx web server with PHP 8.1+
- MySQL 5.7+ or MariaDB 10.3+
- Composer installed
- mod_rewrite enabled (Apache)

## Step 1: Server Setup

### Upload Files
Upload all project files to your server's web root or subdirectory.

### Set Permissions
```bash
chmod -R 755 /path/to/project
chmod -R 777 writable/
```

## Step 2: Environment Configuration

### Update .env File
```bash
cp .env .env.production
```

Edit `.env` with production settings:

```ini
CI_ENVIRONMENT = production

app.baseURL = 'https://yourdomain.com/'

database.default.hostname = localhost
database.default.database = your_database_name
database.default.username = your_db_user
database.default.password = your_db_password
database.default.DBDriver = MySQLi
database.default.port = 3306

encryption.key = your_generated_encryption_key
```

### Generate Encryption Key
```bash
php spark key:generate
```

## Step 3: Database Setup

### Import Database
1. Access phpMyAdmin or MySQL CLI
2. Create database: `CREATE DATABASE your_database_name;`
3. Import `database_setup.sql` or run migrations:
```bash
php spark migrate
```

### Create Admin User
Run the seed script or manually insert:
```sql
INSERT INTO users (username, email, password, created_at) 
VALUES ('hanzala', 'hanzala@example.com', '$2y$10$hashed_password', NOW());
```

Generate password hash:
```bash
php -r "echo password_hash('your_password', PASSWORD_BCRYPT);"
```

## Step 4: Web Server Configuration

### Apache (.htaccess already configured)
Ensure `public/.htaccess` exists and mod_rewrite is enabled:
```bash
a2enmod rewrite
systemctl restart apache2
```

### Nginx
Add to your nginx config:
```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /path/to/project/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
```

## Step 5: Security Hardening

### Disable Debug Mode
In `.env`:
```ini
CI_ENVIRONMENT = production
```

### Secure File Permissions
```bash
chmod 640 .env
chmod 644 public/.htaccess
```

### Remove Debug Files
```bash
rm -f verify_db.php seed_admin.php test_login.php
```

### Update Routes (Optional)
Remove debug route from `app/Config/Routes.php`:
```php
// Remove this line:
$routes->get('debug/info', 'DebugController::info');
```

## Step 6: SSL Certificate

Install SSL certificate (Let's Encrypt recommended):
```bash
certbot --apache -d yourdomain.com
```

Update `.env`:
```ini
app.baseURL = 'https://yourdomain.com/'
app.forceGlobalSecureRequests = true
```

## Step 7: Verify Deployment

1. **Homepage**: `https://yourdomain.com/`
2. **Admin Login**: `https://yourdomain.com/admin/login`
3. **API Endpoint**: `https://yourdomain.com/api/posts`

## Troubleshooting

### 404 Errors
- Check mod_rewrite is enabled
- Verify `.htaccess` exists in `public/`
- Check file permissions

### Database Connection Failed
- Verify database credentials in `.env`
- Ensure database exists
- Check MySQL user permissions

### Blank Page
- Check `writable/` permissions (777)
- Review error logs in `writable/logs/`
- Verify PHP version (8.1+)

## Maintenance

### Update Blog Posts
Access admin dashboard: `https://yourdomain.com/admin/login`

### Backup Database
```bash
mysqldump -u username -p database_name > backup.sql
```

### Monitor Logs
```bash
tail -f writable/logs/log-*.log
```

## Performance Optimization

### Enable Caching
In `app/Config/Cache.php`, configure Redis or Memcached.

### Optimize Database
```sql
OPTIMIZE TABLE posts;
OPTIMIZE TABLE users;
```

### Enable Gzip Compression
Add to `.htaccess`:
```apache
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css text/javascript application/javascript
</IfModule>
```

## Support

For issues, check:
- CodeIgniter 4 Documentation: https://codeigniter.com/user_guide/
- Server error logs
- Application logs in `writable/logs/`
