@extends('layouts.template')
    @section('content')
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">Dashboard Admin Penjualan Skincare Wardah</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-download"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                        <a href="#" class="dropdown-item">Export PDF</a>
                        <a href="#" class="dropdown-item">Export Excel</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>Rp 12,500,000</h3>
                                <p>Total Penjualan Hari Ini</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <a href="#" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>125</h3>
                                <p>Transaksi Hari Ini</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <a href="#" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>43</h3>
                                <p>Produk Terjual Hari Ini</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-box"></i>
                            </div>
                            <a href="#" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>15</h3>
                                <p>Stock Hampir Habis</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <a href="#" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Grafik Penjualan (6 Bulan Terakhir)</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="salesChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Produk Terlaris</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <ul class="products-list product-list-in-card pl-2 pr-2">
                                    <li class="item">
                                        <div class="product-img">
                                            <img src="{{ asset('img/wardah-lightening-day-cream.jpg') }}" alt="Lightening Day Cream" class="img-size-50">
                                        </div>
                                        <div class="product-info">
                                            <a href="#" class="product-title">Lightening Day Cream
                                                <span class="badge badge-success float-right">Rp 50,000</span>
                                            </a>
                                            <span class="product-description">
                                                Terjual 35 pcs minggu ini
                                            </span>
                                        </div>
                                    </li>
                                    <li class="item">
                                        <div class="product-img">
                                            <img src="{{ asset('img/wardah-serum.jpg') }}" alt="Vitamin C Serum" class="img-size-50">
                                        </div>
                                        <div class="product-info">
                                            <a href="#" class="product-title">Vitamin C Serum
                                                <span class="badge badge-success float-right">Rp 125,000</span>
                                            </a>
                                            <span class="product-description">
                                                Terjual 28 pcs minggu ini
                                            </span>
                                        </div>
                                    </li>
                                    <li class="item">
                                        <div class="product-img">
                                            <img src="{{ asset('img/wardah-sunscreen.jpg') }}" alt="UV Shield Sunscreen" class="img-size-50">
                                        </div>
                                        <div class="product-info">
                                            <a href="#" class="product-title">UV Shield Sunscreen
                                                <span class="badge badge-success float-right">Rp 75,000</span>
                                            </a>
                                            <span class="product-description">
                                                Terjual 25 pcs minggu ini
                                            </span>
                                        </div>
                                    </li>
                                    <li class="item">
                                        <div class="product-img">
                                            <img src="{{ asset('img/wardah-acne-series.jpg') }}" alt="Acne Series Kit" class="img-size-50">
                                        </div>
                                        <div class="product-info">
                                            <a href="#" class="product-title">Acne Series Kit
                                                <span class="badge badge-success float-right">Rp 200,000</span>
                                            </a>
                                            <span class="product-description">
                                                Terjual 22 pcs minggu ini
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer text-center">
                                <a href="#" class="uppercase">Lihat Semua Produk</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Transaksi Terbaru</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th>ID Order</th>
                                                <th>Produk</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><a href="#">WRD0025</a></td>
                                                <td>Lightening Series (3 items)</td>
                                                <td><span class="badge badge-success">Selesai</span></td>
                                                <td>Rp 350,000</td>
                                            </tr>
                                            <tr>
                                                <td><a href="#">WRD0024</a></td>
                                                <td>Acne Series Kit</td>
                                                <td><span class="badge badge-info">Proses</span></td>
                                                <td>Rp 200,000</td>
                                            </tr>
                                            <tr>
                                                <td><a href="#">WRD0023</a></td>
                                                <td>UV Shield Sunscreen (2 pcs)</td>
                                                <td><span class="badge badge-success">Selesai</span></td>
                                                <td>Rp 150,000</td>
                                            </tr>
                                            <tr>
                                                <td><a href="#">WRD0022</a></td>
                                                <td>Vitamin C Serum</td>
                                                <td><span class="badge badge-warning">Pengiriman</span></td>
                                                <td>Rp 125,000</td>
                                            </tr>
                                            <tr>
                                                <td><a href="#">WRD0021</a></td>
                                                <td>Complete Facial Set</td>
                                                <td><span class="badge badge-success">Selesai</span></td>
                                                <td>Rp 450,000</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <a href="#" class="uppercase">Lihat Semua Transaksi</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Kategori Produk Terlaris</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="categoryChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('css')
    <style>
        .products-list .product-img {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            border-radius: 5px;
        }
        .products-list .product-img img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }
    </style>
    @endpush

    @push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Sales Chart
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['November', 'Desember', 'Januari', 'Februari', 'Maret', 'April'],
                datasets: [{
                    label: 'Penjualan (dalam juta rupiah)',
                    data: [18.5, 22.3, 19.8, 24.5, 28.7, 32.1],
                    backgroundColor: 'rgba(60, 141, 188, 0.2)',
                    borderColor: 'rgba(60, 141, 188, 1)',
                    borderWidth: 2,
                    pointRadius: 4,
                    pointBackgroundColor: '#3c8dbc'
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Category Chart
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        const categoryChart = new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: ['Perawatan Wajah', 'Sunscreen', 'Makeup', 'Perawatan Tubuh', 'Skincare Set'],
                datasets: [{
                    data: [35, 25, 20, 10, 10],
                    backgroundColor: [
                        '#f56954', 
                        '#00a65a', 
                        '#f39c12', 
                        '#00c0ef', 
                        '#3c8dbc'
                    ],
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
            }
        });
    </script>
    @endpush    