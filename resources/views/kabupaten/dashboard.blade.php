@extends("_partials.master")
@section("title","Dashboard Kabupaten")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="/logout" class="btn btn-primary">log out</a>
        <hr>
        <h1>Dasboard Kabupaten/Kota {{ $data->nama_kabupaten }}</h1>

        <div class="jumbotron">
            <h2>Laporan Pencapaian</h2>
            <a href="./capaian/kabupaten" class="btn btn-primary">Capaian Kabupaten/Kota</a>
            <a href="./capaian/puskesmas" class="btn btn-primary">Capaian Pukesmas</a>
            <a href="./capaian/kampung" class="btn btn-primary">Capaian Kampung</a>
        </div>

        <div class="jumbotron">
            <h2>Data Induvidu</h2>
            <a href="./data/dashboard" class="btn btn-primary">Data Induvidu</a>
        </div>

        <div class="jumbotron">
            <h2>Data Regional</h2>
            <a href="./regional-puskesmas/dashboard" class="btn btn-primary">Dashboard data Puskesmas</a>
            <a href="./regional-kampung/dashboard" class="btn btn-primary">Dashboard data Kampung</a>
            <a href="./regional-posyandu/dashboard" class="btn btn-primary">Dashboard data Posyandu</a>
        </div>

        <div class="jumbotron">
            <h2>Data Sasaran</h2>
            <a href="./sasaran/dashboard" class="btn btn-primary">Sasaran per kampung</a>
        </div>

        <div class="jumbotron">
            <h2>Manjemen Akun Kabupaten/Kota</h2>
            <a href="./akun/dashboard" class="btn btn-primary">dashboard manajemen akun</a>
        </div>
    </div>
@endsection
</html>
