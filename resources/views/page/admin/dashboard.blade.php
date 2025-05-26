@extends('layout.app')
@section('title', 'Dashboard')
@section('content')
    <div class="card card-secondary">
        <div class="card-header d-flex justify-content-start align-items-center" style="gap:10px; align-items:center;">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo" style="width:60px;height:60px">
            <div class="card-title" style="margin: 0px;">
                <h5 class="m-0">SMA Muhammadiyah Kasihan</h5>
                <p class="m-0">Jl. Bantul Km.5 Mirisi Tritonirmolo Kasihan Bantul Yogyakarta</p>
            </div>
        </div>
        <div class="card-body">
            <strong>Selamat Datang {{ auth()->user()->name }}</strong><br>
            Anda login sebagai <strong>{{ auth()->user()->role }}</strong>. Anda memiliki akses penuh terhadap sistem.
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-primary"><i class="far fa-user"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Users</span>
                    <span class="info-box-number">{{ $user }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fas fa-graduation-cap"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Alumni</span>
                    <span class="info-box-number">{{ $student }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="fas fa-layer-group"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Ijazah</span>
                    <span class="info-box-number">{{ $ijazah }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-university"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Jurusan</span>
                    <span class="info-box-number">{{ $prodi }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Statistik Ijazah per Tahun Lulus</h3>
                </div>
                <div class="card-body">
                    <canvas id="ijazahChart" style="max-height: 300px; width: 100%;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Statistik Alumni per Jurusan</h3>
                </div>
                <div class="card-body">
                    <canvas id="jurusanChart" style="max-height: 300px; width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        const chartIjazah = document.getElementById('ijazahChart').getContext('2d');

        const ijazahChart = new Chart(chartIjazah, {
            type: 'bar',
            data: {
                labels: @json($tahun),
                datasets: [{
                    label: 'Jumlah Ijazah',
                    data: @json($jumlah),
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Jumlah Ijazah per Tahun Lulus',
                        font: {
                            size: 18
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        const chartJurusan = document.getElementById('jurusanChart').getContext('2d');

        const jurusanChart = new Chart(chartJurusan, {
            type: 'pie',
            data: {
                labels: @json($jurusan),
                datasets: [{
                    label: 'Jumlah Siswa',
                    data: @json($jumlahJurusan),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)',
                        'rgba(199, 199, 199, 0.6)'
                    ],
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    title: {
                        display: true,
                        text: 'Jumlah Alumni per Jurusan',
                        font: {
                            size: 18
                        }
                    }
                }
            }
        });
    </script>
@endsection
