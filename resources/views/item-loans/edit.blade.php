@extends('layouts.main')

@section('breadcumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Peminjaman</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('items.index') }}">Peminjaman</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Terjadi kesalahan.
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Edit Peminjaman</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <!-- Nama Barang -->
                        <div class="form-group">
                            <label for="name">Nama Barang</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="Masukan nama barang" value="{{ old('name', $itemLoan->name) }}"
                                autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kuantitas -->
                        <div class="form-group">
                            <label for="qty">Kuantitas</label>
                            <input type="number" class="form-control @error('qty') is-invalid @enderror" id="qty"
                                name="qty" placeholder="Masukan jumlah barang" value="{{ old('qty', $itemLoan->qty) }}"
                                min="0">
                            @error('qty')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="form-group">
                            <label>Status</label>
                            <div class="form-check">
                                <input class="form-check-input @error('status') is-invalid @enderror" type="radio"
                                    name="status" value="available" id="available"
                                    {{ old('status', $itemLoan->status) == 'available' ? 'checked' : '' }}>
                                <label class="form-check-label" for="available">Available</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input @error('status') is-invalid @enderror" type="radio"
                                    name="status" value="unavailable" id="unavailable"
                                    {{ old('status', $itemLoan->status) == 'unavailable' ? 'checked' : '' }}>
                                <label class="form-check-label" for="unavailable">Unavailable</label>
                            </div>
                            @error('status')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-end">Simpan</button>
                        <a href="{{ route('item-loans.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
