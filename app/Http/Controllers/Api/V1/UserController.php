<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // check data required
        if (
            empty($request->input('mobile_number'))
        ) {
            return parent::error( 'data_required');
//            return $this->outApiJson(false, 'data_required');
        }
    }
}
