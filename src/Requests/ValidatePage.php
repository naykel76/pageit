<?php

namespace Naykel\Pageit\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Naykel\Pageit\Models\Page;

class ValidatePage extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'order.integer' => 'The order must be a positive or negative number.',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        /**
         * uploaded_file is guarded so it will be validated,
         * then its converted to db:field in validateMergeData
         */
        return [
            'title' => 'required|max:100',
            'body' => 'sometimes',
            'uploaded_file' => 'sometimes|file|image|max:3000',
            'published_at' => 'sometimes',
            // 'show_title' => 'sometimes',
            // 'headline' => 'sometimes|max:255',
            // 'description' => 'sometimes|max:255',
            // 'order' => 'sometimes|integer',
            // 'template' => 'sometimes',
            // 'layout_type' => 'sometimes',
        ];
    }

    protected function prepareForValidation()
    {


        // if uploaded_file = remove, then clear from db?


        // dd(request()->all());
        if (request('isChecked')) {
            $this->merge([
                'published_at' => now()
            ]);
        } else {
            $this->merge([
                'published_at' => null
            ]);
        }

        if (request('order') === null) {
            $this->merge([
                'order' => 0,
            ]);
        }
    }
}
