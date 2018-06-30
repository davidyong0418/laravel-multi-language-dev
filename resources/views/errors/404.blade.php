@extends('layouts.errors')
@section('title','Страница не найдена (Ошибка 404) – Адвокат Жаров')
@section('content')
    <main class="content">
        <div class="content__wrapper content__wrapper--error">
            <h1 class="content__title">Страница не найдена</h1>
            <p class="content__text">К&nbsp;сожалению, такой страницы не&nbsp;существует. Вы&nbsp;можете начать поиск необходимой информации заново с&nbsp;<a href="{{route('index')}}" class="content__link-text">главной&nbsp;страницы</a> сайта.</p>
        </div>
    </main>
@endsection
@section('modals')
    @parent
    @if (isset($modals))
        {!! $modals !!}
    @endif
@endsection
