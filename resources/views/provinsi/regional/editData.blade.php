@extends("_partials.master")
@section("title","Edit Data Regional")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="./dashboard.html" class="btn btn-primary">Back</a>
        <hr>
        <h1>Edit Data kampung</h1>

        <br>
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-6">
                    <form>
                        <div class="form-group">
                            <label for="namaKampung">Nama Kampung</label>
                            <input type="text" class="form-control" id="namaKampung">
                        </div>
                        <div class="form-group">
                            <label for="kodeRegion">Kode Region</label>
                            <input type="text" class="form-control" id="kodeRegion">
                        </div>
                        <a href="./dashboard.html" class="btn btn-primary">Simpan</a>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
</html>
