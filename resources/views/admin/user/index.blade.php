@extends('layouts.admin')
@section('css')
@endsection
@section('content')
    <div class="card">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $page_title }}</li>
            </ol>
        </nav>
        <div class="card-body">

            @include('_message')

            <div class="table-responsive">
                <a href="{{ route('role.create') }}" class="btn btn-success mb-2 btn-sm">Tambah</a>
                <table class="table table-bordered table-hover table-stripped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Date</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($data as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->created_at }}</td>
                                <td>
                                    <a href="{{ route('role.edit', $row->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-fw fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger"
                                        onclick="confirmDelete('{{ route('role.destroy', $row->id) }}', '{{ $row->name }}')">
                                        <i class="fas fa-fw fa-trash"></i>
                                    </button>

                                    <script>
                                        function confirmDelete(deleteUrl, name) {
                                            Swal.fire({
                                                title: "Are you sure?",
                                                text: `You won't be able to revert this! This will delete ${name}.`,
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
                                </td>
                            </tr>
                        @endforeach --}}
                        <tr class="text-center">
                            <td class="text-center" colspan="4">No Data</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
