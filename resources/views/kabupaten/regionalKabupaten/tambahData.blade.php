@extends("_partials.master")
@section("title","Dashboard Provinsi")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard" class="btn btn-primary">Back</a>
        <hr>
        <h1>Edit Data Posyandu</h1>

        <br>
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-6">
                    <form action="../kirim" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="namaKabupaten">Nama Kabupaten</label>
                            <input type="text" class="form-control" id="namaKabupaten" name="namaKabupaten">
                        </div>
                        <div class="form-group">
                            <label for="kodeRegional">Kode Regional :</label>
                            <input type="text" class="form-control" id="kodeRegional" name="kodeRegional">
                        </div>
                        <button class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
</html>
