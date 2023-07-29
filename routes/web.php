<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controller\User;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Profile;
use App\Http\Controllers\SpeedController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('home', ['title' => 'home']);
});
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
// dashboard
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// profile
Route::middleware(['web', 'auth'])->group(function () {
Route::get('/profile', [Profile::class, 'index'])->name('profile');});
Route::get('profile/edit/email', [Profile::class, 'editEmail'])->name('profile.edit.email');
Route::put('profile/update/email', [Profile::class, 'updateEmail'])->name('profile.update.email');
Route::get('profile/edit/username', [Profile::class, 'editUsername'])->name('profile.edit.username');
Route::put('profile/update/username', [Profile::class, 'updateUsername'])->name('profile.update.username');
Route::get('profile/edit/password', [Profile::class, 'editPassword'])->name('profile.edit.password');
Route::put('profile/update/password', [Profile::class, 'updatePassword'])->name('profile.update.password');
// routes/web.php
Route::middleware(['auth'])->group(function () {
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});




Route::get('/get-speed', [SpeedController::class, 'getSpeed']);


// <form method="post" action="{{ route('logout') }}">
        // @csrf
        // <button type="submit">Logout</button>
// </form>