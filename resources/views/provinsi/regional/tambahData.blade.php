@extends("_partials.master")
@section("title","Tambah Data Kampung")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="./dashboard" class="btn btn-primary">Back</a>
        <hr>
        <h1>Tambah Data kampung</h1>
        <br>
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-6">
                    <form action="./tambah/kirim" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="namaKampung">Nama Kampung</label>
                            <input type="text" class="form-control" name="namaKampung">
                        </div>
                        <div class="form-group">
                            <label for="kodeRegion">Kode Region</label>
                            <input type="text" class="form-control" name="kodeRegion">
                        </div>

                        {{-- perbaki filter kabupaten ke puskesmas mulai dari sini --}}
                        <div class="form-group">
                            <label for="puskesmas">Nama Kabupaten :</label>
                            <select class="form-control custom-select" id="puskesmas" name="puskesmas" data-show-subtext="true" data-live-search="true">
                                <option selected disabled>Pilih Kabupaten</option>
                                {{-- @foreach($data2 as $data2)
                                    <option data-tokens="{{ $data2->nama_puskesmas }}" value="{{ $data2->id_puskesmas }}">{{$data2->nama_puskesmas}}</option>
                                @endforeach --}}
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="puskesmas">Nama Puskesmas :</label>
                            <select class="form-control custom-select" id="puskesmas" name="puskesmas" data-show-subtext="true" data-live-search="true">
                                <option selected disabled>Pilih Pukesmas</option>
                                @foreach($data2 as $data2)
                                    <option data-tokens="{{ $data2->nama_puskesmas }}" value="{{ $data2->id_puskesmas }}">{{$data2->nama_puskesmas}}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- perbaiki sampai sini --}}

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
