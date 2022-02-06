@extends("_partials.master")
@section("title","Tambah Data Antigen")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="./dashboard" class="btn btn-primary">Back</a>
        <hr>
        <h1>Tambah Data Antigen</h1>
        <br>
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-6">
                    <form action="./tambah/kirim" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="namaKampung">Nama Antigen</label>
                            <input type="text" class="form-control" id="namaAntigen" name="namaAntigen" required>
                        </div>
                        <div class="form-group">
                            <label for="kodeRegion">Waktu Pemberian</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="waktuPemberian" name="waktuPemberian" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" name="basic-addon2">Bulan</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kodeRegion">Interval Pemberian</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="intervalPemberian" name="intervalPemberian" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" name="basic-addon2">Bulan</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kodeRegion">Target Tahunan</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="targetTahunan" name="targetTahunan" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" name="basic-addon2">%</span>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
</html>
