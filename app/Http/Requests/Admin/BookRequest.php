<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title' => [
             'required',
             'string',
             'min:3',
             'max:255'
            ],
            'author' => [
             'required',
             'string',
             'min:3',
             'max:255'
            ],
            'publication_year' => [
             'required',
             'integer',
             'numeric',
            ],
            'isbn' => [
             'required',
             'string',
             'min:3',
             'max:255'
            ],
            'language' => [
             'required',
             new Enum(BookLanguage::class),
            ],
            'synopsis' => [
             'nullable',
            ],
            'number_of_pages' => [
                'required',
                'integer',
                'numeric',
            ],
            'cover' => [
             'nullable',
             'mimes:png,jpg,webp',
             'max:255'
            ],
            'price' => [
                'required',
                'min:0',
                'numeric',
            ],
            'category_id' => [
                'required',
                'exists:castegories.id',
            ],
            'publisher_id' => [
                'required',
                'exists:publishers.id',
            ],
         ];
    }

    public function attributes():array
    {
        return [
            'title' => 'Judul',
            'author' => 'Penulis',
            'publication_year' => 'Tahun Terbit',
            'isbn' => 'ISBN',
            'language' => 'Bahasa',
            'Synopsis' => 'Sinopsis',
            'cover' => 'Cover',
            'category_id' => 'Kategori',
            'publisher_id' => 'Penerbit',
        ];
    }

}
