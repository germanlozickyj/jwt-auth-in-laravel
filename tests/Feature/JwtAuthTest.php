<?php

use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Request;
use App\Models\User;

test('Test refresh method', function () {
    $response = login();
    $old_token = getToken($response);
    expect($response->status())->toBe(200);
    //refresh request
    $refresh_request = Http::withHeaders([
        'Authorization' => 'Bearer ' . $old_token,
        'Accept' => 'application/json',
    ])->post(env('APP_URL').'/api/refresh');
    
    expect($refresh_request->status())->toBe(200);
    $refresh_token = getToken($refresh_request);

    //tests token invalidated
    $request_token_refresh = Http::withHeaders([
        'Authorization' => 'Bearer ' . $refresh_token,
        'Accept' => 'application/json',
    ])->get(env('APP_URL').'/api/private-endpoint');
    
    expect($request_token_refresh->status())->toBe(200);

    $status_token_invalidated = Http::withHeaders([
                                    'Authorization' => 'Bearer ' . $old_token,
                                    'Accept' => 'application/json',
                                ])->get(env('APP_URL').'/api/private-endpoint');

    expect($status_token_invalidated->status())->toBe(401);
});

test('Test login method', function() {
    $user_valid = Http::post(env('APP_URL').'/api/login', [
                    'email' => 'user@gmail.com',
                    'password' => 'password'                   
                ]);
    expect($user_valid->status())->toBe(200);

    $token = getToken($user_valid);

    $user_valid = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token,
        'Accept' => 'application/json',
    ])->get(env('APP_URL').'/api/private-endpoint');

    expect($user_valid->status(200));
    
    $user_invalid = Http::post(env('APP_URL').'/api/login', [
        'email' => 'user@invalid.com',
        'password' => 'password_invalid'                   
    ]);

    expect($user_invalid->status())->toBe(401);
});

