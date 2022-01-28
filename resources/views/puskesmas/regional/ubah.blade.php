@extends("_partials.master")
@section("title","Ubah Target dan Sasaran Kampung")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard" class="btn btn-primary">back</a>
        <hr>
        <h1>Ubah target dan sasaran kampung {{ $data->nama_kampung }}</h1>
        <form action="../ubah/kirim" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="idKampung" value="{{ $data->id_kampung }}">
            <div class="jumbotron">
                <h3>Kelahiran Hidup</h3>
                <hr>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="khLaki">laki-Laki : </label>
                            <input type="text" class="form-control" id="khLaki" name="khLaki" value="{{ $data->bayi_lahir_L }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="khPerempuan">Perempuan : </label>
                            <input type="text" class="form-control" id="khPerempuan" name="khPerempuan" value="{{ $data->bayi_lahir_L }}">
                        </div>
                    </div>
                </div>

                <br>
                <br>

                <h3>surviving infant</h3>
                <hr>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="siLaki">laki-Laki : </label>
                            <input type="text" class="form-control" id="siLaki" name="siLaki" value="{{
                            $data->surviving_infant_L }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="siPerempuan">Perempuan : </label>
                            <input type="text" class="form-control" id="siPerempuan" name="siPerempuan" value="{{
                            $data->surviving_infant_P }}">
                        </div>
                    </div>
                </div>

                <br>
                <br>

                <h3>Baduta</h3>
                <hr>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="bdLaki">laki-Laki : </label>
                            <input type="text" class="form-control" id="bdLaki" name="bdLaki" value="{{
                            $data->baduta_L }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for=bdPerempuan">Perempuan : </label>
                            <input type="text" class="form-control" id="bdPerempuan" name="bdPerempuan" value="{{
                            $data->baduta_P }}">
                        </div>
                    </div>
                </div>

                <br>
                <br>

                <h3>Balita</h3>
                <hr>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="blLaki">laki-Laki : </label>
                            <input type="text" class="form-control" id="blLaki" name="blLaki" value="{{
                            $data->balita_L }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for=blPerempuan">Perempuan : </label>
                            <input type="text" class="form-control" id="blPerempuan" name="blPerempuan" value="{{$data->balita_P }}">
                        </div>
                    </div>
                </div>

                <br>
                <br>

                <h3>Anak Usia Pra Sekolah (5-6 tahun)</h3>
                <hr>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="pLaki">laki-Laki : </label>
                            <input type="text" class="form-control" id="pLaki" name="pLaki" value="{{
                            $data->prasekolah_L }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="pPerempuan">Perempuan : </label>
                            <input type="text" class="form-control" id="pPerempuan" name="pPerempuan" value="{{
                            $data->prasekolah_P }}">
                        </div>
                    </div>
                </div>

                <br>
                <br>

                <h3>Anak Usia Kelas 1 SD (7 tahun)</h3>
                <hr>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="s1Laki">laki-Laki : </label>
                            <input type="text" class="form-control" id="s1Laki" name="s1Laki" value="{{
                            $data->sd_1_L }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="s1Perempuan">Perempuan : </label>
                            <input type="text" class="form-control" id="s1Perempuan" name="s1Perempuan" value="{{
                            $data->sd_1_P }}">
                        </div>
                    </div>
                </div>

                <br>
                <br>

                <h3>Anak Usia Kelas 2 SD (8 tahun)</h3>
                <hr>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="s2Laki">laki-Laki : </label>
                            <input type="text" class="form-control" id="s2Laki" name="s2Laki" value="{{
                            $data->sd_2_L }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="s2Perempuan">Perempuan : </label>
                            <input type="text" class="form-control" id="s2Perempuan" name="s2Perempuan" value="{{
                            $data->sd_2_P }}">
                        </div>
                    </div>
                </div>

                <br>
                <br>

                <h3>Anak Usia Kelas 5 SD (11 tahun) </h3>
                <hr>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="s5Laki">laki-Laki : </label>
                            <input type="text" class="form-control" id="s5Laki" name="s5Laki" value="{{
                            $data->sd_5_L }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="s5Perempuan">Perempuan : </label>
                            <input type="text" class="form-control" id="s5Perempuan" name="s5Perempuan" value="{{
                            $data->sd_5_P }}">
                        </div>
                    </div>
                </div>
                <br>
                <br>

                <h3>Anak Usia Kelas 6 SD (12 tahun) </h3>
                <hr>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="s6Laki">laki-Laki : </label>
                            <input type="text" class="form-control" id="s6Laki" name="s6Laki" value="{{
                            $data->sd_6_L }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="s6Perempuan">Perempuan : </label>
                            <input type="text" class="form-control" id="s6Perempuan" name="s6Perempuan" value="{{
                            $data->sd_6_P }}">
                        </div>
                    </div>
                </div>
                <br>
                <br>

                <h3>Wanita Usia Subur</h3>
                <hr>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="wusHamil">Hamil : </label>
                            <input type="text" class="form-control" id="wusHamil" name="wusHamil" value="{{$data->wus_hamil}}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="wusTidakHamil">Tidak hamil : </label>
                            <input type="text" class="form-control" id="wusTidakHamil" name="wusTidakHamil" value="{{
                            $data->wus_tidak_hamil }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="dataIsValid" required>
                <label class="form-check-label" for="dataIsValid">Data yang diisi sudah benar</label>
            </div>
            <button class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
</html>
