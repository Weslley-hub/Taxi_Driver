@extends('layouts.outer')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Iniciar Turno</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Novo Turno</li>
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
                        action="{{ isset($shift) ? route('shifts.update', $shift->id) : route('shifts.store') }}">
                        @csrf
                        @if (isset($shift))
                            @method('PUT')
                        @endif

                        <div class="card-header">
                            <h3 class="card-title">Iniciar novo turno</h3>
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
                                    <div class="form-group">
                                        <label>Escolha o taxi <code>Apenas os disponíveis</code></label>
                                        <select class="form-control select2bs4" style="width: 100%;" id="taxi"
                                            name="taxi" onchange="updateKm(this)"
                                            {{ isset($shift) ? 'disabled' : 'required' }}>
                                            <option selected="selected" value="{{ isset($shift) ? $shift->taxi->id : '' }}">
                                                {{ isset($shift) ? $shift->taxi->plate : 'Selecione um táxi' }}</option>
                                            @if (isset($taxis))
                                                @foreach ($taxis as $taxi)
                                                    @if ($taxi->status == 1)
                                                        <option value="{{ $taxi->id }}" data-km="{{ $taxi->kmActual }}">
                                                            {{ $taxi->plate }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                        @if ($errors->has('taxi'))
                                            <div class="alert alert-danger">{{ $errors->first('taxi') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Data e Hora de início</label>
                                        <input type="datetime-local" class="form-control" id="dataStart" name="dataStart"
                                            value="{{ isset($shift) ? $shift->dataStart : date('Y-m-d\TH:i') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="kmIniciais">KM Iniciais</label>
                                        <input type="number" class="form-control" id="kmStart" name="kmStart"
                                            placeholder="KM Iniciais" value="{{ isset($shift) ? $shift->kmStart : '' }}"
                                            required>
                                        @if (isset($shift) && $shift->taxi->kmActual > $shift->kmStart)
                                            <div class="alert alert-danger">O KM Inicial não pode ser menor que o KM Atual
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Data e Hora de fim</label>
                                        <input type="datetime-local" class="form-control" id="dataFinish" name="dataFinish"
                                            value="{{ isset($shift) ? $shift->dataFinish : old('dataFinish') }}"
                                            min="2000-01-01T00:00" max="2100-12-31T23:59" />
                                    </div>
                                    <div class="form-group">
                                        <label for="kmFinais">KM Finais</label>
                                        <input type="number" class="form-control" id="kmFinish" name="kmFinish"
                                            placeholder="KM Finais" value="{{ isset($shift) ? $shift->kmFinish : '' }}">
                                        @if (isset($shift) && $shift->kmStart > $shift->kmFinish)
                                            <div class="alert alert-danger">O KM Final não pode ser menor que o KM Inicial
                                            </div>
                                        @endif
                                    </div>
                                    @if ($errors->has('kmStart') || $errors->has('kmFinish'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('kmStart') }}
                                            {{ $errors->first('kmFinish') }}
                                        </div>
                                    @endif
                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                        data-target="#addSupplyModal">
                                        Alterar combustível
                                    </button>

                                    <div class="table-container">
                                        <div class="card-body">
                                            <table id="NAbastecimentos" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Litros (L)</th>
                                                        <th>Preço (€)</th>
                                                        <th>KM da Viatura (km)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @error('dataStart')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('kmStart')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        {{-- @error('dataFinish')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('kmFinish')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror --}}
                        <div class="card-footer">
                            <button type="submit"
                                class="btn btn-info">{{ isset($shift) ? 'Atualizar' : 'Registar' }}</button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
    </div>
    </section>
    </div>

    <!-- /.card-body -->
    <div class="card-footer">

        <!-- Modal -->
        <div class="modal fade" id="addSupplyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Adicionar Abastecimento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="liters">Litros (L)</label>
                            <input type="number" class="form-control" id="liters" name="liters"
                                placeholder="Litros" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Preço (€)</label>
                            <input type="number" class="form-control" id="price" name="price"
                                placeholder="Preço" required>
                        </div>
                        <div class="form-group">
                            <label for="km">KM da Viatura (km)</label>
                            <input type="number" class="form-control" id="km" name="km"
                                placeholder="KM da Viatura" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary" onclick="createSupply()">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    </div>
@endsection

<script>
    function createSupply() {
        var liters = document.getElementById('liters').value;
        var price = document.getElementById('price').value;
        var km = document.getElementById('km').value;

        // Acessar diretamente as células da tabela e atualizar seus valores
        var table = document.getElementById('NAbastecimentos');
        var tbody = table.getElementsByTagName('tbody')[0];
        var row = tbody.getElementsByTagName('tr')[0]; // Assumindo que existe apenas uma linha na tabela
        if (row) {
            var cells = row.getElementsByTagName('td');
            cells[0].innerHTML = liters + " L";
            cells[1].innerHTML = price + " €";
            cells[2].innerHTML = km + " km";
        } else {
            // Se não houver uma linha na tabela, criar uma nova linha com os valores inseridos
            var newRow = tbody.insertRow();
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            cell1.innerHTML = liters;
            cell2.innerHTML = price;
            cell3.innerHTML = km + " km";
        }

        // Limpar os campos do formulário no modal
        document.getElementById('liters').value = '';
        document.getElementById('price').value = '';
        document.getElementById('km').value = '';

        // Fechar o modal
        $('#addSupplyModal').modal('hide');
    }

    function updateKm(select) {
        var kmActual = select.options[select.selectedIndex].getAttribute('data-km');
        document.getElementById('kmIniciais').value = kmActual;
    }
</script>
