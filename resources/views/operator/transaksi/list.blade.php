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
        <div class="col-md-12 ">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ $title }}</h3>
                        <a href="/transaksi" class="btn btn-primary">
                            TAMBAH DATA
                        </a>
                    </div>
                </div> <!-- /.card-header -->

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped" id="transaksi">
                            <thead>
                                <tr>
                                    <th>No Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Total Bayar</th>
                                    <th>Uang Masuk</th>
                                    <th>Uang Kembalian</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($data_transaksi as $row)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ date('d-m-Y', strtotime($row->tgl_transaksi)) }}</td>
                                        <td>{{ number_format($row->total_bayar) }}</td>
                                        <td>{{ number_format($row->uang_masuk) }}</td>
                                        <td>{{ number_format($row->uang_kembalian) }}</td>
                                        <td>
                                            <button type="button" href=/detailtransaksi/add class="btn btn-primary"><i
                                                    class="fas fa-detail"></i>Detail</a></button>
                                            <button type="button" data-bs-target="#modaldelete{{ $row->id }}"
                                                data-bs-toggle="modal" class="btn btn-danger"><i
                                                    class="fas fa-trash"></i>Delete</button>
                                        </td>
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

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#transaksi');
    </script>
@endsection
