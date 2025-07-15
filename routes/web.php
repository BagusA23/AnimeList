<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;

//github route
Route::get('/auth/github', function () {
    return Socialite::driver('github')->redirect();
});

Route::get('/auth/github/callback', function () {
    $githubUser = Socialite::driver('github')->stateless()->user();

    // Cari user berdasarkan email terlebih dahulu (lebih aman)
    $user = User::where('email', $githubUser->getEmail())->first();

    if ($user) {
        // Kalau user sudah ada → update github_id dan token
        $user->update([
            'github_id' => $user->github_id ?? $githubUser->getId(),
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
            'avatar' => $githubUser->avatar ?? null,
        ]);
    } else {
        // User baru → buat akun baru
        $user = User::create([
            'name' => $githubUser->getName() ?? $githubUser->getNickname(),
            'email' => $githubUser->getEmail(),
            'github_id' => $githubUser->getId(),
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
            'avatar' => $githubUser->avatar ?? null,
            'password' => bcrypt(Str::random(40)), // biar gak bisa login pakai password
        ]);
    }

    Auth::login($user);

    return redirect('/dashboard');
});


Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

