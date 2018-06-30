@extends('artifico2::layout')
@section('title', 'Редактировать публикацию')
@section('page_header', 'Редактировать публикацию')
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
    <form method="post" action="{{ route('admin.publications.update',['id'=>$publications->id]) }}">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group {{$errors->has('date') ? 'has-error' : ''}}">
                            <label for="date">Дата</label>
                            <input type='date' id="date" class="form-control" name="date" value="{{$publications->date}}" />
                            @if ($errors->has('date'))
                                {!! $errors->first('date','<span class="help-block">:message</span>')  !!}
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="title">Название</label>
                            <br>
                            <input type="text" class="form-control" name="title" id="title" value="{{$publications->title}}">
                            @if ($errors->has('title'))
                                {!! $errors->first('title','<span class="help-block">:message</span>')  !!}
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group {{ $errors->has('author') ? 'has-error' : '' }}">
                            <label for="author">Источник</label>
                            <br>
                            <input type="text" class="form-control" name="author" id="author" value="{{$publications->author}}">
                            @if ($errors->has('author'))
                                {!! $errors->first('author','<span class="help-block">:message</span>')  !!}
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group {{ $errors->has('href') ? 'has-error' : '' }}">
                            <label for="href">Ссылка</label>
                            <br>
                            <input type="text" class="form-control" name="href" id="href" value="{{$publications->href}}">
                            @if ($errors->has('href'))
                                {!! $errors->first('href','<span class="help-block">:message</span>')  !!}
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="active">Категория</label>
                            <select name="category" id="category" class="form-control">
                                @foreach( \App\Publications::$categories as $categoryID => $category)
                                    <option {{ $publications->categories_id === $categoryID ? 'selected' : '' }} value="{{$categoryID}}">{{$category['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            @if(Auth::user()->hasPermissionTo('edit publications') || Auth::user()->hasPermissionTo('*'))
                <input type = "submit" class = "btn btn-success" value="Сохранить" style="min-width:100px;">
            @endif
            <a href="{{ route('admin.publications.index') }}" class="btn btn-default"
               style="min-width:100px;">Отмена</a>
            @if(Auth::user()->hasPermissionTo('delete publications') || Auth::user()->hasPermissionTo('*'))
                <button type="button" class="destroy-model btn btn-default pull-right"
                        data-href="<?php echo e(route('admin.publications.destroy', ['id' => $publications->id])); ?>"
                        data-redirect="<?php echo e(route('admin.publications.index')); ?>"
                        id="destroy-model-accept">Удалить</button>
            @endif
        </div>
        <input type="hidden" name="publication_id" value="{{$publications->id}}">
    </form>


@stop