<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Rules\EndDateAfterStartDate;
use App\Rules\EventNameNotTaken;

class EventEditRequest extends FormRequest
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
          'event_name' => ['string', 'max:120'],
          'host_name' => 'string|max:120',
          'start_date' => 'nullable|required_with:end_date,start_time,end_time|date',
          'end_date' => ['nullable', 'required_with:start_date,start_time,end_time', 'date', 'after_or_equal:start_date', new EndDateAfterStartDate($this->input('start_date'), $this->input('start_time'), $this->input('end_date'), $this->input('end_time'))],
          'start_time' => 'nullable|required_with:start_date,end_date,end_time|date_format:H:i',
          'end_time' => ['nullable', 'required_with:start_date,end_date,start_time,end_time', 'date_format:H:i', new EndDateAfterStartDate($this->input('start_date'), $this->input('start_time'), $this->input('end_date'), $this->input('end_time'))],
          'location' => 'string|max:120',
          'games' => 'nullable|string',
          'description' => 'string|max:240|nullable',
          'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          'price' => 'numeric|min:0',
          'seats' => 'numeric|min:0'
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
