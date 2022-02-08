@extends("_partials.master")
@section("title","Edit Akun")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard" class="btn btn-primary">Back</a>
        <hr>

        <h1>Edit Akun {{ $data->nama_puskesmas }}</h1>
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-6">
                    <h2>Edit Akun</h2>
                    <br>
                    <form action="./kirim" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="idUser" value="{{ $data->id_user }}">
                        <div class="form-group">
                            <label for="username">Username :</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ $data->username }}">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Instansi :</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ $data->nama }}">
                        </div>
                        <div class="form-group">
                            <label for="nama">Email :</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{ $data->email }}">
                        </div>
                        @if(!($data->id_user === session()->get("id_user")))
                            <div class="form-group">
                                <label for="level">Akses Level :</label>
                                <select class="custom-select" id="level" name="level">
                                    <option disabled>Pilih akses level</option>
                                    <option value="3" {{ $data->level === 3 ? "selected" : ""}}>level 3 - Pukesmas</option>
                                    <option value="4" {{ $data->level === 4 ? "selected" : ""}}>Level 4 - Rumah Sakit, Klinik Daerah dan Bidan Desa</option>
                                </select>
                            </div>
                        @endif
                        {{-- baru --}}

                        {{-- baruend --}}



                        <button class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
</html>
