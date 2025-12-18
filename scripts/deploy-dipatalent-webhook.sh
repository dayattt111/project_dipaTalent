#!/bin/bash

# ====================================
# Webhook Deploy Script
# Dipanggil oleh webhook saat ada push ke GitHub
# ====================================

PROJECT_DIR="$HOME/projects/dipaTalent_project"
LOG_FILE="$HOME/scripts/webhook-deploy.log"

echo "=====================================" >> "$LOG_FILE"
echo "Deploy triggered at: $(date)" >> "$LOG_FILE"
echo "=====================================" >> "$LOG_FILE"

cd "$PROJECT_DIR"

# Pull latest code
echo "Pulling latest code..." >> "$LOG_FILE"
git pull origin main >> "$LOG_FILE" 2>&1

# Rebuild and restart
echo "Rebuilding containers..." >> "$LOG_FILE"
docker-compose down >> "$LOG_FILE" 2>&1
docker-compose up -d --build >> "$LOG_FILE" 2>&1

# Wait for containers
sleep 15

# Run migrations
echo "Running migrations..." >> "$LOG_FILE"
docker-compose exec -T app php artisan migrate --force >> "$LOG_FILE" 2>&1

# Optimize
echo "Optimizing..." >> "$LOG_FILE"
docker-compose exec -T app php artisan config:cache >> "$LOG_FILE" 2>&1
docker-compose exec -T app php artisan route:cache >> "$LOG_FILE" 2>&1
docker-compose exec -T app php artisan view:cache >> "$LOG_FILE" 2>&1

# Fix permissions
docker-compose exec -T app chown -R www-data:www-data /var/www/html/storage >> "$LOG_FILE" 2>&1

echo "Deploy completed at: $(date)" >> "$LOG_FILE"
echo "=====================================" >> "$LOG_FILE"
echo "" >> "$LOG_FILE"

exit 0
