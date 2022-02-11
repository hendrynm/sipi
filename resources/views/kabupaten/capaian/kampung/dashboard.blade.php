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
            ["Ketercapaian Antigen Puskesmas", "kabupaten.capaian.puskesmas.capaian.antigen.puskesmas"],
            ["Ketercapaian IDL Tiap Puskesmas", "kabupaten.capaian.idl"],
            ["Ketercapaian IRL Tiap Puskesmas", "kabupaten.capaian.irl"],
            ["Ketercapaian Status T Tiap Puskesmas", "kabupaten.capaian.t"],
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
