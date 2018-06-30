@extends('artifico2::layout')
@section('title', 'Публикации')
@section('page_header', 'Публикации')
@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <h4><i class="icon fa fa-ban"></i> Ошибка</h4>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="box box-default">
        <div class="box-body">
            <div class="row">
                <form method="get" class="form-inline" action="{{ route('admin.publications.index') }}">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="role" class="sr-only">Название</label>
                            <input type="text" class="form-control" id="search" name="search"
                                   value="{{ $search }}" placeholder="Название или псевдоним">
                        </div>
                        <input type="submit" class="btn btn-default" value="Искать">
                        <a href="{{ route('admin.publications.index') }}" class="btn btn-default">Сбросить</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    @if(Auth::user()->hasPermissionTo('create publications') || Auth::user()->hasPermissionTo('*'))
                        <a href="{{ route('admin.publications.create') }}" class="btn btn-primary margin pull-right">
                            <i class="fa fa-plus"></i> Добавить</a>@endif
                </div>
            </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-striped table-hover dataTable" role="grid" aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th>Дата</th>
                                <th>Название</th>
                                <th>Источник</th>
                                <th>Ссылка</th>
                                <th>Категория</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody class="sortable">
                            {{--@if ($publications->count() < 1)--}}
                                {{--<tr>--}}
                                    {{--<td colspan="4"></td>--}}
                                {{--</tr>--}}
                            {{--@else--}}
                                {{--@endif--}}
                                @foreach ($publications as $publication)
                                    <tr role="row" class='row-link sortable-dragging' data-id="{{ $publication->id }}"
                                        data-href='{{ route('admin.publications.edit', ['id' => $publication->id]) }}'>
                                        <td>{{ $publication->date }}</td>
                                        <td>
                                            @if (count($publication->descendants) > 0)
                                                <a href="{{ route('admin.publications.index', ['id' => $publication->id]) }}">{{ $publication->title }}</a>
                                            @else
                                                {{ $publication->title }}
                                            @endif
                                        </td>
                                        <td>{{ $publication->author }}</td>
                                        <td>{{ $publication->href }}</td>
                                        <td>{{\App\Publications::$categories[$publication->categories_id]['name']}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-default btn-xs"
                                                   href="{{ route('admin.publications.edit', ['id' => $publication->id]) }}"><i
                                                            class="fa fa-edit"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            {{ $publications->links() }}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @stop