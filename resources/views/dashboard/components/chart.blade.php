<div class="row animate__animated animate__fadeInUp">

    <div class="col-xl-12 col-lg-12">
        <div class="card shadow-sm border-0 mb-4" style="border-radius: 15px;">
            <div class="card-header py-3 bg-white border-0 d-flex align-items-center justify-content-between" style="border-radius: 15px 15px 0 0;">
                <h5 class="m-0 font-weight-bold text-gray-800">
                    <i class="fas fa-chart-bar text-danger mr-2"></i>Hasil Suara Langsung
                </h5>
                <span class="badge badge-light text-muted p-2">
                    <i class="fas fa-sync-alt fa-spin mr-1"></i> Live Update
                </span>
            </div>
            <div class="card-body">
                <div class="chart-bar" style="position: relative; height: 400px;">
                    <canvas id="myBarChart" aria-label="Vote Count Chart" role="img"></canvas>
                </div>
                <div class="text-xs font-weight-bold text-accent text-uppercase mb-1 tracking-wider">
                <a href="{{ route('dashboard.generate-pdf') }}" target="_blank" class="btn btn-white btn-sm text-danger border-right bg-dark border-0">
                    <i class="fas fa-file-pdf mr-1"></i> AKHIRI SESI & UNDUH LAPORAN
                </a>
            </div>
                <hr class="mt-4">
                <div class="small text-muted italic">
                    <i class="fas fa-info-circle mr-1"></i> Data mewakili total suara sah per kandidat.
                </div>
                
            </div>
        </div>
    </div>

</div>

<div id="chartData" data-chart-data="{{ json_encode($candidateVoteData) }}" style="display: none;"></div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const chartElement = document.getElementById('chartData');
        const candidateData = JSON.parse(chartElement.dataset.chartData);

        const labels = candidateData.map(data => data.label);
        const votes = candidateData.map(data => data.votes);

        const ctx = document.getElementById("myBarChart").getContext('2d');
        
        // Membuat Gradien Warna untuk Bar
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(231, 74, 59, 1)');   // Merah solid (Danger)
        gradient.addColorStop(1, 'rgba(231, 74, 59, 0.3)'); // Merah transparan

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: "Total Votes",
                    backgroundColor: gradient,
                    hoverBackgroundColor: "#be2617",
                    borderColor: "#e74a3b",
                    borderWidth: 1,
                    borderRadius: 8, // Membuat bar melengkung di ujung
                    data: votes,
                    maxBarThickness: 50,
                }],
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                layout: {
                    padding: { left: 10, right: 25, top: 25, bottom: 0 }
                },
                scales: {
                    x: {
                        grid: { display: false, drawBorder: false },
                        ticks: { color: "#858796", font: { weight: 'bold' } }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: "rgb(234, 236, 244)", drawBorder: false, borderDash: [2] },
                        ticks: {
                            stepSize: 1,
                            color: "#858796",
                            callback: function(value) { return value + ' Votes'; }
                        }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyColor: "#858796",
                        titleMarginBottom: 10,
                        titleColor: '#6e707e',
                        titleFont: { size: 14, weight: 'bold' },
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        intersect: false,
                        mode: 'index',
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem) {
                                return 'Total: ' + tooltipItem.raw + ' votes';
                            }
                        }
                    }
                }
            }
        });
    });
</script>