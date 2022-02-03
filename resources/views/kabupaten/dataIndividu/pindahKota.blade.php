@extends("_partials.master")
@section("title","Detail Data Anak")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard" class="btn btn-primary">back</a>
        <hr>
        <h1>Alih Data</h1>
        <br>
        <div class="jumbotron">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h2>Data Personal</h2>
                    <table class="table ">
                        <tbody>
                        <tr>
                            <th scope="row">Nama Lengkap :</th>
                            <td>{{ $data->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Nama Ibu Kandung :</th>
                            <td>{{ $data->nama_ibu }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Tanggal Lahir :</th>
                            <td>{{ $data->tanggal_lahir }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Usia :</th>
                            <td>{{ (new DateTime())->diff(new DateTime($data->tanggal_lahir))->format("%y tahun %m bulan") }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Jenis Kelamin :</th>
                            <td>{{ ($data->jenis_kelamin === "L") ? "Laki-laki" : "Perempuan" }}</td>
                        </tr>
                        <tr>
                            <th scope="row">No HP :</th>
                            <td>{{ $data->no_hp }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Kabupaten/Kota Tinggal :</th>
                            <td>{{ $data->nama_kabupaten }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Alamat Tinggal :</th>
                            <td>{{ $data->alamat }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Posyandu :</th>
                            <td>{{ $data->nama_posyandu }}</td>
                        </tr>
                        <tr>
                            <th scope="row">KTP :</th>
                            <td>{{ $data->nik }}</td>
                        </tr>
                        </tbody>
                    </table>


                    <h2>Data Pindah</h2>
                    <form action="../kirim" method="post">
                        @csrf
                        <input type="hidden" id="idAnak" name="idAnak" value="{{ $data->id_anak }}">
                        {{-- perbaiki dari sini ya, filter selectna --}}
                        <div class="form-group">
                            <label for="kabupatenBaru">Kabupaten/Kota Baru : </label>
                            <select class="form-control custom-select" id="kabupatenBaru" data-show-subtext="true" data-live-search="true">
                                <option selected disabled> --- </option>
                                @foreach($data2 as $data2)
                                <option value="{{ $data2->id_kabupaten }}">{{ $data2->nama_kabupaten }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="puskesmasBaru">Puskesmas Baru : </label>
                            <select class="form-control custom-select" id="puskesmasBaru" data-show-subtext="true" data-live-search="true">
                                <option selected disabled> --- </option>
                                {{-- @foreach($data2 as $data2)
                                <option value="{{ $data2->id_kabupaten }}">{{ $data2->nama_kabupaten }}</option>
                                @endforeach --}}
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="kampungbaru">Kampung Baru : </label>
                            <select class="form-control custom-select" id="kampungbaru" data-show-subtext="true" data-live-search="true">
                                <option selected disabled> --- </option>
                                {{-- @foreach($data2 as $data2)
                                <option value="{{ $data2->id_kabupaten }}">{{ $data2->nama_kabupaten }}</option>
                                @endforeach --}}
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="posyanduBaru">Posyandu Baru : </label>
                            <select class="form-control custom-select" id="posyanduBaru" data-show-subtext="true" data-live-search="true">
                                <option selected disabled> --- </option>
                                @foreach($data3 as $data3)
                                    <option value="{{ $data3->id_posyandu }}">{{ $data3->nama_posyandu }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input position-static" type="checkbox" id="blankCheckbox"
                                   value="option1" aria-label="..." required>
                            <label for="posyanduBaru"> Saya yakin data yang dimasukan sudah benar</label>
                        </div>
                        <button class="btn btn-primary">Simpan Data</button>
                    </form>
                </div>
            </div>
        </div>
@endsection
</html>

@section("js")
    <script>
        $(function() {
            $('#kabupatenBaru').selectpicker();
            $('#posyanduBaru').selectpicker();
        });
    </script>
@endsection
