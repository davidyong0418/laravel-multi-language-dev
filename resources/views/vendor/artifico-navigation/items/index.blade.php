@extends('artifico2::layout')

@section('title', 'Навигация')
@section('page_header', 'Навигация')

@section('breadcrumbs')
    @if ($items->count() > 0)
        @php
            $parents = $items[0]->ancestors()->get();
        @endphp
        @if ($parents->count() > 0)
            <ol class="breadcrumb">
                <li><a href="{{ config('artifico2.root_path') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
                <li><a href="{{ route('admin.navigation.index') }}">Навигация</a></li>
                @foreach ($parents as $parent)
                    <li><a href="{{ route('admin.navigation.index', ['id' => $parent->id]) }}">{{$parent->name}}</a></li>
                @endforeach
            </ol>

        @endif
    @endif
@endsection


@section('content')

    <style>
        .table-sortable {
            position: relative;
        }
        .table-sortable .sortable-placeholder {
            height: 37px;
        }
        .table-sortable .sortable-placeholder:after {
            position: absolute;
            z-index: 10;
            content: " ";
            height: 37px;
            background: #f9f9f9;
            left: 0;
            right: 0;
        }
    </style>

    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    @if(Auth::user()->hasPermissionTo('create navitem') || Auth::user()->hasPermissionTo('*'))
                        <a href="@if ($id != null) {{ route('admin.navigation.create', ['parent_id' => $id]) }} @else {{ route('admin.navigation.create') }} @endif" class="btn btn-primary margin pull-right">
                            <i class="fa fa-plus"></i> Добавить</a>@endif
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-bordered table-sortable table-striped table-hover dataTable"
                           role="grid"
                           aria-describedby="example1_info">
                        <thead>
                        <tr role="row">
                            <th>Название</th>
                            <th>Псевдоним</th>
                            <th>Статус</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="sortable" data-ajax-sortable-url="{{ route('admin.navigation.sort') }}">
                        @if ($items->count() < 1)
                            <tr>
                                <td colspan="4">По вашему запросу ничего не найдено</td>
                            </tr>
                        @else
                            @foreach ($items as $item)
                                <tr role="row" class='row-link sortable-dragging' data-id="{{ $item->id }}"
                                    data-href='{{ route('admin.navigation.edit', ['id' => $item->id]) }}'>
                                    <td>
                                        @if (count($item->descendants) > 0)
                                            <a href="{{ route('admin.navigation.index', ['id' => $item->id]) }}">{{ $item->name }}</a>
                                        @else
                                            {{ $item->name }}
                                        @endif
                                    </td>
                                    <td>{{ $item->alias }}</td>
                                    <td>
                                        <span class="label label-{{ \Nutnet\Artifico2\Navigation\App\Models\Item::STATUS_ACTIVE == $item->active ? 'success' : 'danger' }}">{{ \Nutnet\Artifico2\Navigation\App\Models\Item::getStatusName($item->active) }}</span></td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-default btn-xs"
                                               href="{{ route('admin.navigation.edit', ['id' => $item->id]) }}"><i
                                                        class="fa fa-edit"></i></a>
                                            {{--<a class="btn btn-default btn-xs"
                                               href="javascript:void(0)"><i
                                                        class="fa fa-arrows"></i></a>--}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascripts')
    @parent
    <script src="{{ URL::asset('vendor/artifico-navigation/index.js') }}"></script>
@endsection