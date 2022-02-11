@extends("_partials.master")
@section("title","Data Anak Belum Imunisasi")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard" class="btn btn-primary">back</a>

        <h1>Data Anak Belum Imunisasi - <span class="nama"></span></h1>
        <br>

        <table class="table" id="belumImunisasi">
            <thead>
            <tr>
                <th scope="col" data-priority="1">No</th>
                <th scope="col" data-priority="2">Nama Anak</th>
                <th scope="col">Usia</th>
                <th scope="col">Alamat</th>
                <th scope="col">No HP</th>
                <th scope="col" data-priority="3">Belum Imunisasi</th>
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
        $.ajax({
            url: window.location.href + "/nama",
            dataType: 'json',
            cache: false,
            success: function(data) {
                $(".nama").append(data.nama_posyandu);
                let nama = data.nama_posyandu;

                $(function () {
                    var table = $('#belumImunisasi').DataTable({
                        processing: true,
                        serverSide: true,
                        responsive: true,
                        language: { url: "//cdn.datatables.net/plug-ins/1.11.4/i18n/id.json" },
                        ajax: window.location.href,
                        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]],
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
                            {data: 'alamat', name: 'alamat'},
                            {data: 'no_hp', name: 'no_hp'},
                            {data: 'nama_antigen', name: 'nama_antigen',
                                render: function (data, type, row, meta ){
                                    return data.split(", ").join(", <br/>");
                                }
                            }
                        ],
                        dom: 'Bfrtip',
                        buttons: {
                            buttons: [
                                {
                                    extend: 'print',
                                    autoPrint: true,
                                    title: 'Data Anak Belum Imunisasi - ' + nama,
                                    customize: function ( win ) {
                                        $(win.document.body).find( 'table' )
                                            .addClass( 'compact' )
                                            .css( 'font-size', 'inherit' )
                                    }
                                },
                                'pageLength'
                            ]
                        }
                    });
                });
            }
        });
    </script>
@endsection
