@extends("_partials.master")
@section("title","Login")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        @if(session()->has("gagal"))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                {{ session()->get("gagal") }}
            </div>
        @endif

        <form action="/login" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <a href="./kabupaten/dasboard.html" class="btn btn-primary">sementara - kabupaten</a>
            <a href="./provinsi/dasboard.html" class="btn btn-primary">sementara - provinsi</a>
            <div class="form-group">
                <a href="./lupa_password.html">lupa password</a>
            </div>
        </form>
    </div>
@endsection
</html>
