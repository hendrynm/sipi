@extends("_partials.master")
@section("title","Dashboard Puskesmas")

<!DOCTYPE html>
<html lang="id">
@section("konten")
<div class="container main-dashboard">


    <a href="/logout" class="btn btn-danger">Log Out</a>
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
        <a href="{{route('puskesmas.capaian.laporanBulanan')}}" class="btn btn-primary">
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
    </div>

    <div class="jumbotron">
        <h2>Data Induvidu</h2>
        <a href="./data-anak/dashboard" class="btn btn-primary">

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
        <h2>Posyandu</h2>
        <a href="./posyandu/dashboard" class="btn btn-primary">
            <div class="row justify-content-center">
                <div class="col-8">
                    <img class="img-fluid" src="{{ asset("/images/icon/posyandu.png")}}" width="60" height="60">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    Modul Posyandu
                </div>
            </div>

        </a>
    </div>

    <div class="jumbotron">
        <h2>Data Regional</h2>
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
        <h2>Manjemen Akun</h2>
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
