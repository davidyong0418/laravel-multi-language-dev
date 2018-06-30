@extends('layouts.main')
@section('meta_title', 'Публикации – Адвокат Жаров')
@section('meta_description','Архив телепередач, статей и радио эфиров с участием адвоката Жарова.')
@section('content')
<main class="content">
    <main class="content__wrapper">
        <h1 class="content__title">Публикации</h1>
        <div id="content__anchors-block-id" class="content__anchors-block">
            @foreach($publications as $categoryID => $categoryPublications)
                <a href="#{{App\Publications::$categories[$categoryID]['selector']}}" class="content__link">{{App\Publications::$categories[$categoryID]['name']}}</a>
            @endforeach
        </div>
        <div class="content__blocks">
            @if (!$publications)
                <p>Нет публикаций</p>
            @endif
            @foreach($publications as $categoryID => $categoryPublications)
            <div class="content__block content__block--publications">
                <h2 id="{{App\Publications::$categories[$categoryID]['selector']}}" class="content__block-title">{{App\Publications::$categories[$categoryID]['name']}}</h2>
                            @foreach($categoryPublications as $publicationID => $publication )
                            <div class="content__show-block"><a href="{{$publication->href}}" target="_blank" class="content__show-name">{{$publication->title}}</a>
                                <p class="content__show-time">{{\Carbon\Carbon::parse($publication->date)->format('d.m.Y')}} {{$publication->author}}</p>
                            </div>
                            @endforeach
                @if(count($categoryPublications)>5)
                <div class="content__link content__link--publications content__show-all content__show-all--tv">
                    <p class="content__show-all-link">Показать все</p>
                </div>
                @endif
            </div>
@endforeach
        </div>
    </main>
@endsection


