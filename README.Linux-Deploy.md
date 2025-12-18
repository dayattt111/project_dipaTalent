# 🐧 Deployment Guide - Linux (Arch Endeavour) ke Production

Panduan lengkap deploy Laravel + Vite + MySQL menggunakan Docker dari laptop Linux Arch Endeavour dengan CI/CD.

---

## 📋 Arsitektur Deployment

```
Windows Laptop (Development)
    ↓ git push
GitHub Repository
    ↓ git clone/pull
Linux Laptop (Production Server)
    ↓ docker-compose
Production (Online via Hotspot/WiFi)
```

---

## 🔧 Part 1: Setup Linux Server (Arch Endeavour)

### 1.1 Install Docker & Docker Compose

```bash
# Update system
sudo pacman -Syu

# Install Docker
sudo pacman -S docker docker-compose

# Start & enable Docker service
sudo systemctl start docker
sudo systemctl enable docker

# Add user to docker group (agar tidak perlu sudo)
sudo usermod -aG docker $USER

# Logout & login lagi, atau jalankan:
newgrp docker

# Verifikasi instalasi
docker --version
docker-compose --version
```

### 1.2 Install Git & Tools

```bash
# Install git dan tools yang diperlukan
sudo pacman -S git curl wget nano

# Konfigurasi git
git config --global user.name "Your Name"
git config --global user.email "your.email@example.com"
```

### 1.3 Setup SSH Key untuk GitHub (Recommended)

```bash
# Generate SSH key
ssh-keygen -t ed25519 -C "your.email@example.com"

# Copy public key
cat ~/.ssh/id_ed25519.pub

# Tambahkan ke GitHub:
# 1. Buka https://github.com/settings/keys
# 2. Klik "New SSH key"
# 3. Paste public key
# 4. Save
```

### 1.4 Setup Firewall (UFW)

```bash
# Install UFW
sudo pacman -S ufw

# Configure firewall
sudo ufw default deny incoming
sudo ufw default allow outgoing
sudo ufw allow ssh
sudo ufw allow 80/tcp      # HTTP
sudo ufw allow 443/tcp     # HTTPS
sudo ufw allow 8000/tcp    # Laravel app
sudo ufw allow 8080/tcp    # PHPMyAdmin (optional)

# Enable firewall
sudo ufw enable

# Check status
sudo ufw status
```

---

## 📱 Part 2: Setup Koneksi Internet

### 2.1 Koneksi ke Hotspot HP

```bash
# List available networks
nmcli device wifi list

# Connect ke hotspot
nmcli device wifi connect "NAMA_HOTSPOT" password "PASSWORD_HOTSPOT"

# Cek koneksi
ip addr show
ping -c 4 google.com

# Cek IP public Anda
curl ifconfig.me
```

### 2.2 Setup Static IP (Optional untuk LAN)

Untuk koneksi LAN nanti, edit file konfigurasi NetworkManager:

```bash
# Edit connection
sudo nmcli connection modify "Wired connection 1" \
  ipv4.addresses 192.168.1.100/24 \
  ipv4.gateway 192.168.1.1 \
  ipv4.dns 8.8.8.8,8.8.4.4 \
  ipv4.method manual

# Restart connection
sudo nmcli connection down "Wired connection 1"
sudo nmcli connection up "Wired connection 1"
```

### 2.3 Setup Dynamic DNS (Jika IP berubah-ubah)

Karena pakai hotspot, IP akan berubah. Gunakan Dynamic DNS:

**Option 1: No-IP (Free)**
```bash
# Install No-IP client
yay -S noip

# Configure
sudo noip2 -C

# Start service
sudo systemctl start noip2
sudo systemctl enable noip2
```

**Option 2: DuckDNS (Free)**
```bash
# Buat account di https://www.duckdns.org/
# Dapatkan token dan subdomain

# Install cron job
mkdir ~/duckdns
cd ~/duckdns
nano duck.sh
```

Isi `duck.sh`:
```bash
#!/bin/bash
echo url="https://www.duckdns.org/update?domains=YOUR_SUBDOMAIN&token=YOUR_TOKEN&ip=" | curl -k -o ~/duckdns/duck.log -K -
```

```bash
chmod 700 duck.sh
crontab -e
# Tambahkan: */5 * * * * ~/duckdns/duck.sh >/dev/null 2>&1
```

---

## 🚀 Part 3: Deploy Application

### 3.1 Clone Project

```bash
# Buat direktori untuk project
mkdir -p ~/projects
cd ~/projects

# Clone dari GitHub
git clone https://github.com/YOUR_USERNAME/dipaTalent_project.git
# atau dengan SSH:
git clone git@github.com:YOUR_USERNAME/dipaTalent_project.git

cd dipaTalent_project
```

### 3.2 Setup Environment

```bash
# Copy environment file
cp .env.example .env

# Edit .env
nano .env
```

Edit file `.env` dengan konfigurasi production:

```env
APP_NAME="Dipa Talent"
APP_ENV=production
APP_DEBUG=false
APP_KEY=
APP_URL=http://YOUR_IP_OR_DOMAIN:8000

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=dipatalent
DB_USERNAME=dipatalent_user
DB_PASSWORD=STRONG_PASSWORD_HERE

SESSION_DRIVER=database
SESSION_LIFETIME=120

CACHE_STORE=database
QUEUE_CONNECTION=database
```

### 3.3 Generate APP_KEY

```bash
# Generate key tanpa start container
docker run --rm -v $(pwd):/app composer:2 bash -c "cd /app && composer install --no-dev --optimize-autoloader && php artisan key:generate --show"

# Copy output dan paste ke .env file di APP_KEY
```

### 3.4 Build & Deploy

```bash
# Build images
docker-compose build --no-cache

# Start services
docker-compose up -d

# Cek logs
docker-compose logs -f

# Wait beberapa detik, lalu run migrations
docker-compose exec app php artisan migrate --force

# Optimize Laravel
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache

# Seed database (optional)
docker-compose exec app php artisan db:seed --force

# Set permissions untuk storage
docker-compose exec app chown -R www-data:www-data /var/www/html/storage
docker-compose exec app chmod -R 775 /var/www/html/storage
```

### 3.5 Verifikasi Deployment

```bash
# Cek status containers
docker-compose ps

# Should see:
# dipatalent_app         running
# dipatalent_db          running
# dipatalent_phpmyadmin  running

# Test aplikasi
curl http://localhost:8000

# Dari device lain di network yang sama:
curl http://YOUR_LINUX_IP:8000
```

---

## 🔄 Part 4: CI/CD dengan GitHub Actions

### 4.1 Setup Webhook Auto-Deploy

Buat script auto-deploy di Linux:

```bash
# Buat directory untuk scripts
mkdir -p ~/scripts
nano ~/scripts/deploy-dipatalent.sh
```

Isi `deploy-dipatalent.sh`:
```bash
#!/bin/bash

# Auto Deploy Script
PROJECT_DIR=~/projects/dipaTalent_project
LOG_FILE=~/scripts/deploy.log

echo "=== Deploy started at $(date) ===" >> $LOG_FILE

cd $PROJECT_DIR

# Pull latest code
echo "Pulling latest code..." >> $LOG_FILE
git pull origin main >> $LOG_FILE 2>&1

# Rebuild containers
echo "Rebuilding Docker containers..." >> $LOG_FILE
docker-compose down >> $LOG_FILE 2>&1
docker-compose build --no-cache >> $LOG_FILE 2>&1
docker-compose up -d >> $LOG_FILE 2>&1

# Wait for containers to be ready
sleep 10

# Run migrations
echo "Running migrations..." >> $LOG_FILE
docker-compose exec -T app php artisan migrate --force >> $LOG_FILE 2>&1

# Clear & cache
echo "Optimizing application..." >> $LOG_FILE
docker-compose exec -T app php artisan config:cache >> $LOG_FILE 2>&1
docker-compose exec -T app php artisan route:cache >> $LOG_FILE 2>&1
docker-compose exec -T app php artisan view:cache >> $LOG_FILE 2>&1

# Set permissions
docker-compose exec -T app chown -R www-data:www-data /var/www/html/storage >> $LOG_FILE 2>&1

echo "=== Deploy completed at $(date) ===" >> $LOG_FILE
echo "" >> $LOG_FILE
```

```bash
# Make executable
chmod +x ~/scripts/deploy-dipatalent.sh

# Test script
~/scripts/deploy-dipatalent.sh
```

### 4.2 Setup Webhook Receiver

Install webhook listener:

```bash
# Install webhook
yay -S webhook

# Buat config file
mkdir -p ~/.config/webhook
nano ~/.config/webhook/hooks.json
```

Isi `hooks.json`:
```json
[
  {
    "id": "deploy-dipatalent",
    "execute-command": "/home/YOUR_USERNAME/scripts/deploy-dipatalent.sh",
    "command-working-directory": "/home/YOUR_USERNAME/projects/dipaTalent_project",
    "response-message": "Deployment triggered!",
    "trigger-rule": {
      "and": [
        {
          "match": {
            "type": "payload-hmac-sha256",
            "secret": "YOUR_WEBHOOK_SECRET",
            "parameter": {
              "source": "header",
              "name": "X-Hub-Signature-256"
            }
          }
        },
        {
          "match": {
            "type": "value",
            "value": "refs/heads/main",
            "parameter": {
              "source": "payload",
              "name": "ref"
            }
          }
        }
      ]
    }
  }
]
```

```bash
# Start webhook service
webhook -hooks ~/.config/webhook/hooks.json -verbose -port 9000

# Untuk auto-start, buat systemd service:
sudo nano /etc/systemd/system/webhook.service
```

Isi `webhook.service`:
```ini
[Unit]
Description=Webhook Service
After=network.target

[Service]
Type=simple
User=YOUR_USERNAME
ExecStart=/usr/bin/webhook -hooks /home/YOUR_USERNAME/.config/webhook/hooks.json -verbose -port 9000
Restart=on-failure

[Install]
WantedBy=multi-user.target
```

```bash
# Enable & start service
sudo systemctl daemon-reload
sudo systemctl enable webhook
sudo systemctl start webhook
sudo systemctl status webhook

# Open port di firewall
sudo ufw allow 9000/tcp
```

### 4.3 Setup GitHub Webhook

1. Buka repository di GitHub
2. Pergi ke **Settings** → **Webhooks** → **Add webhook**
3. Isi:
   - **Payload URL**: `http://YOUR_IP_OR_DOMAIN:9000/hooks/deploy-dipatalent`
   - **Content type**: `application/json`
   - **Secret**: `YOUR_WEBHOOK_SECRET` (sama dengan di hooks.json)
   - **Events**: Just the push event
   - **Active**: ✅
4. **Add webhook**

### 4.4 Alternative: GitHub Actions Self-Hosted Runner

```bash
# Download runner
mkdir ~/actions-runner && cd ~/actions-runner
curl -o actions-runner-linux-x64-2.311.0.tar.gz -L https://github.com/actions/runner/releases/download/v2.311.0/actions-runner-linux-x64-2.311.0.tar.gz
tar xzf actions-runner-linux-x64-2.311.0.tar.gz

# Configure
./config.sh --url https://github.com/YOUR_USERNAME/dipaTalent_project --token YOUR_REGISTRATION_TOKEN

# Install & start as service
sudo ./svc.sh install
sudo ./svc.sh start
sudo ./svc.sh status
```

Buat file `.github/workflows/deploy.yml` di Windows:

```yaml
name: Deploy to Linux Server

on:
  push:
    branches: [ main ]

jobs:
  deploy:
    runs-on: self-hosted
    
    steps:
    - uses: actions/checkout@v3
    
    - name: Deploy Application
      run: |
        cd ~/projects/dipaTalent_project
        git pull origin main
        docker-compose down
        docker-compose build --no-cache
        docker-compose up -d
        sleep 10
        docker-compose exec -T app php artisan migrate --force
        docker-compose exec -T app php artisan config:cache
        docker-compose exec -T app php artisan route:cache
        docker-compose exec -T app php artisan view:cache
        docker-compose exec -T app chown -R www-data:www-data /var/www/html/storage
```

---

## 🌐 Part 5: Akses dari Internet

### 5.1 Cek IP Public

```bash
# Cek IP public
curl ifconfig.me

# Catat IP ini
```

### 5.2 Port Forwarding (Jika menggunakan router)

Jika nanti pakai WiFi LAN:
1. Akses router admin (biasanya 192.168.1.1)
2. Setup port forwarding:
   - External Port 80 → Internal IP:8000
   - External Port 443 → Internal IP:8000

### 5.3 Setup Reverse Proxy dengan Nginx (Production)

```bash
# Install Nginx di host
sudo pacman -S nginx certbot certbot-nginx

# Configure Nginx
sudo nano /etc/nginx/sites-available/dipatalent
```

Isi config:
```nginx
server {
    listen 80;
    server_name your-domain.com www.your-domain.com;

    location / {
        proxy_pass http://localhost:8000;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }
}
```

```bash
# Enable site
sudo ln -s /etc/nginx/sites-available/dipatalent /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx

# Setup SSL (jika sudah punya domain)
sudo certbot --nginx -d your-domain.com -d www.your-domain.com
```

---

## 📊 Part 6: Monitoring & Maintenance

### 6.1 Setup Monitoring

```bash
# Install monitoring tools
sudo pacman -S htop nethogs ncdu

# Monitor Docker
docker stats

# Monitor logs real-time
docker-compose logs -f --tail=50
```

### 6.2 Backup Database

```bash
# Create backup script
nano ~/scripts/backup-database.sh
```

Isi:
```bash
#!/bin/bash

BACKUP_DIR=~/backups/database
DATE=$(date +%Y%m%d_%H%M%S)
PROJECT_DIR=~/projects/dipaTalent_project

mkdir -p $BACKUP_DIR

cd $PROJECT_DIR
docker-compose exec -T db mysqldump -u dipatalent_user -pdipatalent_password dipatalent > $BACKUP_DIR/backup_$DATE.sql

# Keep only last 7 days
find $BACKUP_DIR -name "backup_*.sql" -mtime +7 -delete

echo "Backup completed: backup_$DATE.sql"
```

```bash
chmod +x ~/scripts/backup-database.sh

# Setup cron untuk auto backup setiap hari jam 2 pagi
crontab -e
# Tambahkan:
0 2 * * * ~/scripts/backup-database.sh >> ~/scripts/backup.log 2>&1
```

### 6.3 Update Application

```bash
# Manual update
cd ~/projects/dipaTalent_project
git pull origin main
docker-compose down
docker-compose build --no-cache
docker-compose up -d

# Auto via webhook (sudah di setup di Part 4)
```

---

## 🔒 Part 7: Security Hardening

### 7.1 SSH Security

```bash
# Edit SSH config
sudo nano /etc/ssh/sshd_config
```

Ubah:
```
PermitRootLogin no
PasswordAuthentication no
PubkeyAuthentication yes
Port 2222  # Ubah dari 22
```

```bash
sudo systemctl restart sshd

# Update firewall
sudo ufw delete allow ssh
sudo ufw allow 2222/tcp
```

### 7.2 Fail2Ban

```bash
# Install
sudo pacman -S fail2ban

# Configure
sudo cp /etc/fail2ban/jail.conf /etc/fail2ban/jail.local
sudo nano /etc/fail2ban/jail.local
```

Tambahkan:
```ini
[sshd]
enabled = true
port = 2222
maxretry = 3
bantime = 3600

[nginx-http-auth]
enabled = true
```

```bash
sudo systemctl enable fail2ban
sudo systemctl start fail2ban
```

### 7.3 Docker Security

```bash
# Set proper file permissions
sudo chown -R $USER:$USER ~/projects/dipaTalent_project
chmod -R 755 ~/projects/dipaTalent_project
chmod -R 775 ~/projects/dipaTalent_project/storage

# Update .env permissions
chmod 600 ~/projects/dipaTalent_project/.env
```

---

## 📝 Part 8: Troubleshooting

### 8.1 Container tidak start

```bash
# Cek logs
docker-compose logs app
docker-compose logs db

# Restart
docker-compose restart

# Rebuild
docker-compose down
docker-compose build --no-cache
docker-compose up -d
```

### 8.2 Database connection error

```bash
# Cek DB status
docker-compose ps db

# Cek logs
docker-compose logs db

# Test connection
docker-compose exec app php artisan tinker
# Di tinker: DB::connection()->getPdo();
```

### 8.3 Permission errors

```bash
# Fix storage permissions
docker-compose exec app chown -R www-data:www-data /var/www/html/storage
docker-compose exec app chmod -R 775 /var/www/html/storage
docker-compose exec app chmod -R 775 /var/www/html/bootstrap/cache
```

### 8.4 Out of memory

```bash
# Cek memory usage
free -h
docker stats

# Limit Docker memory di docker-compose.yml
# Tambahkan di service app:
#   mem_limit: 512m
#   memswap_limit: 512m
```

### 8.5 Hotspot disconnected

```bash
# Auto-reconnect script
nano ~/scripts/check-internet.sh
```

Isi:
```bash
#!/bin/bash

HOTSPOT_NAME="YOUR_HOTSPOT_NAME"
HOTSPOT_PASSWORD="YOUR_PASSWORD"

if ! ping -c 1 8.8.8.8 &> /dev/null; then
    echo "Internet down, reconnecting..."
    nmcli device wifi connect "$HOTSPOT_NAME" password "$HOTSPOT_PASSWORD"
    sleep 5
    
    # Update Dynamic DNS if needed
    ~/duckdns/duck.sh
fi
```

```bash
chmod +x ~/scripts/check-internet.sh

# Add to cron
crontab -e
# Tambahkan:
*/5 * * * * ~/scripts/check-internet.sh >> ~/scripts/internet.log 2>&1
```

---

## 🚀 Quick Start Commands

```bash
# 1. Initial Setup (run once)
sudo pacman -S docker docker-compose git
sudo systemctl start docker && sudo systemctl enable docker
sudo usermod -aG docker $USER

# 2. Clone & Configure
cd ~/projects
git clone git@github.com:YOUR_USERNAME/dipaTalent_project.git
cd dipaTalent_project
cp .env.example .env
nano .env  # Edit sesuai kebutuhan

# 3. Deploy
docker-compose build --no-cache
docker-compose up -d
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate --force
docker-compose exec app php artisan db:seed --force
docker-compose exec app php artisan config:cache

# 4. Verify
docker-compose ps
curl http://localhost:8000

# 5. Get your public IP
curl ifconfig.me

# Access from other devices:
# http://YOUR_PUBLIC_IP:8000
```

---

## 📱 Access URLs

Setelah deploy, akses aplikasi:

**Dari Linux Server:**
- App: http://localhost:8000
- PHPMyAdmin: http://localhost:8080

**Dari Device Lain (HP/Laptop di network sama):**
- App: http://YOUR_LINUX_IP:8000
- PHPMyAdmin: http://YOUR_LINUX_IP:8080

**Dari Internet (jika setup DuckDNS/No-IP):**
- App: http://your-subdomain.duckdns.org:8000

---

## 🎯 Development Workflow

```bash
# Di Windows (Development)
# 1. Coding...
# 2. Test locally
# 3. Commit & push
git add .
git commit -m "Your message"
git push origin main

# Di Linux (Auto-deploy via webhook atau manual)
cd ~/projects/dipaTalent_project
git pull origin main
docker-compose down
docker-compose up -d --build
docker-compose exec app php artisan migrate --force
docker-compose exec app php artisan config:cache
```

---

## ✅ Checklist

- [ ] Docker & Docker Compose installed
- [ ] Project cloned from GitHub
- [ ] .env configured
- [ ] Firewall configured (UFW)
- [ ] Connected to internet (hotspot/WiFi)
- [ ] Containers running
- [ ] Database migrated
- [ ] Application accessible
- [ ] Webhook/CI-CD configured (optional)
- [ ] Backup script setup
- [ ] Monitoring setup

---

## 📚 Resources

- Docker: https://docs.docker.com/
- Laravel Deployment: https://laravel.com/docs/deployment
- Arch Wiki Docker: https://wiki.archlinux.org/title/Docker
- DuckDNS: https://www.duckdns.org/
- Let's Encrypt: https://letsencrypt.org/

---

## 🆘 Support

Jika ada masalah:
1. Cek logs: `docker-compose logs -f`
2. Cek status: `docker-compose ps`
3. Restart: `docker-compose restart`
4. Rebuild: `docker-compose down && docker-compose up -d --build`

---

**Happy Deploying! 🚀**
