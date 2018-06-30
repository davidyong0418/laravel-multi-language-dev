@extends('layouts.main')
@section('meta_title', $page->meta_name ?? $page->name)
@section('meta_description', $page->meta_description ?? '')
@section('meta_keywords', $page->meta_keywords ?? '')
@section('other_meta', $page->meta_other ?? '')


@section('content')
    {{--<h1 class="content__title">{{ $page->name }}</h1>--}}
    {!! $page->content !!}
@endsection

@section('modals')
    @parent
    @if (isset($modals))
        {!! $modals !!}
    @endif
@endsection
