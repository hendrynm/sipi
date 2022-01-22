@extends("_partials.master")
@section("title","Dashboard Provinsi")

    <!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard" class="btn btn-primary">Back</a>
        <hr>
        <h1>Edit Data Puskesmas</h1>
        <br>
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-6">
                    <form action="../kirim" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="idPuskesmas" value="{{ $data->id_puskesmas }}">
                        <div class="form-group">
                            <label for="kodePuskesmas">Kode Puskesmas :</label>
                            <input type="text" class="form-control" id="kodePuskesmas" name="namaPuskesmas" value="{{ $data->kode_puskesmas }}">
                        </div>
                        <div class="form-group">
                            <label for="namaPuskesmas">Nama Puskesmas :</label>
                            <input type="text" class="form-control" id="namaPuskesmas" name="namaPuskesmas" value="{{ $data->nama_puskesmas }}">
                        </div>
                        <div class="form-group">
                            <label for="kabupaten">Kabupaten/Kota Puskesmas :</label>
                            <select class="form-control custom-select" id="kabupaten" name="kabupaten"  data-show-subtext="true" data-live-search="true">
                                <option disabled>Pilih Kabupaten/Kota</option>
                                @foreach($data2 as $data2)
                                    <option data-tokens="{{ $data2->nama_kabupaten }}" value="{{ $data2->id_kabupaten }}"{{ ($data->id_kabupaten === $data2->id_kabupaten) ? " selected":" " }}>{{$data2->nama_kabupaten}}</option>
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
