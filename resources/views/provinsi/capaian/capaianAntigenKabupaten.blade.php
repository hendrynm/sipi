{{--http://localhost:8080/project_sipi/ketercapaian-kabupaten.php
--}}

@extends("_partials.master")
@section("title","Ketercapaian Imunisasi Setiap Kabupaten")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="./dashboard" class="btn btn-primary">Back</a>
        <hr>
        <h1>Ketercapaian Imunisasi Setiap Kabupaten</h1>
        <div class="jumbotron">
            <form method="get">
                <x-antigen-form :antigenForm="$antigenForm" :antigens="$antigens"></x-antigen-form>
                <x-year-form :tahunForm="$tahunForm"></x-year-form>
                <x-submit-button-form></x-submit-button-form>
            </form>

            <?php
            foreach ($query as $data) {
                $kabupaten[] = $data->kabupaten;
                $jumlah[] = $data->jumlah;
                $jumlahP[] = $data->jumlahP;
                $jumlahL[] = $data->jumlahL;
                $target[] = $data->target;
            }
            foreach ($query1 as $data1) {
                $kabupaten1[] = $data1->kabupaten;
                $jumlah1[] = $data1->jumlah;
                $jumlahP1[] = $data1->jumlahP;
                $jumlahL1[] = $data1->jumlahL;
                $target1[] = $data1->target;
            }
            foreach ($query2 as $data2) {
                $kabupaten2[] = $data2->kabupaten;
                $jumlah2[] = $data2->jumlah;
                $jumlahP2[] = $data2->jumlahP;
                $jumlahL2[] = $data2->jumlahL;
                $target2[] = $data2->target;
            }
            foreach ($query3 as $data3) {
                $kabupaten3[] = $data3->kabupaten;
                $jumlah3[] = $data3->jumlah;
                $jumlahP3[] = $data3->jumlahP;
                $jumlahL3[] = $data3->jumlahL;
                $target3[] = $data3->target;
            }
            foreach ($query4 as $data4) {
                $kabupaten4[] = $data4->kabupaten;
                $jumlah4[] = $data4->jumlah;
                $jumlahP4[] = $data4->jumlahP;
                $jumlahL4[] = $data4->jumlahL;
                $target4[] = $data4->target;
            }
            foreach ($query5 as $data5) {
                $kabupaten5[] = $data5->kabupaten;
                $jumlah5[] = $data5->jumlah;
                $jumlahP5[] = $data5->jumlahP;
                $jumlahL5[] = $data5->jumlahL;
                $target5[] = $data5->target;
            }
            foreach ($query6 as $data6) {
                $kabupaten6[] = $data6->kabupaten;
                $jumlah6[] = $data6->jumlah;
                $jumlahP6[] = $data6->jumlahP;
                $jumlahL6[] = $data6->jumlahL;
                $target6[] = $data6->target;
            }
            foreach ($query7 as $data7) {
                $kabupaten7[] = $data7->kabupaten;
                $jumlah7[] = $data7->jumlah;
                $jumlahP7[] = $data7->jumlahP;
                $jumlahL7[] = $data7->jumlahL;
                $target7[] = $data7->target;
            }
            foreach ($query8 as $data8) {
                $kabupaten8[] = $data8->kabupaten;
                $jumlah8[] = $data8->jumlah;
                $jumlahP8[] = $data8->jumlahP;
                $jumlahL8[] = $data8->jumlahL;
                $target8[] = $data8->target;
            }
            foreach ($query9 as $data9) {
                $kabupaten9[] = $data9->kabupaten;
                $jumlah9[] = $data9->jumlah;
                $jumlahP9[] = $data9->jumlahP;
                $jumlahL9[] = $data9->jumlahL;
                $target9[] = $data9->target;
            }
            foreach ($query10 as $data10) {
                $kabupaten10[] = $data10->kabupaten;
                $jumlah10[] = $data10->jumlah;
                $jumlahP10[] = $data10->jumlahP;
                $jumlahL10[] = $data10->jumlahL;
                $target10[] = $data10->target;
            }
            foreach ($query11 as $data11) {
                $kabupaten11[] = $data11->kabupaten;
                $jumlah11[] = $data11->jumlah;
                $jumlahP11[] = $data11->jumlahP;
                $jumlahL11[] = $data11->jumlahL;
                $target11[] = $data11->target;
            }
            foreach ($query12 as $data12) {
                $kabupaten12[] = $data12->kabupaten;
                $jumlah12[] = $data12->jumlah;
                $jumlahP12[] = $data12->jumlahP;
                $jumlahL12[] = $data12->jumlahL;
                $target12[] = $data12->target;
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

            for (var i = 0; i < 12; i++) {
                myHTML += '<div style="height: 500px;"><canvas id="myChart' + (i + 1) + '"></canvas><br><br></div>';
            }

            wrapper.innerHTML = myHTML

        </script>


        <script>
            var data = {
                labels: <?php echo json_encode($kabupaten) ?>,
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
                    text: 'Target dan Realisasi Tahunan Tiap Kabupaten',
                    fontSize: 16,
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
                    text: 'Realisasi Imunisasi Tiap Kabupaten Bulan Januari',
                    fontSize: 16,
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
                    text: 'Realisasi Imunisasi Tiap Kabupaten Bulan Februari',
                    fontSize: 16,
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
                    text: 'Realisasi Imunisasi Tiap Kabupaten Bulan Maret',
                    fontSize: 16,
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
                    text: 'Realisasi Imunisasi Tiap Kabupaten Bulan April',
                    fontSize: 16,
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
                labels: <?php echo json_encode($kabupaten5) ?>,
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
                    text: 'Realisasi Imunisasi Tiap Kabupaten Bulan Mei',
                    fontSize: 16,
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
                labels: <?php echo json_encode($kabupaten6) ?>,
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
                    text: 'Realisasi Imunisasi Tiap Kabupaten Bulan Juni',
                    fontSize: 16,
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
                labels: <?php echo json_encode($kabupaten7) ?>,
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
                    text: 'Realisasi Imunisasi Tiap Kabupaten Bulan Juli',
                    fontSize: 16,
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
                labels: <?php echo json_encode($kabupaten8) ?>,
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
                    text: 'Realisasi Imunisasi Tiap Kabupaten Bulan Agustus',
                    fontSize: 16,
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
                labels: <?php echo json_encode($kabupaten9) ?>,
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
                    text: 'Realisasi Imunisasi Tiap Kabupaten Bulan September',
                    fontSize: 16,
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
                labels: <?php echo json_encode($kabupaten10) ?>,
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
                    text: 'Realisasi Imunisasi Tiap Kabupaten Bulan Oktober',
                    fontSize: 16,
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
                labels: <?php echo json_encode($kabupaten11) ?>,
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
                    text: 'Realisasi Imunisasi Tiap Kabupaten Bulan November',
                    fontSize: 16,
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
                labels: <?php echo json_encode($kabupaten12) ?>,
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
                    text: 'Realisasi Imunisasi Tiap Kabupaten Bulan Desember',
                    fontSize: 16,
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
