@extends("_partials.master")
@section("title","Tambah Data Anak")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard" class="btn btn-primary">back</a>
        <hr>
        <h1>Tambah Data Anak</h1>
        <br>
        <br>
        <div class="jumbotron">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form action="./tambah/kirim" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="namaLengkap">Nama Lengkap : </label>
                            <input type="text" class="form-control" id="namaLengkap" name="namaLengkap" required>
                        </div>
                        <div class="form-group">
                            <label for="namaIbuKandung">Nama Ibu Kandung : </label>
                            <input type="text" class="form-control" id="namaIbuKandung" name="namaIbuKandung" required>
                        </div>
                        <div class="form-group">
                            <label for="noHP">NIK : </label>
                            <input type="text" class="form-control" id="nik" name="nik">
                        </div>
                        <div class="form-group">
                            <label for="tanggalLahir">Tanggal Lahir : </label>
                            <input type="date" class="form-control" id="tanggalLahir" name="tanggalLahir" required>
                        </div>
                        <div class="form-group">
                            <label for="jenisKelamin">Jenis Kelamin : </label>
                            <select class="custom-select" id="jenisKelamin" name="jenisKelamin" required>
                                <option selected disabled>Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="noHP">No HP: </label>
                            <input type="text" class="form-control" id="noHP" name="noHP" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat Tinggal: </label>
                            <input type="text" class="form-control" id="alamat" name="alamat" required>
                        </div>
                        <div class="form-group">
                            <label for="kampung">Kampung : </label>
                            <select class="form-control custom-select" id="kampung" name="kampung" data-show-subtext="true" data-live-search="true" required>
                                <option selected disabled value="">Pilih kampung</option>
                                @foreach($data as $data)
                                    <option value="{{ $data->id_kampung }}">{{ $data->nama_kampung }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="posyandu">Posyandu : </label>
                            <select class="form-control custom-select" id="posyandu" name="posyandu" data-show-subtext="true" data-live-search="true" required>
                                <option selected disabled value="">Pilih Posyandu</option>
                                @foreach($data2 as $data2)
                                    <option value="{{ $data2->id_posyandu }}">{{ $data2->nama_posyandu }}</option>
                                @endforeach
                            </select>
                        </div>

                        <br>
                        <a data-toggle="collapse" class="form-hamil-button" href="#isHamil" role="button"
                            aria-expanded="false" aria-controls="isHamil">
                            + tambah status kehamilan
                        </a>
                        <br>
                        <br>

                        <div class="collapse form-hamil" id="isHamil">
                            <div class="form-group">
                                <label for="isHamil">Status Kehamilan : </label>
                                <select class=custom-select" id="isHamil" name="isHamil">
                                    <option selected disabled>---- Pilih Status ---</option>
                                    <option value="1">Hamil</option>
                                    <option value="1">Tidak Hamil</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggalKehamilan">Tanggal Kehamilan : </label>
                                <input type="date" class="form-control" id="tanggalKehamilan" name="tanggalKehamilan">
                            </div>
                        </div>

                        <button class="btn btn-primary">Simpan Data Personal</button>
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
            $('#posyandu').selectpicker();
        });
    </script>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('select[id="posyandu"]').selectpicker();
            $('select[id="kampung"]').on('change', function() {
                $('select[id="posyandu"]').empty();
                var cityID = $(this).val();
                if(cityID) {
                    $.ajax({
                        url: '/data-ajax/posyandu/' + cityID,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            console.log(data);
                            $('select[id="posyandu"]').empty();
                            $('select[id="posyandu"]').append('<option value=""></option>');
                            $.each(data, function(key, value) {
                                $('select[id="posyandu"]').append('<option data-tokens="'+ key +'" value="'+ value +'">'+ key +'</option>');
                            });
                            $('select[id="posyandu"]').selectpicker('refresh');
                        }
                    });
                }else{
                    $('select[id="posyandu"]').empty();
                }
            });
        });
    </script>
@endpush
