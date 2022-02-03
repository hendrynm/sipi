<?php

use App\Http\Controllers\KabupatenCapaianController;
use App\Http\Controllers\ProvinsiCapaianController;
use App\Http\Controllers\PuskesmasCapaianController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AksesProvinsi;
use App\Http\Middleware\AksesKabupaten;
use App\Http\Middleware\AksesPuskesmas;
use App\Http\Middleware\AksesEksternal;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\PuskesmasController;
use App\Http\Controllers\EksternalController;

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

//        AJAX
Route::prefix("/data-ajax")->middleware('user.isLogin')->group(function () {
    Route::get("/puskesmas/{id}", [PuskesmasController::class,"getListPuskesmasByKabupatenId"])->name('data-ajax.puskesmas');
    Route::get("/uci/puskesmas/{year}/{kabupaten}/{puskesmas}/{quarter}", [PuskesmasCapaianController::class,"getListUciByQuarterId"])->name('data-ajax.uci.puskesmas');
    Route::get("/uci/kabupaten/{year}/{kabupaten}/{quarter}", [KabupatenCapaianController::class,"getListUciByQuarterId"])->name('data-ajax.uci.kabupaten');
    Route::get("/uci/kabupaten/{year}/{quarter}", [ProvinsiCapaianController::class,"getListUciByQuarterId"])->name('data-ajax.uci.provinsi');
});

/*
 * ------------------------------------------------------------------------
 * PROVINSI
 * ------------------------------------------------------------------------
 */
Route::prefix("/provinsi")
    ->middleware([AksesProvinsi::class])
    ->group(function ()
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

            Route::prefix("/kabupaten")->group(function ()
            {
                Route::get("/dashboard",         [ProvinsiCapaianController::class,"kabupaten"])->name('provinsi.capaian.kabupaten.dashboard');
                Route::get  ("/kabupaten",          [ProvinsiCapaianController::class,"capaianAntigenKabupaten"])->name("provinsi.capaian.antigen.kabupaten");
                Route::get  ("/kampung",            [ProvinsiCapaianController::class,"capaianAntigenKampung"])->name("provinsi.capaian.antigen.kampung");
                Route::get  ("/puskesmas",           [ProvinsiCapaianController::class,"capaianAntigenPuskesmas"])->name("provinsi.capaian.antigen.puskesmas");
                Route::get  ("/idl",          [ProvinsiCapaianController::class,"capaianIDL"])->name("provinsi.capaian.idl");
                Route::get  ("/irl",          [ProvinsiCapaianController::class,"capaianIRL"])->name("provinsi.capaian.irl");
                Route::get ("/t",         [ProvinsiCapaianController::class,"capaianT"])->name("provinsi.capaian.t");
                Route::get ("/uci",        [ProvinsiCapaianController::class,"capaianUCI"])->name("provinsi.capaian.uci");
            });

            Route::prefix("/kampung")->group(function ()
            {
                Route::get("/dashboard",         [ProvinsiCapaianController::class,"kampung"])->name('provinsi.capaian.kampung.dashboard');
                Route::get  ("/kabupaten",          [KabupatenCapaianController::class,"capaianAntigenKabupaten"])->name("provinsi.capaian.kampung.capaian.antigen.kabupaten");
                Route::get  ("/kampung",            [KabupatenCapaianController::class,"capaianAntigenKampung"])->name("provinsi.capaian.kampung.capaian.antigen.kampung");
                Route::get  ("/puskesmas",           [KabupatenCapaianController::class,"capaianAntigenPuskesmas"])->name("provinsi.capaian.kampung.capaian.antigen.puskesmas");
                Route::get  ("/idl",          [KabupatenCapaianController::class,"capaianIDL"])->name("provinsi.capaian.kampung.capaian.idl");
                Route::get  ("/irl",          [KabupatenCapaianController::class,"capaianIRL"])->name("provinsi.capaian.kampung.capaian.irl");
                Route::get ("/t",         [KabupatenCapaianController::class,"capaianT"])->name("provinsi.capaian.kampung.capaian.t");
                Route::get ("/uci",        [KabupatenCapaianController::class,"capaianUCI"])->name("provinsi.capaian.kampung.capaian.uci");
            });

            Route::prefix("/puskesmas")->group(function ()
            {
                Route::get("/dashboard",         [ProvinsiCapaianController::class,"puskesmas"])->name('provinsi.capaian.puskesmas.dashboard');
                Route::get  ("/puskesmas",           [PuskesmasCapaianController::class,"capaianAntigenPuskesmas"])->name("provinsi.capaian.puskesmas.capaian.antigen.puskesmas");
                Route::get  ("/kampung",            [PuskesmasCapaianController::class,"capaianAntigenKampung"])->name("provinsi.capaian.puskesmas.capaian.antigen.kampung");
                Route::get  ("/idl",          [PuskesmasCapaianController::class,"capaianIDL"])->name("provinsi.capaian.puskesmas.capaian.idl");
                Route::get  ("/irl",          [PuskesmasCapaianController::class,"capaianIRL"])->name("provinsi.capaian.puskesmas.capaian.irl");
                Route::get ("/t",         [PuskesmasCapaianController::class,"capaianT"])->name("provinsi.capaian.puskesmas.capaian.t");
                Route::get ("/uci",        [PuskesmasCapaianController::class,"capaianUCI"])->name("provinsi.capaian.puskesmas.capaian.uci");
            });

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
            Route::get  ("/hapus/{id}",         [ProvinsiController::class,"akunHapusKirim"]);
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
            Route::get  ("/dashboard",          [ProvinsiController::class,"puskesmasDashboard"])->name("prov.puskesmas");
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

Route::prefix("/kabupaten")
    ->middleware([AksesKabupaten::class])
    ->group(function ()
    {
        Route::redirect("/","/kabupaten/dashboard");
        Route::get("/dashboard",                [KabupatenController::class,"dashboard"]);

        Route::prefix("/capaian")->group(function ()
        {
            Route::prefix("/kampung")->group(function ()
            {
                Route::get("/dashboard",         [KabupatenCapaianController::class,"kampung"])->name('kabupaten.capaian.kampung.dashboard');
                Route::get  ("/kabupaten",          [KabupatenCapaianController::class,"capaianAntigenKabupaten"])->name("kabupaten.capaian.antigen.kabupaten");
                Route::get  ("/kampung",            [KabupatenCapaianController::class,"capaianAntigenKampung"])->name("kabupaten.capaian.antigen.kampung");
                Route::get  ("/puskesmas",           [KabupatenCapaianController::class,"capaianAntigenPuskesmas"])->name("kabupaten.capaian.antigen.puskesmas");
                Route::get  ("/idl",          [KabupatenCapaianController::class,"capaianIDL"])->name("kabupaten.capaian.idl");
                Route::get  ("/irl",          [KabupatenCapaianController::class,"capaianIRL"])->name("kabupaten.capaian.irl");
                Route::get ("/t",         [KabupatenCapaianController::class,"capaianT"])->name("kabupaten.capaian.t");
                Route::get ("/uci",        [KabupatenCapaianController::class,"capaianUCI"])->name("kabupaten.capaian.uci");
            });

            Route::prefix("/puskesmas")->group(function ()
            {
                Route::get("/dashboard",         [KabupatenCapaianController::class,"puskesmas"])->name('kabupaten.capaian.puskesmas.dashboard');
                Route::get  ("/puskesmas",           [PuskesmasCapaianController::class,"capaianAntigenPuskesmas"])->name("kabupaten.capaian.puskesmas.capaian.antigen.puskesmas");
                Route::get  ("/kampung",            [PuskesmasCapaianController::class,"capaianAntigenKampung"])->name("kabupaten.capaian.puskesmas.capaian.antigen.kampung");
                Route::get  ("/idl",          [PuskesmasCapaianController::class,"capaianIDL"])->name("kabupaten.capaian.puskesmas.capaian.idl");
                Route::get  ("/irl",          [PuskesmasCapaianController::class,"capaianIRL"])->name("kabupaten.capaian.puskesmas.capaian.irl");
                Route::get ("/t",         [PuskesmasCapaianController::class,"capaianT"])->name("kabupaten.capaian.puskesmas.capaian.t");
                Route::get ("/uci",        [PuskesmasCapaianController::class,"capaianUCI"])->name("kabupaten.capaian.puskesmas.capaian.uci");
            });
        });

        Route::prefix("/data")->group(function ()
        {
            Route::get("/dashboard",            [KabupatenController::class,"dataDashboard"])->name("kab.anak");
            Route::get("/detail/{id}",          [KabupatenController::class,"dataDetail"]);
            Route::get("/pindah/{id}",          [KabupatenController::class,"dataPindah"]);
            Route::post("/pindah/kirim",        [KabupatenController::class,"dataPindahKirim"]);
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
            Route::get("/hapus/{id}",           [KabupatenController::class,"akunHapusKirim"]);
        });

        Route::prefix("regional-kampung")->group(function ()
        {
            Route::get("/dashboard",            [KabupatenController::class,"kampungDashboard"])->name("kab.kampung");
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


//http://localhost:8000/puskesmas/capaian/dashboard
Route::prefix("/puskesmas")
    ->middleware([AksesPuskesmas::class])
    ->group(function ()
    {
        Route::redirect("/","/puskesmas/dashboard");
        Route::get("/dashboard",                [PuskesmasController::class,"dashboard"]);

        Route::prefix("/capaian")->group(function ()
        {
            Route::get ("/dashboard",            [PuskesmasCapaianController::class,"puskesmas"])->name("puskesmas.capaian.dashboard");
            Route::get  ("/puskesmas",           [PuskesmasCapaianController::class,"capaianAntigenPuskesmas"])->name("puskesmas.capaian.antigen.puskesmas");
            Route::get  ("/kampung",            [PuskesmasCapaianController::class,"capaianAntigenKampung"])->name("puskesmas.capaian.antigen.kampung");
            Route::get  ("/idl",          [PuskesmasCapaianController::class,"capaianIDL"])->name("puskesmas.capaian.idl");
            Route::get  ("/irl",          [PuskesmasCapaianController::class,"capaianIRL"])->name("puskesmas.capaian.irl");
            Route::get ("/t",         [PuskesmasCapaianController::class,"capaianT"])->name("puskesmas.capaian.t");
            Route::get ("/uci",        [PuskesmasCapaianController::class,"capaianUCI"])->name("puskesmas.capaian.uci");
        });

        Route::prefix("/data-anak")->group(function ()
        {
            Route::get("/dashboard",            [PuskesmasController::class,"dataDashboard"])->name("pus.anak");
            Route::get("/detail/{id}",          [PuskesmasController::class,"dataDetail"]);
            Route::get("/edit/{id}",            [PuskesmasController::class,"dataEdit"]);
            Route::post("/edit/kirim",          [PuskesmasController::class,"dataEditKirim"]);
            Route::get("/tambah",               [PuskesmasController::class,"dataTambah"]);
            Route::post("/tambah/kirim",        [PuskesmasController::class,"dataTambahKirim"]);

            // baru gak tau moga ajah gak error
            Route::get("/konfirmasi-hapus",     [PuskesmasController::class,"konfrimasiHapus"]);
            Route::get("/hapus",                [PuskesmasController::class,"hapus"]);
        });

        Route::prefix("akun")->group(function ()
        {
            Route::get("/dashboard",            [PuskesmasController::class,"akunDashboard"]);
            Route::get("/edit/{id}",            [PuskesmasController::class,"akunEdit"]);
            Route::post("/edit/kirim",          [PuskesmasController::class,"akunEditKirim"]);
            Route::get("/ganti-pass/{id}",      [PuskesmasController::class,"akunGantiPass"]);
            Route::post("/ganti-pass/kirim",    [PuskesmasController::class,"akunGantiPassKirim"]);
            Route::get("/tambah",               [PuskesmasController::class,"akunTambah"]);
            Route::post("/tambah/kirim",        [PuskesmasController::class,"akunTambahKirim"]);
            Route::get("/hapus/{id}",           [PuskesmasController::class,"akunHapusKirim"]);
        });

        Route::prefix("regional-kampung")->group(function ()
        {
            Route::get("/dashboard",            [PuskesmasController::class,"kampungDashboard"])->name("pus.kampung");
            Route::get("/edit/{id}",            [PuskesmasController::class,"kampungEdit"]);
            Route::post("/edit/kirim",          [PuskesmasController::class,"kampungEditKirim"]);
            Route::get("/tambah",               [PuskesmasController::class,"kampungTambah"]);
            Route::post("/tambah/kirim",        [PuskesmasController::class,"kampungTambahKirim"]);
            Route::get("/sasaran/{id}",         [PuskesmasController::class,"kampungSasaranDetail"]);
            Route::get("/ubah/{id}",            [PuskesmasController::class,"kampungSasaranUbah"]);
            Route::post("/ubah/kirim",          [PuskesmasController::class,"kampungSasaranUbahKirim"]);
        });

        Route::prefix("regional-posyandu")->group(function ()
        {
            Route::get("/dashboard",            [PuskesmasController::class,"posyanduDashboard"])->name("pus.posyandu");
            Route::get("/edit/{id}",            [PuskesmasController::class,"posyanduEdit"]);
            Route::post("/edit/kirim",          [PuskesmasController::class,"posyanduEditKirim"]);
            Route::get("/tambah",               [PuskesmasController::class,"posyanduTambah"]);
            Route::post("/tambah/kirim",        [PuskesmasController::class,"posyanduTambahKirim"]);
        });

        Route::prefix("posyandu")->group(function ()
        {
            Route::get("/dashboard",            [PuskesmasController::class,"posDashboard"]);
            Route::get("/belum",                [PuskesmasController::class,"posBelumImunisasi"]);
            Route::get("/belum/{id}",           [PuskesmasController::class,"posBelumImunisasiCari"]);
            Route::post("/pilih",               [PuskesmasController::class,"posMulaiPilih"]);
            Route::get("/mulai/{id}",           [PuskesmasController::class,"posMulai"]);
            Route::get("/tambah",               [PuskesmasController::class,"dataTambah"]);
            Route::post("/tambah/kirim",        [PuskesmasController::class,"posTambahKirim"]);
            Route::get("/edit/{id}",            [PuskesmasController::class,"dataEdit"]);
            Route::post("/edit/kirim",          [PuskesmasController::class,"posEditKirim"]);
            Route::get("/entri/{id}",           [PuskesmasController::class,"posEntri"]);
            Route::post("/entri/kirim",         [PuskesmasController::class,"posEntriKirim"]);
        });
    });

Route::prefix("/eksternal")
    ->middleware([AksesEksternal::class])
    ->group(function ()
    {
        Route::redirect("/","/eksternal/dashboard");
        Route::get("/dashboard",                [EksternalController::class,"dashboard"]);

        Route::prefix("/data-anak")->group(function ()
        {
            Route::get("/dashboard",            [EksternalController::class,"dataDashboard"]);
            Route::post("/cari",                 [EksternalController::class,"dataDashboardKirim"]);
            Route::get("/detail/{id}",          [EksternalController::class,"dataDetail"]);
            Route::get("/edit/{id}",            [EksternalController::class,"dataEdit"]);
            Route::post("/edit/kirim",          [EksternalController::class,"dataEditKirim"]);
            Route::get("/tambah",               [EksternalController::class,"dataTambah"]);
            Route::post("/tambah/kirim",        [EksternalController::class,"dataTambahKirim"]);
        });

        Route::prefix("posyandu")->group(function ()
        {
            Route::get("/dashboard",            [EksternalController::class,"posDashboard"]);
            Route::post("/mulai",           [EksternalController::class,"posMulai"]);
            Route::get("/entri/{id}",           [EksternalController::class,"posEntri"]);
            Route::post("/entri/kirim",         [EksternalController::class,"posEntriKirim"]);
        });
    });
