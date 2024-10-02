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

    <div class="row justify-content-center">
        <div class="col-md-12 ">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ $table_title }}</h3>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalcreate">
                            TAMBAH DATA
                        </button>
                    </div>
                </div> <!-- /.card-header -->

                <div class="card-body">
                    <table class="table table-bordered" id="datajenis">
                        <thead>
                            <tr>
                                <th style="width: 1rem">No</th>
                                <th>Nama Jenis Barang</th>
                                <th class="text-center" style="width: 13rem">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_jenis_barang as $row)
                                <tr class="align-middle">
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->nama_jenis_barang }}</td>
                                    <td class="text-center">
                                        <a href=#modaledit{{ $row->id }} data-bs-toggle="modal"
                                            class="btn btn-success"><i class="fas fa-edit"></i></a>
                                        <a href=#modaldelete{{ $row->id }} data-bs-toggle="modal"
                                            class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- /.col -->
    </div> <!--end::Row-->

    <div class="modal fade" id="modalcreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Tambah Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('jenisbarang/store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nama Jenis</label>
                            <input type="text" class="form-control" name="nama_jenis_barang"required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-primary" class="fas fa-save">Save Changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($data_jenis_barang as $d)
        <div class="modal fade" id="modaledit{{ $d->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Edit</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="/jenisbarang/update/{{ $d->id }}">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Jenis</label>
                                <input type="text" value="{{ $d->nama_jenis_barang }}" class="form-control"
                                    name="nama_jenis_barang" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">close</button>
                            <button type="submit" class="btn btn-outline-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($data_jenis_barang as $c)
        <div class="modal fade" id="modaldelete{{ $c->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete jenis barang</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="GET" action="jenisbarang/destroy/{{ $c->id }}">
                        @csrf
                        <div class="modal-body">
                            ...

                            <div class="form-group">
                                <h5>Apakah anda yakin ingin menghapus data ini?</h5>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">close</button>
                            <button type="submit" class="btn btn-outline-primary">Save Changes</button>
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
        new DataTable('#datajenis');
    </script>
@endsection
