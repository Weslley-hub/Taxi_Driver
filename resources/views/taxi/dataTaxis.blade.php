@extends('layouts.outer')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Taxis</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Taxis</li>
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
                        <h3 class="card-title">Lista de Taxis</h3>
                        <a href="{{ route('taxis.create') }}" class="btn btn-primary float-right">Adicionar Táxi</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Matricula</th>
                                    <th>Km Inicial</th>
                                    <th>Km Atual</th>
                                    <th>Estado</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($taxis))
                                    @foreach ($taxis as $taxi)
                                        <tr>
                                            <td>{{ $taxi->plate }}</td>
                                            <td>{{ $taxi->kmStart }}</td>
                                            <td>{{ $taxi->kmActual }}</td>
                                            <td
                                                style="background-color: {{ $taxi->status == 1 ? 'rgba(0, 255, 0, 0.2)' : 'rgba(255, 0, 0, 0.2)' }}">
                                                {{ $taxi->status == 1 ? 'Ativo' : 'Inativo' }}
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('taxis.edit', $taxi->id) }}"
                                                        class="btn btn-sm btn-primary">Editar</a>
                                                    <form action="{{ route('taxis.updateStatus', $taxi->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="btn btn-sm {{ $taxi->status == 1 ? 'btn-danger' : 'btn-success' }}">
                                                            {{ $taxi->status == 1 ? 'Desativar' : 'Ativar' }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </section>
    </div>
@endsection
