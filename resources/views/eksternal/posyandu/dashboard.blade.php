@extends("_partials.master")
@section("title","Dashboard Posyandu")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        @if(session()->has("sukses"))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get("sukses") }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(session()->has("gagal"))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session()->get("gagal") }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <a href="../dashboard" class="btn btn-primary">back</a>
        <h1>Posyandu</h1>
        <br>
        <div class="jumbotron custom-table">
            <form action="./mulai" method="post">
                @csrf
                <div class="form-row">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Nama Anak" id="nama" name="nama">
                    </div>
                    <br>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="NIK" id="nik" name="nik">
                    </div>
                    <div class="col">
                        <button class="btn btn-primary">Cari Data</button>
                    </div>
                </div>
            </form>
        </div>
        <hr>
    </div>
@endsection
</html>
