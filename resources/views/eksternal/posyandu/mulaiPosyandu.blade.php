@extends("_partials.master")
@section("title","Mulai Posyandu")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard" class="btn btn-primary">back</a>
        <hr>
        <h1>Data Anak</h1>
        <br>
        <div class="jumbotron">
            <table class="table" id="mulaiPosyandu">
                <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">NIK</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Ibu Kandung</th>
                    <th scope="col">Usia</th>
                    <th scope="col">Belum Imunisasi</th>
                    <th scope="col">#</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nik }}</td>
                        <td>{{ $data->nama_lengkap }}</td>
                        <td>{{ $data->nama_ibu }}</td>
                        <td>{{ $loop->iteration }}</td>
                        <td>{!! str_replace(", ","<br>",$data->nama_antigen) !!}</td>
                        <td><a href="./entri/{{ $data->id_anak }}" class="btn btn-primary">Entri Imunisasi</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
</html>
