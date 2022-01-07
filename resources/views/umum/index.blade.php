@extends("_partials.master")
@section("title","Login")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    Selamat Datang di SIPI Papua Barat
    <br>
    @if(session()->has("gagal"))
        Error: {{ session()->get("gagal") }}
    @endif

    <form method="post" action="/login">
        {{ csrf_field() }}
        <input type="text" name="username" placeholder="Masukkan username anda" required="required">
        <input type="password" name="password" placeholder="Masukkan password anda" required="required">
        <button type="submit">Login</button>
    </form>
@endsection
</html>
