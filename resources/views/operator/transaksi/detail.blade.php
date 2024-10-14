@extends('layouts.app')
@section('content')
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">{{ $title }}</h3>
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
        <div class="col-md-12 ">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        @if ($data_detail->detail_transaksi->isNotEmpty())
                            <h3 class="card-title">NT-{{ $data_detail->detail_transaksi->first()->transaksi_id }}</h3>
                        @endif
                    </div>
                </div> <!-- /.card-header -->

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>nama Barang </th>
                                    <th>qty</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_detail->detail_transaksi as $row)
                                    <tr>
                                        <td>{{ $row->barang->nama_barang }}</td>
                                        <td>{{ $row->qty }}</td>
                                        <td>Rp. {{ number_format($row->barang->harga) }}</td>
                                        <td>Rp. {{ number_format($row->subtotal) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- /.col -->
    </div> <!-- /.row -->
@endsection
