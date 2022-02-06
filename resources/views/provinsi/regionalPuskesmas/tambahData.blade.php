@extends("_partials.master")
@section("title","Tambah Data Puskesmas")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="./dashboard" class="btn btn-primary">Back</a>
        <hr>
        <h1>Tambah Data Puskesmas</h1>
        <br>
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-6">
                    <form action="./tambah/kirim" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="kodePuskesmas">Kode Puskesmas :</label>
                            <input type="text" class="form-control" id="kodePuskesmas" name="kodePuskesmas" >
                        </div>
                        <div class="form-group">
                            <label for="namaPuskesmas">Nama Puskesmas :</label>
                            <input type="text" class="form-control" id="namaPuskesmas" name="namaPuskesmas" required>
                        </div>
                        <div class="form-group">
                            <label for="kabupaten">Kabupaten/Kota Puskesmas :</label>
                            <select class="form-control custom-select" id="kabupaten" name="kabupaten"  data-show-subtext="true" data-live-search="true" required>
                                <option selected disabled value="">Pilih Kabupaten/Kota</option>
                                @foreach($data2 as $data2)
                                    <option data-tokens="{{ $data2->nama_kabupaten }}" value="{{ $data2->id_kabupaten }}">{{$data2->nama_kabupaten}}</option>
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
            $('#kabupaten').selectpicker();
        });
    </script>
@endsection
