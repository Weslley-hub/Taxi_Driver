@extends('layouts.outer')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ isset($user) ? 'Editar Utilizador' : 'Criar Utilizador' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{ isset($user) ? 'Editar Utilizador' : 'Criar Utilizador' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ isset($user) ? 'Editar Utilizador' : 'Adicionar Utilizador' }}</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ isset($user) ? route('admin.user.update', $user->id) : route('admin.user.store') }}">
                            @csrf
                            @if(isset($user))
                                @method('PUT')
                            @endif
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Nome</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ isset($user) ? $user->name : old('name') }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{ isset($user) ? $user->email : old('email') }}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="password">Senha</label>
                                    <input type="password" name="password" id="password" class="form-control" {{ isset($user) ? '' : 'required' }}>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password_confirmation">Confirmar Senha</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" {{ isset($user) ? '' : 'required' }}>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="TipoUtilizador">Tipo de Usuário</label>
                                <select name="role_id" id="role_id" class="form-control">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ isset($user) && $user->role_id == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            </div>
                            <div class="form-group">
                                <label for="commissionAmount">Valor da Comissão</label>
                                <input type="text" name="commissionAmount" id="commissionAmount" class="form-control" value="{{ isset($user) ? $user->commissionAmount : old('commissionAmount') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="active" value="1" {{ isset($user) && $user->status == 1 ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="active">Ativo</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="inactive" value="0" {{ isset($user) && $user->status == 0 ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="inactive">Inativo</label>
                                </div>
                            </div>
                            @if (Session::has('success'))
                                <div role="alert" class="alert alert-success">{{ Session::get('success') }}</div>
                            @elseif (Session::has('error'))
                                <div role="alert" class="alert alert-danger">{{ Session::get('error') }}</div>
                            @endif
                            <button type="submit" class="btn btn-primary">{{ isset($user) ? 'Atualizar' : 'Adicionar' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
