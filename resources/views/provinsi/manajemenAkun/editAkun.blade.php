@extends("_partials.master")
@section("title","Edit Akun")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard" class="btn btn-primary">Back</a>
        <hr>

        <h1>Akun Kabupaten x</h1>
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-6">
                    <h2>Edit Akun</h2>
                    <br>
                    <form action="./kirim" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="idUser" value="{{ $data->id_user }}">
                        <input type="hidden" name="idLevel" value="{{ $data->id_level }}">
                        <div class="form-group">
                            <label for="username">Username :</label>
                            <input type="text" class="form-control" name="username" value="{{ $data->username }}">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Instansi :</label>
                            <input type="text" class="form-control" name="nama" value="{{ $data->nama }}">
                        </div>
                        <div class="form-group">
                            <label for="nama">Email :</label>
                            <input type="text" class="form-control" name="email" value="{{ $data->email }}">
                        </div>
                        <div class="form-group">
                            <label for="level">Akses Level :</label>
                            <select class="custom-select" name="level">
                                <option selected>Pilih akses level</option>
                                <option value="1">level 1 - Provinsi Papua barat</option>
                                <option value="2">level 2 - Kabupaten/Kota</option>
                                <option value="3">level 3 - Pukesmas</option>
                                <option value="4">Level 4 - Rumah Sakit, Klinik Daerah dan Bidan Desa</option>
                            </select>
                        </div>
                        <button class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
</html>
