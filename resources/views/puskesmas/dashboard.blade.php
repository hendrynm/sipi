@extends("_partials.master")
@section("title","Dashboard Puskesmas")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="/logout" class="btn btn-primary">Log Out</a>
        <hr>
        <h1>Dashboard {{ $data->nama_puskesmas }}</h1>

        <div class="jumbotron">
            <h2>Laporan Pencapaian</h2>
            <?php
            $capaians = [
                ["Capaian Antigen", "puskesmas.capaian.antigen.puskesmas"],
                ["Capaian Antigen Tiap Kampung", "puskesmas.capaian.antigen.kampung"],
                ["Anak IDL", "puskesmas.capaian.idl"],
                ["Anak IRL", "puskesmas.capaian.irl"],
                ["Performa T", "puskesmas.capaian.t"],
                ["Desa UCI", "puskesmas.capaian.uci"]
            ];
            ?>
            @foreach($capaians as $capaian)
                <a href="{{route($capaian[1])}}" class="btn btn-primary">{{$capaian[0]}}</a>
            @endforeach
        </div>

        <div class="jumbotron">
            <h2>Data Induvidu</h2>
            <a href="./data-anak/dashboard" class="btn btn-primary">Data Induvidu</a>
        </div>

        <div class="jumbotron">
            <h2>Posyandu</h2>
            <a href="./posyandu/dashboard" class="btn btn-primary">Posyandu</a>
        </div>

        <div class="jumbotron">
            <h2>Data Regional</h2>
            <a href="./regional-kampung/dashboard" class="btn btn-primary">Dashboard data Kampung</a>
            <a href="./regional-posyandu/dashboard" class="btn btn-primary">Dashboard data Posyandu</a>
        </div>

        <div class="jumbotron">
            <h2>Manjemen Akun</h2>
            <a href="./akun/dashboard" class="btn btn-primary">dashboard manajemen akun</a>
        </div>
    </div>
@endsection
</html>
