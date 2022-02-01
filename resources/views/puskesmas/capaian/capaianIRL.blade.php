@extends("_partials.master")
@section("title","Capaian Per Kabupaten/Kota")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="../dashboard" class="btn btn-primary">Back</a>
        <hr>
        <h1>Laporan Capaian Imunsasi Per Kabupanten Dan Kota</h1>
        <div class="jumbotron">
            <form method="get">
                <x-kabupaten-form :kabupatenForm="$kabupatenForm" :kabupatens="$kabupatens"></x-kabupaten-form>
                <x-puskesmas-form :puskesmasForm="$puskesmasForm" :puskesmas="$puskesmas"></x-puskesmas-form>
                <x-year-form :tahunForm="$tahunForm"></x-year-form>
                <x-submit-button-form></x-submit-button-form>
            </form>

            <?php
            foreach ($query as $data) {
                $kabupaten[] = $data->kabupaten;
                $puskesmas[] = $data->puskesmas;
                $kampung[] = $data->kampung;
                $irl[] = $data->irl;
            }
            foreach ($query1 as $data1) {
                $kabupaten1[] = $data1->kabupaten;
                $puskesmas1[] = $data1->puskesmas;
                $kampung1[] = $data1->kampung;
                $irl1[] = $data1->irl;
            }
            foreach ($query2 as $data2) {
                $kabupaten2[] = $data2->kabupaten;
                $puskesmas2[] = $data2->puskesmas;
                $kampung2[] = $data2->kampung;
                $irl2[] = $data2->irl;
            }
            foreach ($query3 as $data3) {
                $kabupaten3[] = $data3->kabupaten;
                $puskesmas3[] = $data3->puskesmas;
                $kampung3[] = $data3->kampung;
                $irl3[] = $data3->irl;
            }
            foreach ($query4 as $data4) {
                $kabupaten4[] = $data4->kabupaten;
                $puskesmas4[] = $data4->puskesmas;
                $kampung4[] = $data4->kampung;
                $irl4[] = $data4->irl;
            }
            ?>

            <div style="height: 500px;">
                <canvas id="myChart"></canvas>
            </div>

            <br>
            <br>

            <div id="myHTMLWrapper">
            </div>

        </div>

        <script>
            var wrapper = document.getElementById("myHTMLWrapper");

            var myHTML = '';

            for (var i = 0; i < 4; i++) {
                myHTML += '<div style="height: 500px;"><canvas id="myChart' + (i + 1) + '"></canvas><br><br></div>';
            }

            wrapper.innerHTML = myHTML

        </script>


        <script>
            var data = {
                labels: <?php echo json_encode($kampung) ?>,
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
                    text: 'Total Sasaran dan IRL Tahunan Tiap Kampung',
                    fontSize: 14,
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
                labels: <?php echo json_encode($kampung1) ?>,
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
                    text: 'Akumulasi IRL Quarter 1 Tiap Kampung',
                    fontSize: 14,
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
                labels: <?php echo json_encode($kampung2) ?>,
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
                    text: 'Akumulasi IRL Quarter 2 Tiap Kampung',
                    fontSize: 14,
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
                labels: <?php echo json_encode($kampung3) ?>,
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
                    text: 'Akumulasi IRL Quarter 3 Tiap Kampung',
                    fontSize: 14,
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
                labels: <?php echo json_encode($kampung4) ?>,
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
                    text: 'Akumulasi IRL Quarter 4 Tiap Kampung',
                    fontSize: 14,
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