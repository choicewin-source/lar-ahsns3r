# دليل رفع الموقع على Hostinger - خطوة بخطوة بالتفصيل 🚀

## وضعك الحالي
- ✅ لديك موقع WordPress على ahsansaer.com
- ⚠️ يوجد خطأ 500 في الموقع الحالي
- 🎯 تريد استبداله بموقع Laravel (أحسن سعر)

---

## الجزء الأول: التحضير على جهازك المحلي

### الخطوة 1: تحضير الملفات 📦

افتح Terminal/CMD في مجلد المشروع وشغّل:

```bash
# 1. تحديث ملف .env للإنتاج
cp .env .env.production
```

افتح ملف `.env.production` وعدّل الإعدادات التالية:

```env
APP_NAME="أحسن سعر"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://ahsansaer.com

# معلومات قاعدة البيانات - سنحصل عليها من Hostinger
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u000000000_ahsansaer
DB_USERNAME=u000000000_user
DB_PASSWORD=سنحصل_عليها_من_hostinger

SESSION_DRIVER=database
CACHE_DRIVER=file
QUEUE_CONNECTION=database

# البريد الإلكتروني
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=info@ahsansaer.com
MAIL_PASSWORD=كلمة_السر_للبريد
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=info@ahsansaer.com
MAIL_FROM_NAME="أحسن سعر"
```

### الخطوة 2: تحسين المشروع للإنتاج ⚡

```bash
# مسح الكاش
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# تحسين للإنتاج
composer install --optimize-autoloader --no-dev
npm run build

# تحسين Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

### الخطوة 3: تصدير قاعدة البيانات 💾

إذا كان لديك بيانات تريد نقلها:

```bash
# تصدير قاعدة البيانات
mysqldump -u root -p best_price > database_backup.sql
```

أو استخدم phpMyAdmin → Export

### الخطوة 4: ضغط الملفات 📦

**مهم جداً**: لا تضغط مجلدات node_modules و vendor الكبيرة!

**الطريقة الأولى (سهلة)**: يدوياً
- احذف مجلد `node_modules`
- احذف مجلد `vendor`
- اضغط كل شيء في ملف ZIP أو RAR
- سميه `ahsansaer-deployment.zip`

**الطريقة الثانية**: عبر Terminal

```bash
cd ..
zip -r ahsansaer-deployment.zip best-price/ \
    -x "best-price/node_modules/*" \
    -x "best-price/vendor/*" \
    -x "best-price/.git/*" \
    -x "best-price/storage/logs/*" \
    -x "best-price/storage/framework/cache/*"
```

---

## الجزء الثاني: العمل على Hostinger

### الخطوة 5: إنشاء قاعدة بيانات جديدة 🗄️

1. **اذهب إلى لوحة التحكم**:
   - افتح [hpanel.hostinger.com](https://hpanel.hostinger.com)
   - سجل دخولك

2. **اختر موقعك**:
   - انقر على `ahsansaer.com`

3. **اذهب إلى قواعد البيانات**:
   - من القائمة الجانبية، اختر **Databases** (قواعد البيانات)

4. **أنشئ قاعدة بيانات جديدة**:
   - انقر زر **Create New Database**
   - **Database name**: اكتب `ahsansaer_db` (سيصبح مثل: `u000000_ahsansaer_db`)
   - **Database user**: اكتب `ahsansaer_user` (سيصبح مثل: `u000000_ahsansaer_user`)
   - **Password**: أنشئ كلمة سر قوية (مثل: `AhsanSaer@2026!`)
   - انقر **Create**

5. **احفظ المعلومات**! ✍️
   - **Database name**: `u000000_ahsansaer_db`
   - **Username**: `u000000_ahsansaer_user`
   - **Password**: `AhsanSaer@2026!`
   - **Host**: `localhost`

### الخطوة 6: نسخ احتياطي لموقع WordPress الحالي (اختياري) 💾

إذا أردت الاحتفاظ بنسخة احتياطية:

1. اذهب إلى **File Manager**
2. اضغط زر الماوس الأيمن على مجلد `public_html`
3. اختر **Compress** (ضغط)
4. سمّه `wordpress-backup-2026-01-05.zip`
5. بعد الضغط، انقر عليه واختر **Download**

### الخطوة 7: حذف ملفات WordPress القديمة 🗑️

**مهم**: قبل الحذف، تأكد أنك حفظت نسخة احتياطية!

1. **افتح File Manager**:
   - من لوحة التحكم، انقر **File Manager**

2. **اذهب إلى public_html**:
   - انقر على مجلد `public_html`

3. **اختر جميع الملفات**:
   - علّم على المربع بجانب "Name" لاختيار الكل
   - أو اضغط `Ctrl+A`

4. **احذف كل شيء**:
   - انقر زر **Delete** في الأعلى
   - أو اضغط زر الماوس الأيمن → Delete
   - وافق على الحذف

### الخطوة 8: رفع ملفات Laravel 📤

1. **ارفع الملف المضغوط**:
   - في File Manager، تأكد أنك داخل مجلد `public_html`
   - انقر زر **Upload** في الأعلى
   - اختر ملف `ahsansaer-deployment.zip`
   - انتظر حتى يكتمل الرفع (قد يستغرق 5-10 دقائق)

2. **فك ضغط الملف**:
   - بعد انتهاء الرفع، اضغط زر الماوس الأيمن على الملف
   - اختر **Extract** (فك الضغط)
   - انتظر حتى ينتهي

3. **نقل الملفات إلى الجذر**:
   - ستجد مجلد `best-price` تم إنشاؤه
   - افتحه
   - اختر جميع محتوياته (Ctrl+A)
   - انقر **Move** (نقل)
   - اختر المسار: `/public_html/`
   - انقر **Move**

4. **نقل الملفات المخفية**:
   - في أعلى File Manager، انقر **Settings** (⚙️)
   - فعّل خيار **Show Hidden Files**
   - اختر الملفات المخفية (تبدأ بنقطة مثل `.env.example`, `.htaccess`)
   - انقلها إلى `/public_html/`

5. **حذف المجلد الفارغ والملف المضغوط**:
   - احذف مجلد `best-price` الفارغ
   - احذف ملف `ahsansaer-deployment.zip`

### الخطوة 9: إعداد مجلد public 📁

**مشكلة**: Laravel يضع ملف `index.php` داخل مجلد `public/`، لكن Hostinger يتوقعه في `public_html/`

**الحل**: ننقل محتويات `public/` إلى الجذر

1. **في File Manager**:
   - افتح مجلد `public_html/public/`
   - اختر جميع الملفات (Ctrl+A)
   - انقر **Move**
   - اختر المسار: `/public_html/`
   - انقر **Move**

2. **احذف مجلد public الفارغ**:
   - ارجع إلى `/public_html/`
   - احذف مجلد `public/` الفارغ

3. **تعديل مسارات في index.php**:
   - افتح ملف `index.php` في الجذر
   - ابحث عن السطر:
     ```php
     require __DIR__.'/../vendor/autoload.php';
     ```
   - غيّره إلى:
     ```php
     require __DIR__.'/vendor/autoload.php';
     ```
   - ابحث عن السطر:
     ```php
     $app = require_once __DIR__.'/../bootstrap/app.php';
     ```
   - غيّره إلى:
     ```php
     $app = require_once __DIR__.'/bootstrap/app.php';
     ```
   - احفظ الملف

### الخطوة 10: رفع ملف .env 🔧

1. **في File Manager**:
   - ارفع ملف `.env.production` من جهازك
   - بعد الرفع، اضغط عليه بالماوس الأيمن
   - اختر **Rename**
   - سمّه `.env`

2. **تعديل معلومات قاعدة البيانات**:
   - اضغط على `.env` بالماوس الأيمن
   - اختر **Edit**
   - عدّل السطور التالية بمعلومات قاعدة البيانات من الخطوة 5:
   
   ```env
   DB_DATABASE=u000000_ahsansaer_db
   DB_USERNAME=u000000_ahsansaer_user
   DB_PASSWORD=AhsanSaer@2026!
   ```
   
   - احفظ التعديلات

### الخطوة 11: تثبيت حزم Composer 📚

**مشكلة**: حذفنا مجلد `vendor` لتقليل حجم الملف!

**الحل**: نثبته من جديد على السيرفر

1. **الوصول إلى Terminal**:
   
   **الطريقة الأولى (SSH)**:
   - من لوحة Hostinger، اذهب إلى **Advanced** → **SSH Access**
   - فعّل SSH Access
   - احفظ معلومات الاتصال
   - استخدم برنامج مثل PuTTY أو Terminal:
     ```bash
     ssh u000000@yourdomain.com -p 65002
     ```

   **الطريقة الثانية (Online Terminal)**:
   - بعض خطط Hostinger توفر Terminal مباشر في File Manager
   - ابحث عن أيقونة Terminal في الأعلى

2. **بعد الدخول إلى Terminal**:
   
   ```bash
   # الذهاب إلى مجلد الموقع
   cd public_html
   
   # تثبيت حزم Composer
   composer install --optimize-autoloader --no-dev
   
   # إذا لم يكن composer متوفر، استخدم:
   php composer.phar install --optimize-autoloader --no-dev
   ```

   ⏳ **انتظر**: قد يستغرق 5-10 دقائق

### الخطوة 12: تشغيل أوامر Laravel الضرورية ⚙️

في نفس Terminal:

```bash
# 1. توليد مفتاح التطبيق
php artisan key:generate

# 2. إنشاء symbolic link للتخزين
php artisan storage:link

# 3. مسح جميع الكاش
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 4. تحسين للإنتاج
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

### الخطوة 13: إعداد قاعدة البيانات 🗄️

```bash
# تشغيل Migrations
php artisan migrate --force

# تشغيل Seeders (البيانات الأولية)
php artisan db:seed --force
```

**أو إذا كان لديك ملف SQL**:

1. اذهب إلى **Databases** → **phpMyAdmin**
2. اختر قاعدة البيانات `u000000_ahsansaer_db`
3. انقر **Import**
4. اختر ملف `database_backup.sql`
5. انقر **Go**

### الخطوة 14: إعداد أذونات المجلدات 🔐

في Terminal:

```bash
# تعيين أذونات storage و cache
chmod -R 755 storage
chmod -R 755 bootstrap/cache

# أذونات ملف .env
chmod 644 .env
```

### الخطوة 15: إعداد .htaccess 📄

أنشئ ملف `.htaccess` في جذر `public_html/`:

في File Manager:
1. انقر **New File**
2. سمّه `.htaccess`
3. افتحه وأضف:

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

    # Redirect Trailing Slashes If Not A Folder
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

احفظ الملف.

### الخطوة 16: تفعيل SSL 🔒

1. **من لوحة Hostinger**:
   - اذهب إلى **SSL** من القائمة الجانبية
   - ستجد **Free SSL Certificate** متاح
   - انقر **Setup**
   - انتظر 5-10 دقائق

2. **التحقق**:
   - بعد التفعيل، جرب الدخول على: `https://ahsansaer.com`

---

## الجزء الثالث: الاختبار والتحقق

### الخطوة 17: اختبار الموقع 🧪

1. **افتح المتصفح**:
   - اذهب إلى: `https://ahsansaer.com`

2. **تحقق من**:
   - ✅ الصفحة الرئيسية تظهر؟
   - ✅ الصور والأيقونات تظهر؟
   - ✅ CSS يعمل؟
   - ✅ يمكنك الضغط على الأزرار؟

### الخطوة 18: تسجيل الدخول كمدير 👤

1. اذهب إلى: `https://ahsansaer.com/login`
2. استخدم معلومات المدير:
   - **البريد**: `manager@bestprice.ps`
   - **كلمة المرور**: `BestPrice@2026!`
3. تحقق من وصولك للوحة التحكم

### الخطوة 19: اختبار الوظائف 🔍

- ✅ إضافة منتج جديد
- ✅ البحث والفلترة
- ✅ صفحة المقارنة
- ✅ صفحة تفاصيل منتج
- ✅ نظام التعليقات

---

## حل المشاكل الشائعة 🔧

### خطأ 500 Internal Server Error

1. **تحقق من سجلات الأخطاء**:
   ```bash
   tail -f storage/logs/laravel.log
   ```

2. **الأسباب المحتملة**:
   - ملف `.env` غير موجود أو بمعلومات خاطئة
   - أذونات المجلدات غير صحيحة
   - مفتاح التطبيق غير موجود

3. **الحل**:
   ```bash
   php artisan key:generate
   chmod -R 755 storage bootstrap/cache
   php artisan config:clear
   ```

### الصفحة بيضاء فارغة

```bash
# في .env تأكد من:
APP_DEBUG=true  # مؤقتاً لرؤية الأخطاء
APP_ENV=local

# ثم افتح الموقع لترى الخطأ
# بعد الإصلاح، أرجعها إلى:
APP_DEBUG=false
APP_ENV=production
```

### الصور لا تظهر

```bash
# أعد إنشاء symbolic link
rm storage
php artisan storage:link

# تحقق من الأذونات
chmod -R 755 storage
```

### قاعدة البيانات لا تتصل

1. تحقق من معلومات `.env`
2. تحقق من أن قاعدة البيانات موجودة في phpMyAdmin
3. تحقق من أن اسم المستخدم وكلمة المرور صحيحة

---

## ملاحظات مهمة ⚠️

1. **بعد التأكد من عمل الموقع**:
   - غيّر `APP_DEBUG=false` في `.env`
   - غيّر `APP_ENV=production`

2. **النسخ الاحتياطي**:
   - احفظ نسخة من قاعدة البيانات أسبوعياً
   - Hostinger يوفر نسخ احتياطي يومي

3. **الأمان**:
   - غيّر كلمة مرور المدير بعد أول دخول
   - لا تشارك ملف `.env` مع أحد

4. **الأداء**:
   - من لوحة Hostinger، فعّل **OPcache**
   - فعّل **Gzip Compression**

---

## الخلاصة ✅

إذا اتبعت الخطوات بالترتيب، موقعك يجب أن يعمل الآن!

🎉 **مبروك! موقع "أحسن سعر" أصبح على الإنترنت!**

للدعم، راجع:
- [DEPLOYMENT_GUIDE_HOSTINGER.md](./DEPLOYMENT_GUIDE_HOSTINGER.md) - دليل تفصيلي
- [DEPLOYMENT_CHECKLIST.md](./DEPLOYMENT_CHECKLIST.md) - قائمة تحقق
- دعم Hostinger: [support.hostinger.com](https://support.hostinger.com)