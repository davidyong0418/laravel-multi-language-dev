@extends('artifico2::layout')
@section('title', 'Управление администраторами')

@section('content')
    <div class="error-page">
        <h2 class="headline text-yellow"> 403</h2>

        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Нет доступа</h3>

            <p>403 ошибка  возникает, когда у Вас недостаточно прав для доступа к запрашиваему файлу или старнице. Вы можете запросить доступ у Администратора или вернуться <a href="{{ url()->previous() }}">назад.</a></p>
        </div>
        <!-- /.error-content -->
    </div>
@endsection