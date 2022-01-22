@extends("_partials.master")
@section("title","Tambah Data Regional")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="./dashboard" class="btn btn-primary">Back</a>
        <hr>
        <h1>Tambah kampung</h1>
        <br>
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-6">
                    <form action="../kirim" method="post">
                        <div class="form-group">
                            <label for="namaKampung">Nama Kampung</label>
                            <input type="text" class="form-control" name="namaKampung">
                        </div>
                        <div class="form-group">
                            <label for="kodeRegion">Kode Region</label>
                            <input type="text" class="form-control" name="kodeRegion">
                        </div>
                        <div class="form-group">
                            <label for="puskesmas">pukesmas :</label>
                            <select class="form-control custom-select" id="puskesmas" name="puskesmas" data-show-subtext="true" data-live-search="true">
                                <option selected disabled>Pilih Pukesmas</option>
                                @foreach($data2 as $data2)
                                    <option data-tokens="{{ $data2->nama_puskesmas }}" value="{{ $data2->id_puskesmas }}">{{$data2->nama_puskesmas}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
</html>

@section("js")
    <script>
        $(function() {
            $('#puskesmas').selectpicker();
        });
    </script>
@endsection
