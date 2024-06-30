@extends('layouts.outer')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Editar Tipo de Viagem</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Editar Tipo de Viagem</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Editar Tipo de Viagem</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('trip-types.update', $tripType->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="name">Nome:</label>
                                        <input type="text" id="name" name="name" class="form-control" value="{{ $tripType->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Preço:</label>
                                        <input type="text" id="price" name="price" class="form-control" value="{{ $tripType->price }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status:</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="1" {{ $tripType->status ? 'selected' : '' }}>Ativo</option>
                                            <option value="0" {{ !$tripType->status ? 'selected' : '' }}>Inativo</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
