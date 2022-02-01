{{--http://localhost:8080/project_sipi/antigen-kabupaten.php--}}

@extends("_partials.master")
@section("title","Ketercapaian Imunisasi Setiap Antigen Pada Kabupaten")
<!DOCTYPE html>
<html lang="id">
@section("konten")
    <div class="container">
        <a href="./dashboard" class="btn btn-primary">Back</a>
        <hr>
        <h1>Ketercapaian Imunisasi Setiap Antigen Pada Kabupaten</h1>

        <div class="jumbotron">
            <form method="get">
                <x-kabupaten-form :kabupatenForm="$kabupatenForm" :kabupatens="$kabupatens"></x-kabupaten-form>
                <x-year-form :tahunForm="$tahunForm"></x-year-form>
                <x-submit-button-form></x-submit-button-form>
            </form>

            <div style="height: 500px;">
                <canvas id="myChart"></canvas>
            </div>

            <br>
            <br>

            <div id="myHTMLWrapper">
            </div>
        </div>
    </div>

    <?php

    foreach ($query as $data) {
        $kabupaten[] = $data->kabupaten;
        $antigen[] = $data->antigen;
        $jumlah[] = $data->jumlah;
        $target[] = $data->target;
    }

    foreach ($query1 as $data1) {
        $kabupate1[] = $data1->kabupaten;
        $antigen1[] = $data1->antigen;
        $jumlah1[] = $data1->jumlah;
        $target1[] = $data1->target;
    }

    foreach ($query2 as $data2) {
        $kabupate2[] = $data2->kabupaten;
        $antigen2[] = $data2->antigen;
        $jumlah2[] = $data2->jumlah;
        $target2[] = $data2->target;
    }

    foreach ($query3 as $data3) {
        $kabupate3[] = $data3->kabupaten;
        $antigen3[] = $data3->antigen;
        $jumlah3[] = $data3->jumlah;
        $target3[] = $data3->target;
    }

    foreach ($query4 as $data4) {
        $kabupate4[] = $data4->kabupaten;
        $antigen4[] = $data4->antigen;
        $jumlah4[] = $data4->jumlah;
        $target4[] = $data4->target;
    }

    foreach ($query5 as $data5) {
        $kabupate5[] = $data5->kabupaten;
        $antigen5[] = $data5->antigen;
        $jumlah5[] = $data5->jumlah;
        $target5[] = $data5->target;
    }

    foreach ($query6 as $data6) {
        $kabupate6[] = $data6->kabupaten;
        $antigen6[] = $data6->antigen;
        $jumlah6[] = $data6->jumlah;
        $target6[] = $data6->target;
    }

    foreach ($query7 as $data7) {
        $kabupate7[] = $data7->kabupaten;
        $antigen7[] = $data7->antigen;
        $jumlah7[] = $data7->jumlah;
        $target7[] = $data7->target;
    }

    foreach ($query8 as $data8) {
        $kabupate8[] = $data8->kabupaten;
        $antigen8[] = $data8->antigen;
        $jumlah8[] = $data8->jumlah;
        $target8[] = $data8->target;
    }

    foreach ($query9 as $data9) {
        $kabupate9[] = $data9->kabupaten;
        $antigen9[] = $data9->antigen;
        $jumlah9[] = $data9->jumlah;
        $target9[] = $data9->target;
    }

    foreach ($query10 as $data10) {
        $kabupate10[] = $data10->kabupaten;
        $antigen10[] = $data10->antigen;
        $jumlah10[] = $data10->jumlah;
        $target10[] = $data10->target;
    }

    foreach ($query11 as $data11) {
        $kabupate11[] = $data11->kabupaten;
        $antigen11[] = $data11->antigen;
        $jumlah11[] = $data11->jumlah;
        $target11[] = $data11->target;
    }

    foreach ($query12 as $data12) {
        $kabupate12[] = $data12->kabupaten;
        $antigen12[] = $data12->antigen;
        $jumlah12[] = $data12->jumlah;
        $target12[] = $data12->target;
    }
    ?>

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
            labels: <?php echo json_encode($antigen, true) ?>,
            datasets: [{
                label: "Jumlah Imunisasi",
                backgroundColor: 'rgba(73, 110, 196)',
                data: <?php echo json_encode($jumlah, true) ?>,
                xAxisID: "bar-x-axis1",
            }, {
                label: "Target",
                backgroundColor: 'rgba(156, 153, 145, 0.4)',
                data: <?php echo json_encode($target, true) ?>,
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
                text: 'Target dan Realisasi Imunisasi Tahunan Tiap Antigen',
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
            labels: <?php echo json_encode($antigen1, true) ?>,
            datasets: [{
                label: "Imunisasi Lengkap (IDL)",
                backgroundColor: 'rgba(240, 168, 36)',
                data: <?php echo json_encode($jumlah1, true) ?>,
                xAxisID: "bar-x-axis1",
            }, {
                label: "Sasaran",
                backgroundColor: 'rgba(156, 153, 145, 0.4)',
                data: <?php echo json_encode($target1, true) ?>,
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
                text: 'Target dan Realisasi Bulan Januari Tiap antigen',
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
            labels: <?php echo json_encode($antigen2, true) ?>,
            datasets: [{
                label: "Imunisasi Lengkap (IDL)",
                backgroundColor: 'rgba(240, 168, 36)',
                data: <?php echo json_encode($jumlah2, true) ?>,
                xAxisID: "bar-x-axis1",
            }, {
                label: "Sasaran",
                backgroundColor: 'rgba(156, 153, 145, 0.4)',
                data: <?php echo json_encode($target2, true) ?>,
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
                text: 'Target dan Realisasi Bulan Februari Tiap antigen',
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
            labels: <?php echo json_encode($antigen3, true) ?>,
            datasets: [{
                label: "Imunisasi Lengkap (IDL)",
                backgroundColor: 'rgba(240, 168, 36)',
                data: <?php echo json_encode($jumlah3, true) ?>,
                xAxisID: "bar-x-axis1",
            }, {
                label: "Sasaran",
                backgroundColor: 'rgba(156, 153, 145, 0.4)',
                data: <?php echo json_encode($target3, true) ?>,
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
                text: 'Target dan Realisasi Bulan Maret Tiap antigen',
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
            labels: <?php echo json_encode($antigen4, true) ?>,
            datasets: [{
                label: "Imunisasi Lengkap (IDL)",
                backgroundColor: 'rgba(240, 168, 36)',
                data: <?php echo json_encode($jumlah4, true) ?>,
                xAxisID: "bar-x-axis1",
            }, {
                label: "Sasaran",
                backgroundColor: 'rgba(156, 153, 145, 0.4)',
                data: <?php echo json_encode($target4, true) ?>,
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
                text: 'Target dan Realisasi Bulan April Tiap antigen',
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
            labels: <?php echo json_encode($antigen5, true) ?>,
            datasets: [{
                label: "Imunisasi Lengkap (IDL)",
                backgroundColor: 'rgba(240, 168, 36)',
                data: <?php echo json_encode($jumlah5, true) ?>,
                xAxisID: "bar-x-axis1",
            }, {
                label: "Sasaran",
                backgroundColor: 'rgba(156, 153, 145, 0.4)',
                data: <?php echo json_encode($target5, true) ?>,
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
                text: 'Target dan Realisasi Bulan Mei Tiap antigen',
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
            labels: <?php echo json_encode($antigen6, true) ?>,
            datasets: [{
                label: "Imunisasi Lengkap (IDL)",
                backgroundColor: 'rgba(240, 168, 36)',
                data: <?php echo json_encode($jumlah6, true) ?>,
                xAxisID: "bar-x-axis1",
            }, {
                label: "Sasaran",
                backgroundColor: 'rgba(156, 153, 145, 0.4)',
                data: <?php echo json_encode($target6, true) ?>,
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
                text: 'Target dan Realisasi Bulan Juni Tiap antigen',
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
            labels: <?php echo json_encode($antigen7, true) ?>,
            datasets: [{
                label: "Imunisasi Lengkap (IDL)",
                backgroundColor: 'rgba(240, 168, 36)',
                data: <?php echo json_encode($jumlah7, true) ?>,
                xAxisID: "bar-x-axis1",
            }, {
                label: "Sasaran",
                backgroundColor: 'rgba(156, 153, 145, 0.4)',
                data: <?php echo json_encode($target7, true) ?>,
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
                text: 'Target dan Realisasi Bulan Juli Tiap antigen',
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
            labels: <?php echo json_encode($antigen8, true) ?>,
            datasets: [{
                label: "Imunisasi Lengkap (IDL)",
                backgroundColor: 'rgba(240, 168, 36)',
                data: <?php echo json_encode($jumlah8, true) ?>,
                xAxisID: "bar-x-axis1",
            }, {
                label: "Sasaran",
                backgroundColor: 'rgba(156, 153, 145, 0.4)',
                data: <?php echo json_encode($target8, true) ?>,
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
                text: 'Target dan Realisasi Bulan Agustus Tiap antigen',
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
            labels: <?php echo json_encode($antigen9, true) ?>,
            datasets: [{
                label: "Imunisasi Lengkap (IDL)",
                backgroundColor: 'rgba(240, 168, 36)',
                data: <?php echo json_encode($jumlah9, true) ?>,
                xAxisID: "bar-x-axis1",
            }, {
                label: "Sasaran",
                backgroundColor: 'rgba(156, 153, 145, 0.4)',
                data: <?php echo json_encode($target9, true) ?>,
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
                text: 'Target dan Realisasi Bulan September Tiap antigen',
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
            labels: <?php echo json_encode($antigen10, true) ?>,
            datasets: [{
                label: "Imunisasi Lengkap (IDL)",
                backgroundColor: 'rgba(240, 168, 36)',
                data: <?php echo json_encode($jumlah10, true) ?>,
                xAxisID: "bar-x-axis1",
            }, {
                label: "Sasaran",
                backgroundColor: 'rgba(156, 153, 145, 0.4)',
                data: <?php echo json_encode($target10, true) ?>,
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
                text: 'Target dan Realisasi Bulan Oktober Tiap antigen',
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
            labels: <?php echo json_encode($antigen11, true) ?>,
            datasets: [{
                label: "Imunisasi Lengkap (IDL)",
                backgroundColor: 'rgba(240, 168, 36)',
                data: <?php echo json_encode($jumlah11, true) ?>,
                xAxisID: "bar-x-axis1",
            }, {
                label: "Sasaran",
                backgroundColor: 'rgba(156, 153, 145, 0.4)',
                data: <?php echo json_encode($target11, true) ?>,
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
                text: 'Target dan Realisasi Bulan November Tiap antigen',
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
            labels: <?php echo json_encode($antigen12, true) ?>,
            datasets: [{
                label: "Imunisasi Lengkap (IDL)",
                backgroundColor: 'rgba(240, 168, 36)',
                data: <?php echo json_encode($jumlah12, true) ?>,
                xAxisID: "bar-x-axis1",
            }, {
                label: "Sasaran",
                backgroundColor: 'rgba(156, 153, 145, 0.4)',
                data: <?php echo json_encode($target12, true) ?>,
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
                text: 'Target dan Realisasi Bulan Desember Tiap antigen',
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
@endsection
</html>
