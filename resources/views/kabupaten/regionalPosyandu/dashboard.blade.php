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
        <div class="form-row">
            <div class="col">
                <a href="./tambah" class="btn btn-primary">Tambah Posyandu</a>
            </div>
        </div>
        <div class="jumbotron">
            <table class="table" id="dataPosyandu">
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
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
</html>

@section("js")
    <script>
        $(document).ready( function () {
            $('#dataPosyandu').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.11.4/i18n/id.json"
                }
            });
        } );
    </script>
@endsection

