#!/bin/bash

# ====================================
# Linux Server Setup Script
# For Arch Endeavour
# ====================================

set -e

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

log() {
    echo -e "${GREEN}[✓]${NC} $1"
}

error() {
    echo -e "${RED}[✗]${NC} $1"
    exit 1
}

warn() {
    echo -e "${YELLOW}[!]${NC} $1"
}

info() {
    echo -e "${BLUE}[i]${NC} $1"
}

prompt() {
    echo -e "${YELLOW}$1${NC}"
    read -p "> " response
    echo "$response"
}

# Banner
clear
cat << "EOF"
╔═══════════════════════════════════════════════╗
║                                               ║
║   Dipa Talent - Linux Server Setup            ║
║   Arch Endeavour Edition                      ║
║                                               ║
╚═══════════════════════════════════════════════╝
EOF

echo ""
info "This script will setup your Linux server for deploying Dipa Talent"
info "Press Ctrl+C to cancel at any time"
echo ""
sleep 2

# Check if running on Arch
if ! grep -q "Arch\|EndeavourOS" /etc/os-release; then
    warn "This script is designed for Arch/EndeavourOS"
    warn "Some commands might not work on other distributions"
    read -p "Continue anyway? (y/n) " -n 1 -r
    echo
    if [[ ! $REPLY =~ ^[Yy]$ ]]; then
        exit 1
    fi
fi

# Update system
info "Updating system..."
sudo pacman -Syu --noconfirm
log "System updated"

# Install Docker
info "Installing Docker..."
if command -v docker &> /dev/null; then
    log "Docker already installed"
else
    sudo pacman -S --noconfirm docker docker-compose
    sudo systemctl start docker
    sudo systemctl enable docker
    log "Docker installed"
fi

# Add user to docker group
info "Adding user to docker group..."
sudo usermod -aG docker $USER
log "User added to docker group (you may need to logout and login)"

# Install essential tools
info "Installing essential tools..."
sudo pacman -S --noconfirm \
    git \
    curl \
    wget \
    nano \
    vim \
    htop \
    nethogs \
    ncdu \
    ufw \
    fail2ban \
    nginx
log "Essential tools installed"

# Setup firewall
info "Setting up firewall..."
sudo ufw --force reset
sudo ufw default deny incoming
sudo ufw default allow outgoing
sudo ufw allow ssh
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp
sudo ufw allow 8000/tcp
sudo ufw allow 8080/tcp
sudo ufw --force enable
log "Firewall configured"

# Git configuration
info "Configuring Git..."
GIT_NAME=$(prompt "Enter your Git name:")
GIT_EMAIL=$(prompt "Enter your Git email:")
git config --global user.name "$GIT_NAME"
git config --global user.email "$GIT_EMAIL"
log "Git configured"

# SSH Key generation
info "Setting up SSH key for GitHub..."
if [ -f "$HOME/.ssh/id_ed25519" ]; then
    log "SSH key already exists"
else
    ssh-keygen -t ed25519 -C "$GIT_EMAIL" -N "" -f "$HOME/.ssh/id_ed25519"
    log "SSH key generated"
fi

echo ""
info "Your SSH public key:"
cat "$HOME/.ssh/id_ed25519.pub"
echo ""
warn "Copy this key and add it to GitHub: https://github.com/settings/keys"
read -p "Press Enter when you've added the key to GitHub..."

# Test GitHub connection
info "Testing GitHub connection..."
ssh -T git@github.com || true
log "GitHub connection tested"

# Create project directory
info "Creating project directory..."
mkdir -p "$HOME/projects"
mkdir -p "$HOME/scripts"
mkdir -p "$HOME/backups/database"
log "Directories created"

# Clone project
echo ""
info "Ready to clone the project"
REPO_URL=$(prompt "Enter your repository URL (SSH format - git@github.com:user/repo.git):")

if [ ! -z "$REPO_URL" ]; then
    cd "$HOME/projects"
    git clone "$REPO_URL" dipaTalent_project || warn "Failed to clone. You can do this manually later."
    log "Project cloned"
fi

# Setup automatic reconnect to hotspot
info "Setting up automatic hotspot reconnection..."
HOTSPOT_NAME=$(prompt "Enter your hotspot name (leave empty to skip):")

if [ ! -z "$HOTSPOT_NAME" ]; then
    HOTSPOT_PASSWORD=$(prompt "Enter hotspot password:")
    
    cat > "$HOME/scripts/check-internet.sh" << SCRIPT
#!/bin/bash
HOTSPOT_NAME="$HOTSPOT_NAME"
HOTSPOT_PASSWORD="$HOTSPOT_PASSWORD"

if ! ping -c 1 8.8.8.8 &> /dev/null; then
    echo "\$(date): Internet down, reconnecting..." >> \$HOME/scripts/internet.log
    nmcli device wifi connect "\$HOTSPOT_NAME" password "\$HOTSPOT_PASSWORD"
fi
SCRIPT
    
    chmod +x "$HOME/scripts/check-internet.sh"
    
    # Add to crontab
    (crontab -l 2>/dev/null; echo "*/5 * * * * $HOME/scripts/check-internet.sh") | crontab -
    
    log "Auto-reconnect configured"
fi

# Setup webhook service
info "Setting up webhook service..."
if command -v yay &> /dev/null; then
    yay -S --noconfirm webhook || warn "Webhook installation failed"
else
    warn "yay not found. Install webhook manually if needed: yay -S webhook"
fi

# Setup backup cron
info "Setting up automatic database backup..."
cat > "$HOME/scripts/backup-database.sh" << 'BACKUP_SCRIPT'
#!/bin/bash
BACKUP_DIR="$HOME/backups/database"
DATE=$(date +%Y%m%d_%H%M%S)
PROJECT_DIR="$HOME/projects/dipaTalent_project"

mkdir -p "$BACKUP_DIR"

cd "$PROJECT_DIR"
docker-compose exec -T db mysqldump -u dipatalent_user -pdipatalent_password dipatalent > "$BACKUP_DIR/backup_$DATE.sql"

# Keep only last 7 days
find "$BACKUP_DIR" -name "backup_*.sql" -mtime +7 -delete

echo "$(date): Backup completed - backup_$DATE.sql" >> "$HOME/scripts/backup.log"
BACKUP_SCRIPT

chmod +x "$HOME/scripts/backup-database.sh"

# Add to crontab (daily at 2 AM)
(crontab -l 2>/dev/null; echo "0 2 * * * $HOME/scripts/backup-database.sh") | crontab -

log "Backup cron configured"

# Setup fail2ban
info "Configuring fail2ban..."
sudo systemctl enable fail2ban
sudo systemctl start fail2ban
log "Fail2ban configured"

# Show network info
echo ""
echo "═══════════════════════════════════════════════"
info "Network Information:"
echo "═══════════════════════════════════════════════"
LOCAL_IP=$(hostname -I | awk '{print $1}')
PUBLIC_IP=$(curl -s ifconfig.me || echo "Unable to fetch")

echo "  Local IP:  $LOCAL_IP"
echo "  Public IP: $PUBLIC_IP"
echo ""

# Show summary
echo "═══════════════════════════════════════════════"
log "Setup completed successfully!"
echo "═══════════════════════════════════════════════"
echo ""
info "Next steps:"
echo "  1. Logout and login again for docker group to take effect"
echo "  2. Navigate to: cd ~/projects/dipaTalent_project"
echo "  3. Copy and edit .env: cp .env.example .env && nano .env"
echo "  4. Run deployment: ./scripts/deploy-linux.sh deploy"
echo ""
info "Useful commands:"
echo "  - Deploy app: ~/projects/dipaTalent_project/scripts/deploy-linux.sh deploy"
echo "  - Check status: docker-compose ps"
echo "  - View logs: docker-compose logs -f"
echo "  - Backup DB: ~/scripts/backup-database.sh"
echo ""
info "Access URLs (after deployment):"
echo "  - Local: http://localhost:8000"
echo "  - Network: http://$LOCAL_IP:8000"
echo "  - Public: http://$PUBLIC_IP:8000 (if port forwarding enabled)"
echo ""
warn "Remember to secure your .env file with sensitive data!"
echo ""
