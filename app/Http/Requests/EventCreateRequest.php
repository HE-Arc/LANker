<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Rules\EndDateAfterStartDate;

class EventCreateRequest extends FormRequest
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
          'event_name' => 'required|string|max:120',
          'host_name' => 'required|string|max:120',
          'start_date' => 'required|date',
          'end_date' => ['required', 'date', 'after_or_equal:start_date', new EndDateAfterStartDate($this->input('start_date'), $this->input('start_time'), $this->input('end_date'), $this->input('end_time'))],
          'start_time' => 'required|date_format:H:i',
          'end_time' => 'required|date_format:H:i',
          'location' => 'required|string|max:120',
          'game' => 'required|string|max:120',
          'description' => 'string|max:240|nullable',
          'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          'price' => 'nullable|regex:/[0-9]*\.[0-9][0-9]?/',
          'nb_seats' => 'nullable|numeric|min:0'
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
          'start_time.date_format' => 'The time format must be HH:MM!',
          'end_time.date_format'  => 'The time format must be HH:MM!',
          'image.max'  => 'The image is too big!',
          'price.regex' => 'The price given is not in a valid format!',
          'nb_seats.min' => 'The number of seats cannot be negative!'
      ];
  }
}
