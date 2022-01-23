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
                </tbody>
            </table>
        </div>
    </div>
@endsection
</html>

@section("js")
    <script type="text/javascript">
        $(function () {
            var table = $('#sasaranKampung').DataTable({
                processing: true,
                serverSide: true,
                language: { url: "//cdn.datatables.net/plug-ins/1.11.4/i18n/id.json" },
                ajax: "{{ route('prov.sasaran') }}",
                columns: [
                    {data: 'kode_kampung', name: 'nama_posyandu'},
                    {data: 'nama_kampung', name: 'nama_kampung'},
                    {data: 'id_kampung', name:'action',
                        render: function ( data, type, row, meta ) {
                            return '<a href="./detail/' + data + '" class="btn btn-primary">Detail</a>'
                        },
                    }
                ]
            });
        });
    </script>
@endsection
