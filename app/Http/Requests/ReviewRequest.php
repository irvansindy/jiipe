<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $photoRule = 'required|image|mimes:jpg,jpeg,png,webp|max:2048';

        // Jika update (PUT / PATCH), photo boleh kosong
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $photoRule = 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048';
        }

        return [
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'is_active' => 'sometimes|boolean',
            'description_id' => 'required|string',
            'description_en' => 'required|string',
            'description_zh' => 'required|string',
            'description_ja' => 'required|string',
            'description_ko' => 'required|string',
            'description_tw' => 'required|string',
            'photo' => $photoRule,
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'Nama wajib diisi',
            'position.required' => 'Posisi wajib diisi',
            'description_id.required' => 'Deskripsi (ID) wajib diisi',
            'description_en.required' => 'Deskripsi (EN) wajib diisi',
            'description_zh.required' => 'Deskripsi (ZH) wajib diisi',
            'description_ja.required' => 'Deskripsi (JA) wajib diisi',
            'description_ko.required' => 'Deskripsi (KO) wajib diisi',
            'description_tw.required' => 'Deskripsi (TW) wajib diisi',
            'photo.image' => 'File harus berupa gambar',
            'photo.mimes' => 'Photo hanya mengizinkan jenis file: jpg, jpeg, png, webp',
            'photo.max' => 'Photo maksimal 2MB',
        ];
    }
}
