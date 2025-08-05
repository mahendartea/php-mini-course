# 🐳 Docker Setup untuk PHP Mini Course

## 📋 Prasyarat
- Docker Desktop terinstall di macOS Anda
- Terminal/Command Line

## 🚀 Cara Menjalankan dengan Docker

### 1. Pastikan Docker Desktop Running
Buka Docker Desktop dan pastikan sudah berjalan.

### 2. Clone Repository (jika belum)
```bash
git clone https://github.com/mahendartea/php-mini-course.git
cd php-mini-course
```

### 3. Jalankan Docker Container
```bash
docker-compose up -d
```

### 4. Akses Course di Browser
Buka browser dan akses:
```
http://localhost:8080
```

### 5. Akses File Specific
Untuk mengakses file tertentu:
```
http://localhost:8080/pertemuan-01/hello-world.php
http://localhost:8080/pertemuan-02/biodata.php
http://localhost:8080/pertemuan-03/kalkulator.php
# dst...
```

### 6. Stop Container (jika diperlukan)
```bash
docker-compose down
```

## 🔧 Command Berguna

### Lihat Status Container
```bash
docker-compose ps
```

### Lihat Logs
```bash
docker-compose logs
```

### Restart Container
```bash
docker-compose restart
```

### Masuk ke Container (untuk debugging)
```bash
docker-compose exec php bash
```

## 📝 Konfigurasi Docker

File `docker-compose.yml` menggunakan:
- **Image**: PHP 8.2 dengan Apache
- **Port**: 8080 (host) → 80 (container)
- **Volume**: Folder project di-mount ke `/var/www/html`
- **Auto-restart**: Container akan restart otomatis

## 🎯 Kelebihan Docker

✅ **No Configuration**: Tidak perlu install PHP/Apache secara manual
✅ **Consistent Environment**: Sama di semua sistem
✅ **Easy Management**: Start/stop dengan satu command
✅ **Isolated**: Tidak mengganggu sistem macOS Anda
✅ **PHP 8.2**: Versi PHP terbaru dan stabil

## 🛠️ Troubleshooting

### Port 8080 sudah digunakan?
Edit `docker-compose.yml` dan ganti port:
```yaml
ports:
  - "8081:80"  # Gunakan port 8081
```

### Permission Issues?
```bash
sudo chown -R $(whoami) .
```

### Container tidak start?
```bash
docker-compose down
docker-compose up -d --force-recreate
```

---

**Happy Coding with Docker!** 🐳🚀
