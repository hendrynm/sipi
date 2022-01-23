@extends("_partials.master")
@section("title","Dashboard Provinsi")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard" class="btn btn-primary">back</a>
        <hr>
        <h1>Dasboard data regional</h1>
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
                ajax: "{{ route('kab.sasaran') }}",
                columns: [
                    {data: 'kode_kampung', name: 'kode_kampung'},
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
