@extends('layouts.app')
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
        <div class="col-md-10">
            <div class="card card-primary card-outline mb-4"> <!--begin::Header-->
                <div class="card-header">
                    <div class="card-title">{{ $title }}</div>
                </div> <!--end::Header--> <!--begin::Form-->
                <form action="{{ route('barang/store') }}" method="POST" enctype="multipart/form-data"> <!--begin::Body-->
                    @csrf
                    <div class="card-body">
                        <div class="mb-3"> <label class="form-label">Nama Barang</label> <input name="nama_barang"
                                type="text" class="form-control" aria-describedby="emailHelp">
                        </div>

                        <div class="mb-3"> <label for="nama_barang" class="form-label">Harga</label> <input name="harga"
                                type="text" class="form-control" aria-describedby="emailHelp">
                        </div>

                        <div class="mb-3"> <label for="jenisbarang" class="form-label">Jenis Barang</label>
                            <select class="form-control" name="jenis_barang_id" required>
                                <option value="" hidden>-- Nama Jenis Barang --</option>
                                @foreach ($data_barang as $row)
                                    <option value="{{ $row->id }}">{{ $row->nama_jenis_barang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3"> <label class="form-label">Image</label>
                            <div class="input-group mb-3"> <input type="file" class="form-control" accept="image/*"
                                    @error('image') is-invalid @enderror name="image"> <label class="input-group-text"
                                    for="image">Upload</label>
                                @error('image')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3"> <label for="stok" class="form-label">Stok</label> <input type="text"
                                name="stok" class="form-control">
                        </div>
                    </div> <!--end::Body--> <!--begin::Footer-->
                    <div class="card-footer"> <button type="submit" class="btn btn-outline-primary">Submit</button> </div>
                    <!--end::Footer-->
                </form> <!--end::Form-->
            </div> <!--end::Quick Example--> <!--begin::Input Group-->
        </div>
    </div>
@endsection
