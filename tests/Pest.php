<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

use App\Models\User;
use Illuminate\Support\Facades\Http;

uses(
    Tests\TestCase::class,
)->in('Feature');

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

function login()
{
    $request = Http::post(env('APP_URL').'/api/login', [
        'email' => 'user@gmail.com',
        'password' => 'password'
    ]);

    return $request;

}

function logout()
{
    return auth()->guard('api')->logout();
}

function getToken($request)
{
    return json_decode($request->body())->authorisation->token;
}
