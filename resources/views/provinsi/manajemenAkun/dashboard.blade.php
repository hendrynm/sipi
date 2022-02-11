@extends("_partials.master")
@section("title","Dashboard Manajemen Akun")

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

        <a href="../dashboard" class="btn btn-primary">back</a>
        <hr>
        <h1>Dashboard Manajemen Akun </h1>


        <div class="jumbotron">
            <h2>Akun Level 1 : Provinsi Papua barat</h2>
            <p>

            </p>
            <a href="./edit/1" class="btn btn-primary">Edit Akun Utama</a>
            <a href="./ganti-pass/1" class="btn btn-primary">Ganti Password</a>
            <a href="./tambah" class="btn btn-primary">Tambah Akun</a>

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
        <div class="jumbotron">
            <table class="table" id="dataUser">
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
                @foreach($data as $data)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $data->username }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->email }}</td>
                    <td>Level {{ $data->level }}</td>
                    <td>
                        <a href="./edit/{{ $data->id_user }}" class="btn btn-primary">Edit</a>
                        <a href="./ganti-pass/{{ $data->id_user }}" class="btn btn-primary">Ganti Password</a>
                        <a href="./hapus/{{ $data->id_user }}" onclick="return confirm('Hapus data ini?')" class="btn btn-danger">Hapus</a>
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
            $('#dataUser').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.11.4/i18n/id.json"
                }
            });
        } );
    </script>
@endsection
