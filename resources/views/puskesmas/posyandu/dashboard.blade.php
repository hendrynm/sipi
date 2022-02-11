@extends("_partials.master")
@section("title","Dashboard Posyandu")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container main-dashboard2">
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

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <a href="../dashboard" class="btn btn-primary">back</a>
        <h1>Posyandu</h1>
        <br>
        <hr>
        {{-- <div class="jumbotron">
            <h2>Notifikasi Imunisasi</h2>
            <a href="./notifikasi" class="btn btn-primary">Kirim Notifikasi Posyandu</a>
        </div> --}}
{{--        <div class="jumbotron">--}}
{{--            <h2>Data anak belum Imunisasi</h2>--}}
{{--            <a href="./belum" class="btn btn-primary">Cek data anak belum Imunisasi</a>--}}
{{--        </div>--}}

        <div class="jumbotron">
            <h2>Laporan Status Imunisasi Per Antigen</h2>
            <div class="row justify-content-center">
                <div class="col-md-6 mb-3">
                    <form action="./laporan/cari" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="antigen">Antigen :</label>
                            <select class="form-control custom-select" id="antigen" name="antigen"
                                    data-show-subtext="true" data-live-search="true" required>
                                <option selected disabled value="">Pilih antigen</option>
                                @foreach($data2 as $data2)
                                    <option value="{{ $data2->id_antigen }}">{{ $data2->nama_antigen }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-primary" type="submit">Tampikan Data</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="jumbotron">
            <h2>Data Anak Belum Imunisasi Per Posyandu</h2>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="./belum/cari" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="posyandu">Posyandu :</label>
                            <select class="form-control custom-select" id="posyandu" name="posyandu"
                                    data-show-subtext="true" data-live-search="true" required>
                                <option selected disabled value="">Pilih Posyandu</option>
                                @foreach($data as $data1)
                                    <option value="{{ $data1->id_posyandu }}">{{ $data1->nama_posyandu }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-primary">Tampilkan Data</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="jumbotron">
            <h2>Mulai Data Entri Imunisasi</h2>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="./pilih" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="posyandu">Posyandu :</label>
                            <select class="form-control custom-select" id="posyandu" name="posyandu"
                                    data-show-subtext="true" data-live-search="true" required>
                                <option selected disabled value="">Pilih Posyandu</option>
                                @foreach($data as $data)
                                    <option value="{{ $data->id_posyandu }}">{{ $data->nama_posyandu }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-primary">Mulai Posyandu</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="jumbotron">
            <h2>Entri Posyandu Offline</h2>
            <p>
                file yang diupload hanya dapat dientri oleh puskesmas yang sama
            </p>
            <a href="{{route('unduh.format')}}" class="btn btn-primary">Unduh Format Excel</a>
            <a href="{{route('unduh.data.all')}}" class="btn btn-primary">Unduh Data Id Anak, Id Antigen, Id Posyandu</a>
            <form action="{{route('update.excel')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="excelFile">Masukan File format .xlsx</label>
                  <input required type="file" class="form-control-file" id="excelFile" name="excelFile" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                </div>
                <x-submit-button-form></x-submit-button-form>
              </form>
              <br>
              <br>
        </div>
        <hr>
    </div>
@endsection
</html>

@section("js")
    <script>
        $(function() {
            $('.custom-select').selectpicker();
        });
    </script>
@endsection
