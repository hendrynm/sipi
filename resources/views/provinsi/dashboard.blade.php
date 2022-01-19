@extends("_partials.master")
@section("title","Dashboard Provinsi")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="/logout" class="btn btn-primary">Log Out</a>

        <hr>
        <h1>Dashboard Provinsi Papua barat</h1>
        {{ session()->get("akses") }}

        <div class="jumbotron">
            <h2>Laporan Pencapaian</h2>
            <a href="./capaian/capaianProvinsi.html" class="btn btn-primary">Capaian Provinsi</a>
            <a href="./capaian/capaianKabupatenKota.html" class="btn btn-primary">Capaian Kabupaten/Kota</a>
            <a href="./capaian/capaianPukesmas.html" class="btn btn-primary">Capaian Pukesmas</a>
            <a href="./capaian/capaianKampung.html" class="btn btn-primary">Capaian Kampung</a>

        </div>
        <div class="jumbotron">
            <h2>Data Anak</h2>
            <a href="./dataAnak/dashboard.html" class="btn btn-primary">Data Anak</a>


        </div>
        <div class="jumbotron">
            <h2>Data Regional</h2>
            <a href="./regional/dashboard.html" class="btn btn-primary">Dashboard data regonal</a>


        </div>
        <div class="jumbotron">
            <h2>Data Antigen Provinsi</h2>
            <a href="./antigen/dashboard.html" class="btn btn-primary">Dashboard Data Antigen</a>


        </div>
        <div class="jumbotron">
            <h2>Manjemen Akun Provinsi Papua Barat</h2>
            <a href="./manajemen_akun/dashboard.html" class="btn btn-primary">dashboard manajemen akun</a>

        </div>


    </div>
@endsection
</html>
