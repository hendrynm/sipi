@extends("_partials.master")
@section("title","Dashboard Data Puskesmas")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">

            {{-- alert hijau --}}
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{-- isi pesan disini --}}
        Isi pesan alert
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>


    {{-- alert merah --}}
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
         {{-- isi pesan disini --}}
         Isi pesan alert
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>

        <a href="../dashboard" class="btn btn-primary">back</a>
        <hr>
        <h1>Dasboard Data Puskesmas</h1>
        <br><br>
        <a href="./tambah" class="btn btn-primary">Tambah Puskesmas</a>

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
                </tbody>
            </table>
        </div>
    </div>
@endsection
</html>

@section("js")
    <script type="text/javascript">
        $(function () {
            var table = $('#dataPuskesmas').DataTable({
                processing: true,
                serverSide: true,
                language: { url: "//cdn.datatables.net/plug-ins/1.11.4/i18n/id.json" },
                ajax: "{{ route('prov.puskesmas') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'kode_puskesmas', name: 'kode_puskesmas'},
                    {data: 'nama_puskesmas', name: 'nama_puskesmas'},
                    {data: 'nama_kabupaten', name: 'nama_kabupaten'},
                    {data: 'id_puskesmas', name:'action',
                        render: function ( data, type, row, meta ) {
                            return '<a href="./edit/' + data + '" class="btn btn-primary">Edit</a>'
                        },
                    }
                ]
            });
        });
    </script>
@endsection
