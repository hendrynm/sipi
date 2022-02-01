@extends("_partials.master")
@section("title","Data Anak Belum Imunisasi")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="./dashboard" class="btn btn-primary">back</a>

        <h1>Data Anak Belum Imunisasi</h1>
        <table class="table" id="posyandu">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Posyandu</th>
                <th scope="col">#</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Semua posyandu</td>
                <td><a href="./belum/-1" class="btn btn-primary">Cari</a></td>
            </tr>
            @foreach($data2 as $data2)
                <tr>
                    <th scope="row">{{ $loop->iteration+1 }}</th>
                    <td>{{ $data2->nama_posyandu }}</td>
                    <td><a href="./belum/{{ $data2->id_posyandu }}" class="btn btn-primary">Cari</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <br>
        <br>
        <br>
    </div>
@endsection
</html>

@section("js")
    <script>
        $(document).ready( function () {
            $('#posyandu').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.11.4/i18n/id.json"
                }
            });
        } );
    </script>
@endsection
