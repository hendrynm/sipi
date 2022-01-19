@extends("_partials.master")
@section("title","Ganti Password")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="./dashboard.html" class="btn btn-primary">Back</a>
        <hr>
        <h1>Ganti Password</h1>
        <div class="jumbotron">
            <h2>Data User</h2>
            <p>
                <b>Username</b> : kotaSorong<br>
                <b>Nama</b> : Kota Sorong <br>
                <b>Email</b> : kota.sorong@gmail.com <br>



            </p>
        </div>

        <div class="jumbotron">
            <h2>Ganti password</h2>

            <div class="row">
                <div class="col-md-6">
                    <form>
                        <div class="form-group">
                            <label for="PasswordLama">Password Lama :</label>
                            <input type="password" class="form-control" id="PasswordLama">
                        </div>
                        <div class="form-group">
                            <label for="PasswordBaru">Password Baru :</label>
                            <input type="password" class="form-control" id="PasswordBaru">
                        </div>
                        <div class="form-group">
                            <label for="PasswordBaru2">Ketik Ulang Password Baru :</label>
                            <input type="password" class="form-control" id="PasswordBaru2">
                        </div>

                        <a href="./dashboard.html" class="btn btn-primary">Ganti Password</a>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
</html>
