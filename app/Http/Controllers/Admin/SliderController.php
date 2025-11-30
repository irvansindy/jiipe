<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Services\SliderService;
use App\Helpers\FormatResponseJson;
use Illuminate\Http\Request;
use Exception;

class SliderController extends Controller
{
    protected $sliderService;

    public function __construct(SliderService $sliderService)
    {
        $this->sliderService = $sliderService;
    }

    /**
     * Fetch all sliders with translations
     */
    public function fetch()
    {
        try {
            $sliders = $this->sliderService->getAllSliders();

            return FormatResponseJson::success($sliders, 'Fetched Sliders Successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Fetch single slider by ID
     */
    public function fetchById(Request $request)
    {
        try {
            $slider = $this->sliderService->getSliderById($request->id);

            return FormatResponseJson::success($slider, 'Fetched Slider Successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 404);
        }
    }

    /**
     * Store new slider
     */
    public function store(SliderRequest $request)
    {
        try {
            $file = $request->hasFile('slider_file') ? $request->file('slider_file') : null;
            $slider = $this->sliderService->createSlider($request->validated(), $file);

            return FormatResponseJson::success(['id' => $slider->id], 'Slider created successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Update existing slider
     */
    public function update(SliderRequest $request)
    {
        try {
            $file = $request->hasFile('slider_file') ? $request->file('slider_file') : null;
            $slider = $this->sliderService->updateSlider($request->id, $request->validated(), $file);

            return FormatResponseJson::success(['id' => $slider->id], 'Slider updated successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Delete slider
     */
    public function destroy(int $id)
    {
        try {
            $this->sliderService->deleteSlider($id);

            return FormatResponseJson::success(null, 'Slider deleted successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
}