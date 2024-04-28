<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'post_title'        => ['required','string','unique:posts,post_title'],
            'post_slug'         => ['required','string','unique:posts,post_slug'],
            'post_description'  => ['required','string','max:255'],
            'is_publish'        => ['required'],
            'post_image'        => ['nullable','image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],

            'meta_title'        => ['required','string','unique:metas,meta_title'],
            'meta_description'  => ['required','string','max:255'],
            'meta_image'        => ['nullable','image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048']
        ];
    }
}
