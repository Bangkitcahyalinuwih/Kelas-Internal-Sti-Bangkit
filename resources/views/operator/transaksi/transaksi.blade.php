@extends('layouts.app')
@section('content')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css"
        integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

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
        <div class="col-md-8">
            <div class="row">
                @foreach ($data_detail_transaksi as $row)
                    <div class="col-md-6">
                        <div class="card border shadow-none mb-2">

                            <div class="card-body">

                                <div class="d-flex align-items-start border-bottom pb-3">
                                    <div class="me-4">
                                        <img width="60" src="{{ asset('/storage/public/products/' . $row->foto) }}"
                                            class="avatar-lg rounded" alt="">
                                    </div>
                                    <div class="flex-grow-1 align-self-center overflow-hidden">
                                        <div>
                                            <h5 class="text-truncate font-size-18" class="text-dark">{{ $row->nama_barang }}
                                            </h5>

                                            <p class=" text-muted mb-0 mt-1">Price : <span
                                                    class="fw-medium text-dark">{{ number_format($row->harga, 2, ',', '.') }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 ms-2">
                                        <ul class="list-inline mb-0 font-size-16">
                                            <li class="list-inline-item">
                                                <button type="button" class="btn btn-outline-secondary btn-sm"
                                                    onclick="addToCart('{{ $row->id }}', '{{ $row->nama_barang }}', '{{ asset('storage/public/products/' . $row->foto) }}', '{{ $row->harga }}')">
                                                    <i class="fa-solid fa-square-plus"></i>
                                                </button>
                                            </li>

                                        </ul>
                                    </div>
                                </div>

                                <div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mt-3">
                                                <p class="text-muted mb-2">Stok : <span class="text-dark">
                                                        {{ $row->stok }}</span> </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


            <!-- end card -->


            <!-- end card -->

            <div class="row my-4">
                <div class="col-sm-6">
                    <a href="ecommerce-products.html" class="btn btn-link text-muted">
                        <i class="mdi mdi-arrow-left me-1"></i> Continue Shopping </a>
                </div> <!-- end col -->
                <div class="col-sm-6">
                    <div class="text-sm-end mt-2 mt-sm-0">
                        <a href="ecommerce-checkout.html" class="btn btn-success">
                            <i class="mdi mdi-cart-outline me-1"></i> Checkout </a>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row-->
        </div>


        <div class="col-xl-4">
            <div class="mt-5 mt-lg-0">
                <div class="card border shadow-none">
                    <div class="row">
                        <div class="card-header bg-transparent border-bottom py-3 px-4">
                            <h5 class="font-size-16 mb-0">{{ $title_detail }} <span class="float-end"></span>
                            </h5>
                        </div>
                        @foreach ($data_detail_transaksi as $row)
                            <div class="card-body p-4 pt-1">
                                <div class="table-responsive">
                                    <table class="table mb-1">
                                        <div class="card border shadow-none">

                                            <div class="card-body">

                                                <div class="d-flex align-items-start">
                                                    <div class="me-4 mt-3">
                                                        <img width="60"
                                                            src="{{ asset('/storage/public/products/' . $row->foto) }}"
                                                            class="avatar-lg rounded" alt="">
                                                    </div>
                                                    <div class="flex-grow-1 align-self-center overflow-hidden">
                                                        <div>
                                                            <h5 class="text-truncate fs-5" class="text-dark">
                                                                {{ $row->nama_barang }}
                                                            </h5>

                                                            <p class="text-muted mb-0 mt-1 fs-8">Rp.<span
                                                                    class="fw-medium text-dark">{{ number_format($row->harga, 2, ',', '.') }}</span>
                                                            </p>

                                                            <div class="d-inline-flex mt-1">
                                                                <select class="form-select form-select-sm w-md">
                                                                    <option value="0" selected="">0</option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                    <option value="6">6</option>
                                                                    <option value="7">7</option>
                                                                    <option value="8">8</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-2">
                                                        <ul class="list-inline mb-0 fs-7">
                                                            <li class="list-inline-item">
                                                                <a href="#" class="text-muted px-1"
                                                                    onclick="removeItem(this)">
                                                                    <i class="fa-solid fa-trash"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </table>
                                </div>
                                <!-- end table-responsive -->
                            </div>
                        @endforeach
                    </div>
                </div>


                <div class="card border shadow-none mt-2">
                    <div class="card-header bg-transparent border-bottom py-3 px-4">
                        <h5 class="font-size-16 mb-0">{{ $title_transaksi }} <span class="float-end"></span>
                        </h5>
                    </div>
                    <div class="card-body p-4 pt-2">

                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <td>Date </td>
                                        <td class="text-end"><input type="date" class="form-control form-control-sm">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>User </td>
                                        <td class="text-end">{{ $row->name }}</td>

                                    </tr>
                                    <tr class="bg-light">
                                        <th>Total Bayar</th>
                                        <td class="text-end">
                                            <input type="text" class="form-control form-control-sm">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Pembayaran </td>
                                        <td class="text-end"><input type="text" class="form-control form-control-sm">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kembalian </td>
                                        <td class="text-end"><input type="text" class="form-control form-control-sm">
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
