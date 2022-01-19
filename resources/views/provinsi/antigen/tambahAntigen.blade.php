@extends("_partials.master")
@section("title","Tambah Data Antigen")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="./dashboard.html" class="btn btn-primary">Back</a>
        <h1>Edit Data Antigen</h1>
        <br>
        <form>
            <div class="form-group">
                <label for="namaKampung">Nama Antigen</label>
                <input type="text" class="form-control" id="namaKampung">
            </div>
            <div class="form-group">
                <label for="kodeRegion">Waktu Pemberian</label>
                <input type="text" class="form-control" id="kodeRegion">
            </div>
            <div class="form-group">
                <label for="kodeRegion">Interval Pemberian</label>
                <input type="text" class="form-control" id="kodeRegion">
            </div>
            <div class="form-group">
                <label for="kodeRegion">Target Tahunan</label>
                <input type="text" class="form-control" id="kodeRegion">
            </div>

            <a href="./dashboard.html" class="btn btn-primary">Simpan</a>
        </form>
    </div>
@endsection
</html>
