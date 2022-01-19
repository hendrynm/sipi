@extends("_partials.master")
@section("title","Dashboard Data Antigen")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard.html" class="btn btn-primary">Back</a>
        <hr>
        <h1>Dasboard Data Antigen Provinsi</h1>

        <div class="jumbotron">
            <a href="./tambahAtigen.html" class="btn btn-primary">Tambah Data Antigen</a>
            <br>
            <br>

            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Nama Antigen</th>
                    <th scope="col">waktu pemberian</th>
                    <th scope="col">Interval Pemberian</th>
                    <th scope="col">Target Tahunan</th>
                    <th scope="col"></th>


                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">HB0</th>
                    <td>8 bulan</td>
                    <td>24 bulan</td>
                    <td>95%</td>
                    <td>
                        <a href="./editAntigen.html" class="btn btn-primary">Edit</a>
                        <a href="#" class="btn btn-danger">Hapus</a>
                    </td>

                </tr>
                <tr>
                    <th scope="row">HB0</th>
                    <td>8 bulan</td>
                    <td>24 bulan</td>
                    <td>95%</td>
                    <td>
                        <a href="./editAntigen.html" class="btn btn-primary">Edit</a>
                        <a href="#" class="btn btn-danger">Hapus</a>
                    </td>

                </tr>
                <tr>
                    <th scope="row">HB0</th>
                    <td>8 bulan</td>
                    <td>24 bulan</td>
                    <td>95%</td>
                    <td>
                        <a href="./editAntigen.html" class="btn btn-primary">Edit</a>
                        <a href="#" class="btn btn-danger">Hapus</a>
                    </td>

                </tr>
                </tbody>
            </table>
        </div>

    </div>
@endsection
</html>
