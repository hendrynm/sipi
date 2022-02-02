@extends("_partials.master")
@section("title","Dashboard Data Anak")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard" class="btn btn-primary">back</a>
        <hr>
        <h1>Data Individu</h1>
        <br>

        <div class="jumbotron custom-table">
            <table class="table" id="dataIndividu">
                <thead class="thead-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">NIK</th>
                    <th scope="col">Nama Anak</th>
                    <th scope="col">Tanggal Lahir</th>
                    <th scope="col">Usia</th>
                    <th scope="col">Asal Kabupaten/Kota</th>
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
            var table = $('#dataIndividu').DataTable({
                processing: true,
                serverSide: true,
                language: { url: "//cdn.datatables.net/plug-ins/1.11.4/i18n/id.json" },
                ajax: "{{ route('prov.anak') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'nik', name: 'nik'},
                    {data: 'nama_lengkap', name: 'nama_lengkap'},
                    {data: 'tanggal_lahir', name: 'tanggal_lahir'},
                    {data: 'tanggal_lahir', name: 'usia',
                        render: function ( data, type, row, meta ){
                            let tahun = (new Date().getFullYear()) - (new Date(data).getFullYear())
                            let bulan = (new Date().getMonth()) - (new Date(data).getMonth())
                            if(bulan < 0)
                                return (tahun-1) + " tahun " + (bulan+12) + " bulan"
                            else if(bulan === 0)
                                return tahun + " tahun " + bulan + " bulan"
                            else
                                return tahun + " tahun " + (bulan+12) + " bulan"
                        },
                    },
                    {data: 'nama_kabupaten', name: 'nama_kabupaten'},
                    {data: 'id_anak', name:'action',
                        render: function ( data, type, row, meta ) {
                            return '<a href="./detail/' + data + '" class="btn btn-primary">Detail</a>'
                        },
                    }
                ]
            });
        });
    </script>
@endsection
