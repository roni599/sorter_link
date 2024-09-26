<?php


use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\UserurlController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::middleware(['auth','admin'])->group(function () {
    Route::get('admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
});
Route::get('admin/sortUrl', [UrlController::class, 'index'])->name('admin.sortUrl');
Route::get('/urls', [UrlController::class, 'index'])->name('urls.index');
Route::post('/urls', [UrlController::class, 'store'])->name('urls.store');
Route::get('/{shortUrl}', [UrlController::class, 'show'])->name('urls.redirect');
Route::get('user/urls', [UserurlController::class, 'index'])->name('user.urls');
Route::post('user/urls/create', [UserurlController::class, 'create'])->name('user.urls.create');