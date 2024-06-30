@extends('layouts.outer')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Turnos</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Turnos</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Lista de Turnos</h3>
                        <a href="{{ route('shifts.create') }}" class="btn btn-primary float-right">Adicionar Turno</a>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Taxista</th>
                                    <th>Taxi</th>
                                    <th>KM de início</th>
                                    <th>KM de fim</th>
                                    <th>Data</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shifts as $shift)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $shift->taxi->plate }}</td>
                                        <td>{{ $shift->driver->name }}</td>
                                        <td>{{ $shift->kmStart }}</td>
                                        <td>{{ $shift->kmFinish }}</td>
                                        <td>{{ $shift->dataStart ? $shift->dataStart->format('d/m/Y H:i') : '' }}</td>
                                        <td>
                                            <a href="{{ route('shifts.edit', $shift->id) }}"
                                                class="btn btn-primary btn-sm">Editar</a>
                                            <form action="{{ route('shifts.destroy', $shift->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
                                            </form>
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
