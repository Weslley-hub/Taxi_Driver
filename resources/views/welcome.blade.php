@extends('layouts.outer')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ count($users->where('role_id', '2')) }}</h3>
                                <p>Taxistas</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">Ver mais <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ count($users->where('role_id', '2')->where('shiftstatus', '1')) }}</h3>

                                <p>Em Serviço</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">Ver Mais <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3></h3>
                                <h3>{{ count($travel->where('created_at', '>=', now()->startOfDay())) }}</h3>

                                <p>Numero de serviços hoje</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">Ver Mais <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>50</h3>

                                <p>Outro</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">Ver Mais <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <div class="row">

                    <div class="col-lg-4">
                        <div class="small-box bg-info">
                            <div class="inner">
                                @if (Auth::user()->shiftStatus == 0)
                                    <h4 style="text-align: center">Iniciar Turno</h4>
                                @else
                                    <h4 style="text-align: center">Fechar Turno</h4>
                                @endif
                                <p></p>
                            </div>
                            <a href="/startTurno" class="small-box-footer">Ver mais <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    @if (Auth::user()->shiftStatus == 1)
                        <div class="col-lg-4">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h4 style="text-align: center">Registar Viagem</h4>
                                    <p></p>
                                </div>

                                <a href="/dataViagens" class="small-box-footer">Ver mais <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h4 style="text-align: center">Registar Abastecimento</h4>
                                    <p></p>
                                </div>
                                <a href="/dataViagens" class="small-box-footer">Ver mais <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endif
                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
