@extends("_partials.master")
@section("title","Edit Akun")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard.html" class="btn btn-primary">Back</a>
        <hr>

        <h1>Akun Kabupaten x</h1>
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-6">
                    <h2>Edit Akun</h2>
                    <br>
                    <form>
                        <div class="form-group">
                            <label for="username">Username :</label>
                            <input type="text" class="form-control" id="username">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Instansi :</label>
                            <input type="text" class="form-control" id="nama">
                        </div>
                        <div class="form-group">
                            <label for="nama">Email :</label>
                            <input type="text" class="form-control" id="nama">
                        </div>
                        <div class="form-group">
                            <label for="level">Akses Level :</label>
                            <select class="custom-select" id="level">
                                <option selected>Pilih akses level</option>
                                <option value="1">level 1 - Provinsi Papua barat</option>
                                <option value="2">level 2 - Kabupaten/Kota</option>
                                <option value="3">level 3 - Pukesmas</option>
                                <option value="4">Level 4 - Rumah Sakit, Klinik Daerah dan Bidan Desa</option>
                            </select>
                        </div>
                        <a href="./dashboard.html" class="btn btn-primary">Simpan</a>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
</html>
