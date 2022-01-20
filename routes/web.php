<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProvinsiController;

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

/*
 * ------------------------------------------------------------------------
 * UMUM
 * ------------------------------------------------------------------------
 */
Route::get  ("/",           [LoginController::class,    "index"]);
Route::post ("/login",      [LoginController::class,    "login"]);
Route::get  ("/logout",     [LoginController::class,    "logout"]);
Route::get  ("/lupa",       [LoginController::class,    "lupa"]);

/*
 * ------------------------------------------------------------------------
 * PROVINSI
 * ------------------------------------------------------------------------
 */
Route::prefix("provinsi")->group(function (){
    Route::redirect("/","/provinsi/dashboard");

    Route::get  ("/dashboard",                  [ProvinsiController::class,     "index"]);

    Route::get  ("/antigen/dashboard",          [ProvinsiController::class,     "antigenDashboard"]);
    Route::get  ("/antigen/edit/{id}",          [ProvinsiController::class,     "antigenEdit"]);
    Route::post ("/antigen/edit/kirim",         [ProvinsiController::class,     "antigenEditKirim"]);
    Route::get  ("/antigen/tambah",             [ProvinsiController::class,     "antigenTambah"]);
    Route::post ("/antigen/tambah/kirim",       [ProvinsiController::class,     "antigenTambahKirim"]);

    Route::get  ("/capaian/kabupaten",          [ProvinsiController::class,     "capaianKabupaten"]);
    Route::get  ("/capaian/kampung",            [ProvinsiController::class,     "capaianKampung"]);
    Route::get  ("/capaian/provinsi",           [ProvinsiController::class,     "capaianProvinsi"]);
    Route::get  ("/capaian/puskesmas",          [ProvinsiController::class,     "capaianPuskesmas"]);

    Route::get  ("/data-anak/dashboard",        [ProvinsiController::class,     "anakDashboard"]);
    Route::get  ("/data-anak/detail/{id}",      [ProvinsiController::class,     "anakDetail"]);

    Route::get  ("/akun/dashboard",             [ProvinsiController::class,     "akunDashboard"]);
    Route::get  ("/akun/edit/{id}",             [ProvinsiController::class,     "akunEdit"]);
    Route::post ("/akun/edit/kirim",            [ProvinsiController::class,     "akunEditKirim"]);
    Route::get  ("/akun/ganti-pass/{id}",       [ProvinsiController::class,     "akunGantiPass"]);
    Route::post ("/akun/ganti-pass/kirim",      [ProvinsiController::class,     "akunGantiPassKirim"]);
    Route::get  ("/akun/tambah",                [ProvinsiController::class,     "akunTambah"]);
    Route::post ("/akun/tambah/kirim",          [ProvinsiController::class,     "akunTambahKirim"]);

    Route::get  ("/regional-kampung/dashboard",         [ProvinsiController::class,     "kampungDashboard"]);
    Route::get  ("/regional-kampung/edit/{id}",         [ProvinsiController::class,     "kampungEdit"]);
    Route::post ("/regional-kampung/edit/kirim",        [ProvinsiController::class,     "kampungEditKirim"]);
    Route::get  ("/regional-kampung/tambah",            [ProvinsiController::class,     "kampungTambah"]);
    Route::post ("/regional-kampung/tambah/kirim",      [ProvinsiController::class,     "kampungTambahKirim"]);

    Route::get  ("/regional-posyandu/dashboard",         [ProvinsiController::class,     "posyanduDashboard"]);
    Route::get  ("/regional-posyandu/edit/{id}",         [ProvinsiController::class,     "posyanduEdit"]);
    Route::post ("/regional-posyandu/edit/kirim",        [ProvinsiController::class,     "posyanduEditKirim"]);
    Route::get  ("/regional-posyandu/tambah",            [ProvinsiController::class,     "posyanduTambah"]);
    Route::post ("/regional-posyandu/tambah/kirim",      [ProvinsiController::class,     "posyanduTambahKirim"]);
});


