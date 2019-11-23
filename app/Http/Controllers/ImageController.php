<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
  public function index() {
      return view('image');
  }

  public function saveUserAvatar(Request $request)
  {
      $validation = request()->validate([
          'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=200,max_width=600,max_height=600'
      ]);

      $validated = $validation->validated();

      if(!$validated){
        // return redirect()->back()->withInput();
        return redirect()->route('dashboard');
      }

      if ($files = $request->file('image')) {

          $image = $request->image->store('public/storage/users');

          return Response()->json([
              "success" => true,
              "image" => $image
          ]);

      }

      return Response()->json([
              "success" => false,
              "image" => ''
          ]);

  }
}
