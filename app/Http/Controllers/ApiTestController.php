<?php

namespace App\Http\Controllers;

class ApiTestController extends Controller
{

    public function privateEndopint()
    {
        return response()->json([
            'status' => true
        ], 200);
    }

}
