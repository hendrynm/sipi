@extends("_partials.master")
@section("title","Dashboard Data Anak")

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
        <a href="./dashboard" class="btn btn-primary">back</a>
        <hr>
        <h1>Data Individu</h1>
        <br>

        <div class="jumbotron custom-table">
            <table class="table" id="dataIndividu">
                <thead class="thead-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">NIK Anak</th>
                    <th scope="col">Nama Anak</th>
                    <th scope="col">Tanggal Lahir</th>
                    <th scope="col">Usia</th>
                    <th scope="col">Asal Kabupaten/Kota</th>
                    <th scope="col">#</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->nik }}</td>
                    <td>{{ $data->nama_lengkap }}</td>
                    <td>{{ $data->tanggal_lahir }}</td>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->nama_kabupaten }}</td>
                    <td><a href="./detail/{{ $data->id_anak }}" class="btn btn-primary">Detail</a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
</html>
