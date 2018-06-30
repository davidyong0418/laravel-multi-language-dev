@extends('artifico2::layout')

@section('title', 'Настройка')
@section('page_header', 'Настройки')

@section('content')
    <div class="box">

            {{--<div class="row">--}}
                {{--<div class="col-xs-12">--}}
                    {{--@if(Auth::user()->hasPermissionTo('create setting') || Auth::user()->hasPermissionTo('*'))--}}
                        {{--<a href="{{ route('admin.settings.create') }}" class="btn btn-primary margin pull-right">--}}
                            {{--<i class="fa fa-plus"></i> Добавить</a>@endif--}}
                {{--</div>--}}
            {{--</div>--}}
            @foreach ($settings as $group => $groupSettings)
            <div class="box-group" id="accordion">
                <div class="panel box box-default">
                    <div class="box-header with-border">
                        <h4 class="box-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" class="">
                                {{$group}}
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" aria-expanded="true" style="">
                        <div class="box-body">
                            <table class="table table-bordered table-striped table-hover dataTable"
                                   role="grid"
                                   aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th>Название</th>
                                    <th>Ключ</th>
                                    <th>Значение</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($groupSettings as $setting)
                                    <tr role="row" class='row-link'
                                        data-href='{{ route('admin.settings.edit', ['key' => trim($setting->key)]) }}'>
                                        <td>{{ $setting->name }}</td>
                                        <td>{{ $setting->key }}</td>
                                        <td>{{ $setting->value }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-default btn-xs"
                                                   href="{{ route('admin.settings.edit', ['setting' => trim($setting->key)]) }}"><i
                                                            class="fa fa-edit"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
    </div>
@endsection