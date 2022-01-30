@extends("_partials.master")
@section("title","Dashboard Kabupaten")

<!DOCTYPE html>
<html lang="id">
@section("konten")
<div class="container main-dashboard">
    <a href="/logout" class="btn btn-primary">log out</a>
    <hr>
    <h1>Dasboard Kabupaten/Kota {{ $data->nama_kabupaten }}</h1>

    <div class="jumbotron">
        <h2>Laporan Pencapaian</h2>
        <?php
        $capaians = [
            ["Capaian Antigen", "kabupaten.capaian.antigen.kabupaten"],
            ["Capaian Antigen Tiap Kampung", "kabupaten.capaian.antigen.kampung"],
            ["Capaian Antigen Tiap Puskesmas", "kabupaten.capaian.antigen.puskesmas"],
            ["Anak IDL", "kabupaten.capaian.idl"],
            ["Anak IRL", "kabupaten.capaian.irl"],
            ["Performa T", "kabupaten.capaian.t"],
            ["Desa UCI", "kabupaten.capaian.uci"]
        ];
        ?>
        @foreach($capaians as $capaian)
            <a href="{{ route($capaian[1]) }}" class="btn btn-primary">
                <div class="col justify-content-center">
                    <div class="row justify-content-center" style="height: 60px">
                        <div class="">
                            <img class="mx-auto" src="{{ asset("/images/icon/laporan.png")}}" width="60" height="60">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            {{$capaian[0]}}
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <div class="jumbotron">
        <h2>Data Induvidu</h2>
        <a href="./data/dashboard" class="btn btn-primary">
            <div class="row justify-content-center">
                <div class="col-8">
                    <img class="img-fluid" src="{{ asset("/images/icon/data-induvidu.png")}}" width="60" height="60">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    Data Induvidu
                </div>
            </div>
        </a>
    </div>

    <div class="jumbotron">
        <h2>Data Regional</h2>
        <a href="./regional-puskesmas/dashboard" class="btn btn-primary">
            <div class="row justify-content-center">
                <div class="col-8">
                    <img class="img-fluid" src="{{ asset("/images/icon/regional.png")}}" width="60" height="60">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    Dashboard data Puskesmas
                </div>
            </div>
        </a>
        <a href="./regional-kampung/dashboard" class="btn btn-primary">
            <div class="row justify-content-center">
                <div class="col-8">
                    <img class="img-fluid" src="{{ asset("/images/icon/regional.png")}}" width="60" height="60">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    Dashboard data Kampung
                </div>
            </div>
        </a>
        <a href="./regional-posyandu/dashboard" class="btn btn-primary">
            <div class="row justify-content-center">
                <div class="col-8">
                    <img class="img-fluid" src="{{ asset("/images/icon/regional.png")}}" width="60" height="60">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    Dashboard data Posyandu
                </div>
            </div>
        </a>
    </div>

    <div class="jumbotron">
        <h2>Data Sasaran</h2>
        <a href="./sasaran/dashboard" class="btn btn-primary">
            <div class="row justify-content-center">
                <div class="col-8">
                    <img class="img-fluid" src="{{ asset("/images/icon/sasaran.png")}}" width="70" height="70">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    Sasaran per kampung
                </div>
            </div>
        </a>
    </div>

    <div class="jumbotron">
        <h2>Manjemen Akun Kabupaten/Kota</h2>
        <a href="./akun/dashboard" class="btn btn-primary">
            <div class="row justify-content-center">
                <div class="col-8">
                    <img class="img-fluid" src="{{ asset("/images/icon/akun.png")}}" width="70" height="70">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    dashboard manajemen akun
                </div>
            </div>
        </a>
    </div>


</div>
@endsection

</html>
