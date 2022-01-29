@extends("_partials.master")
@section("title","Data Anak Belum Imunisasi")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="." class="btn btn-primary">back</a>

        <h1>Data Anak Belum Imunisasi</h1>
        <br>
        <a href="./belum-imunisasi/cetak" class="btn btn-primary">Print Data</a>
        <br>
        <br>
        <br>

        <!-- primitif -->
        <table class="table">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Anak</th>
                <th scope="col">Usia</th>
                <th scope="col">Belum Imunisasi</th>
                <th scope="col">Alamat</th>
                <th scope="col">No HP</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection
</html>

@section("js")
    <script type="text/javascript">
        $(function () {
            let path = window.location.pathname.split("/");
            var table = $('#dataIndividu').DataTable({
                processing: true,
                serverSide: true,
                language: { url: "//cdn.datatables.net/plug-ins/1.11.4/i18n/id.json" },
                ajax: "{{ route('pus.belum'}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'nama_lengkap', name: 'nama_lengkap'},
                    {data: 'tanggal_lahir', name: 'usia',
                        render: function ( data, type, row, meta ){
                            let tahun = (new Date().getFullYear()) - (new Date(data).getFullYear());
                            let bulan = (new Date().getMonth()) - (new Date(data).getMonth());
                            if(bulan < 0)
                                return (tahun-1) + " tahun " + (bulan+12) + " bulan";
                            else if(bulan === 0)
                                return tahun + " tahun " + bulan + " bulan";
                            else
                                return tahun + " tahun " + (bulan+12) + " bulan";
                        },
                    },
                    {data: 'nama_lengkap', name: 'belum_imunisasi'},
                    {data: 'alamat', name: 'alamat'},
                    {data: 'no_hp', name: 'no_hp'},
                ]
            });
        });
    </script>
@endsection
