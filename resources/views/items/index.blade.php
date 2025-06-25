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
    <a href="{{ route('items.create') }}" class="btn btn-primary mb-4">Create Barang</a>
    <div class="row">
        <div class="col-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover item-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                        <a href="{{ route('items.edit', ['item' => $item->id]) }}"
                                            class="btn btn-info btn-sm">Edit</a>
                                        <form action="{{ route('items.destroy', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus barang ini?')">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
@endsection

@section('js')
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <script>
        $('.item-table').dataTable();
    </script>

    <!-- Tambahkan di bagian head -->
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Tombol Delete -->
    <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $item->id }}" data-name="{{ $item->name }}">
        <i class="fas fa-trash-alt"></i> Delete
    </button>

    <!-- Form Delete (Hidden) -->
    <form id="delete-form-{{ $item->id }}" action="{{ route('items.destroy', $item->id) }}" method="POST"
        class="d-none">
        @csrf
        @method('DELETE')
    </form>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                $('.delete-btn').on('click', function() {
                    const itemId = $(this).data('id');
                    const itemName = $(this).data('name');

                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: `Anda akan menghapus item "${itemName}"`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(`#delete-form-${itemId}`).submit();
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
