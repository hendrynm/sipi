@extends("_partials.master")
@section("title","Dashboard Laporan Capaian")

<!DOCTYPE html>
<html lang="id">
@section("konten")
<div class="container main-dashboard">
    <a href="../../dashboard" class="btn btn-primary">Back</a>
    <hr>
    <h1>Dashboard Laporan Capaian</h1>



    <div class="jumbotron">
        <h2>Ketercapaian Puskesmas</h2>

        <?php
        $capaians = [
            ["Capaian Antigen", "provinsi.capaian.puskesmas.capaian.antigen.puskesmas"],
            ["Capaian Antigen Tiap Kampung", "provinsi.capaian.puskesmas.capaian.antigen.kampung"],
            ["Anak IDL", "provinsi.capaian.puskesmas.capaian.idl"],
            ["Anak IRL", "provinsi.capaian.puskesmas.capaian.irl"],
            ["Performa T", "provinsi.capaian.puskesmas.capaian.t"],
            ["Desa UCI", "provinsi.capaian.puskesmas.capaian.uci"]
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




</div>
@endsection

</html>
