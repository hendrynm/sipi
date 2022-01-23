<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\KabupatenController;

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
Route::prefix("/provinsi")->group(function ()
{
    Route::redirect("/","/provinsi/dashboard");
    Route::get  ("/dashboard",              [ProvinsiController::class,"index"]);

    Route::prefix("/antigen")->group(function ()
    {
        Route::get  ("/dashboard",          [ProvinsiController::class,"antigenDashboard"]);
        Route::get  ("/edit/{id}",          [ProvinsiController::class,"antigenEdit"]);
        Route::post ("/edit/kirim",         [ProvinsiController::class,"antigenEditKirim"]);
        Route::get  ("/tambah",             [ProvinsiController::class,"antigenTambah"]);
        Route::post ("/tambah/kirim",       [ProvinsiController::class,"antigenTambahKirim"]);
    });

    Route::prefix("/capaian")->group(function ()
    {
        Route::get  ("/kabupaten",          [ProvinsiController::class,"capaianKabupaten"]);
        Route::get  ("/kampung",            [ProvinsiController::class,"capaianKampung"]);
        Route::get  ("/provinsi",           [ProvinsiController::class,"capaianProvinsi"]);
        Route::get  ("/puskesmas",          [ProvinsiController::class,"capaianPuskesmas"]);
    });

    Route::prefix("/data-anak")->group(function ()
    {
        Route::get  ("/dashboard",          [ProvinsiController::class,"anakDashboard"])->name("prov.anak");
        Route::get  ("/detail/{id}",        [ProvinsiController::class,"anakDetail"]);
    });

    Route::prefix("/akun")->group(function ()
    {
        Route::get  ("/dashboard",          [ProvinsiController::class,"akunDashboard"]);
        Route::get  ("/edit/{id}",          [ProvinsiController::class,"akunEdit"]);
        Route::post ("/edit/kirim",         [ProvinsiController::class,"akunEditKirim"]);
        Route::get  ("/ganti-pass/{id}",    [ProvinsiController::class,"akunGantiPass"]);
        Route::post ("/ganti-pass/kirim",   [ProvinsiController::class,"akunGantiPassKirim"]);
        Route::get  ("/tambah",             [ProvinsiController::class,"akunTambah"]);
        Route::post ("/tambah/kirim",       [ProvinsiController::class,"akunTambahKirim"]);
    });

    Route::prefix("/regional-kampung")->group(function ()
    {
        Route::get  ("/dashboard",          [ProvinsiController::class,"kampungDashboard"])->name("prov.kampung");
        Route::get  ("/edit/{id}",          [ProvinsiController::class,"kampungEdit"]);
        Route::post ("/edit/kirim",         [ProvinsiController::class,"kampungEditKirim"]);
        Route::get  ("/tambah",             [ProvinsiController::class,"kampungTambah"]);
        Route::post ("/tambah/kirim",       [ProvinsiController::class,"kampungTambahKirim"]);
    });

    Route::prefix("/regional-posyandu")->group(function ()
    {
        Route::get  ("/dashboard",          [ProvinsiController::class,"posyanduDashboard"])->name("prov.posyandu");
        Route::get  ("/edit/{id}",          [ProvinsiController::class,"posyanduEdit"]);
        Route::post ("/edit/kirim",         [ProvinsiController::class,"posyanduEditKirim"]);
        Route::get  ("/tambah",             [ProvinsiController::class,"posyanduTambah"]);
        Route::post ("/tambah/kirim",       [ProvinsiController::class,"posyanduTambahKirim"]);
    });

    Route::prefix("/regional-kabupaten")->group(function ()
    {
        Route::get  ("/dashboard",          [ProvinsiController::class,"kabupatenDashboard"]);
        Route::get  ("/edit/{id}",          [ProvinsiController::class,"kabupatenEdit"]);
        Route::post ("/edit/kirim",         [ProvinsiController::class,"kabupatenEditKirim"]);
        Route::get  ("/tambah",             [ProvinsiController::class,"kabupatenTambah"]);
        Route::post ("/tambah/kirim",       [ProvinsiController::class,"kabupatenTambahKirim"]);
    });

    Route::prefix("/regional-puskesmas")->group(function ()
    {
        Route::get  ("/dashboard",          [ProvinsiController::class,"puskesmasDashboard"]);
        Route::get  ("/edit/{id}",          [ProvinsiController::class,"puskesmasEdit"]);
        Route::post ("/edit/kirim",         [ProvinsiController::class,"puskesmasEditKirim"]);
        Route::get  ("/tambah",             [ProvinsiController::class,"puskesmasTambah"]);
        Route::post ("/tambah/kirim",       [ProvinsiController::class,"puskesmasTambahKirim"]);
    });

    Route::prefix("sasaran")->group(function ()
    {
        Route::get  ("/dashboard",          [ProvinsiController::class,"sasaranDashboard"])->name("prov.sasaran");
        Route::get  ("/detail/{id}",        [ProvinsiController::class,"sasaranTarget"]);
    });
});

Route::prefix("/kabupaten")->group(function ()
{
    Route::redirect("/","/kabupaten/dashboard");
    Route::get("/dashboard",                [KabupatenController::class,"dashboard"]);

    Route::prefix("/capaian")->group(function ()
    {
        Route::get("/kabupaten",            [KabupatenController::class,"capaianKabupaten"]);
        Route::get("/kampung",              [KabupatenController::class,"capaianKampung"]);
        Route::get("/puskesmas",            [KabupatenController::class,"capaianPuskesmas"]);
    });

    Route::prefix("/data")->group(function ()
    {
        Route::get("/dashboard",            [KabupatenController::class,"dataDashboard"])->name("kab.anak");
        Route::get("/detail/{id}",          [KabupatenController::class,"dataDetail"]);
    });

    Route::prefix("akun")->group(function ()
    {
        Route::get("/dashboard",            [KabupatenController::class,"akunDashboard"]);
        Route::get("/edit/{id}",            [KabupatenController::class,"akunEdit"]);
        Route::post("/edit/kirim",          [KabupatenController::class,"akunEditKirim"]);
        Route::get("/ganti-pass/{id}",      [KabupatenController::class,"akunGantiPass"]);
        Route::post("/ganti-pass/kirim",    [KabupatenController::class,"akunGantiPassKirim"]);
        Route::get("/tambah",               [KabupatenController::class,"akunTambah"]);
        Route::post("/tambah/kirim",        [KabupatenController::class,"akunTambahKirim"]);
    });

    Route::prefix("regional-kampung")->group(function ()
    {
        Route::get("/dashboard",            [KabupatenController::class,"kampungDashboard"]);
        Route::get("/edit/{id}",            [KabupatenController::class,"kampungEdit"]);
        Route::post("/edit/kirim",          [KabupatenController::class,"kampungEditKirim"]);
        Route::get("/tambah",               [KabupatenController::class,"kampungTambah"]);
        Route::post("/tambah/kirim",        [KabupatenController::class,"kampungTambahKirim"]);
    });

    Route::prefix("regional-posyandu")->group(function ()
    {
        Route::get("/dashboard",            [KabupatenController::class,"posyanduDashboard"]);
        Route::get("/edit/{id}",            [KabupatenController::class,"posyanduEdit"]);
        Route::post("/edit/kirim",          [KabupatenController::class,"posyanduEditKirim"]);
        Route::get("/tambah",               [KabupatenController::class,"posyanduTambah"]);
        Route::post("/tambah/kirim",        [KabupatenController::class,"posyanduTambahKirim"]);
    });

    Route::prefix("/regional-puskesmas")->group(function ()
    {
        Route::get  ("/dashboard",          [KabupatenController::class,"puskesmasDashboard"]);
        Route::get  ("/edit/{id}",          [KabupatenController::class,"puskesmasEdit"]);
        Route::post ("/edit/kirim",         [KabupatenController::class,"puskesmasEditKirim"]);
        Route::get  ("/tambah",             [KabupatenController::class,"puskesmasTambah"]);
        Route::post ("/tambah/kirim",       [KabupatenController::class,"puskesmasTambahKirim"]);
    });

    Route::prefix("sasaran")->group(function ()
    {
        Route::get  ("/dashboard",          [KabupatenController::class,"sasaranDashboard"])->name("kab.sasaran");
        Route::get  ("/detail/{id}",        [KabupatenController::class,"sasaranTarget"]);
    });
});
