@extends("_partials.master")
@section("title","Detail Data Anak")

<!DOCTYPE html>
<html lang="id">
@section("konten")
<div class="container">
    <a href="../dashboard" class="btn btn-primary">back</a>
    <hr>
    <h1>Konfirmasi Penghapusan Data Individu</h1>

    <br>
    <div class="jumbotron">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <br>
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
                <br>

                <h2 class="konfirmasi">Apakah Anda yakin akan menghapus data ini?</h2>
                <a href="../hapus/{{ $data->id_anak }}" class="btn btn-danger">Hapus</a>
            </div>
        </div>

    </div>
</div>
@endsection
</html>
