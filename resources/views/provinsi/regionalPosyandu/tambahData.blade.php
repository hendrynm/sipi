@extends("_partials.master")
@section("title","Tambah Data Posyandu")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="./dashboard" class="btn btn-primary">Back</a>
        <hr>
        <h1>Tambah Data Posyandu</h1>

        <br>
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-6">
                    <form action="./tambah/kirim" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="namaPosyandu">Nama Posyandu</label>
                            <input type="text" class="form-control" name="namaPosyandu" required>
                        </div>

                         {{-- perbaiki filer select mulai dari sini | kabupaten -> puskesmas -> kampung --}}
                        <x-kabupaten-form-ajax></x-kabupaten-form-ajax>
                        <x-puskesmas-form-ajax></x-puskesmas-form-ajax>
                        <div class="form-group">
                            <label for="kampung">Nama Kampung :</label>
                            <select class="form-control custom-select" id="kampung" name="kampung" data-show-subtext="true" data-live-search="true" required>
                                <option selected disabled value="">Pilih Kampung</option>
                                @foreach($data2 as $data2)
                                    <option data-tokens="{{ $data2->nama_kampung }}" value="{{ $data2->id_kampung }}">{{ $data2->nama_kampung }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- perbaiki sampai sini --}}
                        <div class="form-group">
                            <label for="alamatLengkap">Alamat Lengkap Posyandu :</label>
                            <input type="text" class="form-control" name="alamatLengkap" required>
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
            $('#kampung').selectpicker();
        });
    </script>
@endsection
