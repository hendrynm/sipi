@extends("_partials.master")
@section("title","Dashboard Eksternal")

<!DOCTYPE html>
<html lang="id">
@section("konten")
<div class="container main-dashboard">
    <a href="/logout" class="btn btn-danger">Log Out</a>
    <hr>
    <h1>Dashboard Eksternal</h1>

    <div class="jumbotron">
        <h2>Data Induvidu</h2>
        <a href="./data-anak/tambah" class="btn btn-primary">
            <div class="row justify-content-center">
                <div class="col-8">
                    <img class="img-fluid" src="{{ asset("/images/icon/data-induvidu.png")}}" width="60" height="60">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    Tambah Data Induvidu
                </div>
            </div>
        </a>
        <a href="./data-anak/dashboard" class="btn btn-primary">
            <div class="row justify-content-center">
                <div class="col-8">
                    <img class="img-fluid" src="{{ asset("/images/icon/data-induvidu.png")}}" width="60" height="60">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    Cari Data Induvidu
                </div>
            </div>
        </a>
    </div>

    <div class="jumbotron">
        <h2>Imunisasi</h2>
        <a href="./posyandu/dashboard" class="btn btn-primary">
            <div class="row justify-content-center">
                <div class="col-8">
                    <img class="img-fluid" src="{{ asset("/images/icon/posyandu.png")}}" width="60" height="60">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    Modul Imunisasi
                </div>
            </div>
        </a>
    </div>

@endsection
</html>
