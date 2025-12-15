# 🚀 Deploy Dipa Talent ke Render

Panduan lengkap untuk deploy aplikasi Laravel Dipa Talent ke platform Render.

## 📋 Prerequisites

- Akun GitHub (untuk push code)
- Akun Render (gratis): https://render.com
- Repository GitHub dengan code project ini

---

## 🎯 Langkah-langkah Deploy

### 1️⃣ Persiapan Repository

```bash
# Pastikan semua file sudah di commit
git add .
git commit -m "Prepare for Render deployment"
git push origin master
```

### 2️⃣ Setup di Render Dashboard

#### A. Login ke Render
1. Buka https://render.com
2. Sign up atau Login (bisa pakai GitHub)
3. Klik **Dashboard**

#### B. Buat MySQL Database (Free)
1. Klik **New +** → **MySQL**
2. Isi detail:
   - **Name**: `dipatalent-db`
   - **Database**: `dipatalent`
   - **User**: (otomatis)
   - **Region**: `Singapore` (pilih terdekat)
   - **Plan**: `Free` (512MB RAM, 1GB Storage)
3. Klik **Create Database**
4. ⏳ Tunggu 2-3 menit sampai status jadi **Available**
5. 📝 **Catat informasi koneksi** (akan digunakan nanti):
   - Internal Database URL
   - External Database URL
   - Host
   - Port
   - Username
   - Password

#### C. Buat Web Service
1. Klik **New +** → **Web Service**
2. Connect ke GitHub repository
   - Pilih repository `dipaTalent_project`
   - Klik **Connect**
3. Isi detail:
   - **Name**: `dipatalent-app`
   - **Region**: `Singapore`
   - **Branch**: `master`
   - **Runtime**: `Docker`
   - **Dockerfile Path**: `./Dockerfile.render`
   - **Plan**: `Free` atau `Starter $7/month`

#### D. Setup Environment Variables
Scroll ke **Environment Variables**, tambahkan satu per satu:

**Aplikasi:**
```env
APP_NAME=Dipa Talent
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:GENERATE_THIS_LATER
APP_URL=https://dipatalent-app.onrender.com
APP_TIMEZONE=Asia/Jakarta
```

**Database (gunakan info dari step B):**
```env
DB_CONNECTION=mysql
DB_HOST=[INTERNAL_HOST_FROM_DATABASE]
DB_PORT=3306
DB_DATABASE=dipatalent
DB_USERNAME=[USERNAME_FROM_DATABASE]
DB_PASSWORD=[PASSWORD_FROM_DATABASE]
```

**Session & Cache:**
```env
SESSION_DRIVER=database
SESSION_LIFETIME=120
CACHE_STORE=database
QUEUE_CONNECTION=database
```

**Log:**
```env
LOG_CHANNEL=errorlog
LOG_LEVEL=error
```

**Mail (Optional):**
```env
MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
```

**Build Configuration:**
```env
RUN_MIGRATIONS=true
PORT=10000
```

4. Klik **Create Web Service**

---

### 3️⃣ Generate APP_KEY

Setelah deployment pertama selesai (akan error karena APP_KEY kosong):

1. Buka **Shell** di Render Dashboard
2. Jalankan:
   ```bash
   php artisan key:generate --show
   ```
3. Copy output `base64:...`
4. Buka **Environment** tab
5. Edit `APP_KEY` dan paste value yang di-copy
6. Save → Service akan auto-redeploy

---

### 4️⃣ Run Database Migrations

Setelah deployment berhasil:

1. Buka **Shell** tab di Render Dashboard
2. Jalankan command:
   ```bash
   # Run migrations
   php artisan migrate --force

   # Seed data (optional)
   php artisan db:seed --force
   
   # Create storage link
   php artisan storage:link
   
   # Optimize
   php artisan optimize
   ```

---

### 5️⃣ Update APP_URL

1. Setelah deploy selesai, salin URL Render:
   - Contoh: `https://dipatalent-app.onrender.com`
2. Update environment variable `APP_URL`
3. Clear cache:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

---

## 🎉 Akses Aplikasi

Aplikasi bisa diakses di:
- **URL**: `https://dipatalent-app.onrender.com`
- **Custom Domain**: Bisa setup di Render → Settings → Custom Domain

---

## 🔧 Troubleshooting

### ❌ Build Failed

**Cek logs:**
1. Buka tab **Logs** di Render Dashboard
2. Lihat error message
3. Perbaiki di local, commit, dan push

**Common issues:**
- Missing dependencies: Update `Dockerfile.render`
- Syntax error: Check PHP/JavaScript code
- Out of memory: Upgrade ke Starter plan

### ❌ Database Connection Error

**Verify database info:**
```bash
# Di Render Shell
php artisan tinker
DB::connection()->getPdo();
```

**Fix:**
1. Cek DB credentials di Environment
2. Pastikan database status = Available
3. Gunakan **Internal Database URL** bukan External

### ❌ 500 Internal Server Error

**Check logs:**
```bash
# Di Render Shell
tail -n 100 storage/logs/laravel.log
```

**Common fixes:**
```bash
# Clear all cache
php artisan optimize:clear

# Rebuild config
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Fix permissions
chown -R www-data:www-data storage bootstrap/cache
```

### ❌ Assets Not Loading

**Run Vite build:**
```bash
npm run build
```

**Check public path:**
```bash
# Verify files exist
ls -la public/build
```

---

## 📊 Monitoring

### View Logs
1. Dashboard → Your Service
2. Tab **Logs** → Real-time logs
3. Filter: Error, Warning, Info

### Metrics
- Tab **Metrics**: CPU, Memory, Response time
- Tab **Events**: Deployment history

### Health Check
Render auto-checks: `https://dipatalent-app.onrender.com/health`

---

## 🔄 Update Aplikasi

```bash
# 1. Update code locally
git add .
git commit -m "Update feature X"
git push origin master

# 2. Render akan auto-deploy (jika auto-deploy enabled)
# Atau manual deploy di Dashboard → Deploy latest commit
```

---

## 💰 Pricing

### Free Tier Limits:
- **Web Service**: 750 jam/bulan, sleep after 15 min inactivity
- **Database**: 1GB storage, expires after 90 days
- **Bandwidth**: 100GB/month

### Upgrade ke Paid:
- **Starter**: $7/month (no sleep, 0.5GB RAM)
- **Standard**: $25/month (2GB RAM)
- **Pro**: $85/month (4GB RAM, priority support)

---

## 🔒 Security Best Practices

### 1. Environment Variables
✅ Jangan commit `.env` ke Git
✅ Gunakan Render Environment Variables
✅ Generate strong `APP_KEY`

### 2. Database
✅ Gunakan internal database URL
✅ Strong password
✅ Regular backups

### 3. SSL/HTTPS
✅ Otomatis enabled di Render
✅ Force HTTPS di Laravel (sudah setup)

### 4. Logs
✅ Set `APP_DEBUG=false` di production
✅ Monitor error logs regularly

---

## 📦 Backup Strategy

### Database Backup

**Manual:**
```bash
# Di Render Shell
mysqldump -h [DB_HOST] -u [DB_USER] -p[DB_PASS] dipatalent > backup.sql
```

**Automated:**
- Gunakan Render scheduled jobs (paid plan)
- Atau setup cron job external

### Storage Backup

**Download dari Render:**
```bash
# Zip storage files
tar -czf storage.tar.gz storage/app/public

# Download via Render shell
```

---

## 🚀 Performance Tips

### 1. Enable Caching
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 2. Optimize Composer
```bash
composer install --optimize-autoloader --no-dev
```

### 3. Use CDN for Assets
- Upload static assets (images, fonts) ke CDN
- Update paths di code

### 4. Database Indexing
```sql
-- Add indexes untuk query yang sering dipakai
CREATE INDEX idx_user_email ON users(email);
CREATE INDEX idx_prestasi_status ON prestasis(status);
```

---

## 📞 Support

### Render Support:
- Docs: https://render.com/docs
- Community: https://community.render.com
- Status: https://status.render.com

### Project Issues:
- Check Laravel logs: `storage/logs/laravel.log`
- Run diagnostics: `php artisan about`

---

## ✅ Deployment Checklist

Pre-deployment:
- [ ] Code tested locally
- [ ] All migrations created
- [ ] Frontend assets built
- [ ] Environment variables documented
- [ ] Database seeders ready (optional)

Post-deployment:
- [ ] APP_KEY generated
- [ ] Migrations run successfully
- [ ] Storage link created
- [ ] Cache optimized
- [ ] Test all major features
- [ ] Monitor logs for errors
- [ ] Setup custom domain (optional)
- [ ] Configure backups

---

## 🎓 Resources

- [Render Docs](https://render.com/docs)
- [Laravel Deployment](https://laravel.com/docs/deployment)
- [Docker Best Practices](https://docs.docker.com/develop/dev-best-practices/)

---

**Happy Deploying! 🎉**
