<?php

namespace App\Http\Controllers;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function privateEndopint()
    {
        return response()->json([
            'status' => true
        ], 200);
    }

}
