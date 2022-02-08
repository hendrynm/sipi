@extends("_partials.master")
@section("title","Edit Data Anak")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard" class="btn btn-primary">back</a>
        <hr>
        <h1>Edit Data Anak {{ $data->nama_lengkap }}</h1>
        <br>
        <br>
        <div class="jumbotron">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form action="./kirim" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="idAnak" value="{{ $data->id_anak }}">
                        <input type="hidden" name="kampung" value="{{ $data->id_kampung }}">
                        <div class="form-group">
                            <label for="namaLengkap">Nama Lengkap : </label>
                            <input type="text" class="form-control" id="namaLengkap" name="namaLengkap" value="{{ $data->nama_lengkap }}">
                        </div>
                        <div class="form-group">
                            <label for="namaIbuKandung">Nama Ibu Kandung : </label>
                            <input type="text" class="form-control" id="namaIbuKandung" name="namaIbuKandung" value="{{ $data->nama_ibu }}">
                        </div>
                        <div class="form-group">
                            <label for="noHP">NIK : </label>
                            <input type="text" class="form-control" id="nik" name="nik" value="{{ $data->nik }}">
                        </div>
                        <div class="form-group">
                            <label for="tanggalLahir">Tanggal Lahir : </label>
                            <input type="date" class="form-control" id="tanggalLahir" name="tanggalLahir" value="{{ $data->tanggal_lahir }}">
                        </div>
                        <div class="form-group">
                            <label for="jenisKelamin">Jenis Kelamin : </label>
                            <select class="custom-select" id="jenisKelamin" name="jenisKelamin">
                                <option disabled>Pilih Jenis Kelamin</option>
                                <option value="L" {{ $data->jenis_kelamin === "L" ? "selected" : "" }}>Laki-laki</option>
                                <option value="P" {{ $data->jenis_kelamin === "P" ? "selected" : ""
                                }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="noHP">No HP: </label>
                            <input type="text" class="form-control" id="noHP" name="noHP" value="{{ $data->no_hp }}">
                        </div>
                        <div class="form-group">
                            <label for="kabupaten">Kabupaten/kota Tinggal: </label>
                            <input type="text" class="form-control" id="kabupaten" name="kabupaten" value="{{ $data->nama_kabupaten }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat Tinggal: </label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $data->alamat }}">
                        </div>
                        {{-- ini untuk input kampung --}}

                        <div class="form-group">
                            <label for="kampung">Kampung : </label>
                            <select class="custom-select" id="kampung" name="kampung" required>
                                <option selected disabled value="">Pilih kampung</option>
                                @foreach($data3 as $da)
                                    <option value="{{ $da->id_kampung }}" {{$da->id_kampung == $data->id_kampung ? 'selected' : ''}}>{{ $da->nama_kampung }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="posyandu">Posyandu : </label>
                            <select class="custom-select" id="posyandu" name="posyandu" required>
                                <option selected disabled value="">Pilih Posyandu</option>
                                @foreach($data2 as $da2)
                                    <option value="{{ $da2->id_posyandu }}" {{$da2->id_posyandu == $data->id_posyandu ? 'selected' : ''}}>{{ $da2->nama_posyandu }}</option>
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
                                <select class="custom-select" id="isHamil" name="isHamil">
                                    <option disabled>---- Pilih Status ---</option>
                                    <option value="hamil" {{ $data->status_hamil === "hamil" ? "selected" : ""
                                    }}>Hamil</option>
                                    <option value="" {{ $data->status_hamil === null ? "selected" : "" }}>Tidak Hamil</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggalKehamilan">Tanggal Kehamilan : </label>
                                <input type="date" class="form-control" id="tanggalKehamilan" name="tanggalKehamilan" value="{{ $data->tanggal_hamil }}">
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
                            $('select[id="posyandu"]').append('<option></option>');
                            $.each(data, function(key, value) {
                                $('select[id="posyandu"]').append('<option data-tokens="'+ key +'" value="'+ value +'">'+ key +'</option>');
                            });
                            $('select[id="posyandu"]').selectpicker('refresh');
                            $('select[id="posyandu"]').selectpicker('val', {{$data->id_posyandu}});
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
