{{--http://localhost:8080/project_sipi/irl-kabupaten.php
--}}

@extends("_partials.master")
@section("title","Ketercapaian Imunisasi Rutin Lengkap (IRL) Setiap Kabupaten")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="./dashboard" class="btn btn-primary">Back</a>
        <hr>
        <h1>Ketercapaian Imunisasi Rutin Lengkap (IRL) Setiap Kabupaten</h1>
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-6 col-12">
                    <form method="get">
                        <x-year-form :tahunForm="$tahunForm"></x-year-form>
                        <x-submit-button-form></x-submit-button-form>
                    </form>
                </div>
            </div>




            <?php
            $queryArrays = [$query, $query1, $query2, $query3, $query4]
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
                        <th scope="col">Kabupaten</th>
                        <th scope="col">IRL</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($queryArrays[$i] as $data)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $data->kabupaten }}</td>
                            <td>{{ $data->irl }}</td>
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
                $irl[] = $data->irl;
            }
            foreach ($query1 as $data1) {
                $kabupaten1[] = $data1->kabupaten;
                $irl1[] = $data1->irl;
            }
            foreach ($query2 as $data2) {
                $kabupaten2[] = $data2->kabupaten;
                $irl2[] = $data2->irl;
            }
            foreach ($query3 as $data3) {
                $kabupaten3[] = $data3->kabupaten;
                $irl3[] = $data3->irl;
            }
            foreach ($query4 as $data4) {
                $kabupaten4[] = $data4->kabupaten;
                $irl4[] = $data4->irl;
            }
            ?>


        </div>



        <script>
            var data = {
                labels: <?php echo json_encode($kabupaten) ?>,
                datasets: [{
                    label: "Imunisasi Rutin Lengkap (IRL)",
                    backgroundColor: 'rgba(240, 168, 36)',
                    data: <?php echo json_encode($irl) ?>,
                }]
            };

            var options = {
                scales: {
                    xAxes: [{
                        ticks: {
                            autoSkip: false,
                            maxRotation: 90,
                            minRotation: 90,
                        }
                    }],
                    yAxes: [{
                        stacked: false,
                        ticks: {
                            beginAtZero: true,
                            userCallback: function(label, index, labels) {
                                // when the floored value is the same as the value we have a whole number
                                if (Math.floor(label) === label) {
                                    return label;
                                }
                            },
                        },
                    }]

                },
                title: {
                    display: true,
                    text: 'Total IRL Tahunan Tiap Kabupaten',
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
                labels: <?php echo json_encode($kabupaten1) ?>,
                datasets: [{
                    label: "Imunisasi Rutin Lengkap (IRL)",
                    backgroundColor: 'rgba(240, 168, 36)',
                    data: <?php echo json_encode($irl1) ?>,
                }]
            };

            var options = {
                scales: {
                    xAxes: [{
                        ticks: {
                            autoSkip: false,
                            maxRotation: 90,
                            minRotation: 90,
                        }
                    }],
                    yAxes: [{
                        stacked: false,
                        ticks: {
                            beginAtZero: true,
                            userCallback: function(label, index, labels) {
                                // when the floored value is the same as the value we have a whole number
                                if (Math.floor(label) === label) {
                                    return label;
                                }
                            },
                        },
                    }]

                },
                title: {
                    display: true,
                    text: 'Akumulasi IRL Triwulan 1 Tiap Kabupaten',
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
                labels: <?php echo json_encode($kabupaten2) ?>,
                datasets: [{
                    label: "Imunisasi Rutin Lengkap (IRL)",
                    backgroundColor: 'rgba(240, 168, 36)',
                    data: <?php echo json_encode($irl2) ?>,
                }]
            };

            var options = {
                scales: {
                    xAxes: [{
                        ticks: {
                            autoSkip: false,
                            maxRotation: 90,
                            minRotation: 90,
                        }
                    }],
                    yAxes: [{
                        stacked: false,
                        ticks: {
                            beginAtZero: true,
                            userCallback: function(label, index, labels) {
                                // when the floored value is the same as the value we have a whole number
                                if (Math.floor(label) === label) {
                                    return label;
                                }
                            },
                        },
                    }]

                },
                title: {
                    display: true,
                    text: 'Akumulasi IRL Triwulan 2 Tiap Kabupaten',
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
                labels: <?php echo json_encode($kabupaten3) ?>,
                datasets: [{
                    label: "Imunisasi Rutin Lengkap (IRL)",
                    backgroundColor: 'rgba(240, 168, 36)',
                    data: <?php echo json_encode($irl3) ?>,
                }]
            };

            var options = {
                scales: {
                    xAxes: [{
                        ticks: {
                            autoSkip: false,
                            maxRotation: 90,
                            minRotation: 90,
                        }
                    }],
                    yAxes: [{
                        stacked: false,
                        ticks: {
                            beginAtZero: true,
                            userCallback: function(label, index, labels) {
                                // when the floored value is the same as the value we have a whole number
                                if (Math.floor(label) === label) {
                                    return label;
                                }
                            },
                        },
                    }]

                },
                title: {
                    display: true,
                    text: 'Akumulasi IRL Triwulan 3 Tiap Kabupaten',
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
                labels: <?php echo json_encode($kabupaten4) ?>,
                datasets: [{
                    label: "Imunisasi Rutin Lengkap (IRL)",
                    backgroundColor: 'rgba(240, 168, 36)',
                    data: <?php echo json_encode($irl4) ?>,
                }]
            };

            var options = {
                scales: {
                    xAxes: [{
                        ticks: {
                            autoSkip: false,
                            maxRotation: 90,
                            minRotation: 90,
                        }
                    }],
                    yAxes: [{
                        stacked: false,
                        ticks: {
                            beginAtZero: true,
                            userCallback: function(label, index, labels) {
                                // when the floored value is the same as the value we have a whole number
                                if (Math.floor(label) === label) {
                                    return label;
                                }
                            },
                        },
                    }]

                },
                title: {
                    display: true,
                    text: 'Akumulasi IRL Triwulan 4 Tiap Kabupaten',
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
    </div>
@endsection
</html>
