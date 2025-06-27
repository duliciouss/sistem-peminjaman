@extends('layouts.main')

@section('breadcumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-box"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Peminjaman</span>
                    <span class="info-box-number">
                        {{ $stats['totalLoans'] }}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-box"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Pengembalian</span>
                    <span class="info-box-number">
                        {{ $stats['returnedLoans'] }}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-box"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Belum Dikembalikan</span>
                    <span class="info-box-number">
                        {{ $stats['unreturnedLoans'] }}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-4">

            <div class="info-box">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-box"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Barang</span>
                    <span class="info-box-number">
                        {{ $totalBarang }}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-box"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Status Barang Unavailable</span>
                    <span class="info-box-number">
                        {{ $unavailable }}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-box"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Status Barang Available</span>
                    <span class="info-box-number">
                        {{ $available }}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>
@endsection
