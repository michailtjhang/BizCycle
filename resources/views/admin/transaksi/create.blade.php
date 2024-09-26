@extends('layouts.admin')
@section('css')
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('transaksi.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="id_supplier">Daftar Supplier</label>
                            <select class="form-control" id="id_supplier">
                                <option value="">Pilih Supplier</option>
                                @foreach ($dataSupplier as $supplier)
                                    <option value="{{ $supplier->id_user }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="id_product">Daftar Product</label>
                            <select class="form-control" id="id_product">
                                <option value="">Pilih Product</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="">&nbsp;</label>
                            <button class="btn btn-primary d-block" type="button" onclick="tambahItem()">Tambah
                                Item</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Quantity</th>
                                    <th>Harga</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody class="transaksiItem">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3">Diskon</th>
                                    <th class="totalDiskon">Rp. 0</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th colspan="2">Jumlah</th>
                                    <th class="quantity">0</th>
                                    <th class="totalHarga">Rp. 0</th>
                                    <th></th>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" name="total_diskon" value="0">
                        <input type="hidden" name="total_harga" value="0">
                        <button class="btn btn-success">Simpan Transaksi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        var totalHarga = 0;
        var totalDiskon = 0;
        var quantity = 0;
        var listItem = [];

        function formatRupiah(angka) {
            var number_string = angka.toString().replace(/[^,\d]/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return 'Rp. ' + rupiah;
        }

        function tambahItem() {
            var selectedProduct = $('#id_product').find(':selected');
            var hargaSatuan = parseInt(selectedProduct.data('harga'));
            var productId = selectedProduct.data('id');
            var stokProduct = parseInt(selectedProduct.data('stok'));
            var item = listItem.filter(el => el.id_product === productId);

            if (item.length > 0) {
                if (item[0].quantity < stokProduct) {
                    item[0].quantity += 1;
                    updateQuantity(1);
                    updateTotalHarga(hargaSatuan);

                    if (item.length > 0 && item[0].quantity % 10 === 0) {
                        item[0].diskon = item[0].harga_satuan * 0.1 * item[0].quantity;
                        totalDiskon += item[0].harga_satuan * 0.1;
                    }
                    updateTotalDiskon(totalHarga, totalDiskon);
                } else {
                    alert('Stok tidak mencukupi!');
                }
            } else {
                var newItem = {
                    id_product: productId,
                    name_product: selectedProduct.data('nama'),
                    harga_satuan: hargaSatuan,
                    quantity: 1,
                    diskon: 0,
                    stok: stokProduct
                };
                listItem.push(newItem);
                updateQuantity(1);
                updateTotalHarga(hargaSatuan);

                if (item.length > 0 && item[0].quantity % 10 === 0) {
                    item[0].diskon = item[0].harga_satuan * 0.1 * item[0].quantity;
                    totalDiskon += item[0].harga_satuan * 0.1;
                }
                updateTotalDiskon(totalHarga, totalDiskon);
            }

            updateTable();
        }

        function deleteItem(index) {
            var item = listItem[index];

            if (item.quantity > 1) {
                listItem[index].quantity -= 1;
                updateTotalHarga(-item.harga_satuan);
                updateQuantity(-1);
                
                // Jika jumlah item menjadi kurang dari konstanta 10, kembalikan diskon
                if (listItem[index].quantity % 10 === 9) {
                    item.diskon = item.harga_satuan * 0.1;
                    console.log('Item dikurangi ' + totalDiskon + ' ' + totalHarga + ' ' + item.diskon);
                    totalDiskon = totalDiskon - item.diskon;
                    listItem[index].diskon = 0;
                } 
                updateTotalDiskon(totalHarga, totalDiskon);

                updateTable();

            } else {
                updateTotalHarga(-(item.harga_satuan * item.quantity));
                updateQuantity(-(item.quantity));
                listItem.splice(index, 1);
                emptyTable();
            }

        }

        function updateTable() {
            var html = '';
            listItem.map((el, index) => {
                var harga_satuan = formatRupiah(el.harga_satuan.toString());
                var quantity = el.quantity;
                var diskon = formatRupiah(el.diskon.toString());

                html += `
        <tr>
            <td>${index + 1}</td>
            <td>${el.name_product}</td>
            <td>${quantity}</td>
            <td>${harga_satuan}</td>
            <td>
                <input type="hidden" name="id_product[]" value="${el.id_product}">
                <input type="hidden" name="quantity[]" value="${el.quantity}">
                <button type="button" onclick="deleteItem(${index})" class="btn btn-link"><i class="fas fa-fw fa-trash text-danger"></i></button>
            </td>
        </tr>
        `;
            });
            $('.transaksiItem').html(html);
            $('.totalDiskon').html(formatRupiah(totalDiskon.toString()));
        }

        function updateTotalHarga(nom) {
            totalHarga = totalHarga + nom;
            $('[name=total_harga]').val(totalHarga);
            $('.totalHarga').html(formatRupiah(totalHarga.toString()));
        }

        function updateTotalDiskon(totalHarga, totalDiskon) {
            var hargaSetelahDiskon = totalHarga - totalDiskon;
            $('[name=total_diskon]').val(totalDiskon);
            $('[name=total_harga]').val(hargaSetelahDiskon);
            $('.totalHarga').html(formatRupiah(hargaSetelahDiskon.toString()));
        }

        function updateQuantity(nom) {
            quantity = quantity + nom;
            $('.quantity').html(quantity.toString());
        }

        function emptyTable() {
            $('.transaksiItem').html(`
        <tr>
            <td colspan="4">Belum ada item, silahkan tambahkan</td>
        </tr>
    `);
        }

        $(document).ready(function() {
            emptyTable();

            $('#id_supplier').change(function() {
                var supplierId = $(this).val();
                if (supplierId) {
                    $.ajax({
                        url: '/admin/get-products/' + supplierId,
                        type: 'GET',
                        success: function(data) {
                            var productOptions = '<option value="">Pilih Product</option>';
                            data.forEach(function(product) {
                                productOptions += '<option value="' + product
                                    .id_product + '" data-nama="' + product
                                    .name_product + '" data-harga="' + product
                                    .harga_satuan + '" data-id="' + product.id_product +
                                    '" data-stok="' + product.stok_product +
                                    '">' + product.name_product + ' (Rp.' +
                                    formatRupiah(product.harga_satuan.toString()) +
                                    ') - Stok: ' + product.stok_product + '</option>';
                            });
                            $('#id_product').html(productOptions);
                        },
                        error: function() {
                            alert('Gagal mengambil data produk');
                        }
                    });
                } else {
                    $('#id_product').html('<option value="">Pilih Product</option>');
                }
            });
        });
    </script>
@endsection
