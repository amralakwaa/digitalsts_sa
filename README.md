# STS — Smart Tech Systems Platform
### منصة وحلول شركة STS للأنظمة الأمنية والتقنية الذكية المتكاملة

منصة مؤسسية احترافيّة متكاملة لشركة **STS (Smart Tech Systems)** متخصصة في الأنظمة الأمنية والحلول الذكية، مبنية بأحدث الممارسات الهندسية باستخدام **Laravel 10**, **PHP 8.1+**, **MySQL**, **Tailwind CSS 3**, **Alpine.js**, و **Vite**.

---

## 🌟 مميزات المنصة الرئيسية

1. **تصميم بصري فاخر (High-Tech Aesthetics):**
   - هوية داكنة راقية (Deep Navy / Neon Blue & Tech Cyan) تناسب كبرى شركات التكنولوجيا والأمن.
   - تأثيرات الزجاج المصقول (Glassmorphism) وشبكات إلكترونية ناعمة (Circuit Matrix Grids).
   - خطوط عصرية من Google Fonts: **Cairo** للواجهة العربية و**Outfit / Inter** للواجهة الإنجليزية.

2. **ثنائية اللغة الكاملة (Bilingual Arabic & English with RTL/LTR):**
   - دعم كامل وتبديل فوري عبر رابط `/lang/{locale}` دون فقدان الصفحة الحالية.
   - قوالب متجاوبة مع اتجاه الكتابة `dir="rtl"` و `dir="ltr"`.
   - محتوى الخدمات والمشاريع ثنائي اللغة من قاعدة البيانات.

3. **منظومة الخدمات الأمنية والذكية الكاملة (12 خدمة معتمدة):**
   - أنظمة كاميرات المراقبة CCTV (CCTV Surveillance Systems)
   - أنظمة التحكم في الدخول Access Control
   - أنظمة الحضور والانصراف Attendance Systems
   - أنظمة إنذار الحريق Fire Alarm Systems
   - أنظمة كشف التسلل Intrusion Alarm Systems
   - الشبكات والبنية التحتية Networks & Infrastructure
   - مراكز البيانات Data Centers & Server Rooms
   - أنظمة المنازل الذكية Smart Home Automation
   - الأنظمة السمعية والبصرية Audio-Visual Systems
   - حلول الفنادق والضيافة Hospitality Solutions
   - تكامل الأنظمة System Integration
   - الصيانة والدعم الفني Maintenance & Technical Support

4. **نظام طلبات عروض الأسعار الذكي (Smart RFP / Quotation Engine):**
   - نموذج متقدم لجمع متطلبات المشروع، والمساحة، والميزانية التقديرية، والخدمة المطلوبة.
   - رفع آمن للمخططات والمستندات الهندسية (PDF, DWG, ZIP, JPG - حتى 10MB).
   - توليد تلقائي لرقم مرجعي فريد لتتبع الطلب: مثل `STS-2026-XXXX`.
   - معالجة آمنة عبر Transactions في قاعدة البيانات وحماية ضد الهجمات وتكرار الإرسال.

5. **لوحة تحكم إدارية متطورة ومحمية (STS Command Center):**
   - مسار محمي ومخصص عبر بوابة الإدارة: `/admin/login`.
   - إحصائيات حية ورسوم بيانية KPI لحالات الطلبات (جديدة، قيد المراجعة، تم التواصل، مكتملة).
   - إدارة طلبات الأسعار وتحديث حالتها وإضافة ملاحظات هندسية داخلية وتحميل المرفقات.
   - إدارة الخدمات والمشاريع المنفذة وتفعيل/تعطيل النشر.
   - إدارة رسائل التواصل الواردة.

6. **اختبارات آلية وجودة برمجية (QA & Automated Testing):**
   - 11 اختبار وظيفي مغطى بالكامل (Feature Tests) ناجح بنسبة 100%.

---

## 🔐 بيانات الدخول الافتراضية للوحة التحكم (Admin Portal)

| الحقل | القيمة |
| :--- | :--- |
| **رابط الدخول** | `http://127.0.0.1:8000/admin/login` |
| **البريد الإلكتروني** | `admin@sts.com.sa` |
| **كلمة المرور** | `Admin@STS2026` |

---

## 🛠️ متطلبات التشغيل والبيئة (Prerequisites)

- **PHP:** 8.1 أو أحدث (مع إضافات: `pdo_mysql`, `mbstring`, `openssl`, `curl`, `fileinfo`).
- **MySQL / MariaDB:** 10.4 أو أحدث (قاعدة البيانات: `sts_db`).
- **Composer:** 2.x
- **Node.js:** v18.x أو v20.x و **npm**.

---

## 🚀 خطوات التشغيل المحلي السريع (Quick Local Setup)

1. **الدخول إلى مجلد المشروع:**
   ```bash
   cd c:\xampp\htdocs\fristpro
   ```

2. **التأكد من تشغيل Apache و MySQL في XAMPP Control Panel.**

3. **إعداد ملف البيئة `.env`:**
   ```env
   APP_NAME="STS Smart Tech Systems"
   APP_URL=http://127.0.0.1:8000
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=sts_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **تشغيل التهجير والتغذية بالبيانات الأولية:**
   ```bash
   php artisan migrate:fresh --seed
   ```

5. **بناء أصول الواجهة الأمامية:**
   ```bash
   npm run build
   ```

6. **تشغيل خادم التطوير:**
   ```bash
   php artisan serve --port=8000
   ```
   افتح المتصفح على: `http://127.0.0.1:8000`

---

## 🧪 تشغيل الاختبارات الآلية (Running Feature Tests)

```bash
php artisan test
```

نتائج الاختبار:
```
PASS  Tests\Feature\StsPlatformTest
✓ home page loads successfully
✓ services page loads
✓ single service page loads
✓ sectors page loads
✓ projects page loads
✓ quote page loads
✓ contact page loads
✓ language switch
✓ quote request submission stores in database
✓ unauthenticated user cannot access admin dashboard
✓ admin can login and access dashboard

Tests: 11 passed (21 assertions)
```

---

## 📁 البنية الهيكلية للمشروع

```
fristpro/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/ (AuthController, DashboardController, QuoteController, ServiceController, ProjectController, MessageController)
│   │   │   ├── HomeController.php
│   │   │   ├── ServiceController.php
│   │   │   ├── ProjectController.php
│   │   │   ├── QuoteController.php
│   │   │   ├── ContactController.php
│   │   │   ├── PageController.php
│   │   │   └── LocaleController.php
│   │   ├── Middleware/ (SetLocale.php, AdminMiddleware.php, Authenticate.php)
│   │   └── Requests/ (QuoteRequestStoreRequest.php, ContactStoreRequest.php)
│   └── Models/ (User, Service, Project, ProjectImage, QuoteRequest, ContactMessage, SiteSetting)
├── database/
│   ├── migrations/ (10 migrations covering users, services, projects, quotes, messages, settings)
│   └── seeders/ (UserSeeder, ServiceSeeder, ProjectSeeder, SiteSettingSeeder)
├── lang/
│   ├── ar/ (messages.php)
│   └── en/ (messages.php)
├── resources/
│   ├── css/ (app.css with custom gradients, tech patterns, and Tailwind directives)
│   ├── js/ (app.js with Alpine.js and Lucide bootstrap)
│   └── views/
│       ├── layouts/ (app.blade.php, admin.blade.php)
│       ├── components/ (service-card, project-card, section-heading)
│       ├── pages/ (home, about, sectors, quote, contact, legal, services/*, projects/*)
│       └── admin/ (auth/login, dashboard, quotes/*, services/*, projects/*, messages/*)
└── routes/
    └── web.php (All public and protected admin endpoints)
```
