# اختبار سريع لتسجيل المتجر ⚡

## الطريقة الأسرع لاختبار البريد الإلكتروني

### استخدم Mailtrap (5 دقائق) 🚀

1. **افتح Mailtrap:**
   - اذهب إلى: https://mailtrap.io
   - سجل حساب مجاني
   - انتقل إلى "Inboxes"

2. **احصل على الإعدادات:**
   - اختر "My Inbox"
   - تبويب "SMTP Settings"
   - اختر "Laravel 9+"
   - انسخ الكود

3. **حدّث `.env`:**
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=<الكود من mailtrap>
MAIL_PASSWORD=<الكود من mailtrap>
MAIL_ENCRYPTION=tls
```

4. **امسح الكاش:**
```bash
php artisan config:clear
```

5. **جرب التسجيل:**
   - افتح: `http://localhost:8000/register-shop`
   - سجل متجر جديد
   - افتح Mailtrap لرؤية البريد!

---

## اختبار تسجيل عبر Google

1. **تأكد من `.env`:**
```env
GOOGLE_CLIENT_ID=57158123082-enckaf1upp8f58q8cttmi54fec49597o.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=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
GOOGLE_REDIRECT_URL=http://localhost:8000/auth/google/callback
```

2. **جرب التسجيل:**
   - افتح: `http://localhost:8000/register-shop`
   - اضغط "تسجيل المتجر باستخدام Google"
   - سجل دخول بحساب Google
   - أكمل معلومات المتجر

---

## التحقق من النتائج

### في Mailtrap:
- يجب أن تظهر رسالتان:
  1. "طلب تسجيل متجر جديد" → للمدير
  2. "Verify Email Address" → للمستخدم

### في قاعدة البيانات:
```bash
php artisan tinker
```
```php
// عرض جميع المتاجر
\App\Models\User::where('role', 'shop_owner')->get(['name', 'shop_name', 'email']);

// التحقق من متجر محدد
$shop = \App\Models\User::where('email', 'your@email.com')->first();
echo "Shop: " . $shop->shop_name;
echo "\nApproved: " . ($shop->is_approved ? 'Yes' : 'No');
echo "\nEmail Verified: " . ($shop->email_verified_at ? 'Yes' : 'No');
```

---

## مشاكل شائعة

### البريد لا يُرسل؟
```bash
php artisan config:clear
php artisan cache:clear
# ثم جرب مرة أخرى
```

### Google OAuth لا يعمل؟
- تأكد من أن `GOOGLE_REDIRECT_URL` صحيح في `.env`
- يجب أن يطابق الرابط في Google Console

---

## ملاحظات مهمة ⚠️

- المتجر المسجل **لن** يكون مفعلاً تلقائياً (`is_approved = false`)
- المدير يجب أن يوافق عليه من لوحة التحكم
- المتجر المسجل عبر Google يكون بريده **مؤكداً** تلقائياً
- المتجر المسجل عبر النموذج يحتاج **تأكيد البريد**

---

## للمساعدة

إذا واجهت مشكلة، راجع الملف الكامل: [TESTING_GUIDE_SHOP_REGISTRATION.md](TESTING_GUIDE_SHOP_REGISTRATION.md)