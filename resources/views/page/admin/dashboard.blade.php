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
        <div class="col-md-4 col-sm-6 col-12">
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
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fas fa-graduation-cap"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Student</span>
                    <span class="info-box-number">{{ $student }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-12">
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
        <!-- /.col -->
    </div>
@endsection
