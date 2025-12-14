<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactOverview;
use App\Models\ContactOverviewTranslation;
use Illuminate\Support\Facades\DB;

class ContactOverviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactOverviewTranslation::truncate();
        ContactOverview::truncate();
        DB::beginTransaction();

        try {
            // Create contact overview
            $contact = ContactOverview::create([
                'image' => 'default-contact.jpg', // Placeholder image
            ]);

            // Translation data for each locale
            $translations = [
                'id' => [
                    'title' => 'Hubungi Kami',
                    'subtitle' => 'Kami Di Sini untuk Mendukung Anda',
                    'description' => '<p>Silakan hubungi hotline kami untuk informasi lebih lanjut (Senin - Jumat, 08.00 - 17.00 waktu setempat)</p><p>Untuk pertanyaan di luar jam operasional, silakan isi formulir kontak dan kami akan menghubungi Anda secepatnya.</p>',
                    'office_name' => 'PT. Berkah Kawasan Manyar Sejahtera',
                    'phone' => '+62 31 985 409 99',
                    'address' => 'Jl. Raya Manyar Km. 11, Manyar-Gresik, East Java 61151',
                    'map_link' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.234!2d112.6046212!3d-7.0856958!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xaee7dea2e8cb80a3!2sJIIPE+Office!5e0!3m2!1sen!2sid!4v1234567890" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
                ],
                'en' => [
                    'title' => 'Contact Us',
                    'subtitle' => 'We are here to support you',
                    'description' => '<p>Please contact our hotline for further information (Monday - Friday, 08.00 - 17.00 local time)</p><p>For inquiries above operating hours, kindly fill in the contact form and we will be in touch with you at our earliest.</p>',
                    'office_name' => 'PT. Berkah Kawasan Manyar Sejahtera',
                    'phone' => '+62 31 985 409 99',
                    'address' => 'Jl. Raya Manyar Km. 11, Manyar-Gresik, East Java 61151',
                    'map_link' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.234!2d112.6046212!3d-7.0856958!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xaee7dea2e8cb80a3!2sJIIPE+Office!5e0!3m2!1sen!2sid!4v1234567890" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
                ],
                'zh' => [
                    'title' => '联系我们',
                    'subtitle' => '我们随时为您提供支持',
                    'description' => '<p>请联系我们的热线获取更多信息（周一至周五，当地时间 08.00 - 17.00）</p><p>如需在营业时间外咨询，请填写联系表格，我们会尽快与您联系。</p>',
                    'office_name' => 'PT. Berkah Kawasan Manyar Sejahtera',
                    'phone' => '+62 31 985 409 99',
                    'address' => 'Jl. Raya Manyar Km. 11, Manyar-Gresik, East Java 61151',
                    'map_link' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.234!2d112.6046212!3d-7.0856958!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xaee7dea2e8cb80a3!2sJIIPE+Office!5e0!3m2!1sen!2sid!4v1234567890" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
                ],
                'ja' => [
                    'title' => 'お問い合わせ',
                    'subtitle' => '私たちはあなたをサポートするためにここにいます',
                    'description' => '<p>詳細については、ホットラインにお問い合わせください（月曜日〜金曜日、現地時間 08.00〜17.00）</p><p>営業時間外のお問い合わせについては、お問い合わせフォームにご記入ください。できるだけ早くご連絡いたします。</p>',
                    'office_name' => 'PT. Berkah Kawasan Manyar Sejahtera',
                    'phone' => '+62 31 985 409 99',
                    'address' => 'Jl. Raya Manyar Km. 11, Manyar-Gresik, East Java 61151',
                    'map_link' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.234!2d112.6046212!3d-7.0856958!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xaee7dea2e8cb80a3!2sJIIPE+Office!5e0!3m2!1sen!2sid!4v1234567890" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
                ],
                'ko' => [
                    'title' => '문의하기',
                    'subtitle' => '우리는 당신을 지원하기 위해 여기에 있습니다',
                    'description' => '<p>자세한 정보는 핫라인으로 문의하십시오 (월요일 - 금요일, 현지 시간 08.00 - 17.00)</p><p>영업 시간 외 문의 사항은 연락처 양식을 작성해 주시면 최대한 빨리 연락 드리겠습니다.</p>',
                    'office_name' => 'PT. Berkah Kawasan Manyar Sejahtera',
                    'phone' => '+62 31 985 409 99',
                    'address' => 'Jl. Raya Manyar Km. 11, Manyar-Gresik, East Java 61151',
                    'map_link' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.234!2d112.6046212!3d-7.0856958!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xaee7dea2e8cb80a3!2sJIIPE+Office!5e0!3m2!1sen!2sid!4v1234567890" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
                ],
                'tw' => [
                    'title' => '聯絡我們',
                    'subtitle' => '我們隨時為您提供支援',
                    'description' => '<p>請聯繫我們的熱線獲取更多資訊（週一至週五，當地時間 08.00 - 17.00）</p><p>如需在營業時間外諮詢，請填寫聯絡表格，我們會盡快與您聯繫。</p>',
                    'office_name' => 'PT. Berkah Kawasan Manyar Sejahtera',
                    'phone' => '+62 31 985 409 99',
                    'address' => 'Jl. Raya Manyar Km. 11, Manyar-Gresik, East Java 61151',
                    'map_link' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.234!2d112.6046212!3d-7.0856958!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xaee7dea2e8cb80a3!2sJIIPE+Office!5e0!3m2!1sen!2sid!4v1234567890" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
                ],
            ];

            // Insert translations
            foreach ($translations as $locale => $data) {
                ContactOverviewTranslation::create([
                    'contact_overviews_id' => $contact->id,
                    'locale' => $locale,
                    'title' => $data['title'],
                    'subtitle' => $data['subtitle'],
                    'description' => $data['description'],
                    'office_name' => $data['office_name'],
                    'phone' => $data['phone'],
                    'address' => $data['address'],
                    'map_link' => $data['map_link'],
                ]);
            }

            DB::commit();

            $this->command->info('Contact Overview seeded successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error('Error seeding Contact Overview: ' . $e->getMessage());
        }
    }
}