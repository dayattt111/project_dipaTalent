#!/bin/bash

# ====================================
# Dipa Talent - Linux Deployment Script
# ====================================

set -e  # Exit on error

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Configuration
PROJECT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
LOG_FILE="$PROJECT_DIR/deploy.log"

# Functions
log() {
    echo -e "${GREEN}[$(date +'%Y-%m-%d %H:%M:%S')]${NC} $1" | tee -a "$LOG_FILE"
}

error() {
    echo -e "${RED}[ERROR]${NC} $1" | tee -a "$LOG_FILE"
    exit 1
}

warn() {
    echo -e "${YELLOW}[WARNING]${NC} $1" | tee -a "$LOG_FILE"
}

check_docker() {
    if ! command -v docker &> /dev/null; then
        error "Docker is not installed. Please install Docker first."
    fi
    
    if ! command -v docker-compose &> /dev/null; then
        error "Docker Compose is not installed. Please install Docker Compose first."
    fi
    
    log "✓ Docker and Docker Compose are installed"
}

check_env() {
    if [ ! -f "$PROJECT_DIR/.env" ]; then
        warn ".env file not found. Creating from .env.example..."
        cp "$PROJECT_DIR/.env.example" "$PROJECT_DIR/.env"
        log "✓ Created .env file. Please edit it with your configuration."
        exit 0
    fi
    log "✓ .env file exists"
}

pull_latest() {
    log "Pulling latest code from Git..."
    cd "$PROJECT_DIR"
    
    if [ -d ".git" ]; then
        git pull origin main || git pull origin master || warn "Failed to pull from git"
        log "✓ Code updated"
    else
        warn "Not a git repository. Skipping pull."
    fi
}

stop_containers() {
    log "Stopping existing containers..."
    cd "$PROJECT_DIR"
    docker-compose down || warn "No containers to stop"
    log "✓ Containers stopped"
}

build_images() {
    log "Building Docker images..."
    cd "$PROJECT_DIR"
    docker-compose build --no-cache || error "Failed to build images"
    log "✓ Images built successfully"
}

start_containers() {
    log "Starting containers..."
    cd "$PROJECT_DIR"
    docker-compose up -d || error "Failed to start containers"
    
    log "Waiting for containers to be ready..."
    sleep 15
    
    log "✓ Containers started"
}

run_migrations() {
    log "Running database migrations..."
    cd "$PROJECT_DIR"
    docker-compose exec -T app php artisan migrate --force || error "Migration failed"
    log "✓ Migrations completed"
}

seed_database() {
    log "Seeding database..."
    cd "$PROJECT_DIR"
    docker-compose exec -T app php artisan db:seed --force || warn "Seeding failed or skipped"
    log "✓ Database seeded"
}

optimize_app() {
    log "Optimizing application..."
    cd "$PROJECT_DIR"
    
    docker-compose exec -T app php artisan config:cache
    docker-compose exec -T app php artisan route:cache
    docker-compose exec -T app php artisan view:cache
    
    log "✓ Application optimized"
}

fix_permissions() {
    log "Fixing storage permissions..."
    cd "$PROJECT_DIR"
    
    docker-compose exec -T app chown -R www-data:www-data /var/www/html/storage
    docker-compose exec -T app chmod -R 775 /var/www/html/storage
    docker-compose exec -T app chmod -R 775 /var/www/html/bootstrap/cache
    
    log "✓ Permissions fixed"
}

show_status() {
    log "Container Status:"
    cd "$PROJECT_DIR"
    docker-compose ps
    
    echo ""
    log "Application URLs:"
    
    LOCAL_IP=$(hostname -I | awk '{print $1}')
    PUBLIC_IP=$(curl -s ifconfig.me || echo "Unable to fetch")
    
    echo "  Local Access:"
    echo "    - App: http://localhost:8000"
    echo "    - PHPMyAdmin: http://localhost:8080"
    echo ""
    echo "  Network Access:"
    echo "    - App: http://$LOCAL_IP:8000"
    echo "    - PHPMyAdmin: http://$LOCAL_IP:8080"
    echo ""
    echo "  Public Access (if port forwarding enabled):"
    echo "    - App: http://$PUBLIC_IP:8000"
    echo ""
}

show_logs() {
    log "Showing recent logs..."
    cd "$PROJECT_DIR"
    docker-compose logs --tail=50
}

# Main deployment function
deploy() {
    log "========================================="
    log "Starting Deployment Process"
    log "========================================="
    
    check_docker
    check_env
    pull_latest
    stop_containers
    build_images
    start_containers
    run_migrations
    
    if [ "$1" == "--with-seed" ]; then
        seed_database
    fi
    
    optimize_app
    fix_permissions
    show_status
    
    log "========================================="
    log "Deployment Completed Successfully!"
    log "========================================="
}

# Quick deploy (without rebuild)
quick_deploy() {
    log "========================================="
    log "Quick Deployment (No Rebuild)"
    log "========================================="
    
    check_docker
    pull_latest
    stop_containers
    
    log "Starting containers..."
    cd "$PROJECT_DIR"
    docker-compose up -d
    
    sleep 10
    
    run_migrations
    optimize_app
    fix_permissions
    show_status
    
    log "Quick deployment completed!"
}

# Rollback function
rollback() {
    log "========================================="
    log "Rolling Back to Previous Version"
    log "========================================="
    
    cd "$PROJECT_DIR"
    
    if [ -d ".git" ]; then
        git reset --hard HEAD~1
        quick_deploy
    else
        error "Not a git repository. Cannot rollback."
    fi
}

# Backup database
backup_db() {
    BACKUP_DIR="$HOME/backups/database"
    mkdir -p "$BACKUP_DIR"
    
    DATE=$(date +%Y%m%d_%H%M%S)
    BACKUP_FILE="$BACKUP_DIR/backup_$DATE.sql"
    
    log "Creating database backup..."
    cd "$PROJECT_DIR"
    
    docker-compose exec -T db mysqldump -u dipatalent_user -pdipatalent_password dipatalent > "$BACKUP_FILE"
    
    log "✓ Backup saved to: $BACKUP_FILE"
    
    # Keep only last 7 days
    find "$BACKUP_DIR" -name "backup_*.sql" -mtime +7 -delete
    log "✓ Old backups cleaned up"
}

# Restore database
restore_db() {
    if [ -z "$1" ]; then
        error "Usage: $0 restore <backup_file>"
    fi
    
    BACKUP_FILE="$1"
    
    if [ ! -f "$BACKUP_FILE" ]; then
        error "Backup file not found: $BACKUP_FILE"
    fi
    
    log "Restoring database from: $BACKUP_FILE"
    cd "$PROJECT_DIR"
    
    docker-compose exec -T db mysql -u dipatalent_user -pdipatalent_password dipatalent < "$BACKUP_FILE"
    
    log "✓ Database restored successfully"
}

# Health check
health_check() {
    log "Running health check..."
    cd "$PROJECT_DIR"
    
    # Check if containers are running
    if docker-compose ps | grep -q "Up"; then
        log "✓ Containers are running"
    else
        error "Some containers are not running"
    fi
    
    # Check app response
    if curl -s http://localhost:8000 > /dev/null; then
        log "✓ Application is responding"
    else
        warn "Application is not responding on port 8000"
    fi
    
    # Check database connection
    if docker-compose exec -T app php artisan tinker --execute="DB::connection()->getPdo();" > /dev/null 2>&1; then
        log "✓ Database connection is working"
    else
        warn "Database connection failed"
    fi
    
    log "Health check completed"
}

# Show help
show_help() {
    cat << EOF
Dipa Talent - Linux Deployment Script

Usage: $0 [command] [options]

Commands:
    deploy          Full deployment (pull, rebuild, migrate)
    deploy --with-seed  Full deployment with database seeding
    quick           Quick deployment (no rebuild)
    rollback        Rollback to previous version
    backup          Backup database
    restore <file>  Restore database from backup
    health          Run health check
    status          Show container status
    logs            Show recent logs
    stop            Stop all containers
    start           Start all containers
    restart         Restart all containers
    clean           Clean up Docker resources
    help            Show this help message

Examples:
    $0 deploy                           # Full deployment
    $0 deploy --with-seed              # Full deployment with seeding
    $0 quick                           # Quick update without rebuild
    $0 backup                          # Backup database
    $0 restore ~/backups/backup.sql    # Restore database
    $0 health                          # Check system health

EOF
}

# Parse command line arguments
case "${1:-help}" in
    deploy)
        deploy "$2"
        ;;
    quick)
        quick_deploy
        ;;
    rollback)
        rollback
        ;;
    backup)
        backup_db
        ;;
    restore)
        restore_db "$2"
        ;;
    health)
        health_check
        ;;
    status)
        cd "$PROJECT_DIR"
        docker-compose ps
        ;;
    logs)
        show_logs
        ;;
    stop)
        log "Stopping containers..."
        cd "$PROJECT_DIR"
        docker-compose down
        log "✓ Containers stopped"
        ;;
    start)
        log "Starting containers..."
        cd "$PROJECT_DIR"
        docker-compose up -d
        log "✓ Containers started"
        ;;
    restart)
        log "Restarting containers..."
        cd "$PROJECT_DIR"
        docker-compose restart
        log "✓ Containers restarted"
        ;;
    clean)
        log "Cleaning up Docker resources..."
        docker system prune -af --volumes
        log "✓ Cleanup completed"
        ;;
    help|*)
        show_help
        ;;
esac
