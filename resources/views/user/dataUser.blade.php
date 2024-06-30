@extends('layouts.outer')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      <h1>Utilizadores</h1>
      </div>
      <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Utilizadores</li>
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
          <h3 class="card-title">Lista de Utilizadores</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Status</th>
                <th>Role</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
              <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                @if($user->status == 0)
                                <td class="table-danger" style="text-align: center">Inativo</td>
                                @elseif($user->status == 1)
                                <td class="table-success" style="text-align: center">Ativo</td>
                                @endif
                <td>@foreach($user->roles as $role)
                    <span>{{ $role->name }}</span>
                  @endforeach</td>
                <td>
                  <!-- Aqui você pode adicionar botões de ação, por exemplo, para editar ou excluir usuários -->
                  @if($roles->contains(function ($role) {
                          return $role->permissions->contains('id', 2);
                      }))
                    <a href="{{ route('admin.user.edit', [$user->id]) }}" class="btn btn-primary">Editar</a>
                  @endif
                    <form action="{{ route('admin.user.toggleStatus', $user->id) }}"
                          method="POST" style="display: inline;">
                          @csrf
                          @method('PATCH')
                          @if($roles->contains(function ($role) {
                            return $role->permissions->contains('id', 3);
                        }))
                          <button type="submit"
                              class="btn  {{ $user->status == 1 ? 'btn-danger' : 'btn-success' }}">
                              {{ $user->status == 1 ? 'Desativar' : 'Ativar' }}
                          </button>
                          @endif
                      </form>      
                  <!-- Adicione mais botões conforme necessário -->
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
  <!-- /.row -->
</div>
<!-- /.container-fluid -->

@endsection