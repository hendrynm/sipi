@extends("_partials.master")
@section("title","Data Target dan Sasaran Kampung")

<!DOCTYPE html>
<html lang="id">
@section("konten")
<div class="container main-dashboard">
        <a href="../dashboard" class="btn btn-primary">back</a>
        <hr>
        <h1>Data target dan sasaran kampung {{ $data->nama_kampung }}</h1>
        <div class="jumbotron">
            <br>
            <br>
            <div class="row justify-content-center">
                <div class="col-10">
                    <p> <b>Kelahiran Hidup</b> </p>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">angka</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>laki-laki</td>
                            <td>{{ $data->bayi_lahir_L }}</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>perempuan</td>
                            <td>{{ $data->bayi_lahir_P }}</td>
                        </tr>
                        </tbody>
                    </table>

                    <p> <b>surviving infant</b> </p>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">angka</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>laki-laki</td>
                            <td>{{ $data->surviving_infant_L }}</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>perempuan</td>
                            <td>{{ $data->surviving_infant_P }}</td>
                        </tr>
                        </tbody>
                    </table>

                    <p> <b>baduta</b> </p>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">angka</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>laki-laki</td>
                            <td>{{ $data->baduta_L }}</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>perempuan</td>
                            <td>{{ $data->baduta_P }}</td>
                        </tr>
                        </tbody>
                    </table>

                    <p> <b>Anak Usia Pra Sekolah (5-6 tahun)</b> </p>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">angka</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>laki-laki</td>
                            <td>{{ $data->prasekolah_L }}</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>perempuan</td>
                            <td>{{ $data->prasekolah_P }}</td>
                        </tr>
                        </tbody>
                    </table>

                    <p> <b>Anak Usia Kelas 1 SD (7 tahun)</b> </p>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">angka</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>laki-laki</td>
                            <td>{{ $data->sd_1_L }}</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>perempuan</td>
                            <td>{{ $data->sd_1_P }}</td>
                        </tr>
                        </tbody>
                    </table>

                    <p> <b>Anak Usia Kelas 2 SD (8 tahun)</b> </p>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">angka</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>laki-laki</td>
                            <td>{{ $data->sd_2_L }}</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>perempuan</td>
                            <td>{{ $data->sd_2_P }}</td>
                        </tr>
                        </tbody>
                    </table>

                    <p> <b>Anak Usia Kelas 5 SD (11 tahun)</b> </p>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">angka</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>laki-laki</td>
                            <td>{{ $data->sd_5_L }}</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>perempuan</td>
                            <td>{{ $data->sd_5_P }}</td>
                        </tr>
                        </tbody>
                    </table>

                    <p> <b>Anak Usia Kelas 6 SD (12 tahun) </b> </p>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">angka</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>laki-laki</td>
                            <td>{{ $data->sd_6_L }}</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>perempuan</td>
                            <td>{{ $data->sd_6_P }}</td>
                        </tr>
                        </tbody>
                    </table>

                    <p> <b>Wanita Usia Subur </b>
                    </p>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Kondisi</th>
                            <th scope="col">angka</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>sedang hamil</td>
                            <td>{{ $data->wus_hamil }}</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>tidak hamil</td>
                            <td>{{ $data->wus_tidak_hamil }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
</html>
