@extends('layouts.outer')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Roles</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Roles</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lista de Roles</h3>
                    <div class="float-right">

                                @if($roles->contains(function ($role) {
                return $role->permissions->contains('id', 1);
            }))
                <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Criar</a>
            @endif

                      

                    </div>
                    
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Estado</th>
                                <th>Permissões</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                @if($role->status == 0)
                                <td class="table-danger" style="text-align: center">Inativo</td>
                                @elseif($role->status == 1)
                                <td class="table-success" style="text-align: center">Ativo</td>
                                @endif
                                <td>
                                @foreach($role->permissions as $permission)
                                 {{ $permission->name }} <br>
                                @endforeach
                                </td>
                                <td>
                                
                                @if($roles->contains(function ($role) {
                                    return $role->permissions->contains('id', 2);
                                }))
                                    <a href="{{ route('admin.roles.edit', $role->id)  }}" class="btn btn-primary">Edit</a>
                               @endif
                                    <form action="{{ route('admin.roles.toggleRole', $role->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        @if($roles->contains(function ($role) {
                                            return $role->permissions->contains('id', 3);
                                        }))
                                        <button type="submit"
                              class="btn  {{ $role->status == 1 ? 'btn-danger' : 'btn-success' }}">
                              {{ $role->status == 1 ? 'Desativar' : 'Ativar' }}
                          </button>
                                      
                                        @endif
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                
            </div>
            @if (Session::has('success'))
                        <div role="alert" class="alert alert-success" style="width: 20%; margin: left;">{{ Session::get('success') }}</div>
                    @endif
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </section>
</div>

@endsection