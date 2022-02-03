{{--http://localhost:8080/project_sipi/idl-kampung.php
--}}

@extends("_partials.master")
@section("title","Laporan Bulanan")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container-fluid t">
        <a href="./dashboard" class="btn btn-primary">Back</a>
        <hr>
        <h1>laporan Bulanan</h1>
        <div >


            <?php
            $queryArrays = [$query]
            ?>

            @for($i = 0; $i < count($queryArrays); $i++)
                <table class="table laporan-bulanan" id="table{{$i}}">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kabupaten</th>
                        <th scope="col">Puskemas</th>
                        <th scope="col">Kampung</th>
                        <th scope="col">Sasaran bayi L</th>
                        <th scope="col">Sasaran bayi P</th>
                        <th scope="col">Sasaran Total Bayi</th>
                        <th scope="col">Jumlah L</th>
                        <th scope="col">% Jumlah L</th>
                        <th scope="col">Jumlah P</th>
                        <th scope="col">% Jumlah P</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">% Jumlah Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($queryArrays[$i] as $data)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $data->kabupaten }}</td>
                            <td>{{ $data->puskesmas }}</td>
                            <td>{{ $data->kampung }}</td>
                            <td>{{ $data->sasaran_bayi_lahir_L }}</td>
                            <td>{{ $data->sasaran_bayi_lahir_P }}</td>
                            <td>{{ $data->total_sasaran_bayi_lahir }}</td>

                            <td>{{ $data->jumlahL }}</td>
                            <td>{{ $data->persen_jumlahL }}</td>

                            <td>{{ $data->jumlahP }}</td>
                            <td>{{ $data->persen_jumlahP }}</td>

                            <td>{{ $data->jumlah }}</td>
                            <td>{{ $data->persen_jumlah }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <br>
                <br>
                <hr>
            @endfor
        </div>
    </div>
@endsection
</html>
