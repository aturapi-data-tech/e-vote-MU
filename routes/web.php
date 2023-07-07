<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Post\PostTable;
use Illuminate\Support\Facades\Route;

use App\Http\Livewire\MasterLevelSatu\MasterLevelSatu;
use App\Http\Livewire\MasterLevelDua\MasterLevelDua;

use App\Http\Livewire\CalonFormatur\CalonFormatur;
use App\Http\Livewire\FormaturVote\FormaturVote;
use App\Http\Livewire\FormaturHasil\FormaturHasil;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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




Route::get('masterlevelsatu', MasterLevelSatu::class)->name('MasterLevelSatu');
Route::get('masterleveldua', MasterLevelDua::class)->middleware('auth')->name('MasterLevelDua');

Route::get('calonFormatur', calonFormatur::class)->name('calonFormatur');
Route::get('formaturVote', formaturVote::class)->name('formaturVote');
Route::get('formaturHasil', formaturHasil::class)->name('formaturHasil');
Route::get('apiChart', [formaturHasil::class, 'apiChart'])->name('api.chart');




require __DIR__ . '/auth.php';
