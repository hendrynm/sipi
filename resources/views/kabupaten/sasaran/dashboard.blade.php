@extends("_partials.master")
@section("title","Dashboard Provinsi")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard" class="btn btn-primary">back</a>
        <hr>
        <h1>Dasboard data regional</h1>
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
                </div>
            </div>
        </form>
        <hr>
        <div class="jumbotron">
            <table class="table" id="sasaranKampung">
                <thead>
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
                        <a href="./detail/{{ $data->id_kampung }}" class="btn btn-primary">Sasaran dan Target</a>
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
            $('#sasaranKampung').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.11.4/i18n/id.json"
                }
            });
        } );
    </script>
@endsection
