@extends("_partials.master")
@section("title","Edit Data Puskesmas")

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
                    <form action="./kirim" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="idPuskesmas" value="{{ $data->id_puskesmas }}">
                        <div class="form-group">
                            <label for="kodePuskesmas">Kode Puskesmas :</label>
                            <input type="text" class="form-control" id="kodePuskesmas" name="kodePuskesmas" value="{{ $data->kode_puskesmas }}">
                        </div>
                        <div class="form-group">
                            <label for="namaPuskesmas">Nama Puskesmas :</label>
                            <input type="text" class="form-control" id="namaPuskesmas" name="namaPuskesmas" value="{{ $data->nama_puskesmas }}">
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
