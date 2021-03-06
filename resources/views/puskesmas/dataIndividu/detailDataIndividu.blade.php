@extends("_partials.master")
@section("title","Detail Data Anak")

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
                        <th scope="row">NIK Anak :</th>
                        <td>{{ $data->nik }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

       @if($data->jenis_kelamin === "P")
        <h2>Data kehamilan</h2>

        <div class="row">
            <div class="col-md-6">
                <div class="jumbotron isHamil">
                    <table class="table table-borderless">
                        <tbody>
                        <tr>
                            <th scope="row">Status Hamil :</th>
                            <td>
                                @if($data->status_hamil === "hamil")
                                    <div class="hamil text-center">
                                        Sedang Hamil
                                    </div>
                                @else
                                    <div class="not-hamil text-center">
                                        Tidak Hamil
                                    </div>
                                @endif
                            </td>
                        </tr>
                        @if($data->status_hamil === "hamil")
                            <tr>
                                <th scope="row"> Tanggal Kehamilan :</th>
                                <td>
                                    {{ $data->tanggal_hamil }}<br>
                                    {{ (new DateTime())->diff(new DateTime($data->tanggal_hamil))->format("%m bulan") }}
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        @endif

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
                @if($data->idl === 1)
                    <a href="./{{ $data->id_anak }}/cetak-idl" class="btn btn-primary">Cetak Sertifikat IDL</a>
                @endif
                @if($data->irl === 1)
                    <a href="./{{ $data->id_anak }}/cetak-irl" class="btn btn-primary">Cetak Sertifikat IRL</a>
                @endif
                <a href="../konfirmasi/{{ $data->id_anak }}" class="btn btn-danger">Hapus Data Anak</a>
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
                    <td style="color:#E25A56">{{ $data2->status }} imunisasi</td>
                @else
                    <td>{{ $data2->status }} imunisasi</td>
                @endif
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
</html>
