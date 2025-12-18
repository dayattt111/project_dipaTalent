# 🚀 Panduan Deploy Laravel dari Linux ke Render

## 📋 Persiapan di Laptop Linux (Arch Endeavour)

### 1. Install Dependencies yang Diperlukan

```bash
# Update system
sudo pacman -Syu

# Install PHP 8.2 dan extensions
sudo pacman -S php php-fpm php-gd php-intl php-sqlite php-pgsql composer

# Install Node.js dan npm
sudo pacman -S nodejs npm

# Install Git
sudo pacman -S git

# Verifikasi instalasi
php -v        # Harus PHP 8.2+
node -v       # Harus Node 18+
npm -v
git --version
composer -v
```

### 2. Transfer Project dari Windows ke Linux

**Opsi A: Via GitHub (RECOMMENDED)**

```bash
# Di laptop Windows, pastikan sudah push ke GitHub
git add .
git commit -m "prepare for deployment"
git push origin master

# Di laptop Linux, clone repository
cd ~
mkdir projects
cd projects
git clone https://github.com/dayattt111/project_dipaTalent.git
cd project_dipaTalent
```

**Opsi B: Via Network Share (jika kedua laptop terhubung)**

```bash
# Di Linux, mount shared folder Windows
# Atau copy via USB/external drive
cp -r /mnt/usb/dipaTalent_project ~/projects/
cd ~/projects/dipaTalent_project
```

**Opsi C: Via SCP (jika SSH server aktif di Windows)**

```bash
# Di Linux
scp -r user@windows-ip:/c/laragon/www/dipaTalent_project ~/projects/
cd ~/projects/dipaTalent_project
```

### 3. Setup Project di Linux

```bash
# Masuk ke directory project
cd ~/projects/dipaTalent_project

# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Build assets
npm run build

# Test local (optional)
php artisan serve
# Akses: http://localhost:8000
```

---

## 🌐 Deploy ke Render

### 1. Persiapan Repository

```bash
# Pastikan semua perubahan sudah di commit
git status
git add .
git commit -m "ready for render deployment"

# Push ke GitHub
git push origin master

# Jika belum setup remote
git remote add origin https://github.com/dayattt111/project_dipaTalent.git
git push -u origin master
```

### 2. Setup di Render Dashboard

#### A. Buat Web Service

1. **Login ke Render**
   - Buka browser: https://dashboard.render.com
   - Login atau signup dengan GitHub

2. **Create New Web Service**
   - Klik "New +" → "Web Service"
   - Connect GitHub repository: `dayattt111/project_dipaTalent`
   - Authorize Render untuk akses repo

3. **Konfigurasi Service**
   ```
   Name: dipatalent-app
   Region: Singapore (terdekat)
   Branch: master
   Runtime: Docker
   Instance Type: Free (atau sesuai kebutuhan)
   ```

4. **Advanced Settings**
   - Dockerfile Path: `./Dockerfile.render`
   - Build Command: (kosongkan, sudah di Dockerfile)
   - Start Command: (kosongkan, sudah di Dockerfile)

#### B. Buat Database PostgreSQL

**CATATAN: Render tidak support MySQL gratis, gunakan PostgreSQL**

1. **Create PostgreSQL Database**
   - Klik "New +" → "PostgreSQL"
   - Name: `dipatalent-db`
   - Database: `dipatalent`
   - User: `dipatalent_user`
   - Region: Singapore (sama dengan app)
   - Instance Type: Free

2. **Catat Credentials**
   ```
   Internal Database URL: postgres://...
   External Database URL: postgres://...
   PSQL Command: psql -h ...
   ```

### 3. Konfigurasi Environment Variables

Di Render Web Service → Environment:

```bash
# Application
APP_NAME="Dipa Talent"
APP_ENV=production
APP_DEBUG=false
APP_TIMEZONE=Asia/Jakarta
APP_URL=https://dipatalent-app.onrender.com
APP_KEY=base64:YOUR_KEY_HERE

# Database (dari PostgreSQL credentials)
DB_CONNECTION=pgsql
DB_HOST=dpg-xxxxxxxxxxxxx-a
DB_PORT=5432
DB_DATABASE=dipatalent
DB_USERNAME=dipatalent_user
DB_PASSWORD=xxxxxxxxxxxxx

# Session & Cache
SESSION_DRIVER=database
SESSION_LIFETIME=120
CACHE_STORE=database
QUEUE_CONNECTION=database

# Filesystem
FILESYSTEM_DISK=local

# Mail (gunakan Mailtrap atau SMTP)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@dipatalent.com
MAIL_FROM_NAME="${APP_NAME}"

# Logging
LOG_CHANNEL=stack
LOG_LEVEL=error

# Build
BUILD_COMMAND="npm ci && npm run build && composer install --optimize-autoloader --no-dev"
```

### 4. Update Kode untuk PostgreSQL

**Buat file: `config/database.php` adjustment**

PostgreSQL sudah support di Laravel, tapi perlu update migration untuk compatibility.

```bash
# Di Linux, edit migrations jika ada MySQL specific syntax
# Contoh: ubah 'string' length dari 255 ke 191 untuk index
```

### 5. Deploy!

```bash
# Push final changes
git add .
git commit -m "configure for render deployment with postgresql"
git push origin master

# Render akan otomatis detect push dan deploy
# Tunggu proses build (~5-10 menit)
```

---

## 🔧 Troubleshooting

### Jika Build Gagal

```bash
# Check logs di Render Dashboard
# Biasanya masalah:
# 1. PHP version tidak sesuai
# 2. Extension PHP kurang
# 3. npm build gagal
# 4. Composer dependencies error
```

**Solusi:**

1. **Update Dockerfile.render** untuk PHP extensions:
```dockerfile
RUN apt-get update && apt-get install -y \
    php8.2-pgsql \
    php8.2-gd \
    php8.2-zip \
    php8.2-mbstring
```

2. **Clear build cache** di Render:
   - Settings → Clear Build Cache → Trigger Deploy

### Jika Database Connection Gagal

```bash
# Test connection dari Render shell
php artisan tinker
DB::connection()->getPdo();

# Jika error, cek:
# 1. DB credentials di Environment Variables
# 2. DB_CONNECTION=pgsql (bukan mysql)
# 3. Database sudah dibuat di Render
```

### Migration Error

```bash
# Run migrations manual
# Di Render Dashboard → Shell
php artisan migrate --force

# Jika error foreign key, run satu per satu
php artisan migrate:fresh --force
```

---

## 📱 Akses dari Hotspot HP

### Setup di Linux (dengan Hotspot HP)

```bash
# 1. Connect ke hotspot HP
nmcli device wifi connect "Nama_Hotspot_HP" password "password123"

# 2. Cek koneksi
ping google.com
ping render.com

# 3. Configure Git dengan credentials
git config --global user.name "dayattt111"
git config --global user.email "your-email@example.com"

# 4. Setup GitHub authentication
# Opsi A: Personal Access Token (RECOMMENDED)
# - Buka GitHub → Settings → Developer Settings → Personal Access Tokens
# - Generate token dengan repo access
# - Use token sebagai password saat git push

# Opsi B: SSH Key
ssh-keygen -t ed25519 -C "your-email@example.com"
cat ~/.ssh/id_ed25519.pub
# Copy dan tambahkan ke GitHub → Settings → SSH Keys
```

### Tips Koneksi Hotspot HP

```bash
# Jika koneksi lambat/timeout
# 1. Pastikan kuota internet cukup
# 2. Posisikan HP dekat dengan laptop
# 3. Matikan aplikasi lain yang menggunakan internet

# 4. Set Git untuk handle slow connection
git config --global http.postBuffer 524288000
git config --global http.lowSpeedLimit 0
git config --global http.lowSpeedTime 999999

# 5. Use shallow clone untuk save bandwidth
git clone --depth 1 https://github.com/dayattt111/project_dipaTalent.git
```

---

## 🔄 Workflow Development

### Edit dari Windows, Deploy dari Linux

```bash
# 1. Edit code di Windows laptop
# 2. Commit & push dari Windows
cd C:\laragon\www\dipaTalent_project
git add .
git commit -m "update feature"
git push origin master

# 3. Pull di Linux & re-deploy (jika perlu test local)
cd ~/projects/dipaTalent_project
git pull origin master
npm run build
php artisan config:clear

# 4. Push ke GitHub akan trigger auto-deploy di Render
```

### Nanti Pindah ke WiFi LAN

```bash
# 1. Disconnect dari hotspot
nmcli device disconnect wlan0

# 2. Connect ke WiFi LAN
nmcli device wifi connect "Nama_WiFi_LAN" password "wifi_password"

# 3. Test koneksi
ping google.com

# 4. Continue deploy process
git push origin master
```

---

## ✅ Checklist Deploy

- [ ] Linux laptop setup (PHP, Node, Git installed)
- [ ] Project di-clone dari GitHub ke Linux
- [ ] `composer install` dan `npm install` berhasil
- [ ] `npm run build` berhasil generate assets
- [ ] Repository pushed ke GitHub
- [ ] Render account created dan connected ke GitHub
- [ ] Web Service created di Render
- [ ] PostgreSQL Database created di Render
- [ ] Environment variables configured
- [ ] Dockerfile.render sudah ada dan correct
- [ ] First deploy triggered
- [ ] Build success dan app running
- [ ] Migrations executed
- [ ] Storage linked
- [ ] App accessible via Render URL
- [ ] Test login dan fitur utama

---

## 🎯 URL Penting

- **Render Dashboard**: https://dashboard.render.com
- **Deployed App**: https://dipatalent-app.onrender.com
- **GitHub Repo**: https://github.com/dayattt111/project_dipaTalent
- **PHP Docs**: https://www.php.net/manual/en/
- **Laravel Docs**: https://laravel.com/docs
- **Render Docs**: https://render.com/docs

---

## 💡 Tips & Best Practices

### 1. Save Bandwidth (penting untuk hotspot)

```bash
# Clone dengan depth 1
git clone --depth 1 <repo-url>

# Download dependencies via cache
composer install --prefer-dist --no-dev

# Compress git objects
git gc --aggressive
```

### 2. Monitor Deployment

```bash
# Check logs di Render Dashboard
# Logs → View Logs

# Set notification
# Settings → Notifications → Slack/Email
```

### 3. Backup Database

```bash
# Export dari Render PostgreSQL
pg_dump -h your-host -U user -d database > backup.sql

# Di Linux, bisa schedule backup
crontab -e
# Add: 0 2 * * * pg_dump ... > ~/backups/db_$(date +\%Y\%m\%d).sql
```

### 4. Performance Optimization

```bash
# Di Render Shell
php artisan optimize
php artisan view:cache
php artisan route:cache
php artisan config:cache
```

---

## 🆘 Support

Jika ada masalah:

1. **Check Render Logs**: Dashboard → Logs
2. **Check GitHub Actions**: Repo → Actions
3. **Test Local**: `php artisan serve`
4. **Render Community**: https://community.render.com
5. **Laravel Forum**: https://laracasts.com/discuss

---

## 📝 Notes

- Free tier Render akan sleep setelah 15 menit tidak ada traffic
- First request setelah sleep akan lambat (~30 detik)
- Upgrade ke paid tier untuk always-on service
- PostgreSQL free tier: 1 GB storage, 90 days retention
- Build time: ~5-10 menit
- Cold start: ~30 detik

---

Good luck dengan deployment! 🚀
