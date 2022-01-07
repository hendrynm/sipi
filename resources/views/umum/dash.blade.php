@extends("_partials.master")
@section("title","Login")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    Selamat Datang di SIPI Papua Barat
    @if(session()->has("sukses"))
        {{ session()->get("sukses") }}
    @endif
@endsection
</html>
