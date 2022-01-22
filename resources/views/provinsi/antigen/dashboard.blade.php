@extends("_partials.master")
@section("title","Dashboard Data Antigen")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href=".." class="btn btn-primary">Back</a>
        <hr>
        <h1>Dasboard Data Antigen Provinsi</h1>

        <div class="jumbotron">
            <a href="./tambah" class="btn btn-primary">Tambah Data Antigen</a>
            <br>
            <br>

            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Nama Antigen</th>
                    <th scope="col">waktu pemberian</th>
                    <th scope="col">Interval Pemberian</th>
                    <th scope="col">Target Tahunan</th>
                    <th scope="col">#</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $data)
                    <tr>
                        <th scope="row">{{ $data->nama_antigen }}</th>
                        <td>{{ $data->waktu_pemberian }} bulan</td>
                        <td>{{ $data->interval_pemberian }} bulan</td>
                        <td>{{ $data->target_tahunan }}%</td>
                        <td>
                            <a href="./edit/{{ $data->id_antigen }}" class="btn btn-primary">Edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
</html>
