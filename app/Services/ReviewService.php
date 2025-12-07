<?php

namespace App\Services;

use App\Models\Review;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ReviewService
{
    protected $locales = ['id', 'en', 'zh', 'ja', 'ko', 'tw'];

    public function fetch(string $locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        return Review::with(['translations' => function ($q) use ($locale) {
            $q->where('locale', $locale);
        }])->get();
    }

    public function find(int $id)
    {
        return Review::with('translations')->findOrFail($id);
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $photoPath = null;
            if (!empty($data['_file_photo']) && $data['_file_photo']->isValid()) {
                $photoPath = $data['_file_photo']->store('reviews/photos', 'uploads');
            }

            $review = Review::create([
                'name' => Arr::get($data, 'name'),
                'position' => Arr::get($data, 'position'),
                'is_active' => Arr::get($data, 'is_active', 0),
                'photo' => $photoPath,
            ]);

            foreach ($this->locales as $locale) {
                $field = 'description_' . $locale;
                if (isset($data[$field]) && $data[$field] !== null) {
                    $review->translations()->create([
                        'locale' => $locale,
                        'description' => $data[$field],
                    ]);
                }
            }

            DB::commit();
            return $review->load('translations');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function update(int $id, array $data)
    {
        DB::beginTransaction();
        try {
            $review = Review::findOrFail($id);

            $review->name = Arr::get($data, 'name', $review->name);
            $review->position = Arr::get($data, 'position', $review->position);
            $review->is_active = Arr::get($data, 'is_active', $review->is_active);

            if (!empty($data['_file_photo']) && $data['_file_photo']->isValid()) {
                // delete old photo
                if ($review->photo && Storage::disk('uploads')->exists($review->photo)) {
                    Storage::disk('uploads')->delete($review->photo);
                }
                $review->photo = $data['_file_photo']->store('reviews/photos', 'uploads');
            }

            $review->save();

            foreach ($this->locales as $locale) {
                $field = 'description_' . $locale;
                if (array_key_exists($field, $data)) {
                    $value = $data[$field];
                    if ($value !== null) {
                        $review->translations()->updateOrCreate(
                            ['locale' => $locale],
                            ['description' => $value]
                        );
                    }
                }
            }

            DB::commit();
            return $review->load('translations');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function delete(int $id)
    {
        DB::beginTransaction();
        try {
            $review = Review::findOrFail($id);
            if ($review->photo && Storage::disk('uploads')->exists($review->photo)) {
                Storage::disk('uploads')->delete($review->photo);
            }
            $review->translations()->delete();
            $review->delete();
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function toggleStatus(int $id)
    {
        $review = Review::findOrFail($id);
        $review->is_active = !$review->is_active;
        $review->save();
        return $review;
    }
}
