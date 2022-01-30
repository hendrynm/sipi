@extends("_partials.master")
@section("title","Tambah Data Anak")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard" class="btn btn-primary">back</a>
        <hr>
        <h1>Tambah Data Anak</h1>
        <br>
        <br>
        <div class="jumbotron">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form action="./tambah/kirim" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="namaLengkap">Nama Lengkap : </label>
                            <input type="text" class="form-control" id="namaLengkap" name="namaLengkap">
                        </div>
                        <div class="form-group">
                            <label for="namaIbuKandung">Nama Ibu Kandung : </label>
                            <input type="text" class="form-control" id="namaIbuKandung" name="namaIbuKandung">
                        </div>
                        <div class="form-group">
                            <label for="noHP">NIK : </label>
                            <input type="text" class="form-control" id="nik" name="nik">
                        </div>
                        <div class="form-group">
                            <label for="tanggalLahir">Tanggal Lahir : </label>
                            <input type="date" class="form-control" id="tanggalLahir" name="tanggalLahir">
                        </div>
                        <div class="form-group">
                            <label for="jenisKelamin">Jenis Kelamin : </label>
                            <select class="custom-select" id="jenisKelamin" name="jenisKelamin">
                                <option selected disabled>Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="noHP">No HP: </label>
                            <input type="text" class="form-control" id="noHP" name="noHP">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat Tinggal: </label>
                            <input type="text" class="form-control" id="alamat" name="alamat">
                        </div>
                        <div class="form-group">
                            <label for="kampung">Kampung : </label>
                            <select class="custom-select" id="kampung" name="kampung">
                                <option selected disabled>Pilih kampung</option>
                                @foreach($data as $data)
                                    <option value="{{ $data->id_kampung }}">{{ $data->nama_kampung }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="posyandu">Posyandu : </label>
                            <select class="custom-select" id="posyandu" name="posyandu">
                                <option selected disabled>Pilih Posyandu</option>
                                @foreach($data2 as $data2)
                                    <option value="{{ $data2->id_posyandu }}">{{ $data2->nama_posyandu }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- ini blum di konfigurasi ya hend --}}

                        <br>
                        <a data-toggle="collapse" class="form-hamil-button" href="#isHamil" role="button"
                            aria-expanded="false" aria-controls="isHamil">
                            + tambah status kehamilan
                        </a>
                        <br>
                        <br>

                        <div class="collapse form-hamil" id="isHamil">

                            <div class="form-group">
                                <label for="isHamil">Status Kehamilan : </label>
                                <select class="custom-select" id="isHamil">
                                    <option selected>---- Pilih Status ---</option>
                                    <option value="1">Hamil</option>
                                    <option value="1">Tidak Hamil</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggalKehamilan">Tanggal Kehamilan : </label>
                                <input type="date" class="form-control" id="tanggalKehamilan">
                            </div>
                        </div>

                        {{-- ini belum di konfigurasi yang hend --}}


                        <button class="btn btn-primary">Simpan Data Personal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
</html>
