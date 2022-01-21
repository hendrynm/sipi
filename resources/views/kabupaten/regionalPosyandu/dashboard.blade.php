@extends("_partials.master")
@section("title","Dashboard Provinsi")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard" class="btn btn-primary">back</a>
        <hr>
        <h1>Dasboard Data Posyandu</h1>
        <br><br>
        <form>
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Kode Region">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Nama Kampung">
                </div>
                <div class="col">
                    <a href="#" class="btn btn-primary">Cari Data</a>
                    <a href="./tambah" class="btn btn-primary">Tambah Posyandu</a>
                </div>

            </div>
        </form>
        <div class="jumbotron">
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Posyadu</th>
                    <th scope="col">Kampung</th>
                    <th scope="col">Alamat Lengkap</th>
                    <th scope="col">#</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $data)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $data->nama_posyandu }}</td>
                    <td>{{ $data->nama_kampung }}</td>
                    <td>{{ $data->alamat_posyandu }}</td>
                    <td>
                        <a href="./edit/{{ $data->id_posyandu }}" class="btn btn-primary">Edit</a>
                        <a href="#" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>

        </div>


    </div>
@endsection
</html>
