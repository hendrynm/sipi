@extends("_partials.master")
@section("title","Dashboard Data Anak")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard" class="btn btn-primary">back</a>
        <hr>
        <h1>Data Individu</h1>
        <br>
        <div class="jumbotron custom-table">
            <form action="./cari" method="post">
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
    </div>
@endsection
</html>
