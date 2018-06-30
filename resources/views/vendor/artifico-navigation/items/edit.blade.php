@extends('artifico2::layout')

@section('title', 'Редактировать пункт')
@section('page_header', 'Редактировать пункт')


@section('breadcrumbs')
        @php
            $parents = $item->ancestors()->get();
        @endphp
        @if ($parents->count() > 0)
            <ol class="breadcrumb">
                <li><a href="{{ config('artifico2.root_path') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
                <li><a href="{{ route('admin.navigation.index') }}">Навигация</a></li>
                @foreach ($parents as $parent)
                    <li><a href="{{ route('admin.navigation.index', ['id' => $parent->id]) }}">{{$parent->name}}</a></li>
                @endforeach
                <li><a href="{{route('admin.navigation.index',['id' => $item->id]) }}"> {{$item->name}}</a></li>
            </ol>

        @endif
@endsection

@section('content')
    <div class="modal fade" id="destroy-model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Подтвердите действие</h4>
                </div>
                <div class="modal-body">
                    Вы действительно хотите удалить пункт {{$item->name}}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-primary"
                            data-href="{{ route('admin.navigation.destroy', ['id' => $item->id]) }}"
                            data-redirect="{{ route('admin.navigation.index') }}"
                            id="destroy-model-accept">Удалить</button>
                </div>
            </div>
        </div>
    </div>

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

    <form method="post" action="{{ route('admin.navigation.update', ['id' => $item->id]) }}">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="box box-default">
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">
                            <label for="active">Родительский пункт</label>
                            <select name="parent_id" id="parent_id" class="form-control">
                                <option value="0">-</option>
                                @php
                                $traverse = function ($categories, $prefix = '-', $parent_id) use (&$traverse) {
                                    foreach ($categories as $category) {
                                        echo PHP_EOL."<option value=\"$category->id\" ".((old('parent_id') != null && old('parent_id') == $category->id) || (old('parent_id') == null && $parent_id == $category->id)?"selected":"").">".$prefix.' '.$category->name."</option>";
                                        $traverse($category->children, $prefix.'-', $parent_id);
                                    }
                                };
                                $traverse($items, "-", $item->parent_id);
                                @endphp
                            </select>
                            @if ($errors->has('parent_id'))
                                {!! $errors->first('parent_id','<span class="help-block">:message</span>')  !!}
                            @endif
                        </div>
                    </div>

                    <div class="col-xs-12">
                        @include('artifico-navigation::items.widgets.name-field')
                    </div>

                    <div class="col-xs-12">
                        <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                            <label for="type">Тип</label>
                            <select name="type" id="type" class="form-control">
                                @if (old('type') != '')
                                    <option value="{{ \Nutnet\Artifico2\Navigation\App\Models\Item::TYPE_LINK }}"
                                    @if ( old('type') == \Nutnet\Artifico2\Navigation\App\Models\Item::TYPE_LINK)
                                            selected
                                            @endif>{{ \Nutnet\Artifico2\Navigation\App\Models\Item::getTypeName(\Nutnet\Artifico2\Navigation\App\Models\Item::TYPE_LINK) }}</option>
                                    <option value="{{ \Nutnet\Artifico2\Navigation\App\Models\Item::TYPE_PAGE }}"
                                    @if ( old('type') == \Nutnet\Artifico2\Navigation\App\Models\Item::TYPE_PAGE)
                                            selected
                                            @endif>{{ \Nutnet\Artifico2\Navigation\App\Models\Item::getTypeName(\Nutnet\Artifico2\Navigation\App\Models\Item::TYPE_PAGE) }}</option>
                                @else
                                    <option value="{{ \Nutnet\Artifico2\Navigation\App\Models\Item::TYPE_LINK }}"
                                    @if ( $item->type == \Nutnet\Artifico2\Navigation\App\Models\Item::TYPE_LINK)
                                            selected
                                            @endif>{{ \Nutnet\Artifico2\Navigation\App\Models\Item::getTypeName(\Nutnet\Artifico2\Navigation\App\Models\Item::TYPE_LINK) }}</option>
                                    <option value="{{ \Nutnet\Artifico2\Navigation\App\Models\Item::TYPE_PAGE }}"
                                    @if ( $item->type == \Nutnet\Artifico2\Navigation\App\Models\Item::TYPE_PAGE)
                                            selected
                                            @endif>{{ \Nutnet\Artifico2\Navigation\App\Models\Item::getTypeName(\Nutnet\Artifico2\Navigation\App\Models\Item::TYPE_PAGE) }}</option>
                                @endif
                            </select>
                            @if ($errors->has('type'))
                                {!! $errors->first('type','<span class="help-block">:message</span>')  !!}
                            @endif
                        </div>
                    </div>

                    <div class="col-xs-12 {{ old('type') && old('type') != \Nutnet\Artifico2\Navigation\App\Models\Item::TYPE_LINK ? 'hidden' : ($item->type != \Nutnet\Artifico2\Navigation\App\Models\Item::TYPE_LINK) ? 'hidden' : '' }}">
                        <div class="form-group {{ $errors->has('url') ? 'has-error' : '' }}">
                            <label for="url">URL</label>
                            <input type="text" class="form-control" id="url" name="url" value="{{ old('url') ? : ($item->type == \Nutnet\Artifico2\Navigation\App\Models\Item::TYPE_LINK ? $item->value : '') }}">
                            @if ($errors->has('url'))
                                {!! $errors->first('url','<span class="help-block">:message</span>')  !!}
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12 {{ old('type') && old('type') != \Nutnet\Artifico2\Navigation\App\Models\Item::TYPE_PAGE ? 'hidden' : ($item->type != \Nutnet\Artifico2\Navigation\App\Models\Item::TYPE_PAGE) ? 'hidden' : '' }}">
                        <div class="form-group {{ $errors->has('page_id') ? 'has-error' : '' }}">
                            <label for="page_id">Страница</label>

                            <select name="page_id" id="page_id" class="form-control">
                                <option value="">-</option>
                                @foreach ($pages as $page)
                                    <option value="{{ $page->id }}" {{ old('page_id') ? ($page->id == old('page_id') ? 'selected' : '') : ( $item->type == \Nutnet\Artifico2\Navigation\App\Models\Item::TYPE_PAGE && $page->id == $item->value ? 'selected' : '' ) }}>{{ $page->name }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('page_id'))
                                {!! $errors->first('page_id','<span class="help-block">:message</span>')  !!}
                            @endif
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="form-group {{ $errors->has('active') ? 'has-error' : '' }}">
                            <label for="active">Статус</label>
                            <select name="active" id="active" class="form-control">
                                @if (old('active') != '')
                                    <option value="{{ \Nutnet\Artifico2\Navigation\App\Models\Item::STATUS_ACTIVE }}"
                                    @if ( old('active') == \Nutnet\Artifico2\Navigation\App\Models\Item::STATUS_ACTIVE)
                                            selected
                                            @endif>{{ \Nutnet\Artifico2\Navigation\App\Models\Item::getStatusName(\Nutnet\Artifico2\Navigation\App\Models\Item::STATUS_ACTIVE) }}</option>
                                    <option value="{{ \Nutnet\Artifico2\Navigation\App\Models\Item::STATUS_DISABLED }}"
                                            @if ( old('active') == \Nutnet\Artifico2\Navigation\App\Models\Item::STATUS_DISABLED)
                                            selected
                                            @endif>{{ \Nutnet\Artifico2\Navigation\App\Models\Item::getStatusName(\Nutnet\Artifico2\Navigation\App\Models\Item::STATUS_DISABLED) }}</option>
                                @else
                                    <option value="{{ \Nutnet\Artifico2\Navigation\App\Models\Item::STATUS_ACTIVE }}"
                                    @if ( $item->active == \Nutnet\Artifico2\Navigation\App\Models\Item::STATUS_ACTIVE)
                                            selected
                                            @endif>{{ \Nutnet\Artifico2\Navigation\App\Models\Item::getStatusName(\Nutnet\Artifico2\Navigation\App\Models\Item::STATUS_ACTIVE) }}</option>
                                    <option value="{{ \Nutnet\Artifico2\Navigation\App\Models\Item::STATUS_DISABLED }}"
                                    @if ( $item->active == \Nutnet\Artifico2\Navigation\App\Models\Item::STATUS_DISABLED)
                                            selected
                                            @endif>{{ \Nutnet\Artifico2\Navigation\App\Models\Item::getStatusName(\Nutnet\Artifico2\Navigation\App\Models\Item::STATUS_DISABLED) }}</option>
                                @endif

                            </select>
                            @if ($errors->has('active'))
                                {!! $errors->first('active','<span class="help-block">:message</span>')  !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box collapsed-box">
            <div class="box-header with-border">
                <h3 class="box-title">Параметры</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group {{ $errors->has('alias') ? 'has-error' : '' }}">
                            <label for="alias">Псевдоним</label>
                            <input type="text" class="form-control" id="alias" name="alias" value="{{ old('alias') ? : $item->alias }}">
                            <p class="help-block">Может использоваться для вывода меню на странице</p>
                            @if ($errors->has('alias'))
                                {!! $errors->first('alias','<span class="help-block">:message</span>')  !!}
                            @endif
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="checkbox {{ $errors->has('link_attributes.target') ? 'has-error' : '' }}">
                            <label for="link_attributes_target">
                                <input type="checkbox" id="link_attributes_target" name="link_attributes[target]" value="_blank"{!! (!empty(old()) ? old('link_attributes.target') : !empty($item->link_attributes['target'])) ? ' checked' : '' !!}/> Открывать ссылку в новой вкладке
                            </label>

                            @if ($errors->has('link_attributes.target'))
                                {!! $errors->first('link_attributes.target','<span class="help-block">:message</span>')  !!}
                            @endif
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="checkbox {{ $errors->has('link_attributes.rel') ? 'has-error' : '' }}">
                            <label for="link_attributes_rel">
                                <input type="checkbox" id="link_attributes_rel" name="link_attributes[rel]" value="nofollow"{!! (!empty(old()) ? old('link_attributes.rel') : !empty($item->link_attributes['rel'])) ? ' checked' : '' !!}/> Не передавать по ссылке ТИЦ и PR
                            </label>

                            @if ($errors->has('link_attributes.rel'))
                                {!! $errors->first('link_attributes.rel','<span class="help-block">:message</span>')  !!}
                            @endif
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="checkbox {{ $errors->has('noindex') ? 'has-error' : '' }}">
                            <input type="hidden" name="noindex" value="0"/>
                            <label for="noindex">
                                <input type="checkbox" id="noindex" name="noindex" value="1"{!! (!empty(old()) ? old('noindex') : !empty($item->noindex)) ? ' checked' : '' !!}/> Не индексировать
                            </label>

                            @if ($errors->has('noindex'))
                                {!! $errors->first('noindex','<span class="help-block">:message</span>')  !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-success" style="min-width:100px;"
                   value="Сохранить">
            <a href="{{ route('admin.navigation.index') }}" class="btn btn-default"
               style="min-width:100px;">Отмена</a>
            @if(Auth::user()->hasPermissionTo('delete navitem') || Auth::user()->hasPermissionTo('*'))
                <span class="destroy-model btn btn-default pull-right"
                      style="min-width:100px;">Удалить</span>@endif
        </div>
    </form>
@endsection

@section('javascripts')
    @parent
    <script src="{{ URL::asset('vendor/artifico-navigation/edit.js') }}"></script>
    <script>
        var TYPE_LINK = '{{ \Nutnet\Artifico2\Navigation\App\Models\Item::TYPE_LINK }}';
        var TYPE_PAGE = '{{ \Nutnet\Artifico2\Navigation\App\Models\Item::TYPE_PAGE }}';
    </script>
@endsection
