@extends('layouts.admin')
@section('css')
@endsection
@section('content')
    <div class="card">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Product</li>
            </ol>
        </nav>
        <div class="card-body">
            <div class="table-responsive">

                @include('_message')

                @if (!empty($data['PermissionAdd']))
                    <a href="{{ route('product.create') }}" class="btn btn-success mb-2 btn-sm">Tambah Daftar
                        Product</a>
                @endif
                <table class="table table-bordered table-hover table-stripped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Product</th>
                            <th>Nama Product</th>
                            <th>Harga Satuan</th>
                            <th>Stok Product</th>
                            @if (!empty($data['PermissionEdit']) || !empty($data['PermissionDelete']))
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($data['product']) == 0)
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data</td>
                            </tr>
                        @else
                            @foreach ($data['product'] as $row)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $row->id_product }}</td>
                                    <td>{{ $row->name_product }}</td>
                                    <td>Rp. {{ number_format($row->harga_satuan, 0, ',', '.') }}</td>
                                    <td>{{ $row->stok_product }}</td>
                                    <td>

                                        @if (!empty($data['PermissionEdit']))
                                            <a href="{{ route('product.edit', $row->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-fw fa-edit"></i>
                                            </a>
                                        @endif

                                        @if (!empty($data['PermissionDelete']))
                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="confirmDelete('{{ route('product.destroy', $row->id) }}', '{{ $row->name_product }}')">
                                                <i class="fas fa-fw fa-trash"></i>
                                            </button>

                                            <script>
                                                function confirmDelete(deleteUrl, productName) {
                                                    Swal.fire({
                                                        title: "Are you sure?",
                                                        text: `You won't be able to revert this! This will delete ${productName}.`,
                                                        icon: "warning",
                                                        showCancelButton: true,
                                                        confirmButtonColor: "#3085d6",
                                                        cancelButtonColor: "#d33",
                                                        confirmButtonText: "Yes, delete it!"
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            var form = document.createElement('form');
                                                            form.method = 'POST';
                                                            form.action = deleteUrl;

                                                            var csrfToken = document.createElement('input');
                                                            csrfToken.type = 'hidden';
                                                            csrfToken.name = '_token';
                                                            csrfToken.value = '{{ csrf_token() }}';
                                                            form.appendChild(csrfToken);

                                                            var methodField = document.createElement('input');
                                                            methodField.type = 'hidden';
                                                            methodField.name = '_method';
                                                            methodField.value = 'DELETE';
                                                            form.appendChild(methodField);

                                                            document.body.appendChild(form);
                                                            form.submit();
                                                        }
                                                    });
                                                }
                                            </script>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
