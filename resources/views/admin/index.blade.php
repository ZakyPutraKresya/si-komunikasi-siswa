@extends('layouts.app')
@section('heading', 'Dashboard')
@section('page')
  <li class="breadcrumb-item active">Admin</li>
  <li class="breadcrumb-item active">Dashboard</li>
@endsection
@section('content')
    <div class="col-lg-4 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{$htgjurusan}}</h3>
                <p>Jurusan</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-alt nav-icon"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <div class="small-box bg-info">
            <div class="inner" style="color: #FFFFFF;">
                <h3>{{ $guru }}</h3>
                <p>Guru</p>
            </div>
            <div class="icon">
                <i class="fas fa-id-card nav-icon"></i>
            </div>
            <a href="#" style="color: #FFFFFF !important;" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $siswa }}</h3>
                <p>Siswa</p>
            </div>
            <div class="icon">
                <i class="fas fa-id-card nav-icon"></i>
            </div>
            <a href="{{ route('siswa.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $kelas }}</h3>
                <p>Kelas</p>
            </div>
            <div class="icon">
                <i class="fas fa-home nav-icon"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{$mapel}}</h3>
                <p>Mapel</p>
            </div>
            <div class="icon">
                <i class="fas fa-book nav-icon"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>{{ $user }}</h3>
                <p>User Registrations</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-plus nav-icon"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <p class="d-flex flex-column">
                        <span class="text-bold text-lg">DataGuru</span>
                    </p>
                    <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-success">
                            <i class="fas fa-arrow-up"></i> {{ $guru }}
                        </span>
                    </p>
                </div>
                <div class="position-relative mb-4">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="chart-responsive">
                                <canvas id="pieChartGuru" height="200"></canvas>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <ul class="chart-legend clearfix">
                                <li><i class="far fa-circle text-primary"></i> Laki-laki</li>
                                <li><i class="far fa-circle text-danger"></i> Perempuan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <p class="d-flex flex-column">
                        <span class="text-bold text-lg">Data Siswa</span>
                    </p>
                    <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-success">
                            <i class="fas fa-arrow-up"></i> {{ $siswa }}
                        </span>
                    </p>
                </div>
                <div class="position-relative mb-4">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="chart-responsive">
                                <canvas id="pieChartSiswa" height="200"></canvas>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <ul class="chart-legend clearfix">
                                <li><i class="far fa-circle text-primary"></i> Laki-laki</li>
                                <li><i class="far fa-circle text-danger"></i> Perempuan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <p class="d-flex flex-column">
                        <span class="text-bold text-lg">Data Siswa / Jurusan</span>
                    </p>
                    <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-success">
                            <i class="fas fa-arrow-up"></i> {{ $kelas }}
                        </span>
                    </p>
                </div>
                <div class="position-relative mb-4">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="chart-responsive">
                                <canvas id="pieChartJurusan" height="150"></canvas>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <ul class="chart-legend clearfix">
                                <li><i class="far fa-circle" style="color: #cd6133"></i> Teknik Jaringan dan Komputer</li>
                                <li><i class="far fa-circle" style="color: #0d5fba"></i> Rekayasa Perangkat Lunak</li>
                                <li><i class="far fa-circle" style="color: #2ecc71"></i> Broadcasting</li>
                                <li><i class="far fa-circle" style="color: #D980FA"></i> Multimedia</li>
                                <li><i class="far fa-circle" style="color: #ff5252"></i> Teknik Elektronika Industri</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

    <!-- Diagram -->
    <script type="text/javascript">
        $(document).ready(function () {
            'use strict'

            var pieChartCanvasGuru = $('#pieChartGuru').get(0).getContext('2d')
            var pieDataGuru        = {
                labels: [
                    'Laki-laki', 
                    'Perempuan',
                ],
                datasets: [
                    {
                    data: [{{ $gurulk }}, {{ $gurupr }}],
                    backgroundColor : ['#007BFF', '#DC3545'],
                    }
                ]
            }
            var pieOptions     = {
                legend: {
                    display: false
                }
            }
            var pieChart = new Chart(pieChartCanvasGuru, {
                type: 'doughnut',
                data: pieDataGuru,
                options: pieOptions      
            })

            var pieChartCanvasSiswa = $('#pieChartSiswa').get(0).getContext('2d')
            var pieDataSiswa        = {
                labels: [
                    'Laki-laki', 
                    'Perempuan',
                ],
                datasets: [
                    {
                    data: [{{ $siswalk }}, {{ $siswapr }}],
                    backgroundColor : ['#007BFF', '#DC3545'],
                    }
                ]
            }
            var pieOptions     = {
                legend: {
                    display: false
                }
            }
            var pieChart = new Chart(pieChartCanvasSiswa, {
                type: 'doughnut',
                data: pieDataSiswa,
                options: pieOptions      
            })

            
            var pieChartCanvasJurusan = $('#pieChartJurusan').get(0).getContext('2d')
            var pieDataJurusan        = {
                labels: [
                    'Teknik Jaringan dan Komputer',
                    'Rekayasa Perangkat Lunak',
                    'Broadcasting',
                    'Multimedia',
                    'Teknik Elektronika Industri'
                ],
                datasets: [
                    {
                    data: [{{ $tkj }}, {{ $rpl }}, {{$bc}}, {{$mm}}, {{$tei}}],
                    backgroundColor : ['#cd6133','#0d5fba','#2ecc71','#D980FA','#ff5252'],
                    }
                ]
            }
            var pieOptions     = {
                legend: {
                    display: true
                }
            }
            var pieChart = new Chart(pieChartCanvasJurusan, {
                type: 'doughnut',
                data: pieDataJurusan,
                options: pieOptions      
            })
        })
        
        $("#AdminDashboard").addClass("active");
    </script>
@endsection