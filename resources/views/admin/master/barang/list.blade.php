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
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ $title_table }}</h3>
                        <a href="/addbarang" class="btn btn-primary">
                            TAMBAH DATA
                        </a>
                    </div>
                </div> <!-- /.card-header -->

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="databarang">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th class="text-center">Nama Jenis Barang</th>
                                    <th class="text-center">Nama barang</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">image</th>
                                    <th class="text-center">stok</th>
                                    <th style="width: 10rem" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($data_barang as $row)
                                    <tr class="align-middle">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $row->jenisbarang->nama_jenis_barang }}</td>
                                        <td>{{ $row->nama_barang }}</td>
                                        <td>{{ 'Rp ' . number_format($row->harga, 2, ',', '.') }}</td>
                                        <td class="text-center">
                                            <img width="60" src="{{ asset('/storage/public/products/' . $row->foto) }}"
                                                alt="">
                                        </td>
                                        <td>{{ $row->stok }}</td>
                                        <td class="text-center">
                                            <a href="/editbarang/{{ $row->id }}" class="btn btn-success"><i
                                                    class="fas fa-edit"></i></a>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#modaldelete{{ $row->id }}">
                                                <i class="fas fa-trash "></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> <!-- /.card-body -->

            </div> <!-- /.card -->
        </div> <!-- /.col -->
    </div> <!--end::Row-->

    @foreach ($data_barang as $c)
        <div class="modal fade" id="modaldelete{{ $c->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $title }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="GET" action="barang/destroy/{{ $c->id }}">
                        @csrf
                        <div class="modal-body">

                            <div class="form-group">
                                <h7>Apakah anda yakin ingin menghapus data ini?</h7>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i
                                    class="fas fa-undo"></i></button>
                            <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#databarang');
    </script>
@endsection
