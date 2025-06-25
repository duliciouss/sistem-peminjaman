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
                    <h3 class="card-title">Form Edit Barang</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama Barang</label>
                            <input type="email" class="form-control" id="name" placeholder="Masukan nama barang"
                                value="{{ $item->name }}">
                        </div>
                        <div class="form-group">
                            <label for="name">Kuantitas</label>
                            <input type="number" class="form-control" id="name" placeholder="Masukan kuantitas"
                                value="{{ $item->qty }}">
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="available"
                                    {{ $item->status == 'available' ? 'checked' : '' }}>
                                <label class="form-check-label" for="available">Available</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="unavailable"
                                    {{ $item->status == 'unavailable' ? 'checked' : '' }}>
                                <label class="form-check-label" for="unavailable">Unavailable</label>
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
