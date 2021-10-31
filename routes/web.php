<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\MasterdataGuru; //Load class Guru
use App\Http\Livewire\MasterdataSiswa; //Load class Siswa
use App\Http\Livewire\MasterdataKelas; //Load class Kelas
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');

    Route::get('masterdata_guru', MasterdataGuru::class)->name('masterdata_guru'); //Tambahkan routing ini
    Route::get('masterdata_siswa', MasterdataSiswa::class)->name('masterdata_siswa'); //Tambahkan routing ini
    Route::get('masterdata_kelas', MasterdataKelas::class)->name('masterdata_kelas'); //Tambahkan routing ini

});