# Docker Deployment Guide - Dipa Talent

## Prerequisites

- Docker Engine 20.10+
- Docker Compose 2.0+
- Minimal 2GB RAM
- 10GB disk space

## Quick Start

### 1. Clone & Setup

```bash
# Clone repository
git clone <repository-url>
cd dipaTalent_project

# Copy environment file
cp .env.example.docker .env

# Generate application key
docker-compose run --rm app php artisan key:generate
```

### 2. Configure Environment

Edit `.env` file dengan konfigurasi yang sesuai:

```env
APP_NAME="Dipa Talent"
APP_ENV=production
APP_DEBUG=false
APP_URL=http://localhost:8000

DB_HOST=db
DB_DATABASE=dipatalent
DB_USERNAME=dipatalent_user
DB_PASSWORD=dipatalent_password
```

### 3. Build & Run

```bash
# Build images
docker-compose build

# Start services
docker-compose up -d

# Run migrations
docker-compose exec app php artisan migrate --force

# Seed database (optional)
docker-compose exec app php artisan db:seed
```

### 4. Access Application

- **Application**: http://localhost:8000
- **PHPMyAdmin**: http://localhost:8080

## Development Mode

Untuk development dengan hot reload:

```bash
# Run dengan bind mount untuk source code
docker-compose -f docker-compose.dev.yml up
```

## Common Commands

### Application Management

```bash
# View logs
docker-compose logs -f app

# Access container shell
docker-compose exec app sh

# Run artisan commands
docker-compose exec app php artisan <command>

# Clear cache
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan view:clear
docker-compose exec app php artisan route:clear
```

### Database Management

```bash
# Create backup
docker-compose exec db mysqldump -u dipatalent_user -pdipatalent_password dipatalent > backup.sql

# Restore backup
docker-compose exec -T db mysql -u dipatalent_user -pdipatalent_password dipatalent < backup.sql

# Access MySQL CLI
docker-compose exec db mysql -u dipatalent_user -pdipatalent_password dipatalent
```

### Service Management

```bash
# Stop services
docker-compose stop

# Start services
docker-compose start

# Restart services
docker-compose restart

# Stop and remove containers
docker-compose down

# Stop and remove containers + volumes
docker-compose down -v
```

## Production Deployment

### 1. Update Environment

```bash
# Set production values
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

# Configure proper database credentials
DB_PASSWORD=strong_random_password

# Configure mail settings
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
```

### 2. SSL/TLS Setup

Tambahkan reverse proxy (Nginx/Traefik) dengan SSL certificate:

```yaml
# docker-compose.prod.yml
services:
  nginx-proxy:
    image: nginxproxy/nginx-proxy
    ports:
      - "80:80"
      - "443:443"
    volumes:
      - /var/run/docker.sock:/tmp/docker.sock:ro
      - ./certs:/etc/nginx/certs:ro
```

### 3. Optimize for Production

```bash
# Build with no cache
docker-compose build --no-cache

# Run optimizations
docker-compose exec app php artisan optimize
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache
```

## Troubleshooting

### Permission Issues

```bash
docker-compose exec app chown -R www-data:www-data /var/www/html/storage
docker-compose exec app chmod -R 755 /var/www/html/storage
```

### Database Connection Failed

```bash
# Check database status
docker-compose ps db

# View database logs
docker-compose logs db

# Restart database
docker-compose restart db
```

### Storage Symlink Not Working

```bash
docker-compose exec app php artisan storage:link
```

### Clear All Cache

```bash
docker-compose exec app php artisan optimize:clear
```

## File Structure

```
.
├── Dockerfile                      # Main application image
├── docker-compose.yml              # Development compose
├── docker-entrypoint.sh           # Startup script
├── .dockerignore                   # Ignore patterns
├── .env.example.docker            # Environment template
├── docker/
│   ├── nginx/
│   │   ├── nginx.conf             # Nginx main config
│   │   └── default.conf           # Site configuration
│   └── supervisor/
│       └── supervisord.conf       # Process manager config
└── README.Docker.md               # This file
```

## Performance Tuning

### PHP-FPM Settings

Edit `docker/supervisor/supervisord.conf`:

```ini
[program:php-fpm]
environment=PHP_FPM_PM_MAX_CHILDREN=50,PHP_FPM_PM_START_SERVERS=10
```

### Database Optimization

```sql
-- Optimize tables
OPTIMIZE TABLE users, prestasis, beasiswas;

-- Add indexes for better performance
CREATE INDEX idx_user_role ON users(role);
CREATE INDEX idx_prestasi_status ON prestasis(status);
```

## Backup Strategy

### Automated Backup Script

```bash
#!/bin/bash
# backup.sh

DATE=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="./backups"

# Create backup directory
mkdir -p $BACKUP_DIR

# Backup database
docker-compose exec -T db mysqldump -u dipatalent_user -pdipatalent_password dipatalent > $BACKUP_DIR/db_$DATE.sql

# Backup storage files
tar -czf $BACKUP_DIR/storage_$DATE.tar.gz storage/app/public

# Keep only last 7 days
find $BACKUP_DIR -name "*.sql" -mtime +7 -delete
find $BACKUP_DIR -name "*.tar.gz" -mtime +7 -delete

echo "Backup completed: $DATE"
```

## Security Checklist

- [ ] Change default database passwords
- [ ] Set `APP_DEBUG=false` in production
- [ ] Configure proper firewall rules
- [ ] Enable HTTPS with valid SSL certificate
- [ ] Regular security updates
- [ ] Implement rate limiting
- [ ] Use strong `APP_KEY`
- [ ] Restrict database access
- [ ] Enable fail2ban for SSH
- [ ] Regular backup verification

## Monitoring

### Health Check

```bash
# Check application health
curl http://localhost:8000/up

# Check all services
docker-compose ps
```

### Log Monitoring

```bash
# Application logs
docker-compose logs -f app

# Database logs
docker-compose logs -f db

# All logs
docker-compose logs -f
```

## Support

Untuk pertanyaan atau masalah:
1. Check logs: `docker-compose logs -f`
2. Restart services: `docker-compose restart`
3. Rebuild if needed: `docker-compose up -d --build`
