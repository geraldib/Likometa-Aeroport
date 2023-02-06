<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'       => 'required|string|max:255',
            'surname'       => 'required|string|max:255',
            'email'       => 'required|string|max:255',
            'number'       => 'required|max:10|min:10',
            'nr_persons'      => 'required|max:12|min:1',
            'note'        => '',
            'st_location' => 'required|string',
            'end_location'   => 'required|string',
            'st_date'   => 'required',
            'st_time'   => 'required'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Kerkohet te plotesohet!',
            'surname.required' => 'Kerkohet te plotesohet!',
            'email.required' => 'Kerkohet te plotesohet!',
            'number.required' => 'Kerkohet te plotesohet!',
            'nr_persons.required' => 'Kerkohet te plotesohet!',
            'st_location.required' => 'Kerkohet te plotesohet!',
            'end_location.required' => 'Kerkohet te plotesohet!',
            'st_date.required' => 'Kerkohet te plotesohet!',
            'st_time.required' => 'Kerkohet te plotesohet!',
        ];
    }

}
