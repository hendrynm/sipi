@extends("_partials.master")
@section("title","Dashboard Provinsi")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="/logout" class="btn btn-primary">Log Out</a>

        <hr>
        <h1>Dashboard Provinsi Papua barat</h1>

        <div class="jumbotron">
            <h2>Laporan Pencapaian</h2>
            <a href="./capaian/provinsi" class="btn btn-primary">Capaian Provinsi</a>
            <a href="./capaian/kabupaten" class="btn btn-primary">Capaian Kabupaten/Kota</a>
            <a href="./capaian/puskesmas" class="btn btn-primary">Capaian Pukesmas</a>
            <a href="./capaian/kampung" class="btn btn-primary">Capaian Kampung</a>

        </div>
        <div class="jumbotron">
            <h2>Data Induvidu</h2>
            <a href="./data-anak/dashboard" class="btn btn-primary">Data Induvidu</a>


        </div>
        <div class="jumbotron">
            <h2>Data Regional</h2>
            <a href="./regional-kampung/dashboard" class="btn btn-primary">Dashboard data Kampung</a>
            <a href="./regional-posyandu/dashboard" class="btn btn-primary">Dashboard data Posyandu</a>


        </div>
        <div class="jumbotron">
            <h2>Data Antigen Provinsi</h2>
            <a href="./antigen/dashboard" class="btn btn-primary">Dashboard Data Antigen</a>


        </div>
        <div class="jumbotron">
            <h2>Manjemen Akun Provinsi Papua Barat</h2>
            <a href="./akun/dashboard" class="btn btn-primary">dashboard manajemen akun</a>

        </div>


    </div>
@endsection
</html>
