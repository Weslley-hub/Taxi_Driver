@extends('layouts.outer')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Listagem de Tipos de Viagem</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tipos de Viagem</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lista de Tipos de Viagem</h3>
                    <a href="{{ route('trip-types.create') }}" class="btn btn-primary float-right">Adicionar Tipo de
                        Viagem</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tripTypes as $tripType)
                            <tr>
                                <td>{{ $tripType->id }}</td>
                                <td>{{ $tripType->name }}</td>
                                <td>{{ $tripType->price }}</td>
                                <td>{{ $tripType->status ? 'Ativo' : 'Inativo' }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('trip-types.edit', $tripType->id) }}"
                                            class="btn btn-sm btn-primary mr-1">Editar</a>
                                        <form action="{{ route('trip-types.updateStatus', $tripType->id) }}"
                                            method="POST" style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="btn btn-sm {{ $tripType->status ? 'btn-danger' : 'btn-success' }}">
                                                {{ $tripType->status ? 'Desativar' : 'Ativar' }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
