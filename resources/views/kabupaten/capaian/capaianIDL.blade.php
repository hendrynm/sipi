@extends("_partials.master")
@section("title","Capaian Per Kabupaten/Kota")

<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="./dashboard" class="btn btn-primary">Back</a>
        <hr>
        <h1>Laporan Capaian Anak IDL</h1>
        <div class="jumbotron">
            <form method="get">
                <x-kabupaten-form :kabupatenForm="$kabupatenForm" :kabupatens="$kabupatens"></x-kabupaten-form>
                <x-year-form :tahunForm="$tahunForm"></x-year-form>
                <x-submit-button-form></x-submit-button-form>
            </form>

            <?php
            foreach ($query as $data) {
                $kabupaten[] = $data->kabupaten;
                $puskesmas[] = $data->puskesmas;
                $idl[] = $data->idl;
                $sasaran[] = $data->sasaran;
            }
            foreach ($query1 as $data1) {
                $kabupaten1[] = $data1->kabupaten;
                $puskesmas1[] = $data1->puskesmas;
                $idl1[] = $data1->idl;
                $sasaran1[] = $data1->sasaran;
            }
            foreach ($query2 as $data2) {
                $kabupaten2[] = $data2->kabupaten;
                $puskesmas2[] = $data2->puskesmas;
                $idl2[] = $data2->idl;
                $sasaran2[] = $data2->sasaran;
            }
            foreach ($query3 as $data3) {
                $kabupaten3[] = $data3->kabupaten;
                $puskesmas3[] = $data3->puskesmas;
                $idl3[] = $data3->idl;
                $sasaran3[] = $data3->sasaran;
            }
            foreach ($query4 as $data4) {
                $kabupaten4[] = $data4->kabupaten;
                $puskesmas4[] = $data4->puskesmas;
                $idl4[] = $data4->idl;
                $sasaran4[] = $data4->sasaran;
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
                labels: <?php echo json_encode($puskesmas) ?>,
                datasets: [{
                    label: "Imunisasi Dasar Lengkap (IDL)",
                    backgroundColor: 'rgba(240, 168, 36)',
                    data: <?php echo json_encode($idl) ?>,
                    xAxisID: "bar-x-axis1",
                }, {
                    label: "Sasaran",
                    backgroundColor: 'rgba(156, 153, 145, 0.4)',
                    data: <?php echo json_encode($sasaran) ?>,
                    xAxisID: "bar-x-axis2",
                }]
            };

            var options = {
                scales: {
                    xAxes: [{
                        stacked: true,
                        id: "bar-x-axis1",
                        barThickness: 20,
                        ticks: {
                            autoSkip: false,
                            maxRotation: 90,
                            minRotation: 90,
                        }
                    }, {
                        display: false,
                        stacked: true,
                        id: "bar-x-axis2",
                        barThickness: 35,
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
                    text: 'Total Sasaran dan IDL Tahunan Tiap Puskesmas',
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
                labels: <?php echo json_encode($puskesmas1) ?>,
                datasets: [{
                    label: "Imunisasi Lengkap (IDL)",
                    backgroundColor: 'rgba(240, 168, 36)',
                    data: <?php echo json_encode($idl1) ?>,
                    xAxisID: "bar-x-axis1",
                }, {
                    label: "Sasaran",
                    backgroundColor: 'rgba(156, 153, 145, 0.4)',
                    data: <?php echo json_encode($sasaran1) ?>,
                    xAxisID: "bar-x-axis2",
                }]
            };

            var options = {
                scales: {
                    xAxes: [{
                        stacked: true,
                        id: "bar-x-axis1",
                        barThickness: 20,
                        ticks: {
                            autoSkip: false,
                            maxRotation: 90,
                            minRotation: 90,
                        }
                    }, {
                        display: false,
                        stacked: true,
                        id: "bar-x-axis2",
                        barThickness: 35,
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
                    text: 'Target (20% Sasaran) dan IDL Quarter 1 Tiap Puskesmas',
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
                labels: <?php echo json_encode($puskesmas2) ?>,
                datasets: [{
                    label: "Imunisasi Lengkap (IDL)",
                    backgroundColor: 'rgba(240, 168, 36)',
                    data: <?php echo json_encode($idl2) ?>,
                    xAxisID: "bar-x-axis1",
                }, {
                    label: "Sasaran",
                    backgroundColor: 'rgba(156, 153, 145, 0.4)',
                    data: <?php echo json_encode($sasaran2) ?>,
                    xAxisID: "bar-x-axis2",
                }]
            };

            var options = {
                scales: {
                    xAxes: [{
                        stacked: true,
                        id: "bar-x-axis1",
                        barThickness: 20,
                        ticks: {
                            autoSkip: false,
                            maxRotation: 90,
                            minRotation: 90,
                        }
                    }, {
                        display: false,
                        stacked: true,
                        id: "bar-x-axis2",
                        barThickness: 35,
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
                    text: 'Target (40% Sasaran) dan IDL Quarter 2 Tiap Puskesmas',
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
                labels: <?php echo json_encode($puskesmas3) ?>,
                datasets: [{
                    label: "Imunisasi Lengkap (IDL)",
                    backgroundColor: 'rgba(240, 168, 36)',
                    data: <?php echo json_encode($idl3) ?>,
                    xAxisID: "bar-x-axis1",
                }, {
                    label: "Sasaran",
                    backgroundColor: 'rgba(156, 153, 145, 0.4)',
                    data: <?php echo json_encode($sasaran3) ?>,
                    xAxisID: "bar-x-axis2",
                }]
            };

            var options = {
                scales: {
                    xAxes: [{
                        stacked: true,
                        id: "bar-x-axis1",
                        barThickness: 20,
                        ticks: {
                            autoSkip: false,
                            maxRotation: 90,
                            minRotation: 90,
                        }
                    }, {
                        display: false,
                        stacked: true,
                        id: "bar-x-axis2",
                        barThickness: 35,
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
                    text: 'Target (60% Sasaran) dan IDL Quarter 3 Tiap Puskesmas',
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
                labels: <?php echo json_encode($puskesmas4) ?>,
                datasets: [{
                    label: "Imunisasi Lengkap (IDL)",
                    backgroundColor: 'rgba(240, 168, 36)',
                    data: <?php echo json_encode($idl4) ?>,
                    xAxisID: "bar-x-axis1",
                }, {
                    label: "Sasaran",
                    backgroundColor: 'rgba(156, 153, 145, 0.4)',
                    data: <?php echo json_encode($sasaran4) ?>,
                    xAxisID: "bar-x-axis2",
                }]
            };

            var options = {
                scales: {
                    xAxes: [{
                        stacked: true,
                        id: "bar-x-axis1",
                        barThickness: 20,
                        ticks: {
                            autoSkip: false,
                            maxRotation: 90,
                            minRotation: 90,
                        }
                    }, {
                        display: false,
                        stacked: true,
                        id: "bar-x-axis2",
                        barThickness: 35,
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
                    text: 'Target (80% Sasaran) dan IDL Quarter 4 Tiap Puskesmas',
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
