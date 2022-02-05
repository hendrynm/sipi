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
        <h2>Ketercapaian Kabupaten</h2>
        <a href="#" class="btn btn-primary">
            <div class="row justify-content-center">
                <div class="col-8">
                    <img class="img-fluid" src="{{ asset(" /images/icon/data-induvidu.png")}}" width="60" height="60">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    Capaian Kabupaten
                </div>
            </div>

        </a>
        <a href="#" class="btn btn-primary">
            <div class="row justify-content-center">
                <div class="col-8">
                    <img class="img-fluid" src="{{ asset(" /images/icon/data-induvidu.png")}}" width="60" height="60">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    Capaian Antigen
                </div>
            </div>

        </a>
        <a href="#" class="btn btn-primary">
            <div class="row justify-content-center">
                <div class="col-8">
                    <img class="img-fluid" src="{{ asset(" /images/icon/data-induvidu.png")}}" width="60" height="60">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    Capaian IDL
                </div>
            </div>

        </a>
        <a href="#" class="btn btn-primary">
            <div class="row justify-content-center">
                <div class="col-8">
                    <img class="img-fluid" src="{{ asset(" /images/icon/data-induvidu.png")}}" width="60" height="60">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    Capaian IRL
                </div>
            </div>

        </a>
        <a href="#" class="btn btn-primary">
            <div class="row justify-content-center">
                <div class="col-8">
                    <img class="img-fluid" src="{{ asset(" /images/icon/data-induvidu.png")}}" width="60" height="60">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    Capaian Status T
                </div>
            </div>

        </a>
    </div>




</div>
@endsection

</html>
