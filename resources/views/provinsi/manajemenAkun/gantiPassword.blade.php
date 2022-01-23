@extends("_partials.master")
@section("title","Ganti Password")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard" class="btn btn-primary">Back</a>
        <hr>
        <h1>Ganti Password</h1>
        <div class="jumbotron">
            <h2>Data User</h2>
            <p>
                <b>Username</b> : {{ $data->username }}<br>
                <b>Nama</b> : {{ $data->nama }} <br>
                <b>Email</b> : {{ $data->email }} <br>
            </p>
        </div>
        <div class="jumbotron">
            <h2>Ganti password</h2>
            <div class="row">
                <div class="col-md-6">
                    <form action="./kirim" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="idUser" value="{{ $data->id_user }}">
                        <div class="form-group">
                            <label for="PasswordLama">Password Lama :</label>
                            <input type="password" class="form-control" id="PasswordLama" name="PasswordLama">
                        </div>
                        <div class="form-group">
                            <label for="PasswordBaru">Password Baru :</label>
                            <input type="password" class="form-control" id="PasswordBaru" name="PasswordBaru">
                        </div>
                        <div class="form-group">
                            <label for="PasswordBaru2">Ketik Ulang Password Baru :</label>
                            <input type="password" class="form-control" id="PasswordBaru2" name="PasswordBaru2">
                        </div>
                        <button class="btn btn-primary">Ganti Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
</html>
