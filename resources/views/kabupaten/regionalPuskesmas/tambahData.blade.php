@extends("_partials.master")
@section("title","Tambah Data Puskesmas")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="./dashboard" class="btn btn-primary">Back</a>
        <hr>
        <h1>Tambah Data Puskesmas</h1>
        <br>

        <div class="jumbotron">
            <div class="row">
                <div class="col-md-6">
                    <form action="./tambah/kirim" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="kodePuskesmas">Kode Puskesmas :</label>
                            <input type="text" class="form-control" id="kodePuskesmas" name="kodePuskesmas">
                        </div>
                        <div class="form-group">
                            <label for="namaPuskesmas">Nama Puskesmas :</label>
                            <input type="text" class="form-control" id="namaPuskesmas" name="namaPuskesmas" required>
                        </div>
                        <button class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
</html>
