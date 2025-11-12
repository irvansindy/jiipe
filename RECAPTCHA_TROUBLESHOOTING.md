# reCAPTCHA Troubleshooting Guide

## ✅ Checklist untuk Memastikan reCAPTCHA Tampil

### 1. **Konfigurasi Environment Variables (.env)**
   ```env
   NOCAPTCHA_SITEKEY=YOUR_SITE_KEY
   NOCAPTCHA_SECRET=YOUR_SECRET_KEY
   ```
   - [ ] Dapatkan keys dari: https://www.google.com/recaptcha/admin
   - [ ] Pilih reCAPTCHA v2 "I'm not a robot" Checkbox
   - [ ] Ensure keys bukan testing/invalid keys
   - [ ] Run: `php artisan config:cache` setelah update .env

### 2. **Package Installation**
   ```bash
   php artisan composer show | grep -i captcha
   # Output: anhskohbo/no-captcha should show version
   ```
   - [ ] Package `anhskohbo/no-captcha ^3.7` terinstall
   - [ ] Jika belum: `composer require anhskohbo/no-captcha:^3.7`

### 3. **Google reCAPTCHA Script**
   - [ ] Script loading di bottom of page: `https://www.google.com/recaptcha/api.js`
   - [ ] Di dalam `@push('scripts')` atau `<head>`

### 4. **Form Elements**
   - [ ] `{!! NoCaptcha::display() !!}` di dalam `<form>`
   - [ ] Hidden field recaptcha response: `<input name="g-recaptcha-response" type="hidden">`
   - [ ] Form action mengarah ke POST route yang benar
   - [ ] CSRF token ada: `@csrf`

### 5. **Backend Validation**
   ```php
   'g-recaptcha-response' => 'required|captcha',
   ```
   - [ ] Validation rule include `captcha`
   - [ ] Request validator memiliki attribute yang benar

### 6. **Responsive CSS Fix**
   ```css
   #recaptcha-container {
       min-height: 78px;
   }
   ```
   - [ ] CSS untuk responsive reCAPTCHA sudah ada

---

## 🔧 Common Issues & Solutions

### Issue 1: reCAPTCHA Widget tidak tampil
**Solusi:**
```bash
# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan optimize:clear

# Republish package config
php artisan vendor:publish --provider="Anhskohbo\NoCaptcha\NoCaptchaServiceProvider"
```

### Issue 2: "g-recaptcha-response" error saat submit
**Solusi:**
- Pastikan `grecaptcha.getResponse()` di-call dengan benar
- Check JavaScript console untuk errors
- Ensure reCAPTCHA widget fully loaded sebelum form submit

### Issue 3: Validation fails dengan pesan reCAPTCHA
**Solusi:**
- Ensure secret key valid dan tidak expired
- Check server timezone sama dengan Google server
- Enable network access untuk: `https://www.google.com/recaptcha/api/siteverify`

### Issue 4: Form action blank
**Solusi:**
Update form action:
```blade
<form action="{{ route('store-quick-appointment') }}" method="POST">
```

---

## 📝 Updated Files

### 1. `.env` - Environment Variables
- Update dengan reCAPTCHA v2 keys yang valid

### 2. `routes/web.php` - Client-side Route
```php
Route::post('/appointment/store', [AppointmentClient::class, 'storeQuickAppointment'])
    ->name('store-quick-appointment');
```

### 3. `app/Http/Controllers/Client/AppointmentController.php` - New Controller
- Handle form submission dengan reCAPTCHA validation

### 4. `resources/views/components/appointment-form.blade.php` - Form Update
- Update form action ke route yang benar
- reCAPTCHA display sudah ada
- JavaScript validation sudah ada

---

## 🚀 Testing Steps

1. **Test di Browser:**
   ```bash
   php artisan serve
   # Buka http://localhost:8000/id/contact
   ```

2. **Inspect reCAPTCHA:**
   - Open DevTools (F12)
   - Network tab: Check jika `api.js` loading
   - Console: Check untuk JavaScript errors

3. **Submit Form:**
   - Isi semua field
   - Complete reCAPTCHA challenge
   - Submit form
   - Check console untuk response

---

## 📞 Support

Jika masih ada issue:
1. Check PHP error logs: `storage/logs/laravel.log`
2. Check browser console (F12 → Console)
3. Verify reCAPTCHA keys di admin console Google
4. Test dengan fresh keys dari Google reCAPTCHA Admin Console
