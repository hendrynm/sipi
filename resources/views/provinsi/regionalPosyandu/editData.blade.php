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
                    <form action="../kirim" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="idPosyandu" value="{{ $data->id_posyandu }}">
                        <div class="form-group">
                            <label for="namaPosyandu">Nama Posyandu</label>
                            <input type="text" class="form-control" name="namaPosyandu" value="{{ $data->nama_posyandu }}">
                        </div>
                        <div class="form-group">
                            <label for="namaKampung">Nama Kampung :</label>
                            <input type="text" class="form-control" name="namaKampung" value="{{ $data->nama_kampung }}">
                        </div>
                        <div class="form-group">
                            <label for="alamatLengkap">Alamat Lengkap Posyandu :</label>
                            <input type="text" class="form-control" name="alamatLengkap" value="{{
                            $data->alamat_posyandu }}">
                        </div>
                        <button class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
</html>
