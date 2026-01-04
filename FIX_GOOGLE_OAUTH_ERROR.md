# إصلاح خطأ Google OAuth 🔧

## الخطأ الذي يظهر:
```
Error 400: invalid_request
Missing required parameter: redirect_uri
```

## السبب:
الـ `redirect_uri` المُعرّف في ملف `.env` غير مُضاف في Google Cloud Console

---

## الحل (خطوة بخطوة):

### 1. افتح Google Cloud Console
اذهب إلى: https://console.cloud.google.com/

### 2. اختر المشروع أو أنشئ مشروع جديد
- إذا لم يكن لديك مشروع، اضغط "Create Project"
- أدخل اسم المشروع: `ahsan-price`
- اضغط "Create"

### 3. فعّل Google+ API
- من القائمة الجانبية: **APIs & Services** > **Library**
- ابحث عن "Google+ API"
- اضغط عليه ثم اضغط "Enable"

### 4. أنشئ OAuth 2.0 Credentials

#### أ) اذهب إلى Credentials
- من القائمة: **APIs & Services** > **Credentials**
- اضغط **+ CREATE CREDENTIALS**
- اختر **OAuth client ID**

#### ب) إعداد OAuth consent screen (إذا طُلب منك)
- اختر **External**
- املأ البيانات الأساسية:
  - **App name**: أحسن سعر
  - **User support email**: بريدك الإلكتروني
  - **Developer contact**: بريدك الإلكتروني
- اضغط **Save and Continue**
- في صفحة Scopes، اضغط **Save and Continue**
- في Test users، اضغط **Save and Continue**

#### ج) أنشئ OAuth Client ID
- عد إلى **Credentials**
- اضغط **+ CREATE CREDENTIALS** > **OAuth client ID**
- اختر **Application type**: **Web application**
- **Name**: `ahsan-price-web`

#### د) أضف Authorized redirect URIs (مهم جداً! 🔴)
في قسم **Authorized redirect URIs**، أضف هذه الروابط:

```
http://localhost:8000/auth/google/callback
http://127.0.0.1:8000/auth/google/callback
```

⚠️ **تأكد أن الرابط صحيح تماماً بدون مسافات زائدة!**

- اضغط **Create**

### 5. احصل على Client ID و Client Secret
بعد الإنشاء ستظهر لك نافذة بها:
- **Client ID**: انسخه
- **Client Secret**: انسخه

احتفظ بهم في مكان آمن!

### 6. حدّث ملف `.env`

افتح ملف `.env` في مشروعك وحدّث:

```env
GOOGLE_CLIENT_ID=your_client_id_here
GOOGLE_CLIENT_SECRET=your_client_secret_here
GOOGLE_REDIRECT_URL=http://localhost:8000/auth/google/callback
```

⚠️ **مهم**: تأكد أن `GOOGLE_REDIRECT_URL` يطابق تماماً ما أضفته في Google Console

### 7. امسح الكاش

```bash
php artisan config:clear
php artisan cache:clear
```

### 8. جرب الآن! 🎉

افتح المتصفح واذهب إلى:
```
http://localhost:8000/register-shop
```

اضغط على زر "تسجيل المتجر باستخدام Google" ويجب أن يعمل الآن!

---

## ملاحظات مهمة:

### للإنتاج (Production):
عند نشر المشروع على سيرفر حقيقي، يجب:

1. إضافة الدومين الخاص بك في **Authorized redirect URIs**:
```
https://yourdomain.com/auth/google/callback
```

2. تحديث `.env` في السيرفر:
```env
GOOGLE_REDIRECT_URL=https://yourdomain.com/auth/google/callback
```

### للتطوير المحلي:
- استخدم `http://localhost:8000` أو `http://127.0.0.1:8000`
- **لا تستخدم** HTTPS في المحلي
- تأكد من تشغيل Laravel على نفس البورت (8000)

### إذا غيّرت البورت:
لو شغّلت Laravel على بورت مختلف مثل 8080:
```bash
php artisan serve --port=8080
```

يجب تحديث:
1. `.env`:
```env
GOOGLE_REDIRECT_URL=http://localhost:8080/auth/google/callback
```

2. Google Console > Credentials > أضف:
```
http://localhost:8080/auth/google/callback
```

---

## اختبار سريع:

بعد إصلاح الإعدادات، اختبر الرابط مباشرة:

```
http://localhost:8000/auth/google/shop
```

- يجب أن يحولك إلى صفحة تسجيل دخول Google
- اختر حساب Google
- وافق على الصلاحيات
- يجب أن يحولك إلى صفحة "أكمل تسجيل متجرك"

---

## الأخطاء الشائعة وحلولها:

### 1. "The redirect URI provided does not match"
**الحل**: تأكد أن الرابط في `.env` يطابق تماماً ما في Google Console

### 2. "Access blocked: This app's request is invalid"
**الحل**: أضف Test Users في OAuth consent screen

### 3. "Error 403: access_denied"
**الحل**: أضف نفسك كـ Test User في OAuth consent screen

### 4. الصفحة تعلق على "Authorizing..."
**الحل**: 
```bash
composer require laravel/socialite
php artisan config:clear
```

---

## التحقق من الإعدادات:

```bash
# تأكد من وجود Laravel Socialite
composer show | grep socialite

# يجب أن يظهر:
# laravel/socialite

# إذا لم يظهر، ثبّته:
composer require laravel/socialite
```

---

## للمساعدة:

إذا استمرت المشكلة:
1. راجع ملف [TESTING_GUIDE_SHOP_REGISTRATION.md](TESTING_GUIDE_SHOP_REGISTRATION.md)
2. تأكد من جميع الخطوات أعلاه
3. أعد تشغيل الخادم: `php artisan serve`