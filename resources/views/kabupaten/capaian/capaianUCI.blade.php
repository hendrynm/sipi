@extends("_partials.master")
@section("title","Capaian Per Kabupaten/Kota")
<?php $quarters = [1, 2, 3, 4] ?>
<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="./dashboard" class="btn btn-primary">Back</a>
        <hr>
        <h1>Laporan Desa UCI</h1>
        <div class="jumbotron">
            <form method="get">
                <x-kabupaten-form :kabupatenForm="$kabupatenForm" :kabupatens="$kabupatens"></x-kabupaten-form>
                <x-year-form :tahunForm="$tahunForm"></x-year-form>
                <x-submit-button-form></x-submit-button-form>
            </form>
        </div>
        @foreach($quarters as $quarter)
        <h2>Laporan Quarter {{$quarter}}</h2>
        <div class="jumbotron custom-table">
            <table class="table" id="quarter{{$quarter}}">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Kabupaten</th>
                    <th scope="col">Puskesmas</th>
                    <th scope="col">Kampung</th>
                    <th scope="col">IDL</th>
                    <th scope="col">Sasaran</th>
                    <th scope="col">Ketercapaian</th>
                    <th scope="col">UCI</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        @endforeach
    </div>
@endsection
</html>

@section("js")
    @foreach($quarters as $quarter)
    <script type="text/javascript">
        $(function () {
            $('#quarter{{$quarter}}').DataTable({
                processing: true,
                serverSide: true,
                language: { url: "//cdn.datatables.net/plug-ins/1.11.4/i18n/id.json" },
                ajax: "{{ route('data-ajax.uci.kabupaten', ['year'=> $tahunForm, 'kabupaten'=>$kabupatenForm, 'quarter'=>$quarter]) }}",
                columns: [
                    { data: 'kabupaten', name: 'kabupaten' },
                    { data: 'puskesmas', name: 'puskesmas' },
                    { data: 'kampung', name: 'kampung' },
                    { data: 'idl', name: 'idl' },
                    { data: 'sasaran', name: 'sasaran' },
                    { data: 'ketercapaian', name: 'ketercapaian' },
                    { data: 'uci', name: 'uci' }
                ]
            });
        });
    </script>
    @endforeach
@endsection
