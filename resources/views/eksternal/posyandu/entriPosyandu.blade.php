@extends("_partials.master")
@section("title","Entri Data Posyandu")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        @if(session()->has("sukses"))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get("sukses") }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(session()->has("gagal"))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session()->get("gagal") }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <a href="../dashboard" class="btn btn-primary">back</a>
        <hr>
        <h1>Data Anak</h1>
        <br>
        <br>

        <div class="row">
            <div class="col-md-6">
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
            </div>
        </div>

        <h2>Status Imunisasi</h2>
        <div class="row">
            <div class="col-md-6">
                <table class="table ">
                    <tbody>
                    <tr>
                        <th scope="row">Imunisasi Dasar Lengkap :</th>
                        <td>{{ ($data->idl === 0) ? "Belum Terpenuhi" : "Sudah terpenuhi" }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Imunisasi Rutin Lengkap :</th>
                        <td>{{ ($data->irl === 0) ? "Belum Terpenuhi" : "Sudah terpenuhi" }}</td>
                    </tr>

                    @if($data->jenis_kelamin === "P")
                        <tr>
                            <th scope="row">Status T :</th>
                            <td>{{ $data->status_t ?? "-"}}</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>

        <br>
        <br>
        <h2>Data Imunisasi</h2>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Imunisasi</th>
                <th scope="col">Tanggal Imunisasi</th>
                <th scope="col">Tempat Imunisasi</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data2 as $data2)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $data2->nama_antigen }}</td>
                <td>{{ $data2->tanggal_pemberian }}</td>
                <td>{{ $data2->tempat_imunisasi }}</td>
                @if($data2->status === "belum")
                    <td style="color:#E25A56">
                        <form action="./kirim" method="post">
                            @csrf
                            <input type="hidden" id="lokasi" name="lokasi" value="{{ $data4->nama }}">
                            <input type="hidden" id="idAnak" name="idAnak" value="{{ $data->id_anak }}">
                            <input type="hidden" id="antigen" name="antigen" value="{{ $data2->id_antigen }}">
                            <input type="hidden" id="tanggal" name="tanggal" value="{{ date("Y/m/d") }}">
                            <button class="btn btn-primary"
                                    onclick="return confirm('Apakah Anda yakin ingin menyimpan data tersebut? \n\n' +
                                        'Antigen: {{$data2->nama_antigen}} \n' +
                                        'Tanggal: {{date("d-m-Y")}} \n' +
                                        'Lokasi: {{$data4->nama}}');">
                                Entri Imunisasi
                            </button>
                        </form>
                    </td>
                @else
                    <td>{{ $data2->status }} imunisasi</td>
                @endif
            </tr>
            @endforeach
            </tbody>
        </table>

        <br>
        <br>
        <h2>Data Entri</h2>
        <div class="jumbotron">
            <div class="row justify-content-center">
                <div class="col-8">
                    <form action="./kirim" method="post">
                        @csrf
                        <input type="hidden" id="lokasi" name="lokasi" value="{{ $data4->nama }}">
                        <input type="hidden" id="idAnak" name="idAnak" value="{{ $data->id_anak }}">
                        <div class="form-group">
                            <label for="antigen"> <b> Antigen :</b></label>
                            <select class="custom-select" id="antigen" name="antigen" required>
                                <option selected disabled value="">Pilih Antigen...</option>
                                @foreach($data3 as $data3)
                                    <option value="{{ $data3->id_antigen }}">{{ $data3->nama_antigen }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal Posyandu :</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="antigenIsValid" required>
                            <label class="form-check-label" for="antigenIsValid">Data Antigen diatas sudah benar</label>
                        </div>
                        <button class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
</html>
