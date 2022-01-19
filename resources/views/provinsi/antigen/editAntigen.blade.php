@extends("_partials.master")
@section("title","Edit Data Antigen")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="./dashboard.html" class="btn btn-primary">Back</a>
        <hr>
        <h1>Edit Data Antigen</h1>
        <br>
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-8">
                    <form>
                        <div class="form-group">
                            <label for="namaKampung">Nama Antigen :</label>
                            <input type="text" class="form-control" id="namaKampung">
                        </div>
                        <div class="form-group">
                            <label for="kodeRegion">Waktu Pemberian :</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Recipient's username"
                                       aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Bulan</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kodeRegion">Interval Pemberian :</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Recipient's username"
                                       aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Bulan</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kodeRegion">Target Tahunan :</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Recipient's username"
                                       aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>
                            </div>
                        </div>

                        <a href="./dashboard.html" class="btn btn-primary">Simpan</a>
                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection
</html>
