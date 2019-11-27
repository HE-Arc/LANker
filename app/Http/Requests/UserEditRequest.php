<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserEditRequest extends FormRequest
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
      'email' => 'required|email',
      'password' => 'confirmed',
      'description' => 'max:2048'
    ];
  }

  /**
  * Get the error messages for the defined validation rules.
  *
  * @return array
  */
  public function messages()
  {
    // no custom messages
  }
}
