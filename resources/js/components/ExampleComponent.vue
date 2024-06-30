<template>
    <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
            <form method="POST" action="{{ route('tarifas.store') }}">
                @csrf
                <div class="card-header">
                    <h3 class="card-title">Registar Tarifas</h3>
                </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Dias da Semana</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="segunda-feira" />
                                        <label class="form-check-label" for="segunda-feira">Segunda-Feira</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="terca-feira" checked />
                                        <label class="form-check-label" for="terca-feira">Terça-Feira</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="quarta-feira" />
                                        <label class="form-check-label" for="quarta-feira">Quarta-Feira</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="quinta-feira" />
                                        <label class="form-check-label" for="quinta-feira">Quinta-Feira</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="sexta-feira" />
                                        <label class="form-check-label" for="sexta-feira">Sexta-Feira</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="hora-inicio">Hora de inicio</label>
                                    <div class="input-group time" id="hora-inicio" data-target-input="nearest">
                                        <input type="time" class="form-control timepicker-input" data-target="#hora-inicio" />
                                        <div class="input-group-append" data-target="#hora-inicio" data-toggle="timepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="hora-fim">Hora de Fim</label>
                                    <div class="input-group time" id="hora-fim" data-target-input="nearest">
                                        <input type="time" class="form-control timepicker-input" data-target="#hora-fim" />
                                        <div class="input-group-append" data-target="#hora-fim" data-toggle="timepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="estado">Estado</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="estado" id="ativo" />
                                        <label class="form-check-label" for="ativo">Ativo</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="estado" id="inativo" checked />
                                        <label class="form-check-label" for="inativo">Inativo</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <!-- Seus campos do formulário aqui -->
                            e<button type="submit">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</template>
