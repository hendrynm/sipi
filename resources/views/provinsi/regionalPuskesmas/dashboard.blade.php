@extends("_partials.master")
@section("title","Dashboard Provinsi")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard" class="btn btn-primary">back</a>
        <hr>
        <h1>Dasboard Data Puskesmas</h1>
        <br><br>
        <form>
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Kode Puskesmas">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Nama Puskesmas">
                </div>
                <div class="col">
                    <select class="custom-select" id="kabupaten">
                        <option selected>Kabupaten</option>
                        <option value="1">manokwari</option>
                        <option value="2">Sorong</option>
                        <option value="3">Pegunungan Arfak</option>
                    </select>
                </div>
                <div class="col">
                    <a href="#" class="btn btn-primary">Cari Data</a>
                    <a href="./tambah" class="btn btn-primary">Tambah Puskesmas</a>
                </div>

            </div>
        </form>
        <div class="jumbotron">
            <table class="table" id="dataPuskesmas">
                <thead class="thead-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode Puskesmas</th>
                    <th scope="col">Nama Puskesmas</th>
                    <th scope="col">Kabupaten</th>
                    <th scope="col">#</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $data)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $data->kode_puskesmas }}</td>
                    <td>{{ $data->nama_puskesmas }}</td>
                    <td>{{ $data->nama_kabupaten }}</td>
                    <td>
                        <a href="./edit/{{ $data->id_puskesmas }}" class="btn btn-primary">Edit</a>
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
            $('#dataPuskesmas').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.11.4/i18n/id.json"
                }
            });
        } );
    </script>
@endsection
