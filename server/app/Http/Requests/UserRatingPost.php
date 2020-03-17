<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rating;

class UserRatingPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $rating = Rating::find($this->route('user'));

        return $rating && $this->user()->can('post', $rating);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:ratings|max:255',
            'type' => 'required',
            'rating' => 'required'
        ];
    }

        /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'A title is required',
            'type.required'  => 'A type is required',
            'rating.required' => 'A rating is required'
        ];
    }
}
