<?php

namespace App\Services;

use App\Models\FrequentlyAskedQuestions;
use App\Models\FrequentlyAskedQuestionsTranslation;
use Illuminate\Support\Facades\DB;
use Exception;

class FAQService
{
    protected $locales = ['id', 'en', 'zh', 'ja', 'ko', 'tw'];

    /**
     * Get all FAQs with translations
     */
    public function getAllFAQs(string $locale = null)
    {
        $locale = $locale ?? app()->getLocale();

        return FrequentlyAskedQuestions::with([
            'translations' => function($query) use ($locale) {
                $query->where('locale', $locale);
            }
        ])->orderBy('position', 'asc')->get();
    }

    /**
     * Get FAQ by ID with all translations
     */
    public function getFAQById(int $id)
    {
        return FrequentlyAskedQuestions::with(['translations'])->findOrFail($id);
    }

    /**
     * Create new FAQ with translations
     */
    public function createFAQ(array $data)
    {
        DB::beginTransaction();

        try {
            $faq = FrequentlyAskedQuestions::create([
                'position' => $data['position'],
                'is_active' => $data['is_active'],
            ]);

            $this->saveTranslations($faq, $data);

            DB::commit();

            return $faq->load('translations');
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Update FAQ with translations
     */
    public function updateFAQ(int $id, array $data)
    {
        DB::beginTransaction();

        try {
            $faq = FrequentlyAskedQuestions::findOrFail($id);

            $faq->update([
                'position' => $data['position'],
                'is_active' => $data['is_active'],
            ]);

            $this->updateTranslations($faq, $data);

            DB::commit();

            return $faq->load('translations');
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Delete FAQ
     */
    public function deleteFAQ(int $id)
    {
        DB::beginTransaction();

        try {
            $faq = FrequentlyAskedQuestions::findOrFail($id);

            // Delete translations first
            $faq->translations()->delete();

            // Delete FAQ
            $faq->delete();

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Toggle FAQ status
     */
    public function toggleStatus(int $id)
    {
        $faq = FrequentlyAskedQuestions::findOrFail($id);
        $faq->is_active = !$faq->is_active;
        $faq->save();

        return $faq;
    }

    /**
     * Save translations for FAQ
     */
    private function saveTranslations(FrequentlyAskedQuestions $faq, array $data)
    {
        foreach ($this->locales as $locale) {
            $questionField = 'question_' . $locale;
            $answerField = 'answer_' . $locale;

            if (!empty($data[$questionField]) || !empty($data[$answerField])) {
                $faq->translations()->create([
                    'locale' => $locale,
                    'question' => $data[$questionField] ?? '',
                    'answer' => $data[$answerField] ?? '',
                ]);
            }
        }
    }

    /**
     * Update translations for FAQ
     */
    private function updateTranslations(FrequentlyAskedQuestions $faq, array $data)
    {
        foreach ($this->locales as $locale) {
            $questionField = 'question_' . $locale;
            $answerField = 'answer_' . $locale;

            if (isset($data[$questionField]) || isset($data[$answerField])) {
                $faq->translations()->updateOrCreate(
                    ['locale' => $locale],
                    [
                        'question' => $data[$questionField] ?? '',
                        'answer' => $data[$answerField] ?? '',
                    ]
                );
            }
        }
    }
}
