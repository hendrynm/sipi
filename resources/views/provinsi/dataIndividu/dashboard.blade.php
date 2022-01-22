@extends("_partials.master")
@section("title","Dashboard Data Anak")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard" class="btn btn-primary">back</a>
        <hr>
        <h1>Data Induvidu</h1>
        <br>

        <form>
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Nama Anak">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="NIK">
                </div>
                <div class="col">
                    <a href="#" class="btn btn-primary">Cari Data</a>
                </div>
            </div>
        </form>

        <!-- primitif -->
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
                @foreach($data1 as $data)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $data->nik }}</td>
                    <td>{{ $data->nama_lengkap }}</td>
                    <td>{{ $data->tanggal_lahir }}</td>
                    <td>{{ $data->tanggal_lahir }} bulan</td>
                    <td>{{ $data->nama_kabupaten }}</td>
                    <td>
                        <a href="./detail/{{ $data->id_anak }}" class="btn btn-primary">Detail</a>
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
        $('#dataIndividu').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.11.4/i18n/id.json"
            }
        });
    } );
</script>
@endsection
