@extends('layouts.outer')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ isset($role) ? 'Editar Role' : 'Criar Role' }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{ isset($role) ? 'Editar Role' : 'Criar Role' }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-default">
                    <form class="form-horizontal" method="POST"
                        action="{{ isset($role) ? route('admin.roles.update', $role->id) : route('admin.roles.store') }}">
                        @csrf
                        @if (isset($role))
                            @method('PUT')
                        @endif

                        <div class="card-body">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Nome da Role</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name', isset($role) ? $role->name : '') }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status_active"
                                            value="1" {{ isset($role) && $role->status == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status_active">
                                            Ativo
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status_inactive"
                                            value="0" {{ isset($role) && $role->status == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status_inactive">
                                            Inativo
                                        </label>
                                    </div>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>



                            <!-- Formulário para atribuir funções à permissão -->

                            <div class="flex space-x-2 form-group">
                                <label for="permission">Permissões</label>
                                <select class="form-control" id="permission" autocomplete="permission-name"
                                    name="permission[]" multiple>
                                    @foreach ($permissions as $permission)
                                        <option value="{{ $permission->id }}"
                                            {{ isset($role) ? ($role->hasPermissionTo($permission->id) ? 'selected' : '') : '' }}>
                                            {{ $permission->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @if (Session::has('message'))
                                <div role="alert" class="alert alert-success">{{ Session::get('message') }}</div>
                            @endif
                            <!-- /.card-body -->
                        </div>

                        <div class="card-footer">

                            <button type="submit" class="btn btn-info">{{ isset($role) ? 'Atualizar' : 'Criar' }}</button>



                        </div>
                    </form>
                </div>
                <!-- /.card -->




            </div><!-- /.container-fluid -->
            <!-- Exibir permissões atualizadas em um span -->

            <!-- Parte existente do código em create.blade.php -->

        </section>

        <!-- /.content -->
    </div>
@endsection
