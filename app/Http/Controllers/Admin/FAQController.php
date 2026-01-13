<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FAQRequest;
use App\Services\FAQService;
use App\Helpers\FormatResponseJson;
use Illuminate\Http\Request;
use Exception;
class FAQController extends Controller
{
    protected $faqService;

    public function __construct(FAQService $faqService)
    {
        $this->faqService = $faqService;
    }
    /**
     * Fetch all FAQs
     */
    public function fetch(Request $request)
    {
        try {
            $locale = $request->get('locale', app()->getLocale());
            $faqs = $this->faqService->getAllFAQs($locale);

            $message = $faqs->isEmpty() ? 'No data found' : 'Success fetch data FAQs';
            return FormatResponseJson::success($faqs, $message);
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    /**
     * Store new FAQ
     */
    public function store(FAQRequest $request)
    {
        try {
            $faq = $this->faqService->createFAQ($request->validated());

            return FormatResponseJson::success($faq, 'Success create FAQ');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    /**
     * Show FAQ detail
     */
    public function show(int $id)
    {
        try {
            $faq = $this->faqService->getFAQById($id);

            return FormatResponseJson::success($faq, 'Success fetch FAQ data');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    /**
     * Show edit form data
     */
    public function edit(int $id)
    {
        try {
            $faq = $this->faqService->getFAQById($id);

            return response()->json($faq);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    /**
     * Update FAQ
     */
    public function update(FAQRequest $request, int $id)
    {
        try {
            $faq = $this->faqService->updateFAQ($id, $request->validated());

            return response()->json([
                'success' => true,
                'message' => 'FAQ updated successfully!',
                'data' => $faq
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    /**
     * Delete FAQ
     */
    public function destroy(int $id)
    {
        try {
            $this->faqService->deleteFAQ($id);

            return response()->json([
                'success' => true,
                'message' => 'FAQ deleted successfully!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    /**
     * Toggle FAQ status
     */
    public function toggleStatus(int $id)
    {
        try {
            $faq = $this->faqService->toggleStatus($id);

            return response()->json([
                'success' => true,
                'is_active' => $faq->is_active,
                'message' => 'Status updated successfully!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Reorder FAQs
     */
    public function reorder(Request $request)
    {
        try {
            $data = $request->validate([
                'order' => 'required|array',
                'order.*' => 'integer'
            ]);

            $this->faqService->reorder($data['order']);

            return response()->json([
                'success' => true,
                'message' => 'Order updated successfully!'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
