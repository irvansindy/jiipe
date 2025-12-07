<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\VideoTour;

class Video360Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // Determine thumbnail requirement: if updating and existing video has thumbnail, make it nullable
        $thumbnailRule = 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096';
        $id = $this->input('id');
        if ($id) {
            $video = VideoTour::find($id);
            if ($video && $video->thumbnail) {
                $thumbnailRule = 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096';
            }
        }

        return [
            'embed_code' => 'required|string',
            'video_title' => 'required|array',
            'video_title.*' => 'required|string',
            'video_thumbnail' => $thumbnailRule,
        ];
    }

    public function messages()
    {
        $messages = [
            'embed_code.required' => 'Embed code is required',
        ];

        $locales = config('laravellocalization.supportedLocales', []);
        foreach ($locales as $locale => $props) {
            $native = isset($props['native']) ? $props['native'] : $locale;
            $messages["video_title.$locale.required"] = "Title ({$native}) is required";
            $messages["video_title.$locale.string"] = "Title ({$native}) must be a string";
        }

        // Thumbnail format message: provide translation per current app locale (id, en, zh, ja, ko, tw)
        $thumbTranslations = [
            'id' => 'Format file tidak didukung',
            'en' => 'File format is not supported',
            'zh' => '不支持的文件格式',
            'ja' => 'ファイル形式はサポートされていません',
            'ko' => '지원되지 않는 파일 형식입니다',
            'tw' => '不支援的檔案格式',
        ];

        $appLocale = strtolower(app()->getLocale() ?? 'en');
        $cur = $appLocale;
        // normalize locales like zh-TW or zh_TW
        if (strpos($cur, '-') !== false) {
            $parts = explode('-', $cur);
            // if region is TW, map to 'tw'
            if (isset($parts[1]) && strtolower($parts[1]) === 'tw') {
                $cur = 'tw';
            } else {
                $cur = $parts[0];
            }
        }
        if (strpos($cur, '_') !== false) {
            $parts = explode('_', $cur);
            if (isset($parts[1]) && strtolower($parts[1]) === 'TW') {
                $cur = 'tw';
            } else {
                $cur = $parts[0];
            }
        }
        if (!isset($thumbTranslations[$cur])) {
            // try zh variants
            if (strpos($appLocale, 'zh') === 0) {
                $cur = (stripos($appLocale, 'tw') !== false || stripos($appLocale, 'hant') !== false) ? 'tw' : 'zh';
            } else {
                $cur = 'en';
            }
        }
        $thumbMsg = $thumbTranslations[$cur] ?? $thumbTranslations['en'];

        $messages['video_thumbnail.mimes'] = $thumbMsg;
        $messages['video_thumbnail.image'] = $thumbMsg;
        $messages['video_thumbnail.required'] = $thumbMsg;

        return $messages;
    }

    public function attributes()
    {
        $attributes = [];
        $locales = config('laravellocalization.supportedLocales', []);
        foreach ($locales as $locale => $props) {
            // map video_title.<locale> to a friendlier name like "video title id"
            $attributes["video_title.$locale"] = 'video title ' . $locale;
        }

        $attributes['embed_code'] = 'embed code';
        $attributes['video_thumbnail'] = 'video thumbnail';

        return $attributes;
    }
}
