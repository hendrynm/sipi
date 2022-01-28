@extends("_partials.master")
@section("title","Edit Data Kampung")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard" class="btn btn-primary">Back</a>
        <hr>
        <h1>Edit Data kampung</h1>
        <br>
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-6">
                    <form action="./kirim" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="idKampung" value="{{ $data->id_kampung }}">
                        <div class="form-group">
                            <label for="namaKampung">Nama Kampung</label>
                            <input type="text" class="form-control" id="namaKampung" name="namaKampung" value="{{ $data->nama_kampung }}">
                        </div>
                        <div class="form-group">
                            <label for="kodeRegion">Kode Region</label>
                            <input type="text" class="form-control" id="kodeRegion" name="kodeRegion" value="{{ $data->kode_kampung }}">
                        </div>
                        <button class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
</html>
