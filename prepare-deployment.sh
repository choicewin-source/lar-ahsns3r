#!/bin/bash

# سكريبت تحضير الموقع للرفع على Hostinger
# الاستخدام: bash prepare-deployment.sh

echo "🚀 بدء تحضير الموقع للرفع..."
echo ""

# 1. مسح الكاش
echo "📦 مسح الكاش..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 2. تحسين للإنتاج
echo "⚡ تحسين للإنتاج..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# 3. تثبيت الحزم للإنتاج
echo "📚 تثبيت حزم Production..."
composer install --optimize-autoloader --no-dev

# 4. بناء الأصول
echo "🎨 بناء CSS و JavaScript..."
npm run build

# 5. إنشاء ملف .env للإنتاج
echo "⚙️  إنشاء ملف .env.production..."
cp .env .env.production

echo ""
echo "تنبيه: لا تنسى تحديث .env.production بمعلومات السيرفر:"
echo "  - APP_ENV=production"
echo "  - APP_DEBUG=false"
echo "  - APP_URL=https://yourdomain.com"
echo "  - DB_HOST=localhost"
echo "  - DB_DATABASE=اسم_قاعدة_البيانات"
echo "  - DB_USERNAME=اسم_المستخدم"
echo "  - DB_PASSWORD=كلمة_السر"
echo ""

# 6. إنشاء أرشيف مضغوط
echo "📦 إنشاء أرشيف مضغوط..."
cd ..
tar -czf best-price-deployment.tar.gz \
    --exclude='best-price/node_modules' \
    --exclude='best-price/.git' \
    --exclude='best-price/storage/logs/*.log' \
    --exclude='best-price/storage/framework/cache/*' \
    --exclude='best-price/storage/framework/sessions/*' \
    --exclude='best-price/storage/framework/views/*' \
    best-price/

echo ""
echo "✅ تم التحضير بنجاح!"
echo "📦 الملف: best-price-deployment.tar.gz"
echo "📂 الحجم: $(du -h best-price-deployment.tar.gz | cut -f1)"
echo ""
echo "الخطوات التالية:"
echo "1. ارفع ملف best-price-deployment.tar.gz إلى Hostinger"
echo "2. فك الضغط في public_html"
echo "3. اتبع الدليل في DEPLOYMENT_GUIDE_HOSTINGER.md"
echo ""
echo "🎉 حظاً موفقاً!"