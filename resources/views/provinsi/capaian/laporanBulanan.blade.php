{{--http://localhost:8080/project_sipi/idl-kampung.php
--}}

@extends("_partials.master")
@section("title","Laporan Bulanan")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container-fluid t2">
        <a href="../dashboard" class="btn btn-primary">Back</a>
        <hr>
        <h1>laporan Bulanan</h1>
        <div>

            {{-- help buatin form ini thx --}}
            <div class="row">
                <div class="col-md-5">
                    <form action="./laporanBulanan" method="get">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="tahunForm">Tahun</label>
                            <input type="text" class="form-control" id="tahunForm" name="tahunForm">
                        </div>
                        <div class="form-group">
                            <label for="kabupatenForm">Kabupaten</label>
                            <input type="text" class="form-control" id="kabupatenForm" name="kabupatenForm">
                        </div>
                        <div class="form-group">
                            <label for="puskesmasForm">Puskesmas</label>
                            <input type="text" class="form-control" id="puskesmasForm" name="puskesmasForm">
                        </div>
        
        
                        <button class="btn btn-primary">Submit</button>
                    </form>
        
                </div>
            </div>
            



            <?php
            $queryArrays = [$query, $query1, $query2, $query3, $query4, $query5, $query6, $query7, $query8, $query9, $query10, $query11]
            ?>

            @for($i = 0; $i < count($queryArrays); $i++)

            {{-- ini untuk header --}}
                @switch($i)
                    @case(0)
                        <h2 class="laporan-bulanan-heading">Januari</h2>
                        @break
                    @case(1)
                        <h2 class="laporan-bulanan-heading">Februari</h2>
                        @break
                    @case(2)
                        <h2 class="laporan-bulanan-heading">Maret</h2>
                        @break
                    @case(3)
                        <h2 class="laporan-bulanan-heading">April</h2>
                        @break
                    @case(4)
                        <h2 class="laporan-bulanan-heading">Mei</h2>
                        @break
                    @case(5)
                        <h2 class="laporan-bulanan-heading">Juni</h2>
                        @break
                    @case(6)
                        <h2 class="laporan-bulanan-heading">Juli</h2>
                        @break
                    @case(7)
                        <h2 class="laporan-bulanan-heading">Agustus</h2>
                        @break
                    @case(8)
                        <h2 class="laporan-bulanan-heading">September</h2>
                        @break
                    @case(9)
                        <h2 class="laporan-bulanan-heading">Oktober</h2>
                        @break
                    @case(10)
                        <h2 class="laporan-bulanan-heading">November</h2>
                        @break
                    @case(11)
                        <h2 class="laporan-bulanan-heading">Desember</h2>
                        @break
                    @default
                        -
                @endswitch
                

               
                <div class="row justify-content-start">
                    <div class="col-5 no-padding-border">
                        <table class="table table-borderless laporan-bulanan1" id="table{{$i}}">
                            <thead class="thead-light">
        
                                <tr>
                                    <th scope="col" rowspan="2" class="align-middle">No</th>
                                    <th scope="col" rowspan="2" class="align-middle">Kabupaten</th>
                                    <th scope="col" rowspan="2" class="align-middle">Puskemas</th>
                                    <th scope="col" rowspan="2" class="align-middle">Kampung</th>
                                    <th scope="col" class="align-middle hilang">.</th>
        
                            
        
                
                                </tr> 
                                <tr>
                                    <th scope="col" class="align-middle hilang">.</th>
                                    {{-- <th scope="col" class="align-middle">Kabupaten</th> --}}
                                    {{-- <th scope="col" class="align-middle">Puskemas</th>
                                    <th scope="col" class="align-middle">Kampung</th> --}}
        
                            
        
                
                                </tr> 

                            </thead>
                            <tbody>
                            @foreach($queryArrays[$i] as $data)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
        
                                    {{-- data regional --}}
                                    <td>{{ $data->kabupaten }}</td>
                                    <td>{{ $data->puskesmas }}</td>
                                    <td>{{ $data->kampung }}</td>
        
        
                                    
        
        
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-7 no-padding">
                        <table class="table table-borderless laporan-bulanan" id="table{{$i}}">
                            <thead class="thead-light">
        
                                <tr>
                                    {{-- <th scope="col" rowspan="2" class="align-middle">No</th>
                                    <th scope="col" rowspan="2" class="align-middle">Kabupaten</th>
                                    <th scope="col" rowspan="2" class="align-middle">Puskemas</th>
                                    <th scope="col" rowspan="2" class="align-middle">Kampung</th> --}}
        
                                    {{-- bayi baru lahir --}}
        
                                    <th scope="col" colspan="3" class="align-middle">Sasaran Bayi Baru Lahir</th>
                                   
        
                                    {{-- antigen 1 --}}
                                    <th scope="col" colspan="6" class="tabel-antigen">HBO</th>
                                   
        
                                    {{-- antigen 2 --}}
                                    <th scope="col" colspan="6" class="tabel-antigen">BCG</th>
        
                                    {{-- antigen 3 --}}
                                    <th scope="col" colspan="6" class="tabel-antigen">OPV1</th>
        
                                    {{-- si --}}
                                    <th scope="col" colspan="3" class="align-middle">Sasaran SI</th>
                                    
        
                                    {{-- antigen 4 --}}
                                    <th scope="col" colspan="6" class="tabel-antigen">DPT/HepB/Hib1</th>
                                    
                                    {{-- antigen 5 --}}
                                    <th scope="col" colspan="6" class="tabel-antigen">OPV2</th>
        
                                    {{-- antigen 6 --}}
                                    <th scope="col" colspan="6" class="tabel-antigen">OPV2</th>
        
                                    {{-- antigen 7 --}}
                                    <th scope="col" colspan="6" class="tabel-antigen">OPV3</th>
        
                                    {{-- antigen 8 --}}
                                    <th scope="col" colspan="6" class="tabel-antigen">DPT/HepB/Hib3</th>
                                    
                                    {{-- antigen 9 --}}
                                    <th scope="col" colspan="6" class="tabel-antigen">OPV4</th>
                                    
                                    {{-- antigen 10 --}}
                                    <th scope="col" colspan="6" class="tabel-antigen">IPV</th>
                                    {{-- antigen 11 --}}
                                    <th scope="col" colspan="6" class="tabel-antigen">MR</th>
                                    
                                    {{-- Baduta --}}
                                    <th scope="col" colspan="3" class="align-middle">Sasaran Baduta</th>
                        
        
                                    {{-- antigen 12 --}}
                                    <th scope="col" colspan="6" class="tabel-antigen">DPT/HepB/Hib4</th>
        
                                    {{-- antigen 13 --}}
                                    <th scope="col" colspan="6" class="tabel-antigen">MR2</th>
                                    
        
                                    {{-- SD 1 --}}
                                    <th scope="col" colspan="3" class="align-middle">SD Kelas 1</th>
                                    
        
                                    {{-- antigen 14 --}}
                                    <th scope="col" colspan="6" class="tabel-antigen">DT</th>
        
                                     {{-- antigen 15 --}}
                                     <th scope="col" colspan="6" class="tabel-antigen">MR (Kelas 1)</th>
        
                                     
        
                                     {{-- SD 2 --}}
                                     <th scope="col" colspan="3" class="align-middle">SD Kelas 2</th>
                                     
        
                                      {{-- antigen 16 --}}
                                      <th scope="col" colspan="6" class="tabel-antigen">Td (Kelas 2)</th>
         
                                    
        
                                    {{-- SD 5 --}}
                                    <th scope="col" colspan="3" class="align-middle">Sasaran SD Kelas 5</th>
        
                                    {{-- antigen 17 --}}
                                    <th scope="col" colspan="6" class="tabel-antigen">HPV (Kelas 5)</th>
        
                                    {{-- antigen 18 --}}
                                    <th scope="col" colspan="6" class="tabel-antigen">Td (Kelas 5)</th>
        
                                     {{-- SD 6 --}}
                                     <th scope="col" colspan="3" class="align-middle">Sasaran SD Kelas 6</th>
         
                                     {{-- antigen 19 --}}
                                     <th scope="col" colspan="6" class="tabel-antigen">HVP (Kelas 6)</th>
                                </tr> 
        
                                {{-- start --}}
        
                                <tr>
                                    
                                    {{-- <th scope="col">No</th>
                                    <th scope="col">Kabupaten</th>
                                    <th scope="col">Puskemas</th>
                                    <th scope="col">Kampung</th> --}}
        
                                    {{-- bayi baru lahir --}}
        
                                    <th scope="col">L</th>
                                    <th scope="col">P</th>
                                    <th scope="col">Total</th>
        
                                    {{-- antigen 1 --}}
                                    <th scope="col">Jumlah L</th>
                                    <th scope="col">% Jumlah L</th>
                                    <th scope="col">Jumlah P</th>
                                    <th scope="col">% Jumlah P</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">% Total</th>
        
                                    {{-- antigen 2 --}}
                                    <th scope="col">Jumlah L</th>
                                    <th scope="col">% Jumlah L</th>
                                    <th scope="col">Jumlah P</th>
                                    <th scope="col">% Jumlah P</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">% Total</th>
        
                                    {{-- antigen 3 --}}
                                    <th scope="col">Jumlah L</th>
                                    <th scope="col">% Jumlah L</th>
                                    <th scope="col">Jumlah P</th>
                                    <th scope="col">% Jumlah P</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">% Total</th>
        
                                    {{-- si --}}
                                    <th scope="col">L</th>
                                    <th scope="col">P</th>
                                    <th scope="col">Total</th>
        
                                    {{-- antigen 4 sampai 11 --}}
                                    @for ($a = 4; $a <= 11; $a++)
                                    <th scope="col">Jumlah L</th>
                                    <th scope="col">% Jumlah L</th>
                                    <th scope="col">Jumlah P</th>
                                    <th scope="col">% Jumlah P</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">% Total</th>
         
                                    @endfor
        
                                    {{-- Baduta --}}
                                    <th scope="col">L</th>
                                    <th scope="col">P</th>
                                    <th scope="col">Total</th>
        
                                    {{-- antigen 12 sampai 13 --}}
                                    @for ($b = 12; $b <= 13; $b++)
                                    <th scope="col">Jumlah L</th>
                                    <th scope="col">% Jumlah L</th>
                                    <th scope="col">Jumlah P</th>
                                    <th scope="col">% Jumlah P</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">% Total</th>
                                    @endfor
        
                                    {{-- SD 1 --}}
                                    <th scope="col">L</th>
                                    <th scope="col">P</th>
                                    <th scope="col">Total</th>
        
                                    {{-- antigen 14 sampai 15 --}}
                                    @for ($c = 14; $c <= 15; $c++)
                                    <th scope="col">Jumlah L</th>
                                    <th scope="col">% Jumlah L</th>
                                    <th scope="col">Jumlah P</th>
                                    <th scope="col">% Jumlah P</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">% Total</th>
                                    @endfor
        
                                     {{-- SD 2 --}}
                                    <th scope="col">L</th>
                                     <th scope="col">P</th>
                                     <th scope="col">Total</th>
          
                                     {{-- antigen 16 --}}
                                     <th scope="col">Jumlah L</th>
                                     <th scope="col">% Jumlah L</th>
                                     <th scope="col">Jumlah P</th>
                                     <th scope="col">% Jumlah P</th>
                                     <th scope="col">Total</th>
                                     <th scope="col">% Total</th>
        
        
                                    {{-- SD 5 --}}
                                    <th scope="col">L</th>
                                    <th scope="col">P</th>
                                    <th scope="col">Total</th>
        
                                    {{-- antigen 17 sampai 18 --}}
                                    @for ($d = 17; $d <= 18; $d++)
                                    <th scope="col">Jumlah L</th>
                                    <th scope="col">% Jumlah L</th>
                                    <th scope="col">Jumlah P</th>
                                    <th scope="col">% Jumlah P</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">% Total</th>
                                    @endfor
        
                                     {{-- SD 6 --}}
                                     <th scope="col">L</th>
                                     <th scope="col">P</th>
                                     <th scope="col">Total</th>
         
                                     {{-- antigen 19 --}}
                                     <th scope="col">Jumlah L</th>
                                     <th scope="col">% Jumlah L</th>
                                     <th scope="col">Jumlah P</th>
                                     <th scope="col">% Jumlah P</th>
                                     <th scope="col">Total</th>
                                     <th scope="col">% Total</th>
                                </tr> 
                            
                            </thead>
                            <tbody>
                            @foreach($queryArrays[$i] as $data)
                                <tr>
                                    {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
        
                                    {{-- data regional --}}
                                    {{-- <td>{{ $data->kabupaten }}</td>
                                    <td>{{ $data->puskesmas }}</td>
                                    <td>{{ $data->kampung }}</td> --}}
        
        
                                    {{-- bayi lahir --}}
                                    <td class="data-dasar">{{ $data->sasaran_bayi_lahir_L }}</td>
                                    <td class="data-dasar">{{ $data->sasaran_bayi_lahir_P }}</td>
                                    <td class="data-dasar">{{ $data->total_sasaran_bayi_lahir }}</td>
        
                                    {{-- antigen 1 --}}
                                    <td>{{ $data->jumlahL1 }}</td>
                                    <td>{{ $data->persen_jumlahL1 }}</td>
                                    <td>{{ $data->jumlahP1 }}</td>
                                    <td>{{ $data->persen_jumlahP1 }}</td>
                                    <td>{{ $data->total1 }}</td>
                                    <td class="data-total">{{ $data->persen_total1 }}</td>
        
                                    {{-- antigen 2 --}}
                                    <td>{{ $data->jumlahL2 }}</td>
                                    <td>{{ $data->persen_jumlahL2 }}</td>
                                    <td>{{ $data->jumlahP2 }}</td>
                                    <td>{{ $data->persen_jumlahP2 }}</td>
                                    <td>{{ $data->total2 }}</td>
                                    <td class="data-total">{{ $data->persen_total2 }}</td>
        
                                    {{-- antigen 3 --}}
                                    <td>{{ $data->jumlahL3 }}</td>
                                    <td>{{ $data->persen_jumlahL3 }}</td>
                                    <td>{{ $data->jumlahP3 }}</td>
                                    <td>{{ $data->persen_jumlahP3 }}</td>
                                    <td>{{ $data->total3 }}</td>
                                    <td class="data-total">{{ $data->persen_total3 }}</td>
        
                                    {{-- si --}}
                                    <td class="data-dasar">{{ $data->sasaran_si_L }}</td>
                                    <td class="data-dasar">{{ $data->sasaran_si_P }}</td>
                                    <td class="data-dasar">{{ $data->total_sasaran_si }}</td>
        
                                   {{-- antigen 4 --}}
                                   <td>{{ $data->jumlahL4 }}</td>
                                   <td>{{ $data->persen_jumlahL4 }}</td>
                                   <td>{{ $data->jumlahP4 }}</td>
                                   <td>{{ $data->persen_jumlahP4 }}</td>
                                   <td>{{ $data->total4 }}</td>
                                   <td class="data-total">{{ $data->persen_total4 }}</td>
        
                                   {{-- antigen 5 --}}
                                   <td>{{ $data->jumlahL5 }}</td>
                                   <td>{{ $data->persen_jumlahL5 }}</td>
                                   <td>{{ $data->jumlahP5 }}</td>
                                   <td>{{ $data->persen_jumlahP5 }}</td>
                                   <td>{{ $data->total5 }}</td>
                                   <td class="data-total">{{ $data->persen_total5 }}</td>
        
                                   {{-- antigen 6 --}}
                                   <td>{{ $data->jumlahL6 }}</td>
                                   <td>{{ $data->persen_jumlahL6 }}</td>
                                   <td>{{ $data->jumlahP6 }}</td>
                                   <td>{{ $data->persen_jumlahP6 }}</td>
                                   <td>{{ $data->total6 }}</td>
                                   <td class="data-total">{{ $data->persen_total6 }}</td>
        
                                   {{-- antigen 7 --}}
                                   <td>{{ $data->jumlahL7 }}</td>
                                   <td>{{ $data->persen_jumlahL7 }}</td>
                                   <td>{{ $data->jumlahP7 }}</td>
                                   <td>{{ $data->persen_jumlahP7 }}</td>
                                   <td>{{ $data->total7 }}</td>
                                   <td class="data-total">{{ $data->persen_total7 }}</td>
        
                                   {{-- antigen 8 --}}
                                   <td>{{ $data->jumlahL8 }}</td>
                                   <td>{{ $data->persen_jumlahL8 }}</td>
                                   <td>{{ $data->jumlahP8 }}</td>
                                   <td>{{ $data->persen_jumlahP8 }}</td>
                                   <td>{{ $data->total8 }}</td>
                                   <td class="data-total">{{ $data->persen_total8 }}</td>
        
                                   {{-- antigen 9 --}}
                                   <td>{{ $data->jumlahL9 }}</td>
                                   <td>{{ $data->persen_jumlahL9 }}</td>
                                   <td>{{ $data->jumlahP9 }}</td>
                                   <td>{{ $data->persen_jumlahP9 }}</td>
                                   <td>{{ $data->total9 }}</td>
                                   <td class="data-total">{{ $data->persen_total9 }}</td>
        
                                   {{-- antigen 10 --}}
                                   <td>{{ $data->jumlahL10 }}</td>
                                   <td>{{ $data->persen_jumlahL10 }}</td>
                                   <td>{{ $data->jumlahP10 }}</td>
                                   <td>{{ $data->persen_jumlahP10 }}</td>
                                   <td>{{ $data->total10 }}</td>
                                   <td class="data-total">{{ $data->persen_total10 }}</td>
        
                                   {{-- antigen 11 --}}
                                   <td>{{ $data->jumlahL11 }}</td>
                                   <td>{{ $data->persen_jumlahL11 }}</td>
                                   <td>{{ $data->jumlahP11 }}</td>
                                   <td>{{ $data->persen_jumlahP11 }}</td>
                                   <td>{{ $data->total11 }}</td>
                                   <td class="data-total">{{ $data->persen_total11 }}</td>
        
                                     {{-- baduta --}}
                                     <td class="data-dasar">{{ $data->sasaran_baduta_L }}</td>
                                     <td class="data-dasar">{{ $data->sasaran_baduta_P}}</td>
                                     <td class="data-dasar">{{ $data->total_sasaran_baduta }}</td>
        
        
                                   {{-- antigen 12 --}}
                                   <td>{{ $data->jumlahL12 }}</td>
                                   <td>{{ $data->persen_jumlahL12 }}</td>
                                   <td>{{ $data->jumlahP12 }}</td>
                                   <td>{{ $data->persen_jumlahP12 }}</td>
                                   <td>{{ $data->total12 }}</td>
                                   <td class="data-total">{{ $data->persen_total12 }}</td>
        
                                   {{-- antigen 13 --}}
                                   <td>{{ $data->jumlahL13 }}</td>
                                   <td>{{ $data->persen_jumlahL13 }}</td>
                                   <td>{{ $data->jumlahP13 }}</td>
                                   <td>{{ $data->persen_jumlahP13 }}</td>
                                   <td>{{ $data->total13 }}</td>
                                   <td class="data-total">{{ $data->persen_total13 }}</td>
        
                                    {{-- sd 1 --}}
                                    <td class="data-dasar">{{ $data->sasaran_sd_1_L }}</td>
                                    <td class="data-dasar">{{ $data->sasaran_sd_1_P }}</td>
                                    <td class="data-dasar">{{ $data->total_sasaran_sd_1 }}</td>
        
                                   {{-- antigen 14 --}}
                                   <td>{{ $data->jumlahL14 }}</td>
                                   <td>{{ $data->persen_jumlahL14 }}</td>
                                   <td>{{ $data->jumlahP14 }}</td>
                                   <td>{{ $data->persen_jumlahP14 }}</td>
                                   <td>{{ $data->total14 }}</td>
                                   <td class="data-total">{{ $data->persen_total14 }}</td>
        
                                    {{-- antigen 15 --}}
                                    <td>{{ $data->jumlahL15 }}</td>
                                    <td>{{ $data->persen_jumlahL15 }}</td>
                                    <td>{{ $data->jumlahP15 }}</td>
                                    <td>{{ $data->persen_jumlahP15 }}</td>
                                    <td>{{ $data->total15 }}</td>
                                    <td class="data-total">{{ $data->persen_total15 }}</td>
        
        
                                    {{-- sd 2 --}}
                                    <td class="data-dasar">{{ $data->sasaran_sd_2_L }}</td>
                                    <td class="data-dasar">{{ $data->sasaran_sd_2_P }}</td>
                                    <td class="data-dasar">{{ $data->total_sasaran_sd_2 }}</td>
        
                                     {{-- antigen 16 --}}
                                     <td>{{ $data->jumlahL16 }}</td>
                                     <td>{{ $data->persen_jumlahL16 }}</td>
                                     <td>{{ $data->jumlahP16 }}</td>
                                     <td>{{ $data->persen_jumlahP16 }}</td>
                                     <td>{{ $data->total16 }}</td>
                                     <td class="data-total">{{ $data->persen_total16 }}</td>
        
                                     {{-- sd 5 --}}
                                     <td class="data-dasar">{{ $data->sasaran_sd_5_L }}</td>
                                     <td class="data-dasar">{{ $data->sasaran_sd_5_P }}</td>
                                     <td class="data-dasar">{{ $data->total_sasaran_sd_5 }}</td>
        
                                    {{-- antigen 17 --}}
                                    <td>{{ $data->jumlahL17 }}</td>
                                    <td>{{ $data->persen_jumlahL17 }}</td>
                                    <td>{{ $data->jumlahP17 }}</td>
                                    <td>{{ $data->persen_jumlahP17 }}</td>
                                    <td>{{ $data->total17 }}</td>
                                    <td class="data-total">{{ $data->persen_total17 }}</td>
        
                                    {{-- antigen 18 --}}
                                    <td>{{ $data->jumlahL18 }}</td>
                                    <td>{{ $data->persen_jumlahL18 }}</td>
                                    <td>{{ $data->jumlahP18 }}</td>
                                    <td>{{ $data->persen_jumlahP18 }}</td>
                                    <td>{{ $data->total18 }}</td>
                                    <td class="data-total">{{ $data->persen_total18 }}</td>
        
                                    {{-- sd 6 --}}
                                    <td class="data-dasar">{{ $data->sasaran_sd_6_L }}</td>
                                    <td class="data-dasar">{{ $data->sasaran_sd_6_P }}</td>
                                    <td class="data-dasar">{{ $data->total_sasaran_sd_6 }}</td>
        
                                    {{-- antigen 19 --}}
                                    <td>{{ $data->jumlahL19 }}</td>
                                    <td>{{ $data->persen_jumlahL19 }}</td>
                                    <td>{{ $data->jumlahP19 }}</td>
                                    <td>{{ $data->persen_jumlahP19 }}</td>
                                    <td>{{ $data->total19 }}</td>
                                    <td class="data-total">{{ $data->persen_total19 }}</td>
        
        
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                
                <br>
                <br>
               
               
            @endfor
        </div>
    </div>
@endsection
</html>
