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
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            User Data
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

                    @if (Session::has('failed'))
                        <span class="alert alert-danger p-2">{{ $request->session()->get('failed') }}</span>
                    @endif
                    @if (Session::has('succes'))
                        <span class="alert alert-success p-2">{{ $request->session()->get('succes') }}</span>
                    @endif

                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">User Data</h3>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modalcreate">+
                            TAMBAH DATA
                        </button>
                    </div>
                </div> <!-- /.card-header -->

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">id</th>
                                <th>Nama</th>
                                <th>email</th>
                                <th>Role</th>
                                <th>Action</th>
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
                                    <td>
                                        <a href=#modaledit {{ $row->id }} data-bs-toggle="modal"
                                            class="btn btn-primary"><i class="fas fa-edit"></i>Edit</a>
                                        <a href=#modaldelete {{ $row->id }} data-bs-toggle="modal"
                                            class="btn btn-danger"><i class="fas fa-trash"></i>Delete</a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-end">
                        <li class="page-item"> <a class="page-link" href="#">&laquo;</a> </li>
                        <li class="page-item"> <a class="page-link" href="#">1</a> </li>
                        <li class="page-item"> <a class="page-link" href="#">2</a> </li>
                        <li class="page-item"> <a class="page-link" href="#">3</a> </li>
                        <li class="page-item"> <a class="page-link" href="#">&raquo;</a> </li>
                    </ul>
                </div>
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
                            <input type="text" class="form-control" value="{{ old('name') }}" name="name"
                                placeholder="Bangkitscl" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" value="{{ old('email') }}" name="email"
                                placeholder="admin@gmail.com" required>
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                class="fas fa-undo"></i></button>
                        <button type="submit" class="btn btn-primary" class="fas fa-save">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($data_user as $d)
        <div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <option <?php if ($d['role'] == 'admin') {
                                        echo 'selected';
                                    }
                                    ?>>Admin</option>
                                    <option <?php if ($d['role'] == 'operator') {
                                        echo 'selected';
                                    }
                                    ?>>Operator</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                    class="fas fa-undo">Close</i></button>
                            <button type="submit" class="btn btn-primary" class="fas fa-save">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($data_user as $c)
        <div class="modal fade" id="modaldelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="GET" action="user/destroy/{{ $c->id }}">
                        @csrf
                        <div class="modal-body">
                            ...

                            <div class="form-group">
                                <h5>Apakah anda yakin ingin menghapus data ini?</h5>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
