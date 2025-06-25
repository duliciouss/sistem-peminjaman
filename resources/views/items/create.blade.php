@extends('layouts.main')

@section('breadcumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Barang</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Manajemen Barang</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Buat Barang</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama Barang</label>
                            <input type="email" class="form-control" id="name" placeholder="Masukan nama barang">
                        </div>
                        <div class="form-group">
                            <label for="name">Kuantitas</label>
                            <input type="number" class="form-control" id="name" placeholder="Masukan kuantitas">
                        </div>

                        <div class="form-group">
                            <label for="name">Status</label>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status">
                                <label class="form-check-label">Available</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status">
                                <label class="form-check-label">Unavailable</label>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-end">Simpan</button>
                        <a href="{{ route('items.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
