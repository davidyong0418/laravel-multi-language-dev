@extends('artifico2::layout')

@section('title', 'Добавить страницу')
@section('page_header', 'Добавить страницу')


@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ config('artifico2.root_path') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="{{ route('admin.pages.index') }}">Страницы</a></li>
    </ol>
@endsection

@section('content')
    <?php $activeLocale = current(array_keys($locales)); ?>

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

    <form  method="post" action="{{ route('admin.pages.store') }}">
        {{ csrf_field() }}
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group {{ $errors->has('alias') ? 'has-error' : '' }}">
                            <label for="alias">Псевдоним</label>
                            <input type="text" class="form-control" id="alias" name="alias" value="{{ old('alias') }}">
                            @if ($errors->has('alias'))
                                {!! $errors->first('alias','<span class="help-block">:message</span>')  !!}
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group {{ $errors->has('active') ? 'has-error' : '' }}">
                            <label for="active">Статус</label>
                            <select name="active" id="active" class="form-control">
                                <option value="{{ \Nutnet\Artifico2\Pages\App\Models\Page::STATUS_ACTIVE }}"
                                        @if ( old('active') === \Nutnet\Artifico2\Pages\App\Models\Page::STATUS_ACTIVE)
                                        selected
                                        @endif>{{ \Nutnet\Artifico2\Pages\App\Models\Page::getStatusName(\Nutnet\Artifico2\Pages\App\Models\Page::STATUS_ACTIVE) }}</option>
                                <option value="{{ \Nutnet\Artifico2\Pages\App\Models\Page::STATUS_DISABLED }}"
                                        @if ( old('active') === \Nutnet\Artifico2\Pages\App\Models\Page::STATUS_DISABLED)
                                        selected
                                        @endif>{{ \Nutnet\Artifico2\Pages\App\Models\Page::getStatusName(\Nutnet\Artifico2\Pages\App\Models\Page::STATUS_DISABLED) }}</option>
                            </select>
                            @if ($errors->has('active'))
                                {!! $errors->first('active','<span class="help-block">:message</span>')  !!}
                            @endif
                        </div>
                    </div>
                </div>

                <div class="nav-tabs-custom">
                    <?php $uniq = 'tab-locales-main'; ?>
                    @if (count($locales) > 1)
                        <ul class="nav nav-tabs">
                            @foreach ($locales as $code => $name)
                                <li @if($code == $activeLocale)class="active"@endif>
                                    <a href="#tab_{{ $uniq }}_{{ $code }}" data-toggle="tab">{{ $name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="tab-content">
                        @foreach ($locales as $code => $name)
                            <div class="tab-pane{{ $code == $activeLocale ? ' active': '' }}" id="tab_{{ $uniq }}_{{ $code }}">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group {{ $errors->has("name.$code") ? 'has-error' : '' }}">
                                            <label for="name_{{ $code }}">Название</label>
                                            <input type="text" class="form-control" id="name_{{$code}}" name="name[{{ $code }}]"
                                                   value="{{ old("name[$code]") }}">
                                            @if ($errors->has("name.$code"))
                                                {!! $errors->first("name.$code",'<span class="help-block">:message</span>')  !!}
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-xs-12">
                                        <div class="form-group {{ $errors->has("content.$code") ? 'has-error' : '' }}">
                                            <label for="content_{{ $code }}">Текст</label>
                                            <textarea data-ckeditor-config='{"allowedContent":true,"pasteFilter":null}' {!! config('artifico-pages.wysiwyg', true) ? 'data-ckeditor="true" ' : '' !!}class="form-control" id="content_{{$code}}" name="content[{{ $code }}]">{{ old("content[$code]") }}</textarea>
                                            @if ($errors->has("content.$code"))
                                                {!! $errors->first("content.$code",'<span class="help-block">:message</span>')  !!}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="box collapsed-box">
            <div class="box-header with-border">
                <h3 class="box-title">Мета-информация</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="nav-tabs-custom">
                    <?php $uniq = 'tab-locales-meta'; ?>
                    @if (count($locales) > 1)
                        <ul class="nav nav-tabs">
                            @foreach ($locales as $code => $name)
                                <li @if($code == $activeLocale)class="active"@endif>
                                    <a href="#tab_{{ $uniq }}_{{ $code }}" data-toggle="tab">{{ $name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="tab-content">
                        @foreach ($locales as $code => $name)
                            <div class="tab-pane{{ $code == $activeLocale ? ' active': '' }}" id="tab_{{ $uniq }}_{{ $code }}">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group {{ $errors->has("meta_name.$code") ? 'has-error' : '' }}">
                                            <label for="meta_name_{{ $code }}">Заголовок</label>
                                            <input type="text" class="form-control" id="meta_name_{{$code}}" name="meta_name[{{ $code }}]"
                                                   value="{{ old("meta_name[$code]") }}">
                                            @if ($errors->has("meta_name.$code"))
                                                {!! $errors->first("meta_name.$code",'<span class="help-block">:message</span>')  !!}
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-xs-12">
                                        <div class="form-group {{ $errors->has("meta_description.$code") ? 'has-error' : '' }}">
                                            <label for="meta_description_{{ $code }}">Описание</label>
                                            <textarea class="form-control" id="meta_description_{{$code}}" name="meta_description[{{ $code }}]">{{ old("meta_description[$code]") }}</textarea>
                                            @if ($errors->has("meta_description.$code"))
                                                {!! $errors->first("meta_description.$code",'<span class="help-block">:message</span>')  !!}
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-xs-12">
                                        <div class="form-group {{ $errors->has("meta_keywords.$code") ? 'has-error' : '' }}">
                                            <label for="meta_keywords_{{ $code }}">Ключевые слова</label>
                                            <textarea class="form-control" id="meta_keywords_{{$code}}" name="meta_keywords[{{ $code }}]">{{ old("meta_keywords[$code]") }}</textarea>
                                            @if ($errors->has("meta_keywords.$code"))
                                                {!! $errors->first("meta_keywords.$code",'<span class="help-block">:message</span>')  !!}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-success" style="min-width:100px;"
                   value="Добавить">
            <a href="{{ route('admin.pages.index') }}" class="btn btn-default"
               style="min-width:100px;">Отмена</a>
        </div>
    </form>
@endsection

@section('javascripts')
    @parent
    <script src="{{ URL::asset('vendor/artifico2/plugins/ckeditor/ckeditor.js') }}"></script>
@endsection