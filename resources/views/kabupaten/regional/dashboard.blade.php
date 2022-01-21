@extends("_partials.master")
@section("title","Dashboard Regional")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard" class="btn btn-primary">back</a>
        <hr>
        <h1>Dasboard Data Kampung</h1>
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
                    <a href="./tambahData.html" class="btn btn-primary">Tambah kampung</a>
                </div>

            </div>
        </form>
        <div class="jumbotron">
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">kode Region</th>
                    <th scope="col">Nama Kampung</th>
                    <th scope="col">#</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $data)
                <tr>
                    <th scope="row">{{ $data->kode_kampung }}</th>
                    <td>{{ $data->nama_kampung }}</td>
                    <td>
                        <a href="./edit/{{ $data->id_kampung }}" class="btn btn-primary">Edit</a>
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
