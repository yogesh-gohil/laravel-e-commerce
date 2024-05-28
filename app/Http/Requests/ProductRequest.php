<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class ProductRequest extends FormRequest
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

        $rules = [
            'name' => [
                'string',
                'required'
            ],
            'cover_photo' => [
                'nullable',
                Rule::when(isset($this->cover_photo) && ($this->cover_photo != 'null'),
                    ['file', 'mimes:gif,jpg,png', 'max:1000']),
            ],
            'photos' => [
                'nullable',
                'array',
            ],
            'removed_photos' => [
                'nullable',
                'array',
            ],
            'category_id' => [
                'required',
                Rule::exists('categories', 'id'),
            ],
            'price' => [
                'required'
            ],
            'stock' => [
                'numeric',
                'required'
            ],
            'description' => [
                'string',
                'nullable'
            ],
            'sale_price' => [
                'nullable'
            ],
            'is_featured' => [
                'nullable'
            ],
            'unavailable' => [
                'nullable'
            ],
        ];

        return $rules;
    }


    public function getProductPayload()
    {
        return collect($this->validated())
            ->except([
                'photos',
            ])
            ->toArray();
    }
}
