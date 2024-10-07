@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap5.css">
@endsection
@section('content')
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/app">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $title }}
                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content Header--> <!--begin::App Content-->

    <div class="row">
        <div class="col-md-11 ">
            <div class="card mb-4">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped" id="pos">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th class="text-center">Jenis Barang</th>
                                    <th class="text-center">Foto</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Stok</th>
                                    <th class="text-center ">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data_pos as $row)
                                    <tr>
                                        <td>{{ $row->nama_barang }}</td>
                                        <td class="text-center">{{ $row->jenisbarang->nama_jenis_barang }}</td>
                                        <td class="text-center"> <img width="60"
                                                src="{{ asset('/storage/public/products/' . $row->foto) }}"
                                                class="avatar-lg rounded" alt=""></td>
                                        <td class="text-center">{{ $row->harga }}</td>
                                        <td class="text-center">{{ $row->stok }}</td>
                                        <td class="text-center">
                                            <button type="button"
                                                onclick="addToCart('{{ $row->id }}', '{{ $row->nama_barang }}', '{{ asset('storage/public/products/' . $row->foto) }}', '{{ $row->harga }}', '{{ $row->stok }}')"
                                                class="btn btn-primary">
                                                <i class="fas fa-shopping-cart"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->

            <div class="row" id="cart-items">
                <!-- Cart items will be added here dynamically -->
            </div>

            <div class="col-xl-full">
                <div class="mt-5 mt-lg-0">
                    <div class="card border shadow-none">
                        <div class="card-header bg-transparent border-bottom py-3 px-4">
                            @php
                                $no = 1;
                            @endphp
                            <h5 class="font-size-16 mb-0">Order Summary <span
                                    class="float-end">#NT012{{ $no++ }}</span>
                            </h5>
                        </div>
                        <div class="card-body p-4 pt-2">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tbody>

                                        <td>Nama Kasir :
                                            <input name="nam" type="text" class="form-control"
                                                aria-describedby="emailHelp">
                                        </td>
                                        <td>Tanggal :
                                            <input name="tanggal" type="date" class="form-control">
                                        </td>

                                        <tr class="bg-light">
                                            <th>Total :</th>
                                            <td class="text-end">
                                                <span class="fw-bold grand-total">Rp. 0</span>
                                            </td>
                                        </tr>

                                        <td>Uang Masuk :
                                            <input name="uang_masuk" type="text" class="form-control" id="uangMasuk"
                                                oninput="hitungKembalian()">
                                        </td>
                                        <td>Uang Kembalian :
                                            <input name="uang_kembalian" type="text" class="form-control"
                                                id="uangKembalian" readonly>
                                        </td>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div>


            <div class="row my-4">
                <div class="col-sm-6">
                    <a href="ecommerce-products.html" class="btn btn-link text-muted">
                        <i class="mdi mdi-arrow-left me-1"></i> Continue Shopping </a>
                </div> <!-- end col -->
                <div class="col-sm-6">
                    <div class="text-sm-end mt-2 mt-sm-0">
                        <a href="javascript:void(0)" class="btn btn-success btn-checkout">
                            <i class="mdi mdi-cart-outline me-1"></i> Checkout </a>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row-->
        </div>
    </div>

    </div>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#pos');
    </script>

    <script>
        let cartItems = []; // Array to hold cart item data

        function addToCart(id, nama_barang, foto, harga, stok) {
            var container = document.getElementById('cart-items');

            var newItem = document.createElement('div');
            newItem.classList.add('col-md-6');
            newItem.setAttribute('data-id', id);
            newItem.setAttribute('data-stok', stok);
            newItem.setAttribute('data-harga', harga);

            // Create the select options based on stok (0 to stok)
            var quantityOptions = '';
            for (var i = 0; i <= stok; i++) {
                quantityOptions += `<option value="${i}">${i}</option>`;
            }

            newItem.innerHTML = `
            <div class="card border shadow-none mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-start pb-3">
                        <div class="me-4">
                            <img width="60" src="${foto}" alt="" class="avatar-lg rounded">
                        </div>
                        <div class="flex-grow-1 align-self-center overflow-hidden">
                            <div>
                                <h5 class="text-truncate font-size-18"><a href="#" class="text-dark">${nama_barang}</a></h5>
                                <p class="text-muted mb-2">Harga</p>
                                <h5 class="mb-0 mt-2">Rp. ${parseInt(harga).toLocaleString()}</h5>
                                <p class="text-muted">Stok Tersedia: <span class="item-stock">${stok}</span></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <p class="text-muted mb-2">Quantity</p>
                            <div class="d-inline-flex">
                                <select class="form-select form-select-sm" onchange="updateSubTotal(this, ${id}, ${harga}, ${stok})">
                                    ${quantityOptions}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mt-3">
                                <p class="text-muted mb-2">Subtotal</p>
                                <h5 class="item-total mb-0 mt-2">Rp. 0</h5>
                            </div>
                        </div>
                        <div class="flex-shrink-0 ms-2">
                            <ul class="list-inline mb-0 font-size-16">
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted px-1" onclick="removeItem(this)">
                                        <i class="mdi mdi-trash-can-outline"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        `;
            container.appendChild(newItem);
            updateGrandTotal();
        }

        function updateSubTotal(selectElement, id, harga, stok) {
            var quantity = parseInt(selectElement.value);
            var subtotalElement = selectElement.closest('.d-inline-flex').parentNode.nextElementSibling.querySelector(
                '.item-total');
            var subtotal = quantity * harga;

            subtotalElement.textContent = 'Rp. ' + subtotal.toLocaleString();

            var itemContainer = selectElement.closest('.col-md-6');
            var stockElement = itemContainer.querySelector('.item-stock');
            stockElement.textContent = stok - quantity;

            // Update the cartItems array
            const itemIndex = cartItems.findIndex(item => item.id === id);
            if (itemIndex > -1) {
                // Update existing item
                cartItems[itemIndex].qty = quantity; // Update qty
                cartItems[itemIndex].subtotal = subtotal; // Update subtotal
            } else {
                // If the item is not already in cartItems, add it
                cartItems.push({
                    id: id,
                    qty: quantity,
                    harga_satuan: harga,
                    subtotal: subtotal,
                });
            }

            updateGrandTotal();
        }

        function removeItem(element) {
            var itemContainer = element.closest('.col-md-6');
            var itemId = itemContainer.getAttribute('data-id');
            cartItems = cartItems.filter(item => item.id != itemId); // Remove item from cart array
            itemContainer.remove();
            updateGrandTotal();
        }

        function updateGrandTotal() {
            var grandTotal = cartItems.reduce((total, item) => total + item.subtotal, 0);
            document.querySelector('.grand-total').textContent = 'Rp. ' + grandTotal.toLocaleString();
        }

        function hitungKembalian() {
            var uangMasuk = parseInt(document.getElementById('uangMasuk').value) || 0;
            var grandTotal = parseInt(document.querySelector('.grand-total').textContent.replace('Rp. ', '').replace(/,/g,
                '')) || 0;

            var uangKembalian = uangMasuk - grandTotal;
            document.getElementById('uangKembalian').value = 'Rp. ' + (uangKembalian > 0 ? uangKembalian.toLocaleString() :
                0);
        }

        // Function to send data to the server when clicking the Checkout button
        function checkout() {
            const uangMasuk = parseInt(document.getElementById('uangMasuk').value) || 0;
            const uangKembalian = parseInt(document.getElementById('uangKembalian').value) || 0;
            fetch('/pos/store', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        items: cartItems,
                        bayar: uangMasuk,
                        kembalian: uangKembalian.replace('Rp. ', '').replace(/,/g, ''),
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                    window.location.href = '/pos'; // Redirect to checkout
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        }

        // Attach the checkout function to the Checkout button
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.btn-success').addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default anchor behavior
                checkout(); // Call checkout function
            });
        });
    </script>
@endsection
