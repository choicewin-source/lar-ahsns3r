# إعداد سريع بعد رفع المشروع عبر Git 🚀

## معلومات قاعدة البيانات لديك
```
Database: u897582634_ahsansear
Username: u897582634_ahsansear
Password: Asd$Salt25$Sugar26
Host: localhost
```

---

## الخطوات (5-10 دقائق فقط)

### 1️⃣ الاتصال بالسيرفر عبر SSH

```bash
# استخدم معلومات SSH من Hostinger
ssh u897582634@ahsansaer.com -p 65002

# أو استخدم Terminal في لوحة Hostinger
```

### 2️⃣ الذهاب إلى مجلد المشروع

```bash
# اذهب إلى public_html
cd public_html

# تحقق من وجود الملفات
ls -la
```

يجب أن ترى:
- app/
- bootstrap/
- config/
- database/
- public/
- routes/
- storage/
- vendor/
- composer.json
- artisan

### 3️⃣ إنشاء ملف .env

```bash
# انسخ من المثال
cp .env.example .env

# أو إذا لم يكن موجود، أنشئ ملف جديد
nano .env
```

في محرر nano، الصق هذا المحتوى:

```env
APP_NAME="أحسن سعر"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_TIMEZONE=UTC
APP_URL=https://ahsansaer.com

APP_LOCALE=ar
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u897582634_ahsansear
DB_USERNAME=u897582634_ahsansear
DB_PASSWORD=Asd$Salt25$Sugar26

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=file
CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=noreply@ahsansaer.com
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@ahsansaer.com
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"
```

**للحفظ في nano**:
- اضغط `Ctrl + X`
- اضغط `Y` (نعم)
- اضغط `Enter`

### 4️⃣ تثبيت الحزم المطلوبة

```bash
# تثبيت حزم Composer (قد يستغرق 5 دقائق)
composer install --optimize-autoloader --no-dev

# إذا ظهر خطأ "composer not found"، استخدم:
php composer.phar install --optimize-autoloader --no-dev
```

⏳ انتظر حتى ينتهي...

### 5️⃣ توليد مفتاح التطبيق

```bash
# توليد APP_KEY
php artisan key:generate
```

يجب أن ترى: `Application key set successfully.`

### 6️⃣ إعداد أذونات المجلدات

```bash
# أذونات storage و cache
chmod -R 755 storage
chmod -R 755 bootstrap/cache

# أذونات .env
chmod 644 .env

# تأكد من ملكية الملفات
chown -R $USER:$USER storage bootstrap/cache
```

### 7️⃣ إنشاء symbolic link للتخزين

```bash
# إنشاء رابط بين storage و public
php artisan storage:link
```

يجب أن ترى: `The [public/storage] link has been connected to [storage/app/public].`

### 8️⃣ إعداد قاعدة البيانات

```bash
# تشغيل Migrations
php artisan migrate --force

# تشغيل Seeders (إنشاء البيانات الأولية)
php artisan db:seed --force
```

### 9️⃣ تحسين Laravel للإنتاج

```bash
# مسح جميع الكاش
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# تحسين للإنتاج
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

### 🔟 إعداد ملف .htaccess

```bash
# تحقق من وجود .htaccess في الجذر
ls -la .htaccess

# إذا لم يكن موجوداً، أنشئه:
nano .htaccess
```

الصق هذا المحتوى:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    
    # Redirect to public folder
    RewriteCond %{REQUEST_URI} !^/public/
    RewriteRule ^(.*)$ /public/$1 [L]
</IfModule>
```

احفظ (`Ctrl + X` ثم `Y` ثم `Enter`)

### 1️⃣1️⃣ إعداد .htaccess في مجلد public

```bash
# تحقق من .htaccess في public
cat public/.htaccess

# إذا لم يكن موجوداً أو فارغ:
nano public/.htaccess
```

الصق هذا:

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Force HTTPS
    RewriteCond %{HTTPS} off
    RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

احفظ.

---

## ✅ اختبار الموقع

1. **افتح المتصفح** واذهب إلى:
   ```
   https://ahsansaer.com
   ```

2. **يجب أن ترى الصفحة الرئيسية!** 🎉

3. **تسجيل الدخول كمدير**:
   - اذهب إلى: `https://ahsansaer.com/login`
   - البريد: `manager@bestprice.ps`
   - كلمة المرور: `BestPrice@2026!`

---

## 🔧 حل المشاكل

### خطأ 500 Internal Server Error

```bash
# تحقق من سجلات الأخطاء
tail -f storage/logs/laravel.log

# أو
cat storage/logs/laravel.log
```

**الحلول الشائعة**:

```bash
# 1. تأكد من مفتاح التطبيق
php artisan key:generate

# 2. أعد الأذونات
chmod -R 755 storage bootstrap/cache

# 3. مسح الكاش
php artisan cache:clear
php artisan config:clear
```

### الصفحة البيضاء الفارغة

```bash
# فعّل وضع Debug مؤقتاً
nano .env

# غيّر هذا السطر:
APP_DEBUG=true

# احفظ وأعد تحميل الموقع لترى الخطأ
# بعد الإصلاح، أرجعه إلى false
```

### خطأ "No application encryption key"

```bash
php artisan key:generate
php artisan config:cache
```

### الصور لا تظهر

```bash
# أعد إنشاء symbolic link
rm public/storage
php artisan storage:link

# تحقق من الأذونات
chmod -R 755 storage/app/public
```

### قاعدة البيانات لا تتصل

```bash
# تحقق من معلومات .env
nano .env

# تأكد من:
DB_HOST=localhost
DB_DATABASE=u897582634_ahsansear
DB_USERNAME=u897582634_ahsansear
DB_PASSWORD=Asd$Salt25$Sugar26

# اختبر الاتصال
php artisan migrate:status
```

---

## 📝 أوامر مفيدة

```bash
# عرض جميع الأوامر المتاحة
php artisan list

# مشاهدة سجلات الأخطاء مباشرة
tail -f storage/logs/laravel.log

# تحديث المشروع من Git
git pull origin main
composer install --no-dev
php artisan migrate --force
php artisan optimize

# إعادة تشغيل كل شيء
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## ⚠️ بعد التأكد من عمل الموقع

```bash
# غيّر وضع Debug في .env
nano .env

# تأكد من:
APP_ENV=production
APP_DEBUG=false

# احفظ وشغّل:
php artisan config:cache
```

---

## 🎯 الخطوات التالية

1. ✅ **تفعيل SSL** (إذا لم يكن مفعل):
   - من لوحة Hostinger → SSL → Setup

2. ✅ **تغيير كلمة مرور المدير**:
   - سجل دخول وغيّر كلمة المرور

3. ✅ **اختبار جميع الوظائف**:
   - إضافة منتج
   - البحث والفلترة
   - صفحة المقارنة
   - التعليقات

4. ✅ **إعداد النسخ الاحتياطي**:
   - Hostinger يوفر نسخ احتياطي يومي تلقائي

---

## 🆘 إذا احتجت مساعدة

1. **تحقق من السجلات**:
   ```bash
   tail -100 storage/logs/laravel.log
   ```

2. **دعم Hostinger**:
   - دردشة مباشرة 24/7 في لوحة التحكم

3. **نسخ محتوى الخطأ** وأرسله لي

---

✅ **انتهى! موقعك يجب أن يعمل الآن!** 🎉