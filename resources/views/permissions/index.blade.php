@extends('layouts.outer')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Permissões</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Permissões</li>
              
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
            <h3 class="card-title">Lista de Permissões</h3>
                    <div class="float-right">
                    @if($roles->contains(function ($role) {
                      return $role->permissions->contains('id', 1);
                  }))
                        <a href="{{ route('admin.permissions.create')}}" class="btn btn-primary">Criar</a>
                        @endif
                    </div>
                </div>
          <!-- /.card-header -->
          <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Estado</th>
                                <th>Roles</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permissions as $permission)
                            <tr>
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->name }}</td>
                                    @if($permission->status == 0)
                                        <td class="table-danger" style="text-align: center">Inativo</td>
                                    @elseif($permission->status == 1)
                                        <td class="table-success" style="text-align: center">Ativo</td>
                                    @endif
                                    <td>
                                        @foreach($permission->roles as $role)
                                            {{ $role->name }} <br>
                                        @endforeach
                                    </td>
                                <td>
                                @if($roles->contains(function ($role) {
                                      return $role->permissions->contains('id', 2);
                                  }))
                                    <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-primary">Editar</a>
                                    @endif
                                    <form action="{{ route('admin.permissions.togglePermission', $permission->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        @if($roles->contains(function ($role) {
                                            return $role->permissions->contains('id', 3);
                                        }))
                                        <button type="submit"
                                        class="btn  {{ $permission->status == 1 ? 'btn-danger' : 'btn-success' }}">
                                        {{ $permission->status == 1 ? 'Desativar' : 'Ativar' }}
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
        <!-- /.card -->
      </div>
      <!-- /.col -->
  </div>

@endsection