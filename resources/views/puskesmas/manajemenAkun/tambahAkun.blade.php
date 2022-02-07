@extends("_partials.master")
@section("title","Tambah Akun Baru")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="./dashboard" class="btn btn-primary">Back</a>
        <hr>
        <h1>Buat Akun baru</h1>
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-6">
                    <h2>Data Akun Baru</h2>
                    <form action="./tambah/kirim" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="username">username</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Instansi</label>
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="level">Akses Level :</label>
                            <select class="custom-select" id="level" name="level">
                                <option selected disabled>Pilih akses level</option>
                                <option value="3">level 3 - Pukesmas</option>
                                <option value="4">Level 4 - Rumah Sakit, Klinik Daerah dan Bidan Desa</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="password2">Ketik Ulang Password</label>
                            <input type="password" class="form-control" id="password2" name="password2">
                        </div>
                        <button class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
</html>
