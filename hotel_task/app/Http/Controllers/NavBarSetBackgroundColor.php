<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class NavBarSetBackgroundColor extends Controller
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'color' => ['required', 'string', 'in:white,black,red,yellow']
        ]);

        if($validator->failed()) {
            Session::put('navbar-background-color', 'red');
        }

        Session::put('navbar-background-color', $validator->validated()['color']);

        return redirect()->back();
    }
}
