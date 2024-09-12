<x-admin-layout>
    <!-- Header from previous code -->
    <div class="bg-white shadow-md rounded-lg p-4">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold">Dashboard</h2>
        </div>
    </div>

    <!-- FontAwesome CDN (optional, for icons) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <div class="container mx-auto mt-4 px-4">
        <!-- Row for Scorecards -->
        <div class="flex gap-4 mb-4 p-4">
            <!-- Scorecard 1 -->
            <div class="w-full sm:w-1/2 lg:w-1/4">
                <div class="card bg-white shadow-md rounded-lg p-6">
                    <div class="flex">
                        <div class="flex-1">
                            <p class="text-base mb-0 text-uppercase font-weight-bold">Total Resiko</p>
                            <h4 class="font-weight-bolder text-xl">
                                {{ $totalResiko }}
                            </h4>
                        </div>
                        <div class="flex-shrink-0 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="fas fa-exclamation-triangle text-2xl text-primary" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Scorecard 2 -->
            <div class="w-full sm:w-1/2 lg:w-1/4">
                <div class="card bg-white shadow-md rounded-lg p-6">
                    <div class="flex">
                        <div class="flex-1">
                            <p class="text-base mb-0 text-uppercase font-weight-bold">Kategori Resiko</p>
                            <h4 class="font-weight-bolder text-xl">
                                {{ $totalKategoriResiko }}
                            </h4>
                        </div>
                        <div class="flex-shrink-0 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i class="fas fa-project-diagram text-2xl text-success" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Scorecard 3 -->
            <div class="w-full sm:w-1/2 lg:w-1/4">
                <div class="card bg-white shadow-md rounded-lg p-6">
                    <div class="flex">
                        <div class="flex-1">
                            <p class="text-base mb-0 text-uppercase font-weight-bold">Pending Tasks</p>
                            <h4 class="font-weight-bolder text-xl">
                                76
                            </h4>
                        </div>
                        <div class="flex-shrink-0 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="fas fa-tasks text-2xl text-warning" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Scorecard 4 -->
            <div class="w-full sm:w-1/2 lg:w-1/4">
                <div class="card bg-white shadow-md rounded-lg p-6">
                    <div class="flex">
                        <div class="flex-1">
                            <p class="text-base mb-0 text-uppercase font-weight-bold">Jumlah Pengguna</p>
                            <h4 class="font-weight-bolder text-xl">
                                {{ $totalUsers }}
                            </h4>
                        </div>
                        <div class="flex-shrink-0 text-end">
                            <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                <i class="fas fa-users text-2xl text-info" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row for Charts and Calendar -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <!-- Bar Chart -->
            <div class="bg-white shadow-md rounded-lg p-4 h-64">
                <h6 class="text-lg font-bold mb-4">Jumlah Resiko Tim</h6>
                <canvas id="barChart" class="h-full w-full"></canvas>
            </div>

            <!-- Line Chart and Calendar Side by Side -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Line Chart -->
                <div class="bg-white shadow-md rounded-lg p-4 h-64">
                    <h6 class="text-lg font-bold mb-4">Total Resiko Per Bulan</h6>
                    <canvas id="lineChart" class="h-full w-full"></canvas>
                </div>

                <!-- Calendar -->
                <div class="bg-white shadow-md rounded-lg p-4 h-48">
                    <h6 class="text-lg font-bold mb-4">Kalender</h6>
                    <div id="calendar" class="h-full w-full"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- FullCalendar CDN -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Bar Chart
            const ctxBar = document.getElementById('barChart').getContext('2d');
            new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: ['Tim A', 'Tim B', 'Tim C', 'Tim D'], // Label untuk tiap batang
                    datasets: [
                        {
                            label: 'Tinggi',
                            data: [25, 40, 15, 30], // Data untuk kategori "Tinggi"
                            backgroundColor: '#2c94cc', // Warna biru baru (#2c94cc)
                        },
                        {
                            label: 'Sangat Tinggi',
                            data: [40, 20, 35, 45], // Data untuk kategori "Sangat Tinggi"
                            backgroundColor: '#e48c3c', // Warna merah baru (#e48c3c)
                        }
                    ]
                },
                options: {
                    plugins: {
                        legend: {
                            position: 'bottom', // Posisi legenda di bawah chart
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 50 // Menentukan skala maksimum pada sumbu y
                        }
                    }
                }
            });

            // Line Chart for Total Resiko Per Bulan
            const ctxLine = document.getElementById('lineChart').getContext('2d');
            const monthlyResiko = @json($monthlyRiskData);
            new Chart(ctxLine, {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    datasets: [{
                        label: 'Total Resiko',
                        data: Object.values(monthlyResiko), // Mengambil nilai total resiko per bulan
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: true,
                }
            });

            // Calendar
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
            });
            calendar.render();
        });
    </script>
</x-admin-layout>
