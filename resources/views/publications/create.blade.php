@extends('artifico2::layout')
@section('title', 'Добавить публикацию')
@section('page_header', 'Добавить публикацию')
@section('content')

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ config('artifico2.root_path') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="{{ route('admin.publications.index') }}">Публикации</a></li>
    </ol>
@endsection

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

    <form method="post" action="{{ route('admin.publications.store') }}">
        {{ csrf_field() }}
        <div class="box box-default">
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                            <label for="date">Дата</label>
                            <input type='date' id="date" class="form-control" name="date" />
                            @if ($errors->has('date'))
                                {!! $errors->first('date','<span class="help-block">:message</span>')  !!}
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="title">Название</label>
                            <br>
                            <input type="text" class="form-control" name="title" id="title"  value="{{old('title')}}">
                            @if ($errors->has('title'))
                                {!! $errors->first('title','<span class="help-block">:message</span>')  !!}
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group {{ $errors->has('author') ? 'has-error' : '' }}">
                            <label for="author">Источник</label>
                            <br>
                            <input type="text" class="form-control" name="author" id="author" value="{{old('author')}}">
                            @if ($errors->has('author'))
                                {!! $errors->first('author','<span class="help-block">:message</span>')  !!}
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group {{ $errors->has('href') ? 'has-error' : '' }}">
                            <label for="href">Ссылка</label>
                            <br>
                            <input type="text" class="form-control" name="href" id="href" value="{{old('href')}}">
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
                                    <option value="{{$categoryID}}">{{$category['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
         </div>
        <div class="form-group">
            @if(Auth::user()->hasPermissionTo('create publications') || Auth::user()->hasPermissionTo('*'))
                <input type = "submit" value="Сохранить" class = "btn btn-success" style="min-width:100px;">
            @endif
            <a href="{{ route('admin.publications.index') }}" class="btn btn-default"
               style="min-width:100px;">Отмена</a>
        </div>

    </form>

@stop