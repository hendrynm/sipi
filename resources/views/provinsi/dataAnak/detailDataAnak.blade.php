@extends("_partials.master")
@section("title","Detail Data Anak")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">

        <a href="./dashboard.html" class="btn btn-primary">back</a>
        <hr>
        <h1>Data Anak</h1>
        <br>
        <br>



        <div class="row">
            <div class="col-md-6">
                <h2>Data Personal</h2>
                <table class="table ">
                    <tbody>
                    <tr>
                        <th scope="row">Nama Lengkap :</th>
                        <td>Hendry Marbela</td>
                    </tr>
                    <tr>
                        <th scope="row">Nama Ibu Kandung :</th>
                        <td>Pradnya</td>
                    </tr>
                    <tr>
                        <th scope="row">Tanggal Lahir :</th>
                        <td>27 Oktober 2023</td>
                    </tr>
                    <tr>
                        <th scope="row">Usia :</th>
                        <td>12 Bulan</td>
                    </tr>
                    <tr>
                        <th scope="row">Jenis Kelamin :</th>
                        <td>Laki-Laki</td>
                    </tr>
                    <tr>
                        <th scope="row">No HP :</th>
                        <td>082000000010</td>
                    </tr>
                    <tr>
                        <th scope="row">Kabupaten/Kota Tinggal :</th>
                        <td>Sorong Selatan</td>
                    </tr>
                    <tr>
                        <th scope="row">Alamat Tinggal :</th>
                        <td>Laki-Laki</td>
                    </tr>
                    <tr>
                        <th scope="row">Posyandu :</th>
                        <td>Laki-Laki</td>
                    </tr>

                    <tr>
                        <th scope="row">Ibu Kandung :</th>
                        <td>Pradnya Shita</td>
                    </tr>
                    <tr>
                        <th scope="row">KTP :</th>
                        <td>00023</td>
                    </tr>
                    </tbody>
                </table>

            </div>

        </div>

        <h2>Status Imunisasi</h2>


        <div class="row">
            <div class="col-md-6">
                <table class="table ">
                    <tbody>
                    <tr>
                        <th scope="row">Imunisasi Dasar Lengkap :</th>
                        <td>Sudah terpenuhi</td>
                    </tr>
                    <tr>
                        <th scope="row">Imunisasi Rutin Lengkap :</th>
                        <td>Belum Terpenuhi</td>
                    </tr>

                    <!-- hanya berlaku untuk perempuan -->
                    <tr>
                        <th scope="row">Status T :</th>
                        <td>T1</td>
                    </tr>

                    </tbody>
                </table>

            </div>
        </div>

        <br>
        <br>
        <h2>Data Imunisasi</h2>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Imunisasi</th>
                <th scope="col">Status</th>
                <th scope="col">Tanggal Imunisasi</th>
                <th scope="col">Tempat Imunisasi</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">1</th>
                <td>HB0</td>
                <td>sudah imunisasi</td>
                <td>12/02/2022</td>
                <td>Rumah Sakit Provinsi Papua Barat</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>SDT2</td>
                <td>sudah imunisasi</td>
                <td>14/04/2022</td>
                <td>Posyandu Amban 1</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>CampakS1</td>
                <td>Belum imunisasi</td>
                <td>-</td>
                <td>-</td>
            </tr>
            </tbody>
        </table>




    </div>
@endsection
</html>
