@extends("_partials.master")
@section("title","Dashboard Data Posyandu")

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

        <a href="../dashboard" class="btn btn-primary">back</a>
        <hr>
        <h1>Dasboard Data Posyandu</h1>
        <br><br>
        <a href="./tambah" class="btn btn-primary">Tambah Posyandu</a>
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

