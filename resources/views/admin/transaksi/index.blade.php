@extends('layouts.admin')
@section('css')
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Transaksi</th>
                            <th>Items</th>
                            <th>Total Diskon</th>
                            <th>Total Harga</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($data) == 0)
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data</td>
                            </tr>
                        @else
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->id_transaksi }}</td>
                                    <td>
                                        <ol>
                                            @foreach ($row->items as $item)
                                                <li>{{ $item->nama }} ({{ $item->quantity }})</li>
                                            @endforeach
                                        </ol>
                                    </td>
                                    <td>Rp. {{ number_format($row->total_diskon) }}</td>
                                    <td>Rp. {{ number_format($row->total_harga) }}</td>
                                    <td>{{ $row->tgl_beli }}</td>
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
@endsection
