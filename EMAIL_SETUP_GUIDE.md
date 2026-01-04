# دليل إعداد البريد الإلكتروني لموقع أحسن سعر

## المشكلة الحالية
حالياً، إعدادات البريد في ملف `.env` مضبوطة على `MAIL_MAILER=log` وهذا يعني أن الإيميلات **لا تُرسل فعلياً** للمستخدمين، بل تُسجل فقط في ملف اللوج `storage/logs/laravel.log`.

## الحلول المتاحة

### الخيار 1: استخدام Gmail (مجاني - موصى به للتطوير)

#### الخطوة 1: إنشاء App Password من Google

1. اذهب إلى [Google Account](https://myaccount.google.com/)
2. اختر "Security" من القائمة الجانبية
3. فعّل "2-Step Verification" إذا لم يكن مفعلاً
4. ابحث عن "App passwords" أو "كلمات مرور التطبيقات"
5. اختر "Mail" و "Other" وسمّها "Laravel Best Price"
6. انسخ كلمة المرور المكونة من 16 حرف

#### الخطوة 2: تحديث ملف .env

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-16-digit-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your-email@gmail.com"
MAIL_FROM_NAME="أحسن سعر"
```

**ملاحظة:** استبدل `your-email@gmail.com` ببريدك الفعلي و `your-16-digit-app-password` بكلمة المرور التي حصلت عليها.

---

### الخيار 2: استخدام Mailtrap (مجاني - موصى به للتطوير والتجربة)

[Mailtrap](https://mailtrap.io/) هي خدمة تسمح لك باختبار إرسال البريد بدون إرساله للمستخدمين فعلياً.

#### الخطوة 1: إنشاء حساب

1. اذهب إلى [Mailtrap.io](https://mailtrap.io/)
2. أنشئ حساب مجاني
3. اذهب إلى "Inboxes" > "My Inbox"
4. اختر "Laravel" من قائمة التكاملات
5. انسخ الإعدادات

#### الخطوة 2: تحديث ملف .env

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="info@ahsansanar.com"
MAIL_FROM_NAME="أحسن سعر"
```

---

### الخيار 3: استخدام خدمة احترافية (للإنتاج)

للموقع في الإنتاج، يُفضل استخدام إحدى هذه الخدمات:

#### أ. [SendGrid](https://sendgrid.com/)
- **مجاني:** 100 إيميل/يوم
- **مدفوع:** خطط تبدأ من $15/شهر

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-sendgrid-api-key
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="info@ahsansanar.com"
MAIL_FROM_NAME="أحسن سعر"
```

#### ب. [Mailgun](https://www.mailgun.com/)
- **مجاني:** أول 5000 إيميل/شهر لـ 3 أشهر
- **مدفوع:** $0.80 لكل 1000 إيميل

```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=your-domain.mailgun.org
MAILGUN_SECRET=your-mailgun-api-key
MAILGUN_ENDPOINT=api.mailgun.net
MAIL_FROM_ADDRESS="info@ahsansanar.com"
MAIL_FROM_NAME="أحسن سعر"
```

#### ج. [Amazon SES](https://aws.amazon.com/ses/)
- **مجاني:** 62,000 إيميل/شهر (إذا كنت تستخدم EC2)
- **مدفوع:** $0.10 لكل 1000 إيميل

```env
MAIL_MAILER=ses
AWS_ACCESS_KEY_ID=your-aws-access-key
AWS_SECRET_ACCESS_KEY=your-aws-secret-key
AWS_DEFAULT_REGION=us-east-1
MAIL_FROM_ADDRESS="info@ahsansanar.com"
MAIL_FROM_NAME="أحسن سعر"
```

---

## الخطوات بعد تحديث .env

1. **امسح الكاش:**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

2. **اختبر إرسال البريد:**
   ```bash
   php artisan tinker
   ```
   
   ثم اكتب:
   ```php
   Mail::raw('تجربة إرسال بريد', function($message) {
       $message->to('your-email@example.com')->subject('اختبار');
   });
   ```

3. **تحقق من البريد:**
   - إذا كنت تستخدم Gmail، تحقق من صندوق الوارد
   - إذا كنت تستخدم Mailtrap، تحقق من لوحة Mailtrap
   - إذا كنت تستخدم `log`، تحقق من `storage/logs/laravel.log`

---

## اختبار ميزة "نسيت كلمة المرور"

1. اذهب إلى صفحة تسجيل الدخول: `http://localhost:8000/login`
2. اضغط على "نسيت كلمة المرور؟"
3. أدخل البريد الإلكتروني المسجل في الموقع
4. اضغط "إرسال رابط إعادة التعيين"
5. تحقق من البريد الإلكتروني (حسب الخدمة المستخدمة)
6. اضغط على الرابط في البريد
7. أدخل كلمة المرور الجديدة

---

## ملاحظات هامة

### 1. إعدادات الأمان
- **لا تضع** معلومات البريد الحساسة في ملف `.env` في Git
- أضف `.env` إلى `.gitignore` (موجود افتراضياً)
- استخدم متغيرات البيئة على السيرفر

### 2. قالب البريد
يمكنك تخصيص قالب البريد بتشغيل:
```bash
php artisan vendor:publish --tag=laravel-mail
```

ثم عدّل الملفات في `resources/views/vendor/mail/`

### 3. طابور الانتظار (Queue)
لتحسين الأداء، يمكنك استخدام Queue:

```env
QUEUE_CONNECTION=database
```

ثم:
```bash
php artisan queue:table
php artisan migrate
php artisan queue:work
```

---

## استكشاف الأخطاء الشائعة

### 1. "Connection timeout"
- تحقق من إعدادات الجدار الناري
- تأكد من أن Port 587 مفتوح
- جرّب Port 465 بدلاً من 587

### 2. "Authentication failed"
- تأكد من صحة Username و Password
- إذا كنت تستخدم Gmail، تأكد من استخدام App Password وليس كلمة المرور العادية
- تأكد من تفعيل 2FA في Gmail

### 3. "Could not instantiate mail function"
- تأكد من تثبيت PHP extension `php-mbstring`
- أعد تشغيل خادم Laravel

---

## الخلاصة

للبدء السريع، استخدم **Mailtrap** للتطوير لأنه:
- ✅ سهل الإعداد
- ✅ مجاني بالكامل
- ✅ يسمح لك باختبار البريد بأمان
- ✅ يعرض البريد بشكل جميل

للإنتاج، استخدم **SendGrid** أو **Mailgun** لأنهما:
- ✅ موثوقان
- ✅ أسعار معقولة
- ✅ توفران تقارير مفصلة
- ✅ سهلان في التكامل

---

## مساعدة إضافية

إذا واجهت أي مشاكل، تحقق من:
- [Laravel Mail Documentation](https://laravel.com/docs/11.x/mail)
- ملف اللوج: `storage/logs/laravel.log`
- إعدادات البريد في `config/mail.php`