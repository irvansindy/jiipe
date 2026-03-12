# 🚀 JIIPE Social Sharing - Quick Start Guide

Panduan cepat untuk setup dan testing fitur social sharing dengan short links.

---

## ⚡ Setup (5 Menit)

### 1️⃣ Run Migration

```bash
php artisan migrate
```

✅ Ini akan menambah kolom `short_code` ke tabel `news`

### 2️⃣ Clear Cache (Optional)

```bash
php artisan config:cache
php artisan view:cache
```

### 3️⃣ Done! ✨

Tidak perlu install package tambahan atau konfigurasi kompleks.

---

## 🧪 Testing (Per Artikel)

### 1. Buka Halaman Detail Artikel

```
http://localhost:8000/{locale}/blog/{article_id}
```

Contoh: `http://localhost:8000/en/blog/1`

### 2. Cek yang sudah ada:

- [x] **Social Sharing Buttons** - Muncul di bawah konten artikel
    - Facebook button (blue)
    - Twitter button (light blue)
    - LinkedIn button (dark blue)
    - WhatsApp button (green)
    - Email button (red)
    - Copy Link button (gray)

- [x] **Short Link Display** - Terlihat di bawah buttons (desktop)
    - Input field dengan short link
    - Copy button untuk copy ke clipboard

- [x] **OG Meta Tags** - Di HTML `<head>` (inspect source code)
    ```html
    <meta property="og:title" content="..." />
    <meta property="og:description" content="..." />
    <meta property="og:image" content="..." />
    <meta property="og:url" content="..." />
    ```

### 3. Verify Database

```sql
SELECT id, title, short_code, is_published FROM news WHERE id = 1;
```

✅ Harus ada short_code (format: `n-XXXXXXXX`)

### 4. Test Short Link Redirect

```
http://localhost:8000/{locale}/s/{short_code}
```

Contoh: `http://localhost:8000/en/s/n-abc12345`

✅ Harus redirect ke detail page

---

## 🔗 Social Media Preview Testing

### Facebook:

1. Buka: https://developers.facebook.com/tools/debug/og/object/
2. Paste short link: `http://localhost:8000/en/s/n-abc12345`
3. Lihat preview dengan judul & gambar artikel

### Twitter:

1. Buka: https://cards-dev.twitter.com/validator
2. Paste short link
3. Lihat Twitter Card preview

### LinkedIn:

1. Klik share button di halaman detail
2. Lihat preview dengan judul & image

### WhatsApp:

1. Klik WhatsApp button di halaman detail
2. Pilih chat/contact
3. Pesan akan auto-fill dengan title & link

---

## 📊 Database Schema

```sql
-- New column at news table:
ALTER TABLE news ADD COLUMN short_code VARCHAR(255) UNIQUE NULLABLE;

-- Contoh data:
| id | title | short_code | thumbnail | is_published |
|----|-------|-----------|-----------|--------------|
| 1  | Judul | n-abc1234 | image.jpg | 1            |
```

---

## 🔍 Files Created/Modified Summary

| File                                                                     | Type          | Action      |
| ------------------------------------------------------------------------ | ------------- | ----------- |
| `database/migrations/2026_03_12_000001_add_short_code_to_news_table.php` | Migration     | ✅ Created  |
| `app/Helpers/ShareLinkHelper.php`                                        | Helper        | ✅ Created  |
| `resources/views/components/social-sharing.blade.php`                    | Component     | ✅ Created  |
| `app/Http/Controllers/Client/NewsBlogController.php`                     | Controller    | 🔄 Modified |
| `app/Models/News.php`                                                    | Model         | 🔄 Modified |
| `resources/views/layouts/client/main.blade.php`                          | Layout        | 🔄 Modified |
| `resources/views/layouts/client/blog/sections/content-detail.blade.php`  | View          | 🔄 Modified |
| `routes/web.php`                                                         | Routes        | 🔄 Modified |
| `resources/lang/en/system.php`                                           | Language      | 🔄 Modified |
| `resources/lang/id/system.php`                                           | Language      | 🔄 Modified |
| `docs/SOCIAL_SHARING_IMPLEMENTATION.md`                                  | Documentation | ✅ Created  |

---

## 💡 How It Works (Simple Explanation)

```
1. User buka artikel detail (/blog/1)
   ↓
2. Controller auto-generate short code jika belum ada (n-abc1234)
3. Save ke database & build OG meta data
   ↓
4. Pass data ke view:
   - ogMeta (untuk social preview)
   - shareData (untuk social buttons)
   ↓
5. Blade render:
   - OG meta tags di <head>
   - Social buttons component
   ↓
6. User klik share button
   - Facebook: Opens https://www.facebook.com/sharer/...
   - Twitter: Opens https://twitter.com/intent/tweet?...
   - Copy Link: Copy short URL ke clipboard
   ↓
7. Orang lain terima shared message dengan:
   - Judul artikel
   - Gambar artikel
   - Short link: /s/n-abc1234
   ↓
8. Saat klik short link:
   - Redirect ke full URL: /blog/1
```

---

## 🎯 Key URLs

| Action         | URL                                          |
| -------------- | -------------------------------------------- |
| Detail Page    | `/id/blog/{id}` atau `/en/blog/{id}`         |
| Short Link     | `/id/s/{shortCode}` atau `/en/s/{shortCode}` |
| Facebook Share | Handled by FB button                         |
| Twitter Share  | Handled by Twitter button                    |
| LinkedIn Share | Handled by LI button                         |
| WhatsApp Share | Handled by WA button                         |
| Email Share    | Handled by email client                      |

---

## ❓ FAQ

**Q: Apa itu short code?**
A: Kode unik untuk artikel, format `n-XXXXXXXX`. Digunakan untuk membuat short link yang mudah dibagikan.

**Q: Berapa karakter short code?**
A: 11 karakter total (prefix `n-` + 8 random chars)

**Q: Apakah short code unique?**
A: Ya, di-set sebagai UNIQUE constraint di database

**Q: Bagaimana jika short code sudah ada?**
A: Tidak akan di-generate ulang, menggunakan yang sudah ada

**Q: Apakah bisa change short code?**
A: Bisa, tapi 301 redirect akan break. Better jangan di-change.

**Q: Support bahasa apa saja?**
A: Saat ini EN & ID. Bisa add language lain di `resources/lang/{locale}/system.php`

**Q: Apa OG meta tags?**
A: Meta tags untuk social media preview (judul, deskripsi, gambar)

**Q: Bagaimana jika artikel dihapus?**
A: Short link akan return 404 (karena `firstOrFail()`)

---

## 🐛 Troubleshooting

| Problem                     | Solution                                                     |
| --------------------------- | ------------------------------------------------------------ |
| Migration error             | Pastikan sudah run `php artisan migrate`                     |
| Short code null             | Refresh page, akan auto-generate                             |
| OG meta tidak muncul        | Inspect HTML source (bukan Dev Tools preview)                |
| Social buttons tidak tampil | Clear view cache: `php artisan view:cache`                   |
| Copy link tidak bekerja     | Test di Chrome/Firefox/Safari (older browser punya fallback) |
| Short link return 404       | Pastikan short_code ada di database                          |

---

## 📱 Responsive Design

- **Desktop** (> 576px):
    - Buttons dengan text: `Facebook`, `Twitter`, dll
    - Short link display visible
    - 6 buttons per row

- **Tablet** (768px - 991px):
    - Buttons dengan text
    - Short link display visible
    - Wrap ke 3 buttons per row

- **Mobile** (< 576px):
    - Buttons icon only (no text)
    - Short link display hidden
    - Buttons stacked/wrapped

---

## 🎨 Colors (Brand Consistent)

- **Accent Red**: #d22c12 (shared link border)
- **Facebook**: #1877f2
- **Twitter**: #1da1f2
- **LinkedIn**: #0077b5
- **WhatsApp**: #25d366
- **Email**: #ea4335
- **Copy**: #6c757d

---

## 📚 Additional Resources

- OpenGraph Docs: https://ogp.me/
- Twitter Cards: https://developer.twitter.com/en/docs/twitter-for-websites/cards/
- ShareThis Testing: https://www.sharethis.com/
- Facebook Debugger: https://developers.facebook.com/tools/debug/og/

---

## ✅ Deployment Checklist

- [ ] Run migration: `php artisan migrate`
- [ ] Clear caches: `php artisan cache:clear`
- [ ] Test article detail page
- [ ] Test social buttons functionality
- [ ] Test short link redirect
- [ ] Verify OG meta tags
- [ ] Test mobile responsiveness
- [ ] Check database for short_codes

---

**Selamat! Fitur social sharing sudah siap digunakan.** 🎉

Untuk pertanyaan lebih detail, lihat `docs/SOCIAL_SHARING_IMPLEMENTATION.md`
