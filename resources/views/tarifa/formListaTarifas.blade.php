@extends('layouts.outer')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tarifas</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Tarifas</li>
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
                        <h3 class="card-title">Lista de Tarifas</h3>
                        <a href="{{ route('tarifas.create') }}" class="btn btn-primary float-right">Adicionar Tarifas</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Dias da semana</th>
                                    <th>Hora Inicio</th>
                                    <th>Hora Fim</th>
                                    <th>Preços por:</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tariffs as $tariff)
                                    <tr>
                                        <td>{{ $tariff->id }}</td>
                                        <td>{{ $tariff->name }}</td>
                                        <td>
                                            @php
                                                // Verifica se o dia está presente na lista de dias selecionados
                                                if (strpos($tariff->diasSemana, '1') !== false) {
                                                    echo 'Segunda-feira ';
                                                }
                                                if (strpos($tariff->diasSemana, '2') !== false) {
                                                    echo 'Terça-feira ';
                                                }
                                                if (strpos($tariff->diasSemana, '3') !== false) {
                                                    echo 'Quarta-feira ';
                                                }
                                                if (strpos($tariff->diasSemana, '4') !== false) {
                                                    echo 'Quinta-feira ';
                                                }
                                                if (strpos($tariff->diasSemana, '5') !== false) {
                                                    echo 'Sexta-feira ';
                                                }
                                                if (strpos($tariff->diasSemana, '6') !== false) {
                                                    echo 'Sábado ';
                                                }
                                                if (strpos($tariff->diasSemana, '7') !== false) {
                                                    echo 'Domingo ';
                                                }
                                            @endphp
                                        </td>
                                        <td>{{ $tariff->timeStart }}</td>
                                        <td>{{ $tariff->timeFinish }}</td>
                                        <td>Hora: {{ $tariff->valorPriceHour }}€<br>Km: {{ $tariff->valorPriceKm }}€</td>
                                        <td
                                            style="background-color: {{ $tariff->status == 1 ? 'rgba(0, 255, 0, 0.2)' : 'rgba(255, 0, 0, 0.2)' }}">
                                            {{ $tariff->status == 1 ? 'Ativo' : 'Inativo' }}
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('tarifas.edit', $tariff->id) }}"
                                                    class="btn btn-sm btn-primary">Editar</a>
                                            </div>
                                            <div class="btn-group" style="margin-top: 5px;">
                                                <form action="{{ route('tarifas.destroy', $tariff->id) }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm {{ $tariff->status == 1 ? 'btn-danger' : 'btn-success' }}">
                                                        {{ $tariff->status == 1 ? 'Desativar' : 'Ativar' }}
                                                    </button>
                                                    <input type="hidden" name="status"
                                                        value="{{ $tariff->status == 1 ? 0 : 1 }}">
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
