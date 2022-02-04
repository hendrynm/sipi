@extends("_partials.master")
@section("title","Dashboard Data Kampung")

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
        <h1>Dasboard Data Kampung</h1>
        <br><br>
        <a href="./tambah" class="btn btn-primary">Tambah kampung</a>

        <div class="jumbotron">
            <table class="table" id="dataKampung">
                <thead class="thead-light">
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
            var table = $('#dataKampung').DataTable({
                processing: true,
                serverSide: true,
                language: { url: "//cdn.datatables.net/plug-ins/1.11.4/i18n/id.json" },
                ajax: "{{ route('pus.kampung') }}",
                columns: [
                    {data: 'kode_kampung', name: 'kode_kampung'},
                    {data: 'nama_kampung', name: 'nama_kampung'},
                    {data: 'id_kampung', name:'action',
                        render: function ( data, type, row, meta ) {
                            return '<a href="./edit/' + data + '" class="btn btn-primary">Edit</a> <a href="' +
                                './sasaran/' + data + '" class="btn btn-primary">Sasaran</a>'
                        },
                    }
                ]
            });
        });
    </script>
@endsection
