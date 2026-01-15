<!DOCTYPE html>
<html lang="en">

<x-header>{{ $title }}</x-header>

<head>
    <style>
        body {
            background-color: #1A252F !important; /* Darker Midnight */
            color: #ECF0F1;
        }
        #content-wrapper {
            background-color: transparent !important;
        }
        .card {
            background-color: #2C3E50 !important; /* Midnight Blue */
            border: 1px solid rgba(255, 255, 255, 0.05) !important;
            border-radius: 15px !important;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4) !important;
        }
        .card-header {
            background: linear-gradient(135deg, #2C3E50 0%, #1A252F 100%) !important;
            border-bottom: 3px solid #E74C3C !important; /* Accent Red */
            padding: 20px !important;
        }
        .text-primary {
            color: #E74C3C !important;
        }
        .badge-light {
            background-color: #E74C3C !important;
            color: white !important;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: none;
        }
        .lead {
            color: #bdc3c7 !important;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
        }
        hr {
            border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
        }
        /* Efek khusus untuk canvas agar terlihat menyala */
        canvas {
            filter: drop-shadow(0px 10px 10px rgba(0,0,0,0.3));
        }
    </style>
</head>

<body id="page-top">

    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <x-topbar></x-topbar>
                <div class="container-fluid mt-5">
                    <div class="row justify-content-center align-items-center mb-5">
                        <div class="col-md-8 text-center">
                            <h2 class="font-weight-black text-white italic mb-3" style="font-style: italic; font-weight: 900; letter-spacing: -1px;">
                                PERHITUNGAN <span style="color: #E74C3C;">LANGSUNG</span>
                            </h2>
                            <p class="lead mb-0">Berikut adalah bagan penghitungan suara untuk para kandidat.</p>
                        </div>
                    </div>

                    <div class="col-xl-10 col-lg-12 mx-auto">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="m-0 font-weight-bold text-white uppercase tracking-wider">
                                    <i class="fas fa-chart-bar mr-2 text-accent" style="color: #E74C3C;"></i> 
                                    STATISTIK PEROLEHAN SUARA
                                </h6>
                                <span class="badge badge-light px-3 py-2 shadow-sm animate-pulse">
                                    <i class="fas fa-circle mr-1 small"></i> Real Time
                                </span>
                            </div>
                            <div class="card-body p-4">
                                <div class="chart-bar" style="height: 400px; position: relative;">
                                    <canvas id="myBarChart"></canvas>
                                </div>
                                <hr>
                                <div class="text-center small mt-3 text-muted">
                                    <i class="fas fa-shield-alt text-primary mr-1"></i> 
                                    Data terenkripsi dan diperbarui secara otomatis dari sistem pemungutan suara.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="chartData" data-chart-data="{{ json_encode($candidateVoteData) }}" style="display: none;">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    document.addEventListener("DOMContentLoaded", function() {
        const chartElement = document.getElementById("chartData");
        const rawData = JSON.parse(chartElement.getAttribute("data-chart-data"));

        const labels = rawData.map(item => item.name);
        const values = rawData.map(item => item.votes);

        const ctx = document.getElementById("myBarChart").getContext("2d");

        // MEMBUAT GRADIENT WARNA (Profesional Look)
        var gradientFill = ctx.createLinearGradient(0, 0, 0, 400);
        gradientFill.addColorStop(0, "rgba(231, 76, 60, 1)");   // Merah Terang (Atas)
        gradientFill.addColorStop(1, "rgba(231, 76, 60, 0.2)"); // Merah Transparan (Bawah)

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: "Perolehan Suara",
                    backgroundColor: gradientFill,
                    hoverBackgroundColor: "#E74C3C",
                    borderColor: "#E74C3C",
                    borderWidth: 2,
                    data: values,
                    borderRadius: 10, // Membuat ujung batang melengkung (modern)
                    maxBarThickness: 60,
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: { left: 10, right: 25, top: 25, bottom: 0 }
                },
                scales: {
                    xAxes: [{
                        gridLines: { display: false, drawBorder: false },
                        ticks: { 
                            maxTicksLimit: 10, 
                            fontStyle: 'bold', 
                            fontColor: '#ecf0f1',
                            fontSize: 12
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            padding: 15,
                            fontColor: '#bdc3c7',
                            fontSize: 11,
                            callback: function(value) { if (value % 1 === 0) { return value; } }
                        },
                        gridLines: {
                            color: "rgba(255, 255, 255, 0.08)", // Garis horizontal tipis transparan
                            zeroLineColor: "rgba(255, 255, 255, 0.1)",
                            drawBorder: false,
                            borderDash: [5, 5] // Garis putus-putus agar lebih estetik
                        }
                    }],
                },
                legend: { display: false },
                tooltips: {
                    titleMarginBottom: 10,
                    titleFontColor: '#ffffff',
                    titleFontSize: 16,
                    titleStyle: 'bold',
                    backgroundColor: "rgba(26, 37, 47, 0.9)", // Dark Tooltip
                    bodyFontColor: "#E74C3C",
                    bodyFontSize: 14,
                    borderColor: '#E74C3C',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return "Total: " + tooltipItem.yLabel + " Suara";
                        }
                    }
                },
                // Efek animasi masuk yang halus
                animation: {
                    duration: 2000,
                    easing: 'easeOutQuart'
                }
            }
        });
    });
    </script>

    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('template/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('template/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('template/js/demo/chart-pie-demo.js') }}"></script>
    <script src="{{ asset('template/js/demo/chart-bar-demo.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/js/demo/datatables-demo.js') }}"></script>

</body>
</html>