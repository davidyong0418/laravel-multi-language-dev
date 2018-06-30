
@extends('artifico2::layout')

@section('title', 'Пользователи')
@section('page_header', 'Пользователи')


@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Поиск</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <form method="get" class="form-inline" action="{{ route('admin.administrators.index') }}">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group" style="width: 40%">
                            <label for="role" class="sr-only">Группы</label>
                            <select id="role" title="Выберите одну или несколько роей"
                                    name="role[]" class="form-control multiple-select"
                                    multiple="multiple" data-placeholder="Выберите группу" style="width: 100%">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}"
                                    @if (!empty($user_filter['role']) && in_array($role->id, $user_filter['role']))
                                        selected
                                    @endif>{{ $role->human_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="submit" class="btn btn-default" value="Искать">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="box">
        <div class="box-body">
            <div class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-xs-12">
                        @if(Auth::user()->hasPermissionTo('create administrator') || Auth::user()->hasPermissionTo('*'))
                            <a href="{{ route('admin.administrators.create') }}" class="btn btn-primary margin pull-right">
                                <i class="fa fa-user-plus"></i> Добавить</a>@endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-striped table-hover dataTable"
                               role="grid"
                               aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th>Имя</th>
                                <th>Почта</th>
                                <th>Группы</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr role="row" class='row-link'
                                    data-href='{{ route('admin.administrators.edit', ['administrator' => $user->id]) }}'>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach ($user->roles as $role)
                                            {{$role->human_name}}@if (!$loop->last),@endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-default btn-xs"
                                               href="{{ route('admin.administrators.edit', ['administrator' => $user->id]) }}"><i
                                                        class="fa fa-edit"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
                @if ( $users->perpage() < $users->total() )
                <div class="row">
                    <div class="col-sm-5">
                        <div class="dataTables_info" role="status" aria-live="polite">Показаны записи
                            с {{($users->currentpage()-1)*$users->perpage()+1}}
                            по {{($users->currentpage()-1) * $users->perpage() + $users->count()}}
                            из {{$users->total()}}</div>
                    </div>
                    <div class="col-sm-7">
                        <div class="dataTables_paginate paging_simple_numbers">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection