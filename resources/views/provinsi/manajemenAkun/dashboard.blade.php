@extends("_partials.master")
@section("title","Dashboard Manajemen Akun")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard.html" class="btn btn-primary">back</a>
        <hr>
        <h1>Dashboard Majemen Akun </h1>


        <div class="jumbotron">
            <h2>Akun Level 1 : Provinsi Papua barat</h2>
            <p>

            </p>
            <a href="./editAkun.html" class="btn btn-primary">Edit Akun Utama</a>
            <a href="./gantiPassword.html" class="btn btn-primary">Ganti Password</a>
            <a href="./tambahAkun.html" class="btn btn-primary">Tambah Akun</a>

            <hr>
            <h3>Panduan akses level</h3>
            <p>akses level digunakan untuk mitigasi risiko kemanan data dan fitur pada aplikasi Pelaporan Imunisasi
                Provinsi Papua Barat. Admin wajib mengetahui jenis akses level pada aplikasi di
                bawah ini.

            </p>

            <table class="table">
                <thead>
                <tr>

                    <th scope="col">Level </th>
                    <th scope="col">Pemilik</th>
                    <th scope="col">Akses</th>

                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Provinsi Papua Barat</td>
                    <td>
                        <ul>
                            <li>Melihat Laporan imunisasi skala Provinsi</li>
                            <li>Melihat Laporan imunisasi skala kabupaten dan kota</li>
                            <li>Melihat Laporan imunisasi skala pukesmas</li>
                            <li>Melihat Laporan imunisasi skala kampung</li>
                            <li>Melihat data anak induvidu</li>
                            <li>Menambah antigen baru</li>
                            <li>menajamen akun level 1, 2, 3, dan 4</li>

                        </ul>
                    </td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Kabupaten dan Kota</td>
                    <td>
                        <ul>

                            <li>Melihat Laporan imunisasi skala kabupaten dan kota</li>
                            <li>Melihat Laporan imunisasi skala pukesmas</li>
                            <li>Melihat Laporan imunisasi skala kampung</li>
                            <li>Melihat data anak induvidu</li>
                            <li>menajamen akun level 2, 3, dan 4</li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Pukesmas</td>
                    <td>
                        <ul>

                            <li>Melakukan Edit pada data anak</li>
                            <li>Melakukan penambahan data anak dan bayi</li>
                            <li>Melakukan notifikasi posyandu</li>
                            <li>Memulai data entri untuk posyandu</li>
                            <li>menajamen akun akun level 3 dan 4</li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td> <b>External</b> : Rumah Sakit, Klinik Swasta dan Bidan Desa</td>
                    <td>
                        <ul>
                            <li>Melakukan penambahan data anak dan bayi</li>
                            <li>Melakukan imunisasi terbatas</li>
                        </ul>

                    </td>

                </tr>
                </tbody>
            </table>

        </div>


        <h2>Data Akun Terdaftar</h2>
        <form>
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Username">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Nama">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Email">
                </div>
                <div class="col">
                    <a href="#" class="btn btn-primary">Cari Data</a>
                </div>

            </div>
        </form>
        <div class="jumbotron">
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Username</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Access Level</th>
                    <th scope="col">#</th>

                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>pandayani</td>
                    <td>Pukermas Andayani</td>
                    <td>pukesmas.adayani@gmail.com</td>
                    <td>level 3</td>
                    <td>
                        <a href="./editAkun.html" class="btn btn-primary">Edit</a>
                        <a href="./gantiPassword.html" class="btn btn-primary">Ganti Password</a>
                        <a href="#" class="btn btn-danger">Hapus</a>
                    </td>

                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>rsdrsoetomo1</td>
                    <td>Pukesmas soetomo</td>
                    <td>rs.soetomo@gmail.com</td>
                    <td>level 3</td>
                    <td>
                        <a href="./editAkun.html" class="btn btn-primary">Edit</a>
                        <a href="./gantiPassword.html" class="btn btn-primary">Ganti Password</a>
                        <a href="#" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>UtamiMG</td>
                    <td>Pukesmas Mangaprow</td>
                    <td>utami.gm@gmail.com</td>
                    <td>level 3</td>
                    <td>
                        <a href="./editAkun.html" class="btn btn-primary">Edit</a>
                        <a href="./gantiPassword.html" class="btn btn-primary">Ganti Password</a>
                        <a href="#" class="btn btn-danger">Hapus</a>
                    </td>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>


        <nav aria-label="...">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <span class="page-link">Previous</span>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item active" aria-current="page">
                    <span class="page-link">2</span>
                </li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>



    </div>
@endsection
</html>
