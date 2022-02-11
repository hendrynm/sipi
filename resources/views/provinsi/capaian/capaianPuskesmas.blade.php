{{--http://localhost:8080/project_sipi/ketercapaian-puskesmas.php
--}}

@extends("_partials.master")
@section("title","Ketercapaian Imunisasi Setiap Puskesmas")

    <!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        @if(Session::get('level') == 2)
            <a href="./dashboard" class="btn btn-primary">Back</a>
        @elseif(Session::get('level') == 1)
            <a href="{{route('provinsi.dashboard')}}" class="btn btn-primary">Back</a>
        @endif
        <hr>
        <h1>Ketercapaian Imunisasi Setiap Puskesmas</h1>
        <div class="jumbotron">
            <form method="get">
                <x-kabupaten-form :kabupatenForm="$kabupatenForm" :kabupatens="$kabupatens"></x-kabupaten-form>
                <x-antigen-form :antigenForm="$antigenForm" :antigens="$antigens"></x-antigen-form>
                <x-year-form :tahunForm="$tahunForm"></x-year-form>
                <x-submit-button-form></x-submit-button-form>
            </form>

            <?php
            $queryArrays = [$query, $query1, $query2, $query3, $query4, $query5, $query6, $query7, $query8, $query9, $query10, $query11, $query12]
            ?>

            @for($i = 0; $i < count($queryArrays); $i++)
                @if($i == 0)
                    <div style="height: 500px;">
                        <canvas id="myChart"></canvas>
                    </div>

                    <br>
                    <br>

                @else
                    <div style="height: 500px;"><canvas id="myChart{{$i}}"></canvas><br><br></div>

                @endif
                <table class="table" id="table{{$i}}">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Puskemas</th>
                        <th scope="col">Perempuan</th>
                        <th scope="col">Laki-Laki</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Target</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($queryArrays[$i] as $data)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $data->puskesmas }}</td>
                            <td>{{ $data->jumlahP }}</td>
                            <td>{{ $data->jumlahL }}</td>
                            <td>{{ $data->jumlah }}</td>
                            <td>{{$data->target}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <br>
                <br>
                <hr>
            @endfor
        </div>
    </div>

            <?php
            foreach ($query as $data) {
                $kabupaten[] = $data->kabupaten;
                $puskesmas[] = $data->puskesmas;
                $jumlah[] = $data->jumlah;
                $jumlahP[] = $data->jumlahP;
                $jumlahL[] = $data->jumlahL;
                $target[] = $data->target;
            }
            foreach ($query1 as $data1) {
                $kabupaten1[] = $data1->kabupaten;
                $puskesmas1[] = $data1->puskesmas;
                $jumlah1[] = $data1->jumlah;
                $jumlahP1[] = $data1->jumlahP;
                $jumlahL1[] = $data1->jumlahL;
                $target1[] = $data1->target;
            }
            foreach ($query2 as $data2) {
                $kabupaten2[] = $data2->kabupaten;
                $puskesmas2[] = $data2->puskesmas;
                $jumlah2[] = $data2->jumlah;
                $jumlahP2[] = $data2->jumlahP;
                $jumlahL2[] = $data2->jumlahL;
                $target2[] = $data2->target;
            }
            foreach ($query3 as $data3) {
                $kabupaten3[] = $data3->kabupaten;
                $puskesmas3[] = $data3->puskesmas;
                $jumlah3[] = $data3->jumlah;
                $jumlahP3[] = $data3->jumlahP;
                $jumlahL3[] = $data3->jumlahL;
                $target3[] = $data3->target;
            }
            foreach ($query4 as $data4) {
                $kabupaten4[] = $data4->kabupaten;
                $puskesmas4[] = $data4->puskesmas;
                $jumlah4[] = $data4->jumlah;
                $jumlahP4[] = $data4->jumlahP;
                $jumlahL4[] = $data4->jumlahL;
                $target4[] = $data4->target;
            }
            foreach ($query5 as $data5) {
                $kabupaten5[] = $data5->kabupaten;
                $puskesmas5[] = $data5->puskesmas;
                $jumlah5[] = $data5->jumlah;
                $jumlahP5[] = $data5->jumlahP;
                $jumlahL5[] = $data5->jumlahL;
                $target5[] = $data5->target;
            }
            foreach ($query6 as $data6) {
                $kabupaten6[] = $data6->kabupaten;
                $puskesmas6[] = $data6->puskesmas;
                $jumlah6[] = $data6->jumlah;
                $jumlahP6[] = $data6->jumlahP;
                $jumlahL6[] = $data6->jumlahL;
                $target6[] = $data6->target;
            }
            foreach ($query7 as $data7) {
                $kabupaten7[] = $data7->kabupaten;
                $puskesmas7[] = $data7->puskesmas;
                $jumlah7[] = $data7->jumlah;
                $jumlahP7[] = $data7->jumlahP;
                $jumlahL7[] = $data7->jumlahL;
                $target7[] = $data7->target;
            }
            foreach ($query8 as $data8) {
                $kabupaten8[] = $data8->kabupaten;
                $puskesmas8[] = $data8->puskesmas;
                $jumlah8[] = $data8->jumlah;
                $jumlahP8[] = $data8->jumlahP;
                $jumlahL8[] = $data8->jumlahL;
                $target8[] = $data8->target;
            }
            foreach ($query9 as $data9) {
                $kabupaten9[] = $data9->kabupaten;
                $puskesmas9[] = $data9->puskesmas;
                $jumlah9[] = $data9->jumlah;
                $jumlahP9[] = $data9->jumlahP;
                $jumlahL9[] = $data9->jumlahL;
                $target9[] = $data9->target;
            }
            foreach ($query10 as $data10) {
                $kabupaten10[] = $data10->kabupaten;
                $puskesmas10[] = $data10->puskesmas;
                $jumlah10[] = $data10->jumlah;
                $jumlahP10[] = $data10->jumlahP;
                $jumlahL10[] = $data10->jumlahL;
                $target10[] = $data10->target;
            }
            foreach ($query11 as $data11) {
                $kabupaten11[] = $data11->kabupaten;
                $puskesmas11[] = $data11->puskesmas;
                $jumlah11[] = $data11->jumlah;
                $jumlahP11[] = $data11->jumlahP;
                $jumlahL11[] = $data11->jumlahL;
                $target11[] = $data11->target;
            }
            foreach ($query12 as $data12) {
                $kabupaten12[] = $data12->kabupaten;
                $puskesmas12[] = $data12->puskesmas;
                $jumlah12[] = $data12->jumlah;
                $jumlahP12[] = $data12->jumlahP;
                $jumlahL12[] = $data12->jumlahL;
                $target12[] = $data12->target;
            }
            ?>

        </div>



        <script>
            var data = {
                labels: <?php echo json_encode($puskesmas) ?>,
                datasets: [{
                    label: "Sudah Imunisasi",
                    backgroundColor: 'rgba(240, 168, 36)',
                    data: <?php echo json_encode($jumlah) ?>,
                    xAxisID: "bar-x-axis1",
                }, {
                    label: "Target",
                    backgroundColor: 'rgba(156, 153, 145, 0.4)',
                    data: <?php echo json_encode($target) ?>,
                    xAxisID: "bar-x-axis2",
                }]
            };

            var options = {
                scales: {
                    xAxes: [{
                        stacked: true,
                        id: "bar-x-axis1",
                        maxBarThickness: 20,
                        ticks: {
                            autoSkip: false,
                            maxRotation: 90,
                            minRotation: 90,
                        }
                    }, {
                        display: false,
                        stacked: true,
                        id: "bar-x-axis2",
                        maxBarThickness: 35,
                        type: 'category',
                        categoryPercentage: 0.8,
                        barPercentage: 0.9,
                        gridLines: {
                            offsetGridLines: true
                        },
                        offset: true
                    }],
                    yAxes: [{
                        stacked: false,
                        ticks: {
                            beginAtZero: true,
                        },
                    }]

                },
                title: {
                    display: true,
                    text: 'Capaian Imunisasi {{ $nama_antigen }} Tingkat Puskesmas tahun {{ $tahunForm }}',
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
                    label: "Perempuan",
                    backgroundColor: 'rgba(215, 160, 159)',
                    data: <?php echo json_encode($jumlahP1) ?>,
                }, {
                    label: "Laki-Laki",
                    backgroundColor: 'rgba(162, 193, 224)',
                    data: <?php echo json_encode($jumlahL1) ?>,
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
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Capaian Imunisasi {{ $nama_antigen }} Tingkat Puskesmas Bulan Januari',
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
                    label: "Perempuan",
                    backgroundColor: 'rgba(215, 160, 159)',
                    data: <?php echo json_encode($jumlahP2) ?>,
                }, {
                    label: "Laki-Laki",
                    backgroundColor: 'rgba(162, 193, 224)',
                    data: <?php echo json_encode($jumlahL2) ?>,
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
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Capaian Imunisasi {{ $nama_antigen }} Tingkat Puskesmas Bulan Februari',
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


        <script>
            var data = {
                labels: <?php echo json_encode($puskesmas3) ?>,
                datasets: [{
                    label: "Perempuan",
                    backgroundColor: 'rgba(215, 160, 159)',
                    data: <?php echo json_encode($jumlahP3) ?>,
                }, {
                    label: "Laki-Laki",
                    backgroundColor: 'rgba(162, 193, 224)',
                    data: <?php echo json_encode($jumlahL3) ?>,
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
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Capaian Imunisasi {{ $nama_antigen }} Tingkat Puskesmas Bulan Maret',
                    fontSize: 32,
                },
                responsive: true,
                maintainAspectRatio: false
            };

            var ctx = document.getElementById("myChart3").getContext("2d");
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
                labels: <?php echo json_encode($puskesmas4) ?>,
                datasets: [{
                    label: "Perempuan",
                    backgroundColor: 'rgba(215, 160, 159)',
                    data: <?php echo json_encode($jumlahP4) ?>,
                }, {
                    label: "Laki-Laki",
                    backgroundColor: 'rgba(162, 193, 224)',
                    data: <?php echo json_encode($jumlahL4) ?>,
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
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Capaian Imunisasi {{ $nama_antigen }} Tingkat Puskesmas Bulan April',
                    fontSize: 32,
                },
                responsive: true,
                maintainAspectRatio: false
            };

            var ctx = document.getElementById("myChart4").getContext("2d");
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
                labels: <?php echo json_encode($puskesmas5) ?>,
                datasets: [{
                    label: "Perempuan",
                    backgroundColor: 'rgba(215, 160, 159)',
                    data: <?php echo json_encode($jumlahP5) ?>,
                }, {
                    label: "Laki-Laki",
                    backgroundColor: 'rgba(162, 193, 224)',
                    data: <?php echo json_encode($jumlahL5) ?>,
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
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Capaian Imunisasi {{ $nama_antigen }} Tingkat Puskesmas Bulan Mei',
                    fontSize: 32,
                },
                responsive: true,
                maintainAspectRatio: false
            };

            var ctx = document.getElementById("myChart5").getContext("2d");
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
                labels: <?php echo json_encode($puskesmas6) ?>,
                datasets: [{
                    label: "Perempuan",
                    backgroundColor: 'rgba(215, 160, 159)',
                    data: <?php echo json_encode($jumlahP6) ?>,
                }, {
                    label: "Laki-Laki",
                    backgroundColor: 'rgba(162, 193, 224)',
                    data: <?php echo json_encode($jumlahL6) ?>,
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
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Capaian Imunisasi {{ $nama_antigen }} Tingkat Puskesmas Bulan Juni',
                    fontSize: 32,
                },
                responsive: true,
                maintainAspectRatio: false
            };

            var ctx = document.getElementById("myChart6").getContext("2d");
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
                labels: <?php echo json_encode($puskesmas7) ?>,
                datasets: [{
                    label: "Perempuan",
                    backgroundColor: 'rgba(215, 160, 159)',
                    data: <?php echo json_encode($jumlahP7) ?>,
                }, {
                    label: "Laki-Laki",
                    backgroundColor: 'rgba(162, 193, 224)',
                    data: <?php echo json_encode($jumlahL7) ?>,
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
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Capaian Imunisasi {{ $nama_antigen }} Tingkat Puskesmas Bulan Juli',
                    fontSize: 32,
                },
                responsive: true,
                maintainAspectRatio: false
            };

            var ctx = document.getElementById("myChart7").getContext("2d");
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
                labels: <?php echo json_encode($puskesmas8) ?>,
                datasets: [{
                    label: "Perempuan",
                    backgroundColor: 'rgba(215, 160, 159)',
                    data: <?php echo json_encode($jumlahP8) ?>,
                }, {
                    label: "Laki-Laki",
                    backgroundColor: 'rgba(162, 193, 224)',
                    data: <?php echo json_encode($jumlahL8) ?>,
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
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Capaian Imunisasi {{ $nama_antigen }} Tingkat Puskesmas Bulan Agustus',
                    fontSize: 32,
                },
                responsive: true,
                maintainAspectRatio: false
            };

            var ctx = document.getElementById("myChart8").getContext("2d");
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
                labels: <?php echo json_encode($puskesmas9) ?>,
                datasets: [{
                    label: "Perempuan",
                    backgroundColor: 'rgba(215, 160, 159)',
                    data: <?php echo json_encode($jumlahP9) ?>,
                }, {
                    label: "Laki-Laki",
                    backgroundColor: 'rgba(162, 193, 224)',
                    data: <?php echo json_encode($jumlahL9) ?>,
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
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Capaian Imunisasi {{ $nama_antigen }} Tingkat Puskesmas Bulan September',
                    fontSize: 32,
                },
                responsive: true,
                maintainAspectRatio: false
            };

            var ctx = document.getElementById("myChart9").getContext("2d");
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
                labels: <?php echo json_encode($puskesmas10) ?>,
                datasets: [{
                    label: "Perempuan",
                    backgroundColor: 'rgba(215, 160, 159)',
                    data: <?php echo json_encode($jumlahP10) ?>,
                }, {
                    label: "Laki-Laki",
                    backgroundColor: 'rgba(162, 193, 224)',
                    data: <?php echo json_encode($jumlahL10) ?>,
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
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Capaian Imunisasi {{ $nama_antigen }} Tingkat Puskesmas Bulan Oktober',
                    fontSize: 32,
                },
                responsive: true,
                maintainAspectRatio: false
            };

            var ctx = document.getElementById("myChart10").getContext("2d");
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
                labels: <?php echo json_encode($puskesmas11) ?>,
                datasets: [{
                    label: "Perempuan",
                    backgroundColor: 'rgba(215, 160, 159)',
                    data: <?php echo json_encode($jumlahP11) ?>,
                }, {
                    label: "Laki-Laki",
                    backgroundColor: 'rgba(162, 193, 224)',
                    data: <?php echo json_encode($jumlahL11) ?>,
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
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Capaian Imunisasi {{ $nama_antigen }} Tingkat Puskesmas Bulan November',
                    fontSize: 32,
                },
                responsive: true,
                maintainAspectRatio: false
            };

            var ctx = document.getElementById("myChart11").getContext("2d");
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
                labels: <?php echo json_encode($puskesmas12) ?>,
                datasets: [{
                    label: "Perempuan",
                    backgroundColor: 'rgba(215, 160, 159)',
                    data: <?php echo json_encode($jumlahP12) ?>,
                }, {
                    label: "Laki-Laki",
                    backgroundColor: 'rgba(162, 193, 224)',
                    data: <?php echo json_encode($jumlahL12) ?>,
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
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Capaian Imunisasi {{ $nama_antigen }} Tingkat Puskesmass Bulan Desember',
                    fontSize: 32,
                },
                responsive: true,
                maintainAspectRatio: false
            };

            var ctx = document.getElementById("myChart12").getContext("2d");
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
