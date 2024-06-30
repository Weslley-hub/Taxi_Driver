@extends('layouts.outer')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Iniciar Viagem</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Nova Viagem</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <form class="form-horizontal">
            <div class="card-header">
              <h3 class="card-title">Iniciar nova Viamgem</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Tipo de Viagem<code>Lista automática de suplmentos</code></label>
                        <select class="form-control select2bs4" style="width: 100%;">
                          <option selected="selected">Tipo</option>
                          <option>Taximetro</option>
                          <option>Combinado</option>
                          <option>Seguradora</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Tarifa<code></code></label>
                        <select class="form-control select2bs4" style="width: 100%;">
                          <option selected="selected">Tipo</option>
                          
                          <option>exemplo 1</option>
                          <option>exemplo 2</option>
                          <option>exemplo 3</option>
  
                        </select>
                      </div>
                    </div>
                  </div>
                  
                  
                  
                  <div class="form-group">
                    <h4>Dados Iniciais</h4>
                    <div class="row">
                      <div class="col-6">
                        <label>Hora de inicio <code> Automático</code></label>
                        <div class="input-group time" id="" data-target-input="nearest">
                          <input type="time" class="form-control timepicker-input" data-target="" />
                          <div class="input-group-append" data-target="" data-toggle="timepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>
                      <div class="col-6">
                        <label>Km Iniciais<code> Automático</code></label>
                        <div class="input-group time" id="" data-target-input="nearest">
                          <input type="time" class="form-control timepicker-input" data-target="" />
                          <div class="input-group-append" data-target="" data-toggle="timepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <h4>Dados Finais</h4>
                    <div class="row">
                      <div class="col-6">
                        <label>Hora de Fim <code> Automático</code></label>
                        <div class="input-group time" id="" data-target-input="nearest">
                          <input type="time" class="form-control timepicker-input" data-target="" />
                          <div class="input-group-append" data-target="" data-toggle="timepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>
                      <div class="col-6">
                        <label>Km Finais</label>
                        <div class="input-group time" id="" data-target-input="nearest">
                          <input type="time" class="form-control timepicker-input" data-target="" />
                          <div class="input-group-append" data-target="" data-toggle="timepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Preço Cobrado </label>
                    <input type="number" class="form-control" id="exampleInputEmail1" placeholder="">
                  </div>
                  <div class="row">
                     <div class="col-4">
                       <div class="form-group">
                        <label>Destino</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="">
                       </div>
                     </div>
                     <div class="col-4">
                      <div class="form-group">
                        <label>Coordenada Inicial</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Latitude">
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Longitude">

                      </div>
                     </div>
                     <div class="col-4">
                      <div class="form-group">
                        <label>Coordenada Final</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Latitude">
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Longitude">

                      </div>
                     </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Espera </label>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="radio1">
                          <label class="form-check-label">Sim</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="radio1" checked>
                          <label class="form-check-label">Não</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Preço </label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="€">

                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Suplementos </label>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                          <label class="form-check-label">T</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" checked>
                          <label class="form-check-label">B</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                          <label class="form-check-label">A</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Tipo</label>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="radio1">
                          <label class="form-check-label">Sinistrado</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="radio1" checked>
                          <label class="form-check-label">Assistência em Viagem</label>
                        </div>
                       
                      </div>
                    </div>
                  </div>


                
                  <div class="row">
                    <div class="col-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Portagem </label>
                        <input type="number" class="form-control" id="exampleInputEmail1" placeholder="">
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Quem Recebeu</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="">
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Estacionamento</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="">
                      </div>
                    </div>
                    
                    
                    
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Total de Suplementos <code>Automático</code></label>
                    <input type="number" class="form-control" id="exampleInputEmail1" placeholder="">
                  </div>
                  
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-info">Registar</button>
            </div>
          </form>

<button onclick="getLocation()">Try It</button>

<p id="demo"></p>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
    
@endsection