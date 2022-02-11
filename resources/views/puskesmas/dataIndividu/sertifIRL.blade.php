@extends("_partials.master-sertif")
@section("title","Cetak Sertifikat")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <div class="row align-items-center">
            <div class="col-2">
                <img class="img-fluid d-block m-auto" src="{{ asset("images/logo-pabar-header.png") }}" width="130"
                     height="130">
            </div>
            <div class="col-8">
                <h1 class="h1-sertif">Surat Keterangan Imunisasi Rutin Lengkap (IRL)</h1>
                <p class="text-center">
                    Jln. Brigjen Marinir Abraham O. Atururi, Komp. Kantor Gubernur Sel., Kabupaten Manokwari, Papua
                    Bar., Anday,
                    Manokwari Sel., Kabupaten Manokwari, Papua Bar. 98315
                </p>
            </div>
            <div class="col-2">

                <img class="img-fluid d-block m-auto" src="{{ asset("images/logo-kemenkes-header.png") }}"
                     width="130" height="130">
            </div>
        </div>
        <hr>

        <h2 class="text-center h2-sertif">No surat :</h2>
        <p class="text-center">{{ date_format(date_create($data->tanggal_irl),"Y/m") }}/ID-{{ $data->id_anak
        }}</p>

        <h2 class="text-center h2-sertif">Surat ini diberikan kepada :</h2>
        <div class="row justify-content-center">
            <div class="col-5">
                <div class="jumbotron jum-sertif">
                    <table class="table table-borderless">
                        <tbody>
                        <tr>
                            <th scope="row">Nama Lengkap :</th>
                            <td>{{ $data->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Tanggal Lahir :</th>
                            <td>{{ $data->tanggal_lahir }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Jenis Kelamin :</th>
                            <td>{{ ($data->jenis_kelamin === "L") ? "Laki-laki" : "Perempuan" }}</td>
                        </tr>
                        <tr>
                            <th scope="row">NIK Anak:</th>
                            <td>{{ $data->nik }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <h2 class="text-center h2-sertif">Pada Tanggal :</h2>
        <div class="row justify-content-center">
            <div class="col-5">
                <div class="jumbotron jum-sertif-tanggal">
                    <p class="text-center">{{ date_format(date_create($data->tanggal_irl),"d-m-Y") }}</p>
                </div>
            </div>
        </div>



        <h2 class="text-center h2-sertif-telah">Telah melakukan imunisasi rutin lengkap</h2>
        <hr>


        <h2 class="text-center h2-sertif">Data Imunisasi :</h2>
        <div class="row">
            <div class="col-12">
                <div class="jumbotron jum-sertif">

                    <table class="table table-borderless">
                        <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Imunisasi</th>
                            <th scope="col">Tanggal Imunisasi</th>
                            <th scope="col">Tempat Imunisasi</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data2 as $data2)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $data2->nama_antigen }}</td>
                            <td>{{ $data2->tanggal_pemberian }}</td>
                            <td>{{ $data2->tempat_imunisasi }}</td>
                            <td>{{ $data2->status }} imunisasi</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
</html>
