@extends("_partials.master")
@section("title","Dashboard Posyandu")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard" class="btn btn-primary">back</a>
        <h1>Posyandu</h1>
        <br>
        <hr>
        <div class="jumbotron">
            <h2>Notifikasi Imunisasi</h2>
            <a href="./notifikasi" class="btn btn-primary">Kirim Notifikasi Posyandu</a>
        </div>
        <div class="jumbotron">
            <h2>Data anak belum Imunisasi</h2>
            <a href="./belum-imunisasi" class="btn btn-primary">Cek data anak belum Imunisasi</a>
        </div>

        <div class="jumbotron">
            <h2>Mulai Data Entri Imunisasi</h2>
            <br>
            <br>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="./pilih" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="posyandu">Posyandu :</label>
                            <select class="custom-select" id="posyandu">
                                <option selected disabled>Pilih Posyandu</option>
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
        <hr>
    </div>
@endsection
</html>
