@extends('artifico2::layout')

@section('title', 'Страницы')
@section('page_header', 'Страницы')

@section('content')

    <div class="box box-default">
        <div class="box-body">
            <div class="row">
                <form method="get" class="form-inline" action="{{ route('admin.pages.index') }}">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="role" class="sr-only">Название или псевдоним</label>
                            <input type="text" class="form-control" id="search" name="search"
                                   value="{{ $search }}" placeholder="Название или псевдоним">
                        </div>
                        <input type="submit" class="btn btn-default" value="Искать">
                        <a href="{{ route('admin.pages.index') }}" class="btn btn-default">Сбросить</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    @if(Auth::user()->hasPermissionTo('create page') || Auth::user()->hasPermissionTo('*'))
                        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary margin pull-right">
                            <i class="fa fa-plus"></i> Добавить</a>@endif
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-bordered table-striped table-hover dataTable"
                           role="grid"
                           aria-describedby="example1_info">
                        <thead>
                            <tr role="row">
                                <th>ID</th>
                                <th>Заголовок</th>
                                <th>Псевдоним</th>
                                <th>Статус</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @if ($pages->count() < 1)
                            <tr>
                                <td colspan="5">По вашему запросу ничего не найдено</td>
                            </tr>
                        @else
                            @foreach ($pages as $page)
                            <tr role="row" class='row-link'
                                data-href='{{ route('admin.pages.edit', ['id' => $page->id]) }}'>
                                <td>{{ $page->id }}</td>
                                <td>{{ $page->name }}</td>
                                <td>{{ $page->alias }}</td>
                                <td>
                                    <span class="label label-{{ \Nutnet\Artifico2\Pages\App\Models\Page::STATUS_ACTIVE == $page->active ? 'success' : 'danger' }}">{{ \Nutnet\Artifico2\Pages\App\Models\Page::getStatusName($page->active) }}</span></td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-default btn-xs"
                                           href="{{ route('admin.pages.edit', ['id' => $page->id]) }}"><i
                                                    class="fa fa-edit"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @if ( $pages->perpage() < $pages->total() )
                <div class="row">
                    <div class="col-sm-5">
                        <div class="dataTables_info" role="status" aria-live="polite">Показаны записи
                            с {{($pages->currentpage()-1) * $pages->perpage() + 1}}
                            по {{($pages->currentpage()-1) * $pages->perpage() + $pages->count()}}
                            из {{$pages->total()}}</div>
                    </div>
                    <div class="col-sm-7">
                        <div class="dataTables_paginate paging_simple_numbers">
                            {{ $pages->links() }}
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection