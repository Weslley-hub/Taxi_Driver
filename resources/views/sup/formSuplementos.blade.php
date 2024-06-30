@extends('layouts.outer')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ isset($suplement) ? 'Editar Suplemento' : 'Novo Suplemento' }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">
                                {{ isset($suplement) ? 'Editar Suplemento' : 'Novo Suplemento' }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card card-default">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form class="form-horizontal" method="POST"
                            action="{{ isset($suplement) ? route('suplementos.update', $suplement->id) : route('suplementos.store') }}">
                            @csrf
                            @if (isset($suplement))
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nome</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Nome"
                                            value="{{ old('name', isset($suplement->name) ? $suplement->name : '') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">Preço</label>
                                        <input type="number" class="form-control" id="price" name="price"
                                            placeholder="Ex: 5€"
                                            value="{{ old('price', isset($suplement->price) ? $suplement->price : '') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Estado</label>
                                        <select class="form-control" id="status" name="status">
                                            @foreach (\App\Models\Suplement::getStatuses() as $value => $label)
                                                <option value="{{ $value }}"
                                                    {{ old('status', isset($suplement->status) && $suplement->status == $value ? 'selected' : '') }}>
                                                    {{ ucfirst($label) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit"
                                    class="btn btn-info">{{ isset($suplement) ? 'Atualizar' : 'Registrar' }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
