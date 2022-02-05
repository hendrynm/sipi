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
        <form>
            <div class="form-row">
                <div class="col">
                    <a href="./tambah" class="btn btn-primary">Tambah Posyandu</a>
                </div>
            </div>
        </form>
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
                </tbody>
            </table>
        </div>
    </div>
@endsection
</html>

@section("js")
    <script type="text/javascript">
        $(function () {
            var table = $('#dataPosyandu').DataTable({
                processing: true,
                serverSide: true,
                language: { url: "//cdn.datatables.net/plug-ins/1.11.4/i18n/id.json" },
                ajax: "{{ route('prov.posyandu') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    {data: 'nama_posyandu', name: 'nama_posyandu'},
                    {data: 'nama_kampung', name: 'nama_kampung'},
                    {data: 'alamat_posyandu', name: 'alamat_posyandu'},
                    {data: 'id_posyandu', name:'action',
                        render: function ( data, type, row, meta ) {
                            return '<a href="./edit/' + data + '" class="btn btn-primary">Edit</a>'
                        },
                    }
                ]
            });
        });
    </script>
@endsection
