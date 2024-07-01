<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BannerRequest extends FormRequest
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
            'active' => [
              'string'
            ],
            'heading' => [
              'string',
              'nullable'
            ],
        ];

        return $rules;
    }


    public function getBannerPayload()
    {
      return collect($this->validated())
            ->merge(['active' => $this->active == 'true' ? 1 : 0])
            ->toArray();
    }
}
