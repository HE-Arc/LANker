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
      'email' => 'email',
      'password' => 'confirmed',
      'description' => 'max:512',
      'games' => 'string',
      'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ];
  }
}
