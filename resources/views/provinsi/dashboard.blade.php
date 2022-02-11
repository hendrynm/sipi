@extends("_partials.master")
@section("title","Dashboard Provinsi")

<!DOCTYPE html>
<html lang="id">
@section("konten")
<div class="container main-dashboard">



    <a href="/logout" class="btn btn-danger">Log Out</a>

    <hr>
    <h1>Dashboard Provinsi Papua Barat</h1>

    <div class="jumbotron">
        <h2>Laporan Capaian</h2>

        <a href="{{route('provinsi.capaian.antigen.kabupaten')}}" class="btn btn-primary">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <img class="img-fluid" src="{{ asset("/images/icon/laporan.png")}}" width="60" height="60">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    Ketercapaian Imunisasi Setiap Kabupaten
                </div>
            </div>
        </a>
        <a href="{{route('provinsi.capaian.antigen.puskesmas')}}" class="btn btn-primary">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <img class="img-fluid" src="{{ asset("/images/icon/laporan.png")}}" width="60" height="60">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    Ketercapaian Imunisasi Setiap Puskesmas
                </div>
            </div>
        </a>

        <a href="{{route('provinsi.capaian.antigen.kampung')}}" class="btn btn-primary">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <img class="img-fluid" src="{{ asset("/images/icon/laporan.png")}}" width="60" height="60">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    Ketercapaian Imunisasi Setiap Kampung
                </div>
            </div>
        </a>

        <a href="{{route('provinsi.capaian.kabupaten.dashboard')}}" class="btn btn-primary">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <img class="img-fluid" src="{{ asset("/images/icon/laporan2.png")}}" width="60" height="60">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    Laporan Tingkat Kabupaten
                </div>
            </div>
        </a>

        <a href="{{route('provinsi.capaian.kampung.dashboard')}}" class="btn btn-primary">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <img class="img-fluid" src="{{ asset("/images/icon/laporan2.png")}}" width="60" height="60">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    Laporan Tingkat Puskesmas
                </div>
            </div>
        </a>

        <a href="{{route('provinsi.capaian.puskesmas.dashboard')}}" class="btn btn-primary">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <img class="img-fluid" src="{{ asset("/images/icon/laporan2.png")}}" width="60" height="60">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    Laporan Tingkat Kampung
                </div>
            </div>
        </a>




        <a href="{{route('provinsi.capaian.laporanBulanan')}}" class="btn btn-primary">
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

        <a href="{{route('provinsi.capaian.laporanBulananKumulatif')}}" class="btn btn-primary">
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
        <h2>Data Individu</h2>
        <a href="./data-anak/dashboard" class="btn btn-primary">
            <div class="row justify-content-center">
                <div class="col-8">
                    <img class="img-fluid" src="{{ asset("/images/icon/data-induvidu.png")}}" width="60" height="60">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    Data Individu
                </div>
            </div>

        </a>
    </div>

    <div class="jumbotron">
        <h2>Data Regional</h2>
        <a href="./regional-kabupaten/dashboard" class="btn btn-primary">
            <div class="row justify-content-center">
                <div class="col-8">
                    <img class="img-fluid" src="{{ asset("/images/icon/regional.png")}}" width="60" height="60">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    Dashboard data Kabupaten
                </div>
            </div>
        </a>
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
        <h2>Data Antigen Provinsi</h2>
        <a href="./antigen/dashboard" class="btn btn-primary">
            <div class="row justify-content-center">
                <div class="col-8">
                    <img class="img-fluid" src="{{ asset("/images/icon/antigen.png")}}" width="70" height="70">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    Dashboard Data Antigen
                </div>
            </div>
        </a>
    </div>

    <div class="jumbotron">
        <h2>Manajemen Akun Provinsi Papua Barat</h2>
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
