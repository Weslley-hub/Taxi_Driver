@extends('layouts.outer')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Suplementos</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Suplementos</li>
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
                        <h3 class="card-title">Lista de suplementos</h3>
                        <a href="{{ route('suplementos.create') }}" class="btn btn-primary float-right">Adicionar
                            suplemento</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Preço</th>
                                    <th>Estado</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suplements as $suplement)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $suplement->name }}</td>
                                        <td>{{ $suplement->price }}€</td>
                                        <td
                                            style="background-color: {{ $suplement->status == 1 ? 'rgba(0, 255, 0, 0.2)' : 'rgba(255, 0, 0, 0.2)' }}">
                                            {{ $suplement->status == 1 ? 'Disponível' : 'Indisponível' }}
                                        </td>
                                        <td>
                                            <a href="{{ route('suplementos.edit', $suplement->id) }}"
                                                class="btn btn-primary">Editar</a>
                                            <form action="{{ route('suplementos.updateStatus', $suplement->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="btn btn-{{ $suplement->status == 1 ? 'success' : 'danger' }}">
                                                    {{ $suplement->status == 1 ? 'Inativar' : 'Ativar' }}
                                                </button>
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
        </section>
        <!-- /.content -->
    </div>
@endsection
