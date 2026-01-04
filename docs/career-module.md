# Career Module — SRP Refactor

This document explains the refactor applied to the Career module to follow Single Responsibility Principle and match the structure used by the Home Slider.

Overview

-   Controller: `App\Http\Controllers\Admin\CareerController` — now thin, only handles request/response and delegates to services.
-   Services:
    -   `App\Services\CareerService` — handles career CRUD, header & section saving (translations and file handling).
    -   `App\Services\CareerEmailService` — handles enquiries (CareerEmail) CRUD and file handling (CV uploads).
-   Form Requests:
    -   `App\Http\Requests\CareerRequest`
    -   `App\Http\Requests\CareerEmailRequest`
    -   `App\Http\Requests\CareerHeaderRequest`
    -   `App\Http\Requests\CareerSectionRequest`

Notes

-   File uploads are saved under `public/uploads/{folder}` where `{folder}` is `career/header` (for header images) or `career/email` (for enquire files).
-   Translations are saved/updated via the service methods using the models `CareerHeaderTranslation` and `CareerSectionTranslation`.
-   The controller keeps the same route names / request inputs to avoid breaking front-end code (mapping performed where request field names differ).

How to maintain

-   Keep business logic in services and validation in FormRequest.
-   Controllers should not contain DB transactions or file management logic; delegate to services.

If you'd like, I can:

-   Add unit/integration tests for critical flows
-   Add example usage or update any front-end JS to improve UX
