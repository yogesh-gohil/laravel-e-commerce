<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
              'required'
            ],
            'image' => [
              'nullable',
              Rule::when(isset($this->image) && ($this->image != 'null'),
              ['file', 'mimes:gif,jpg,jpeg,png,webp', 'max:1000']),
            ],
        ];

        return $rules;
    }


    public function getCategoryPayload()
    {
      return collect($this->validated())
            ->toArray();
    }
}
