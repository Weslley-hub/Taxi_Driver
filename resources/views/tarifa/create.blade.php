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
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <form class="form-horizontal" method="POST"
                        action="{{ isset($tariff) ? route('tarifas.update', $tariff->id) : route('tarifas.store') }}">
                        @csrf
                        @if (isset($tariff))
                            @method('PUT')
                        @endif
                        <div class="card-header">
                            <h3 class="card-title">{{ isset($tariff) ? 'Editar Tarifa' : 'Registar Tarifas' }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Dias da Semana</label>

                                        <div class="form-check">
                                            <input value="1" id="weekDays" class="form-check-input" type="checkbox"
                                                name="weekDays[]"
                                                {{ isset($tariff) && strpos($tariff->diasSemana, 1) ? 'checked' : '' }}>
                                            <label class="form-check-label">Segunda-Feira</label>
                                        </div>
                                        <div class="form-check">
                                            <input value="2" id="weekDays" class="form-check-input" type="checkbox"
                                                name="weekDays[]"
                                                {{ isset($tariff) && strpos($tariff->diasSemana, 2) ? 'checked' : '' }}>
                                            <label class="form-check-label">Terça-Feira</label>
                                        </div>
                                        <div class="form-check">
                                            <input value="3" id="weekDays" class="form-check-input" type="checkbox"
                                                name="weekDays[]"
                                                {{ isset($tariff) && strpos($tariff->diasSemana, 3) ? 'checked' : '' }}>
                                            <label class="form-check-label">Quarta-Feira</label>
                                        </div>
                                        <div class="form-check">
                                            <input value="4" id="weekDays" class="form-check-input" type="checkbox"
                                                name="weekDays[]"
                                                {{ isset($tariff) && strpos($tariff->diasSemana, 4) ? 'checked' : '' }}>
                                            <label class="form-check-label">Quinta-Feira</label>
                                        </div>
                                        <div class="form-check">
                                            <input value="5" id="weekDays" class="form-check-input" type="checkbox"
                                                name="weekDays[]"
                                                {{ isset($tariff) && strpos($tariff->diasSemana, 5) ? 'checked' : '' }}>
                                            <label class="form-check-label">Sexta-Feira</label>
                                        </div>
                                        <div class="form-check">
                                            <input value="6" id="weekDays" class="form-check-input" type="checkbox"
                                                name="weekDays[]"
                                                {{ isset($tariff) && strpos($tariff->diasSemana, 6) ? 'checked' : '' }}>
                                            <label class="form-check-label">Sábado</label>
                                        </div>
                                        <div class="form-check">
                                            <input value="7" id="weekDays" class="form-check-input" type="checkbox"
                                                name="weekDays[]"
                                                {{ isset($tariff) && strpos($tariff->diasSemana, 7) ? 'checked' : '' }}>
                                            <label class="form-check-label">Domingo</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-7">
                                    <label>Nome das Tarifas</label>
                                    <div class="input-group time" id="" data-target-input="nearest">
                                        <input id="nomeTafifas" name="nomeTarifas" type="text"
                                            value="{{ old('nomeTarifas', isset($tariff->name) ? $tariff->name : '') }}"
                                            class="form-control input" data-target="" />
                                    </div>
                                    <label>Hora de inicio</label>
                                    <div class="input-group time" id="" data-target-input="nearest">
                                        <input id="hi" name="hi" type="time"
                                            value="{{ old('timeStart', isset($tariff->timeStart) ? $tariff->timeStart : '') }}"
                                            class="form-control timepicker-input" data-target="" />
                                        <div class="input-group-append" data-target="" data-toggle="timepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    @error('hi')
                                        <span class="text-danger">{{ $message }}<br></span>
                                    @enderror
                                    <label>Hora de Fim</label>
                                    <div class="input-group time" id="" data-target-input="nearest">
                                        <input id="hf" name="hf" type="time"
                                            value="{{ old('timeFinish', isset($tariff->timeFinish) ? $tariff->timeFinish : '') }}"
                                            class="form-control
                                            timepicker-input"
                                            data-target="" />
                                        <div class="input-group-append" data-target="" data-toggle="timepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    <label>Preço por hora</label>
                                    <div class="input-group time" id="" data-target-input="nearest">
                                        <input id="precoHora" name="precoHora" type="number" step='0.01'
                                            value="{{ old('valorPriceHour', isset($tariff->valorPriceHour) ? $tariff->valorPriceHour : '') }}"
                                            class="form-control timepicker-input" data-target="" />
                                    </div>
                                    <label>Preço por Km</label>
                                    <div class="input-group time" id="" data-target-input="nearest">
                                        <input id="precoKm" name="precoKm" type="number" step='0.01'
                                            value="{{ old('valorPriceKm', isset($tariff->valorPriceKm) ? $tariff->valorPriceKm : '') }}"
                                            class="form-control timepicker-input" data-target="" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Estado</label>
                                        <div class="form-check">
                                            <input value="1" class="form-check-input" type="radio"
                                                {{ old('status', isset($tariff->status) && $tariff->status == 1 ? 'checked' : '') }}
                                                name="estado">
                                            <label class="form-check-label">Ativo</label>
                                        </div>
                                        <div class="form-check">
                                            <input value= "0" class="form-check-input" type="radio" name="estado"
                                                {{ old('status', isset($tariff->status) && $tariff->status == 0 ? 'checked' : '') }}>
                                            <label class="form-check-label">Inativo</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit"
                                    class="btn btn-info">{{ isset($tariff) ? 'Atualizar' : 'Registar' }}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.container-fluid -->
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
