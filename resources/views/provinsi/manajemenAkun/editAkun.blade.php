@extends("_partials.master")
@section("title","Edit Akun")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard" class="btn btn-primary">Back</a>
        <hr>

        <h1>Akun {{ $data->nama }}</h1>
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
                                    <option disabled value="">Pilih akses level</option>
                                    <option value="1" {{ $data->level === 1 ? "selected" : ""}}>level 1 - Provinsi Papua barat</option>
                                    <option value="2" {{ $data->level === 2 ? "selected" : ""}}>level 2 - Kabupaten/Kota</option>
                                    <option value="3" {{ $data->level === 3 ? "selected" : ""}}>level 3 - Pukesmas</option>
                                    <option value="4" {{ $data->level === 4 ? "selected" : ""}}>Level 4 - Rumah Sakit, Klinik Daerah dan Bidan Desa</option>
                                </select>
                            </div>
                        @endif

                        {{-- baru --}}

                        <div class="form-group">
                            <label for="kabupaten">Kabupaten :</label>
                            <select class="custom-select" id="kabupaten" name="kabupaten">
                                <option selected disabled>-- Pilih Kabupaten --</option>

                            </select>
                        </div>

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
