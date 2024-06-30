@extends('layouts.outer')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
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
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lista de Turnos</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Taxista</th>
                                <th>Taxi</th>
                                <th>KM de inicio</th>
                                <th>KM de Fim</th>
                                <th>Data</th>
                                <th>Ações</th>
                                <th>Iniciar Turno</th>
                                <th>Taxista</th>
                                <th>Data Inicio</th>
                                <th>Data Fim</th>
                                <th>KM taxi</th>
                                <th>Contador 1</th>
                                <th>Contador 3</th>
                                <th>Contador 4 </th>
                                <th>Contador 5 </th>
                                <th>Contador 6 </th>
                                <th>Contador 8 </th>
                                <th>Contador 11 </th>
                                <th>Contador 32 </th>
                                <th>Contador 33 </th>
                                <th>Contador 35 </th>
                                <th>Contador f12 </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Jose</td>
                                <td>XX-XX-XX</td>
                                <td>50</td>
                                <td>100</td>
                                <td>02-01-2023</td>
                                <td>X</td>
                            </tr>

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Taxista</th>
                            <th>Taxi</th>
                            <th>KM de inicio</th>
                            <th>KM de Fim</th>
                            <th>Data</th>
                            <th>Ações</th>
                            <th>Iniciar Turno</th>
                            <th>Taxista</th>
                            <th>Data Inicio</th>
                            <th>Data Fim</th>
                            <th>KM taxi</th>
                            <th>Contador 1</th>
                            <th>Contador 3</th>
                            <th>Contador 4 </th>
                            <th>Contador 5 </th>
                            <th>Contador 6 </th>
                            <th>Contador 8 </th>
                            <th>Contador 11 </th>
                            <th>Contador 32 </th>
                            <th>Contador 33 </th>
                            <th>Contador 35 </th>
                            <th>Contador f12 </th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
</div>
@endsection