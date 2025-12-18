# 🚀 Quick Start Guide - Linux Deployment

## Dari Windows (Development)

### 1. Commit & Push Code
```bash
cd C:\laragon\www\dipaTalent_project
git add .
git commit -m "ready for deployment"
git push origin main
```

---

## Di Linux Laptop (Production Server)

### Setup Awal (Hanya sekali)

```bash
# 1. Transfer project ke Linux
# Copy folder scripts ke Linux atau clone dari GitHub

# 2. Jalankan setup script
cd ~/Downloads  # atau tempat Anda simpan script
chmod +x setup-linux-server.sh
./setup-linux-server.sh

# 3. Logout & Login lagi (untuk docker group)
exit
# Login lagi

# 4. Koneksi ke hotspot
nmcli device wifi connect "NAMA_HOTSPOT" password "PASSWORD"

# 5. Clone project
cd ~/projects
git clone git@github.com:USERNAME/dipaTalent_project.git
cd dipaTalent_project

# 6. Setup environment
cp .env.example.production .env
nano .env  # Edit sesuai kebutuhan

# 7. Generate APP_KEY
docker run --rm -v $(pwd):/app composer:2 bash -c "cd /app && composer install --no-dev && php artisan key:generate --show"
# Copy output ke .env

# 8. Deploy!
chmod +x scripts/deploy-linux.sh
./scripts/deploy-linux.sh deploy --with-seed
```

### Deploy Selanjutnya

```bash
# Update code dari Git
cd ~/projects/dipaTalent_project
git pull origin main

# Quick deploy (tanpa rebuild)
./scripts/deploy-linux.sh quick

# Full deploy (dengan rebuild)
./scripts/deploy-linux.sh deploy
```

---

## Commands Berguna

```bash
# Status containers
./scripts/deploy-linux.sh status

# Lihat logs
./scripts/deploy-linux.sh logs

# Health check
./scripts/deploy-linux.sh health

# Backup database
./scripts/deploy-linux.sh backup

# Restore database
./scripts/deploy-linux.sh restore ~/backups/database/backup_YYYYMMDD_HHMMSS.sql

# Restart containers
./scripts/deploy-linux.sh restart

# Stop containers
./scripts/deploy-linux.sh stop

# Start containers
./scripts/deploy-linux.sh start
```

---

## Akses Aplikasi

### Dari Linux Server
```
http://localhost:8000
http://localhost:8080  (PHPMyAdmin)
```

### Dari HP/Device lain (satu network)
```bash
# Cek IP Linux
ip addr show

# Akses dari browser HP
http://IP_LINUX:8000
```

### Dari Internet (dengan port forwarding)
```bash
# Cek IP Public
curl ifconfig.me

# Akses dari browser
http://IP_PUBLIC:8000
```

---

## Setup CI/CD Auto-Deploy

### Option 1: Webhook (Recommended untuk Hotspot)

```bash
# 1. Edit webhook config
cd ~/projects/dipaTalent_project/scripts
cp webhook-hooks.json ~/.config/webhook/
nano ~/.config/webhook/hooks.json
# Ubah YOUR_USERNAME dan YOUR_WEBHOOK_SECRET

# 2. Setup webhook script
chmod +x deploy-dipatalent-webhook.sh
cp deploy-dipatalent-webhook.sh ~/scripts/

# 3. Install webhook service
sudo cp webhook.service /etc/systemd/system/
sudo nano /etc/systemd/system/webhook.service
# Ubah YOUR_USERNAME

sudo systemctl daemon-reload
sudo systemctl enable webhook
sudo systemctl start webhook
sudo systemctl status webhook

# 4. Open firewall
sudo ufw allow 9000/tcp

# 5. Setup di GitHub
# Pergi ke: https://github.com/USERNAME/REPO/settings/hooks
# Add webhook:
#   URL: http://YOUR_IP:9000/hooks/deploy-dipatalent
#   Content type: application/json
#   Secret: YOUR_WEBHOOK_SECRET (sama dengan di hooks.json)
#   Events: Just the push event

# Test: Push code dari Windows, otomatis deploy!
```

### Option 2: GitHub Actions Self-Hosted Runner

```bash
# 1. Download runner
mkdir ~/actions-runner && cd ~/actions-runner
curl -o actions-runner-linux-x64-2.311.0.tar.gz -L \
  https://github.com/actions/runner/releases/download/v2.311.0/actions-runner-linux-x64-2.311.0.tar.gz
tar xzf actions-runner-linux-x64-2.311.0.tar.gz

# 2. Configure (dapatkan token dari GitHub Settings > Actions > Runners)
./config.sh --url https://github.com/USERNAME/dipaTalent_project \
  --token YOUR_RUNNER_TOKEN

# 3. Install as service
sudo ./svc.sh install
sudo ./svc.sh start

# Workflow sudah ada di .github/workflows/deploy-linux.yml
# Push code = auto deploy!
```

---

## Troubleshooting

### Container tidak start
```bash
docker-compose logs app
docker-compose restart
```

### Database error
```bash
docker-compose logs db
docker-compose restart db
```

### Permission error
```bash
./scripts/deploy-linux.sh deploy
# Script otomatis fix permissions
```

### Hotspot disconnect
```bash
# Auto-reconnect sudah disetup oleh setup script
# Manual reconnect:
nmcli device wifi connect "HOTSPOT_NAME" password "PASSWORD"
```

### Out of memory
```bash
# Check memory
free -h
docker stats

# Stop unused containers
docker stop $(docker ps -q)
docker system prune -a
```

---

## Cek IP untuk Akses

```bash
# Local IP
hostname -I

# Public IP
curl ifconfig.me

# Atau
curl icanhazip.com
```

---

## Update .env Production

Jika perlu update environment variables:

```bash
cd ~/projects/dipaTalent_project
nano .env

# Restart containers
./scripts/deploy-linux.sh restart
```

---

## Monitoring

```bash
# Real-time logs
docker-compose logs -f

# Resource usage
docker stats

# System resources
htop

# Network usage
sudo nethogs

# Disk usage
ncdu ~
```

---

## Backup & Restore

```bash
# Manual backup
./scripts/deploy-linux.sh backup

# Auto backup (sudah disetup cron - setiap hari jam 2 pagi)
# Lihat hasil: ls ~/backups/database/

# Restore
./scripts/deploy-linux.sh restore ~/backups/database/backup_20250115_020000.sql
```

---

## Keamanan

```bash
# Update system
sudo pacman -Syu

# Update containers
cd ~/projects/dipaTalent_project
git pull
./scripts/deploy-linux.sh deploy

# Check firewall
sudo ufw status

# Check fail2ban
sudo fail2ban-client status
```

---

## Port yang Digunakan

- 8000: Laravel Application
- 8080: PHPMyAdmin
- 3306: MySQL (internal)
- 9000: Webhook (jika diaktifkan)
- 80/443: HTTP/HTTPS (jika pakai Nginx)

---

**Selamat Deploy! 🚀**

Untuk panduan lengkap, baca: [README.Linux-Deploy.md](README.Linux-Deploy.md)
