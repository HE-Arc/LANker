<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


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
          'name' => 'required|string|max:120',
          'date' => 'required|date',
          'start' => 'required|date_format:H:i',
          'end' => 'required|date_format:H:i|after_or_equal:start',
          'location' => 'required|string|max:120',
          'games' => 'string',
          'description' => 'string|max:240|nullable',
          'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
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
          'start.date_format' => 'Time format must be HH:MM!',
          'end.date_format'  => 'Time format must be HH:MM!',
          'image.max'  => 'The image is too big!',
      ];
  }
}
