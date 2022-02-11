@extends("_partials.master")
@section("title","Dashboard Kabupaten")

<!DOCTYPE html>
<html lang="id">
@section("konten")
<div class="container main-dashboard">



    <a href="/logout" class="btn btn-danger">log out</a>
    <hr>
    <h1>Dasboard Kabupaten/Kota {{ $data->nama_kabupaten }}</h1>

    <div class="jumbotron">
        <h2>Laporan Pencapaian</h2>

        <a href="{{route('kabupaten.capaian.puskesmas.dashboard')}}" class="btn btn-primary">
            <div class="row justify-content-center">
                <div class="col-8">
                    <img class="img-fluid" src="{{ asset("/images/icon/laporan.png")}}" width="60" height="60">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    laporan Puskesmas
                </div>
            </div>
        </a>
        <a href="{{route('kabupaten.capaian.kampung.dashboard')}}" class="btn btn-primary">
            <div class="row justify-content-center">
                <div class="col-8">
                    <img class="img-fluid" src="{{ asset("/images/icon/laporan.png")}}" width="60" height="60">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    Laporan Kampung
                </div>
            </div>
        </a>
        <a href="{{route('kabupaten.capaian.laporanBulanan')}}" class="btn btn-primary">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <img class="img-fluid" src="{{ asset("/images/icon/laporan.png")}}" width="60" height="60">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    Laporan Bulanan
                </div>
            </div>
        </a>
        <a href="{{route('kabupaten.capaian.laporanBulananKumulatif')}}" class="btn btn-primary">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <img class="img-fluid" src="{{ asset("/images/icon/laporan.png")}}" width="60" height="60">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    Laporan Bulanan Kumulatif
                </div>
            </div>
        </a>


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
        <h2>Manajemen Akun Kabupaten/Kota</h2>
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
