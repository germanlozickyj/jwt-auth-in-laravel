<?php

namespace App\Http\Controllers;

class ApiTestController extends Controller
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
