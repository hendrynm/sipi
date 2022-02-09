{{--http://localhost:8080/project_sipi/t-puskesmas.php--}}

@extends("_partials.master")
@section("title","Ketercapaian Status T Setiap Puskesmas")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container-fluid t">
        <a href="./dashboard" class="btn btn-primary">Back</a>
        <hr>
        <h1>Ketercapaian Status T Setiap Puskesmas</h1>
        {{-- ini awalnya container --}}
        <div >
            <form method="get">
                <x-kabupaten-form :kabupatenForm="$kabupatenForm" :kabupatens="$kabupatens"></x-kabupaten-form>
                <x-year-form :tahunForm="$tahunForm"></x-year-form>
                <x-submit-button-form></x-submit-button-form>
            </form>

           

{{-- tabel 1 --}}
            <div style="height: 500px;">
                <canvas id="myChart"></canvas>
            </div>

            <table class="table" id="table0">
                <thead class="thead-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kabupaten</th>
                    <th scope="col">Puskemas</th>
                    <th scope="col">T1 Hamil (%)</th>
                    <th scope="col">T1 Tidak Hamil (%)</th>
                    <th scope="col">T1 Total (%)</th>
                    
                    <th scope="col">T2 Hamil (%)</th>
                    <th scope="col">T2 Tidak Hamil (%)</th>
                    <th scope="col">T2 Total (%)</th>

                    <th scope="col">T3 Hamil (%)</th>
                    <th scope="col">T3 Tidak Hamil (%)</th>
                    <th scope="col">T3 Total (%)</th>

                    <th scope="col">T4 Hamil (%)</th>
                    <th scope="col">T4 Tidak Hamil (%)</th>
                    <th scope="col">T4 Total (%)</th>

                    <th scope="col">T5 Hamil (%)</th>
                    <th scope="col">T5 Tidak Hamil (%)</th>
                    <th scope="col">T5 Total (%)</th>
                </tr>
                </thead>
                <tbody>
                @foreach($query as $data)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $data->kabupaten }}</td>
                        <td>{{ $data->puskesmas }}</td>

                        <td>{{ $data->t1_hamil }}</td>
                        <td>{{ $data->t1_tidak_hamil }}</td>
                        <td>{{ $data->t1_total }}</td>

                        <td>{{ $data->t2_hamil }}</td>
                        <td>{{ $data->t2_tidak_hamil }}</td>
                        <td>{{ $data->t2_total }}</td>

                        <td>{{ $data->t3_hamil }}</td>
                        <td>{{ $data->t3_tidak_hamil }}</td>
                        <td>{{ $data->t3_total }}</td>

                        <td>{{ $data->t4_hamil }}</td>
                        <td>{{ $data->t4_tidak_hamil }}</td>
                        <td>{{ $data->t4_total }}</td>

                        <td>{{ $data->t5_hamil }}</td>
                        <td>{{ $data->t5_tidak_hamil }}</td>
                        <td>{{ $data->t5_total }}</td>
                        
                    </tr>
                @endforeach
                </tbody>
            </table>
            <br>
            <br>
            <hr>

            {{-- tabel 2 --}}
            <div style="height: 500px;"><canvas id="myChart1"></canvas><br><br></div>
            <table class="table" id="table1">
                <thead class="thead-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kabupaten</th>
                    <th scope="col">Puskemas</th>
                    <th scope="col">T1 Hamil (%)</th>
                    
                    
                    <th scope="col">T2 Hamil (%)</th>
                   

                    <th scope="col">T3 Hamil (%)</th>
                   
                    <th scope="col">T4 Hamil (%)</th>
                    

                    <th scope="col">T5 Hamil (%)</th>
                    
                </tr>
                </thead>
                <tbody>
                @foreach($query2 as $data)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $data->kabupaten }}</td>
                        <td>{{ $data->puskesmas }}</td>

                        <td>{{ $data->t1_hamil }}</td>
                        

                        <td>{{ $data->t2_hamil }}</td>
                        

                        <td>{{ $data->t3_hamil }}</td>
                        

                        <td>{{ $data->t4_hamil }}</td>
                        
                        <td>{{ $data->t5_hamil }}</td>
                        
                        
                    </tr>
                @endforeach
                </tbody>
            </table>
            <br>
            <br>
            <hr>

            {{-- tabel 3 --}}
            <div style="height: 500px;"><canvas id="myChart2"></canvas><br><br></div>
            <table class="table" id="table2">
                <thead class="thead-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kabupaten</th>
                    <th scope="col">Puskemas</th>
                  
                    <th scope="col">T1 Tidak Hamil (%)</th>
                    
                    
                   
                    <th scope="col">T2 Tidak Hamil (%)</th>
                    

                   
                    <th scope="col">T3 Tidak Hamil (%)</th>



                    <th scope="col">T4 Tidak Hamil (%)</th>



                    <th scope="col">T5 Tidak Hamil (%)</th>

                </tr>
                </thead>
                <tbody>
                @foreach($query2 as $data)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $data->kabupaten }}</td>
                        <td>{{ $data->puskesmas }}</td>


                        <td>{{ $data->t1_tidak_hamil }}</td>



                        <td>{{ $data->t2_tidak_hamil }}</td>



                        <td>{{ $data->t3_tidak_hamil }}</td>



                        <td>{{ $data->t4_tidak_hamil }}</td>



                        <td>{{ $data->t5_tidak_hamil }}</td>

                        
                    </tr>
                @endforeach
                </tbody>
            </table>
            <br>
            <br>
            <hr>

           
        </div>
    </div>

            <?php
            foreach ($query as $data) {
                $kabupaten[] = $data->kabupaten;
                $puskesmas[] = $data->puskesmas;
                $t1_total[] = $data->t1_total;
                $t1_hamil[] = $data->t1_hamil;
                $t1_tidak_hamil[] = $data->t1_tidak_hamil;
                $t2_total[] = $data->t2_total;
                $t2_hamil[] = $data->t2_hamil;
                $t2_tidak_hamil[] = $data->t2_tidak_hamil;
                $t3_total[] = $data->t3_total;
                $t3_hamil[] = $data->t3_hamil;
                $t3_tidak_hamil[] = $data->t3_tidak_hamil;
                $t4_total[] = $data->t4_total;
                $t4_hamil[] = $data->t4_hamil;
                $t4_tidak_hamil[] = $data->t4_tidak_hamil;
                $t5_total[] = $data->t5_total;
                $t5_hamil[] = $data->t5_hamil;
                $t5_tidak_hamil[] = $data->t5_tidak_hamil;
            }
            foreach ($query1 as $data1) {
                $kabupaten1[] = $data1->kabupaten;
                $puskesmas1[] = $data1->puskesmas;
                $t1_total1[] = $data1->t1_total;
                $t1_hamil1[] = $data1->t1_hamil;
                $t1_tidak_hamil1[] = $data1->t1_tidak_hamil;
                $t2_total1[] = $data1->t2_total;
                $t2_hamil1[] = $data1->t2_hamil;
                $t2_tidak_hamil1[] = $data1->t2_tidak_hamil;
                $t3_total1[] = $data1->t3_total;
                $t3_hamil1[] = $data1->t3_hamil;
                $t3_tidak_hamil1[] = $data1->t3_tidak_hamil;
                $t4_total1[] = $data1->t4_total;
                $t4_hamil1[] = $data1->t4_hamil;
                $t4_tidak_hamil1[] = $data1->t4_tidak_hamil;
                $t5_total1[] = $data1->t5_total;
                $t5_hamil1[] = $data1->t5_hamil;
                $t5_tidak_hamil1[] = $data1->t5_tidak_hamil;
            }
            foreach ($query2 as $data2) {
                $kabupaten2[] = $data2->kabupaten;
                $puskesmas2[] = $data2->puskesmas;
                $t1_total2[] = $data2->t1_total;
                $t1_hamil2[] = $data2->t1_hamil;
                $t1_tidak_hamil2[] = $data2->t1_tidak_hamil;
                $t2_total2[] = $data2->t2_total;
                $t2_hamil2[] = $data2->t2_hamil;
                $t2_tidak_hamil2[] = $data2->t2_tidak_hamil;
                $t3_total2[] = $data2->t3_total;
                $t3_hamil2[] = $data2->t3_hamil;
                $t3_tidak_hamil2[] = $data2->t3_tidak_hamil;
                $t4_total2[] = $data2->t4_total;
                $t4_hamil2[] = $data2->t4_hamil;
                $t4_tidak_hamil2[] = $data2->t4_tidak_hamil;
                $t5_total2[] = $data2->t5_total;
                $t5_hamil2[] = $data2->t5_hamil;
                $t5_tidak_hamil2[] = $data2->t5_tidak_hamil;
            }
            ?>



            <br>
            <br>

           
        </div>

       


        <script>
            var data = {
                labels: <?php echo json_encode($puskesmas) ?>,
                datasets: [{
                    label: "T1 (%)",
                    backgroundColor: 'rgba(196, 59, 59)',
                    data: <?php echo json_encode($t1_total) ?>,
                }, {
                    label: "T2 (%)",
                    backgroundColor: 'rgba(222, 182, 40)',
                    data: <?php echo json_encode($t2_total) ?>,
                }, {
                    label: "T3 (%)",
                    backgroundColor: 'rgba(17, 133, 19)',
                    data: <?php echo json_encode($t3_total) ?>,
                }, {
                    label: "T4 (%)",
                    backgroundColor: 'rgba(17, 90, 133)',
                    data: <?php echo json_encode($t4_total) ?>,
                }, {
                    label: "T5 (%)",
                    backgroundColor: 'rgba(186, 75, 219)',
                    data: <?php echo json_encode($t5_total) ?>,
                }]
            };

            var options = {
                scales: {
                    xAxes: [{
                        stacked: true,
                        ticks: {
                            autoSkip: false,
                            maxRotation: 90,
                            minRotation: 90,
                        }
                    }],
                    yAxes: [{
                        stacked: true,
                        ticks: {
                            beginAtZero: true,
                            min: 0,
                            max: 100,
                            userCallback: function(label, index, labels) {
                                // when the floored value is the same as the value we have a whole number
                                if (Math.floor(label) === label) {
                                    return label + '%';
                                }
                            }
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Ketercapaian Status T pada WUS Hamil & Tidak Hamil Tiap Puskesmas',
                    fontSize: 32,
                },
                responsive: true,
                maintainAspectRatio: false
            };

            var ctx = document.getElementById("myChart").getContext("2d");
            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: options
            });

            function shiftBarColumns(){
                console.log(window.innerWidth);
                console.log(window.outerWidth)
            }
        </script>

        <script>
            var data = {
                labels: <?php echo json_encode($puskesmas1) ?>,
                datasets: [{
                    label: "T1 (%)",
                    backgroundColor: 'rgba(196, 59, 59)',
                    data: <?php echo json_encode($t1_hamil1) ?>,
                }, {
                    label: "T2 (%)",
                    backgroundColor: 'rgba(222, 182, 40)',
                    data: <?php echo json_encode($t2_hamil1) ?>,
                }, {
                    label: "T3 (%)",
                    backgroundColor: 'rgba(17, 133, 19)',
                    data: <?php echo json_encode($t3_hamil1) ?>,
                }, {
                    label: "T4 (%)",
                    backgroundColor: 'rgba(17, 90, 133)',
                    data: <?php echo json_encode($t4_hamil1) ?>,
                }, {
                    label: "T5 (%)",
                    backgroundColor: 'rgba(186, 75, 219)',
                    data: <?php echo json_encode($t5_hamil1) ?>,
                }]
            };

            var options = {
                scales: {
                    xAxes: [{
                        stacked: true,
                        ticks: {
                            autoSkip: false,
                            maxRotation: 90,
                            minRotation: 90,
                        }
                    }],
                    yAxes: [{
                        stacked: true,
                        ticks: {
                            beginAtZero: true,
                            min: 0,
                            max: 100,
                            userCallback: function(label, index, labels) {
                                // when the floored value is the same as the value we have a whole number
                                if (Math.floor(label) === label) {
                                    return label + '%';
                                }
                            }
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Ketercapaian Status T pada WUS Hamil Tiap Puskesmas',
                    fontSize: 32,
                },
                responsive: true,
                maintainAspectRatio: false
            };

            var ctx = document.getElementById("myChart1").getContext("2d");
            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: options
            });

            function shiftBarColumns(){
                console.log(window.innerWidth);
                console.log(window.outerWidth)
            }
        </script>


        <script>
            var data = {
                labels: <?php echo json_encode($puskesmas2) ?>,
                datasets: [{
                    label: "T1 (%)",
                    backgroundColor: 'rgba(196, 59, 59)',
                    data: <?php echo json_encode($t1_tidak_hamil2) ?>,
                }, {
                    label: "T2 (%)",
                    backgroundColor: 'rgba(222, 182, 40)',
                    data: <?php echo json_encode($t2_tidak_hamil2) ?>,
                }, {
                    label: "T3 (%)",
                    backgroundColor: 'rgba(17, 133, 19)',
                    data: <?php echo json_encode($t3_tidak_hamil2) ?>,
                }, {
                    label: "T4 (%)",
                    backgroundColor: 'rgba(17, 90, 133)',
                    data: <?php echo json_encode($t4_tidak_hamil2) ?>,
                }, {
                    label: "T5 (%)",
                    backgroundColor: 'rgba(186, 75, 219)',
                    data: <?php echo json_encode($t5_tidak_hamil2) ?>,
                }]
            };

            var options = {
                scales: {
                    xAxes: [{
                        stacked: true,
                        ticks: {
                            autoSkip: false,
                            maxRotation: 90,
                            minRotation: 90,
                        }
                    }],
                    yAxes: [{
                        stacked: true,
                        ticks: {
                            beginAtZero: true,
                            min: 0,
                            max: 100,
                            userCallback: function(label, index, labels) {
                                // when the floored value is the same as the value we have a whole number
                                if (Math.floor(label) === label) {
                                    return label + '%';
                                }
                            }
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Ketercapaian Status T pada WUS Tidak Hamil Tiap Puskesmas',
                    fontSize: 32,
                },
                responsive: true,
                maintainAspectRatio: false
            };

            var ctx = document.getElementById("myChart2").getContext("2d");
            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: options
            });

            function shiftBarColumns(){
                console.log(window.innerWidth);
                console.log(window.outerWidth)
            }
        </script>
    </div>
@endsection
</html>
