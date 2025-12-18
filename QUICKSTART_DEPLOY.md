# 🚀 Quick Start - Deploy dari Linux ke Render

## Di Linux (Arch Endeavour)

### 1. Install Dependencies
```bash
sudo pacman -S php composer nodejs npm git
```

### 2. Clone Project
```bash
cd ~
git clone https://github.com/dayattt111/project_dipaTalent.git
cd project_dipaTalent
```

### 3. Setup Project
```bash
# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Build assets
npm run build
```

### 4. Connect ke Hotspot HP
```bash
# Connect via WiFi
nmcli device wifi connect "Nama_Hotspot" password "password123"

# Test connection
ping google.com
```

### 5. Setup Git
```bash
# Configure git
git config --global user.name "dayattt111"
git config --global user.email "your-email@example.com"

# Setup GitHub authentication
# Opsi 1: Personal Access Token (saat push, gunakan token sebagai password)
# Opsi 2: SSH Key
ssh-keygen -t ed25519 -C "your-email@example.com"
cat ~/.ssh/id_ed25519.pub  # Copy ke GitHub Settings → SSH Keys
```

### 6. Push ke GitHub
```bash
git add .
git commit -m "ready for deployment"
git push origin master
```

---

## Di Render Dashboard

### 1. Create Web Service
- Login: https://dashboard.render.com
- New + → Web Service
- Connect: github.com/dayattt111/project_dipaTalent
- Name: `dipatalent-app`
- Runtime: `Docker`
- Dockerfile Path: `./Dockerfile.render`
- Branch: `master`

### 2. Create Database
- New + → PostgreSQL
- Name: `dipatalent-db`
- Save credentials!

### 3. Environment Variables
Tambahkan di Web Service → Environment:

```bash
APP_NAME="Dipa Talent"
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_GENERATED_KEY
APP_URL=https://dipatalent-app.onrender.com

DB_CONNECTION=pgsql
DB_HOST=dpg-xxxxxxxxx-a
DB_PORT=5432
DB_DATABASE=dipatalent
DB_USERNAME=dipatalent_user
DB_PASSWORD=xxxxxxxxxxxxxxx

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

### 4. Deploy!
- Click "Create Web Service"
- Wait 5-10 menit
- Access: https://dipatalent-app.onrender.com

---

## Troubleshooting

### Build Failed
```bash
# Check logs di Render Dashboard
# Clear build cache: Settings → Clear Build Cache
```

### Database Error
```bash
# Pastikan DB credentials benar
# DB_CONNECTION harus 'pgsql' bukan 'mysql'
```

### Assets Not Loading
```bash
# Pastikan npm run build berhasil
# Check public/build folder exists
```

---

## Update Deployment

```bash
# Edit code
# Commit & push
git add .
git commit -m "update feature"
git push origin master

# Render auto-deploy!
```

---

## Commands Reference

```bash
# Test local
php artisan serve

# Clear cache
php artisan cache:clear
php artisan config:clear

# Check logs (Render)
# Dashboard → Logs

# Run migrations (Render Shell)
php artisan migrate --force

# Optimize (Render Shell)
php artisan optimize
```

---

📖 **Full Guide**: DEPLOY_LINUX_TO_RENDER.md
🤖 **Auto Script**: `bash deploy-to-render.sh`
