<?php

use Illuminate\Support\Facades\Route;
use LaravelLinear\Http\Controllers\LinearTokenController;
use LaravelLinear\Http\Livewire\Auth;
use LaravelLinear\Http\Livewire\Config;
use LaravelLinear\Http\Middleware\LinearManagementAllowed;

Route::group(
    ['middleware' => ['web', 'auth', LinearManagementAllowed::class]],
    function () {
        Route::get('/linear/auth', Auth::class)->name('linear.auth');
        Route::get('/linear/config/{linear_token:id}', Config::class)->name('linear.config');

        Route::get('/linear/oauth2', [LinearTokenController::class, 'redirectToProvider'])
            ->name('linear.oauth.redirect');

        Route::get('/linear/oauth2/callback', [LinearTokenController::class, 'handleProviderCallback'])->name('linear.oauth.callback');
    }
);
