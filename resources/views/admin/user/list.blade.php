@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap5.css">
@endsection
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
        <div class="col-md-12">
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
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="datauser">
                            <thead>
                                <tr>
                                    <th style="width: 1rem">no</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">email</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center" style="width: 9rem">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($data_user as $row)
                                    <tr class="align-middle">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>{{ $row->role }}</td>
                                        <td class="text-center ">
                                            <a href=#modaledit{{ $row->id }} data-bs-toggle="modal"
                                                class="btn btn-success"><i class="fas fa-edit"></i></a>
                                            <a href=#modaldelete{{ $row->id }} data-bs-toggle="modal"
                                                class="btn btn-danger"><i class="fas fa-trash"></i></a>
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

    <div class="modal fade" id="modalcreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5">create data user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('user/store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Lengkap </label>
                            <input type="text"
                                class="form-control @error('name') is-invalid
                                
                            @enderror"
                                value="{{ old('name') }}" name="name" placeholder="Bangkitscl">

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email"
                                class="form-control @error('email') is-invalid
                                
                            @enderror"
                                value="{{ old('email') }}" name="email" placeholder="admin@gmail.com" required>

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" value="{{ old('password') }}" name="password"
                                placeholder="password" required>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" name="role" required>
                                <option value="" hidden>-- pilih role --</option>
                                <option value="admin">Admin</option>
                                <option value="operator">Operator</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="botton" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i
                                class="fas fa-undo"></i></button>
                        <button type="submit" class="btn btn-outline-primary" class="fas fa-save">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($data_user as $d)
        <div class="modal fade" id="modaledit{{ $d->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Edit</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/user/update/{{ $d->id }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Lengkap </label>
                                <input type="text" value="{{ $d->name }}" class="form-control" name="name"
                                    placeholder="Bangkitscl" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" value="{{ $d->email }}" class="form-control" name="email"
                                    placeholder="admin@gmail.com" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="password"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-control" name="role" required>
                                    <option value="" hidden>-- pilih role --</option>
                                    <option value="{{ $d->role }}" {{ $d->role == 'admin' ? 'selected' : '' }}>
                                        admin</option>
                                    <option value="{{ $d->role }}" {{ $d->role == 'operator' ? 'selected' : '' }}>
                                        operator</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="undo" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">close</button>
                            <button type="submit"class="btn btn-outline-primary">save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($data_user as $c)
        <div class="modal fade" id="modaldelete{{ $c->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="GET" action="user/destroy/{{ $c->id }}">
                        @csrf
                        <div class="modal-body">

                            <div class="form-group">
                                <h7>Apakah anda yakin ingin menghapus data ini?</h7>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline-primary">Save changes</button>
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
        new DataTable('#datauser');
    </script>
@endsection
