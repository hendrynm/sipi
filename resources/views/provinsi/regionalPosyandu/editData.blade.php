@extends("_partials.master")
@section("title","Dashboard Provinsi")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="./dashboard.html" class="btn btn-primary">Back</a>
        <hr>
        <h1>Edit Data Posyandu</h1>

        <br>
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-6">
                    <form>
                        <div class="form-group">
                            <label for="namaPosyandu">Nama Posyandu</label>
                            <input type="text" class="form-control" id="namaPosyandu">
                        </div>
                        <div class="form-group">
                            <label for="namaKampung">Nama Kampung :</label>
                            <input type="text" class="form-control" id="namaKampung">
                        </div>
                        <div class="form-group">
                            <label for="alamatLengkap">Alamat Lengkap Posyandu :</label>
                            <input type="text" class="form-control" id="alamatLengkap">
                        </div>
                        <a href="./dashboard.html" class="btn btn-primary">Simpan</a>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
</html>
