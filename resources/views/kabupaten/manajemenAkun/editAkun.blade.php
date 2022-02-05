@extends("_partials.master")
@section("title","Edit Akun")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard" class="btn btn-primary">Back</a>
        <hr>
        <h1>Edit Akun {{ $data->nama_kabupaten }}</h1>
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-6">
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
                        @if(!($data->id_user === session()->get("id_user")))
                        <div class="form-group">
                            <label for="level">Akses Level :</label>
                            <select class="custom-select" name="level">
                                <option disabled>Pilih akses level</option>
                                <option value="2" {{ $data->level === 2 ? "selected" : ""}}>level 2 - Kabupaten/Kota</option>
                                <option value="3" {{ $data->level === 3 ? "selected" : ""}}>level 3 - Pukesmas</option>
                                <option value="4" {{ $data->level === 4 ? "selected" : ""}}>Level 4 - Rumah Sakit, Klinik Daerah dan Bidan Desa</option>
                            </select>
                        </div>
                        @endif

                        {{-- value kabupaten = value kabupaten itu sendiri --}}
{{--
                        <div class="form-group">
                            <label for="kabupaten">Kabupaten :</label>
                            <select class="custom-select" id="kabupaten" name="kabupaten">
                                <option selected disabled>-- Pilih Kabupaten --</option>

                            </select>
                        </div> --}}


                        <div class="form-group">
                            <label for="puskesmas">Puskesmas :</label>
                            <select class="custom-select" id="puskesmas" name="puskesmas">
                                <option selected disabled>-- Pilih Puskesmas --</option>
                                <option value="1">Puskesmas X</option>

                            </select>
                        </div>


                        {{-- baruend --}}

                        <button class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
</html>
