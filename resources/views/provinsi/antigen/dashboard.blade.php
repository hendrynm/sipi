@extends("_partials.master")
@section("title","Dashboard Data Antigen")

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

        <a href=".." class="btn btn-primary">Back</a>
        <hr>
        <h1>Dasboard Data Antigen</h1>

        <div class="jumbotron">
            <a href="./tambah" class="btn btn-primary">Tambah Data Antigen</a>
            <br>
            <br>
            <table class="table" id="dataAntigen">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Nama Antigen</th>
                    <th scope="col">waktu pemberian</th>
                    <th scope="col">Interval Pemberian</th>
                    <th scope="col">Target Tahunan</th>
                    <th scope="col">#</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $data)
                    <tr>
                        <th scope="row">{{ $data->nama_antigen }}</th>
                        <td>{{ $data->waktu_pemberian }} bulan</td>
                        <td>{{ $data->interval_pemberian }} bulan</td>
                        <td>{{ $data->target_tahunan }}%</td>
                        <td>
                            <a href="./edit/{{ $data->id_antigen }}" class="btn btn-primary">Edit</a>
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
            $('#dataAntigen').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.11.4/i18n/id.json"
                }
            });
        } );
    </script>
@endsection
