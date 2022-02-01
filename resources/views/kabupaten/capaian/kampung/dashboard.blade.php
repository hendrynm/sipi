@extends("_partials.master")
@section("title","Dashboard Laporan Capaian")

<!DOCTYPE html>
<html lang="id">
@section("konten")
<div class="container main-dashboard">
    <a href="../../dashboard" class="btn btn-danger">Back</a>
    <hr>
    <h1>Dashboard Laporan Capaian</h1>




    <div class="jumbotron">
        <h2>Ketercapaian Kampung</h2>
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



</div>
@endsection

</html>
