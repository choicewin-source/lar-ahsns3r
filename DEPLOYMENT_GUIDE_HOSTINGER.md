# دليل رفع الموقع على Hostinger 🚀

## المتطلبات قبل البدء

- ✅ حساب Hostinger نشط
- ✅ خطة استضافة تدعم Laravel (Business أو Premium موصى بها)
- ✅ اتصال إنترنت مستقر
- ✅ برنامج FTP مثل FileZilla

---

## الخطوة 1️⃣: تحضير الملفات للرفع

### 1.1 تحديث ملف `.env` للإنتاج

أولاً، أنشئ نسخة من `.env` للسيرفر:

```bash
cp .env .env.production
```

افتح `.env.production` وعدّل الإعدادات التالية:

```env
APP_NAME="أحسن سعر"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# قاعدة البيانات - ستحصل عليها من Hostinger
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u123456789_bestprice
DB_USERNAME=u123456789_user
DB_PASSWORD=كلمة_السر_من_Hostinger

# جلسات وكاش
SESSION_DRIVER=database
CACHE_DRIVER=file
QUEUE_CONNECTION=database

# البريد الإلكتروني
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=noreply@yourdomain.com
MAIL_PASSWORD=كلمة_السر_للبريد
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"
```

### 1.2 تحسين التطبيق

```bash
# مسح الكاش
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# تحسين للإنتاج
php artisan config:cache
php artisan route:cache
php artisan view:cache

# تثبيت الحزم للإنتاج فقط
composer install --optimize-autoloader --no-dev

# بناء أصول JavaScript و CSS
npm run build
```

### 1.3 إنشاء أرشيف مضغوط

```bash
cd ..
tar -czf best-price.tar.gz best-price/
```

---

## الخطوة 2️⃣: إعداد Hostinger

### 2.1 تسجيل الدخول

1. اذهب إلى [hpanel.hostinger.com](https://hpanel.hostinger.com)
2. سجل الدخول بحسابك

### 2.2 إنشاء قاعدة بيانات MySQL

1. من لوحة التحكم، اختر **قواعد البيانات**
2. انقر على **إنشاء قاعدة بيانات جديدة**
3. املأ البيانات:
   - **اسم قاعدة البيانات**: `u123456789_bestprice`
   - **اسم المستخدم**: `u123456789_user`
   - **كلمة المرور**: أنشئ كلمة سر قوية
4. احفظ هذه المعلومات - ستحتاجها في ملف `.env`
5. انقر **إنشاء**

### 2.3 إعداد SSH (اختياري - يسهل الرفع)

1. من لوحة التحكم، اختر **متقدم** → **SSH Access**
2. قم بتفعيل SSH Access
3. احفظ معلومات الاتصال (Host, Port, Username)

---

## الخطوة 3️⃣: رفع الملفات

### الطريقة الأولى: باستخدام File Manager (سهلة)

#### 3.1 الوصول إلى File Manager

1. من لوحة التحكم، اختر **الملفات** → **File Manager**
2. ستفتح نافذة جديدة بمدير الملفات

#### 3.2 رفع الملفات

1. اذهب إلى مجلد `public_html`
2. **مهم**: احذف جميع الملفات الموجودة (index.html, default.html, إلخ)
3. انقر **Upload** في الأعلى
4. ارفع ملف `best-price.tar.gz`
5. بعد انتهاء الرفع، انقر بالزر الأيمن على الملف واختر **Extract**
6. ستظهر مجلد `best-price` - انقل جميع محتوياته إلى `public_html`

#### 3.3 إعداد هيكل المجلدات

يجب أن يكون الهيكل النهائي كالتالي:

```
public_html/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/           ← المجلد العام
├── resources/
├── routes/
├── storage/
├── vendor/
├── .env              ← رفع ملف .env.production وسميه .env
├── artisan
└── composer.json
```

#### 3.4 نقل محتويات public

**مهم جداً**: محتويات مجلد `public` يجب أن تكون في الجذر:

1. انقل جميع الملفات من `public_html/public/` إلى `public_html/`
2. عدّل ملف `index.php` في `public_html/`:

```php
<?php

// تعديل المسار
require __DIR__.'/bootstrap/autoload.php';  // إذا كان موجوداً
$app = require_once __DIR__.'/bootstrap/app.php';
```

أو بدلاً من ذلك، استخدم `.htaccess` للتوجيه.

### الطريقة الثانية: باستخدام SSH (أسرع)

إذا كان لديك SSH:

```bash
# 1. الاتصال بالسيرفر
ssh u123456789@yourdomain.com -p 65002

# 2. الذهاب إلى public_html
cd public_html

# 3. رفع الملف (من جهازك)
# في terminal جديد:
scp -P 65002 best-price.tar.gz u123456789@yourdomain.com:~/public_html/

# 4. فك الضغط
tar -xzf best-price.tar.gz
mv best-price/* .
mv best-price/.* .
rmdir best-price
rm best-price.tar.gz

# 5. نقل محتويات public
mv public/* .
mv public/.htaccess .
rmdir public
```

---

## الخطوة 4️⃣: إعداد الأذونات

### 4.1 تعيين أذونات المجلدات

في File Manager أو عبر SSH:

```bash
# أذونات المجلدات
chmod -R 755 storage
chmod -R 755 bootstrap/cache

# أذونات الملفات
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;

# أذونات خاصة
chmod 644 .env
chmod 755 artisan
```

### 4.2 إنشاء Symbolic Link للتخزين

عبر SSH:

```bash
php artisan storage:link
```

أو يدوياً في File Manager:
- أنشئ Symbolic Link من `storage/app/public` إلى `public/storage`

---

## الخطوة 5️⃣: إعداد قاعدة البيانات

### 5.1 رفع ملف .env

1. افتح File Manager
2. ارفع ملف `.env.production` وسميه `.env`
3. تأكد من صحة معلومات قاعدة البيانات

### 5.2 استيراد قاعدة البيانات

**الطريقة 1: phpMyAdmin**

1. من لوحة التحكم، اختر **قواعد البيانات** → **phpMyAdmin**
2. اختر قاعدة البيانات التي أنشأتها
3. انقر **استيراد**
4. اختر ملف SQL أو قم بتشغيل Migrations

**الطريقة 2: عبر SSH**

```bash
# رفع ملف dump.sql
scp -P 65002 database.sql u123456789@yourdomain.com:~/

# استيراده
mysql -u u123456789_user -p u123456789_bestprice < database.sql

# أو تشغيل Migrations
php artisan migrate --force
php artisan db:seed --force
```

---

## الخطوة 6️⃣: إعداد .htaccess

### 6.1 في الجذر (public_html/)

أنشئ ملف `.htaccess` في `public_html/`:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    
    # إعادة توجيه لـ public إذا لم يكن موجوداً
    RewriteCond %{REQUEST_URI} !^/public/
    RewriteRule ^(.*)$ /public/$1 [L]
</IfModule>
```

### 6.2 في مجلد public (إذا بقي)

تأكد من وجود `.htaccess` في `public/`:

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

---

## الخطوة 7️⃣: تشغيل الأوامر الضرورية

عبر SSH أو Terminal في Hostinger:

```bash
# 1. توليد مفتاح التطبيق
php artisan key:generate

# 2. مسح الكاش
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 3. تشغيل Migrations
php artisan migrate --force

# 4. تشغيل Seeders
php artisan db:seed --force

# 5. تحسين للإنتاج
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# 6. Symbolic link للتخزين
php artisan storage:link
```

---

## الخطوة 8️⃣: إعداد Cron Jobs (للمهام المجدولة)

إذا كان لديك مهام مجدولة:

1. من لوحة التحكم، اختر **متقدم** → **Cron Jobs**
2. أضف Cron Job جديد:
   - **Interval**: كل دقيقة `* * * * *`
   - **Command**: 
     ```bash
     cd /home/u123456789/public_html && php artisan schedule:run >> /dev/null 2>&1
     ```

---

## الخطوة 9️⃣: إعداد SSL (HTTPS)

### 9.1 تفعيل SSL المجاني

1. من لوحة التحكم، اختر **الأمان** → **SSL**
2. اختر **Let's Encrypt SSL**
3. انقر **تثبيت**
4. انتظر بضع دقائق

### 9.2 فرض HTTPS

أضف في `.htaccess`:

```apache
# Force HTTPS
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

---

## الخطوة 🔟: الاختبار والتحقق

### 10.1 التحقق من الموقع

1. افتح المتصفح واذهب إلى `https://yourdomain.com`
2. تحقق من:
   - ✅ الصفحة الرئيسية تعمل
   - ✅ تسجيل الدخول يعمل
   - ✅ الصور تظهر
   - ✅ قاعدة البيانات متصلة

### 10.2 إصلاح الأخطاء الشائعة

#### خطأ 500 Internal Server Error

```bash
# تحقق من سجلات الأخطاء
tail -f storage/logs/laravel.log

# تحقق من أذونات المجلدات
chmod -R 755 storage bootstrap/cache
```

#### الصفحة فارغة

- تأكد من تشغيل `php artisan key:generate`
- تأكد من صحة معلومات قاعدة البيانات في `.env`

#### الصور لا تظهر

```bash
# أعد إنشاء symbolic link
rm public/storage
php artisan storage:link
```

#### خطأ في الاتصال بقاعدة البيانات

- تحقق من معلومات قاعدة البيانات في `.env`
- تأكد من أن `DB_HOST=localhost`

---

## الخطوة 1️⃣1️⃣: التحديثات المستقبلية

عند الحاجة لتحديث الموقع:

### عبر SSH (الأسرع):

```bash
# 1. اتصل بالسيرفر
ssh u123456789@yourdomain.com -p 65002

# 2. اسحب التحديثات من Git (إذا كنت تستخدم Git)
cd public_html
git pull origin main

# 3. أو ارفع الملفات المحدثة عبر FTP

# 4. تحديث الحزم
composer install --optimize-autoloader --no-dev
npm run build

# 5. تشغيل Migrations الجديدة
php artisan migrate --force

# 6. مسح الكاش
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

---

## نصائح مهمة ⚠️

1. **النسخ الاحتياطي**:
   - احفظ نسخة من قاعدة البيانات بانتظام
   - احفظ نسخة من الملفات المرفوعة

2. **الأمان**:
   - لا تضع `APP_DEBUG=true` في الإنتاج أبداً
   - غيّر `APP_KEY` بعد النشر
   - استخدم كلمات مرور قوية

3. **الأداء**:
   - فعّل OPcache من لوحة Hostinger
   - استخدم CDN للملفات الثابتة
   - فعّل Gzip compression

4. **المراقبة**:
   - راقب سجلات الأخطاء بانتظام
   - راقب استهلاك الموارد
   - فعّل Google Analytics

---

## الدعم والمساعدة 🆘

إذا واجهت مشاكل:

1. **سجلات Laravel**:
   ```bash
   tail -f storage/logs/laravel.log
   ```

2. **سجلات Apache/Nginx**:
   - متوفرة في لوحة Hostinger

3. **دعم Hostinger**:
   - دردشة مباشرة 24/7
   - قاعدة المعرفة: [support.hostinger.com](https://support.hostinger.com)

---

## ملاحظات إضافية للمشروع 📝

### إعداد البريد الإلكتروني

Hostinger يوفر SMTP مجاني:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=noreply@yourdomain.com
MAIL_PASSWORD=كلمة_السر
MAIL_ENCRYPTION=tls
```

### إعداد Queue Workers (إذا لزم الأمر)

للمهام الثقيلة، أضف Cron Job:

```bash
* * * * * cd /home/u123456789/public_html && php artisan queue:work --stop-when-empty >> /dev/null 2>&1
```

---

✅ **مبروك! موقعك الآن على الإنترنت!** 🎉

تذكر مشاركة رابط الموقع مع المستخدمين وجمع التعليقات لتحسينه بشكل مستمر.