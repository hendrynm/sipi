@extends("_partials.master")
@section("title","Dashboard Kampung")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard" class="btn btn-primary">back</a>
        <hr>
        <h1>Dasboard Data Kabupaten</h1>
        <br><br>
        <form>
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Kode Region">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Nama Kabupaten">
                </div>
                <div class="col">
                    <a href="#" class="btn btn-primary">Cari Data</a>
                    <a href="./tambah" class="btn btn-primary">Tambah Kabupaten</a>
                </div>

            </div>
        </form>
        <div class="jumbotron">
            <table class="table" id="dataKabupaten">
                <thead class="thead-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode Regional</th>
                    <th scope="col">Nama Kabupaten</th>
                    <th scope="col">#</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $data)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $data->kode_kabupaten }}</td>
                    <td>{{ $data->nama_kabupaten }}</td>
                    <td>
                        <a href="./edit/{{ $data->id_kabupaten }}" class="btn btn-primary">Edit</a>
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
            $('#dataKabupaten').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.11.4/i18n/id.json"
                }
            });
        } );
    </script>
@endsection
