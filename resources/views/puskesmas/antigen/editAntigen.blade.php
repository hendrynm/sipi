@extends("_partials.master")
@section("title","Edit Data Antigen")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard" class="btn btn-primary">Back</a>
        <hr>
        <h1>Edit Data Antigen</h1>
        <br>
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-8">
                    <form action="../edit/kirim" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="idAntigen" value="{{ $data->id_antigen }}">
                        <div class="form-group">
                            <label for="namaKampung">Nama Antigen :</label>
                            <input type="text" class="form-control" name="namaAntigen" value="{{ $data->nama_antigen }}">
                        </div>
                        <div class="form-group">
                            <label for="kodeRegion">Waktu Pemberian :</label>
                            <div class="input-group mb-3">
                                <input type="text" name="waktuPemberian" class="form-control" placeholder="Recipient's
                                username"
                                       aria-label="Recipient's username" aria-describedby="basic-addon2" value="{{
                                       $data->waktu_pemberian }}">
                                <div class="input-group-append">
                                    <span class="input-group-text" name="basic-addon2">Bulan</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kodeRegion">Interval Pemberian :</label>
                            <div class="input-group mb-3">
                                <input type="text" name="intervalPemberian" class="form-control"
                                       placeholder="Recipient's username"
                                       aria-label="Recipient's username" aria-describedby="basic-addon2" value="{{
                                       $data->interval_pemberian }}">
                                <div class="input-group-append">
                                    <span class="input-group-text" name="basic-addon2">Bulan</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kodeRegion">Target Tahunan :</label>
                            <div class="input-group mb-3">
                                <input type="text" name="targetTahunan" class="form-control" placeholder="Recipient's
                                username"
                                       aria-label="Recipient's username" aria-describedby="basic-addon2" value="{{
                                       $data->target_tahunan }}">
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
