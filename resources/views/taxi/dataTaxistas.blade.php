@extends('layouts.outer')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      <h1>Taxistas</h1>
      </div>
      <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Taxistas</li>
      </ol>
      </div>
    </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Email</th>
                <th style="text-align: center">Status</th>
                <th style="text-align: center">Serviço</th>
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
                                @if ($user->shiftstatus == 0)
                                <td class="table-danger" style="text-align: center">Fora de Serviço</td>
                                @else
                                <!-- <td class="table-danger" style="text-align: center">Fora Serviço</td> -->
                                <td class="table-success" style="text-align: center">Em Serviço</td>
                                @endif
                <td>
                  <!-- Aqui você pode adicionar botões de ação, por exemplo, para editar ou excluir usuários -->
                    <a href="{{ route('admin.user.edit', [$user->id]) }}" class="btn btn-primary">Editar</a>
                     
                    
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
