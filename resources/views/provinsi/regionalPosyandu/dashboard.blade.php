@extends("_partials.master")
@section("title","Dashboard Provinsi")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard.html" class="btn btn-primary">back</a>
        <hr>
        <h1>Dasboard Data Posyandu</h1>
        <br><br>



        <form>
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Kode Region">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Nama Kampung">
                </div>
                <div class="col">
                    <a href="#" class="btn btn-primary">Cari Data</a>
                    <a href="./tambahData.html" class="btn btn-primary">Tambah Posyandu</a>
                </div>

            </div>
        </form>
        <div class="jumbotron">
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Posyadu</th>
                    <th scope="col">Kampung</th>
                    <th scope="col">Alamat Lengkap</th>
                    <th scope="col">#</th>



                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>pandayani</td>
                    <td>Jawa</td>
                    <td>Jl. cendrawasi 20, G 5, amban timur, manokwari barat</td>
                    <td>
                        <a href="./editData.html" class="btn btn-primary">Edit</a>
                        <a href="#" class="btn btn-danger">Hapus</a>
                    </td>

                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>pandayani</td>
                    <td>Jawa</td>
                    <td>Jl. cendrawasi 20, G 5, amban timur, manokwari barat</td>
                    <td>
                        <a href="./editData.html" class="btn btn-primary">Edit</a>
                        <a href="#" class="btn btn-danger">Hapus</a>
                    </td>

                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>pandayani</td>
                    <td>Jawa</td>
                    <td>Jl. cendrawasi 20, G 5, amban timur, manokwari barat</td>
                    <td>
                        <a href="./editData.html" class="btn btn-primary">Edit</a>
                        <a href="#" class="btn btn-danger">Hapus</a>
                    </td>

                </tr>
                </tbody>
            </table>

        </div>


    </div>
@endsection
</html>
