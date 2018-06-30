@extends('artifico2::layout')

@section('title', 'Главная')

@section('content')

    @if ($last12month != null && $last30days != null)
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">В среднем за день</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="visitsPerDayChart" style="height: 327px; width: 715px;" height="654" width="1430"></canvas>
                        </div>
                    </div>
                    <div class="box-footer text-center">
                        <p class="text-muted">Подробнее со статистикой сайта можно ознакомиться на сервисе <a href="http://www.google.com/analytics/" target="_blank" title="Google Analytics">Google Analytics</a> или <a href="http://metrika.yandex.ru/" target="_blank" title="Яндекс.Меткика">Яндекс.Метрика</a></p>
                    </div>

                </div>

                <script>
                    var visitsPerDayData = {
                        labels:  {!! '[' . implode(',', $last12month['month']) . ']' !!},
                        datasets: [
                            {
                                label: "Сессий",
                                fillColor: "rgba(60,141,188,0.9)",
                                strokeColor: "rgba(60,141,188,0.8)",
                                pointColor: "#3b8bba",
                                pointStrokeColor: "rgba(60,141,188,1)",
                                pointHighlightFill: "#fff",
                                pointHighlightStroke: "rgba(60,141,188,1)",
                                data: {{ '[' . implode(',', $last12month['sessionsPerDay']) . ']' }}
                            },
                            {
                                label: "Пользователей",
                                fillColor: "#00a65a",
                                strokeColor: "#018e4a",
                                pointColor: "#018e4a",
                                pointStrokeColor: "#018e4a",
                                pointHighlightFill: "#fff",
                                pointHighlightStroke: "#018e4a",
                                data: {{ '[' . implode(',', $last12month['visitorsPerDay']) . ']' }}
                            }
                        ]
                    };
                </script>

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">За 30 дней</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="visitsLast30DaysChart" style="height: 327px; width: 715px;" height="654" width="1430"></canvas>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-xs-12">
                                <div class="small-box bg-green">
                                    <div class="inner">
                                        <h3>{{ $last30days['percentNewUsers'] }}<sup style="font-size: 20px">%</sup></h3>

                                        <p>Новых</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <div class="small-box bg-green">
                                    <div class="inner">
                                        <h3>{{ $last30days['percentBounces'] }}<sup style="font-size: 20px">%</sup></h3>

                                        <p>Отказов</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <div class="small-box bg-green">
                                    <div class="inner">
                                        <h3>{{ $last30days['pageViewsPerSession'] }}</h3>

                                        <p>Страниц в среднем</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        var visitsLast30DaysData = {
                            labels:  {!! '[' . implode(',', $last30days['date']) . ']' !!},
                            datasets: [
                                /*{
                                    label: "Просмотров",
                                    fillColor: "rgba(210, 214, 222, 1)",
                                    strokeColor: "rgba(210, 214, 222, 1)",
                                    pointColor: "rgba(210, 214, 222, 1)",
                                    pointStrokeColor: "#c1c7d1",
                                    pointHighlightFill: "#fff",
                                    pointHighlightStroke: "rgba(220,220,220,1)",
                                    data: {{ '[' . implode(',', $last30days['pageViews']) . ']' }}
                                },*/
                                {
                                    label: "Сессий",
                                    fillColor: "rgba(60,141,188,0.9)",
                                    strokeColor: "rgba(60,141,188,0.8)",
                                    pointColor: "#3b8bba",
                                    pointStrokeColor: "rgba(60,141,188,1)",
                                    pointHighlightFill: "#fff",
                                    pointHighlightStroke: "rgba(60,141,188,1)",
                                    data: {{ '[' . implode(',', $last30days['sessions']) . ']' }}
                                },
                                {
                                    label: "Пользователей",
                                    fillColor: "#00a65a",
                                    strokeColor: "#018e4a",
                                    pointColor: "#018e4a",
                                    pointStrokeColor: "#018e4a",
                                    pointHighlightFill: "#fff",
                                    pointHighlightStroke: "#018e4a",
                                    data: {{ '[' . implode(',', $last30days['visitors']) . ']' }}
                                }
                            ]
                        };
                    </script>

                </div>
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">За 12 месяцев</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="visitsLast12MonthsChart" style="height: 327px; width: 715px;" height="654" width="1430"></canvas>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-xs-12">
                                <div class="small-box bg-green">
                                    <div class="inner">
                                        <h3>{{ $last12month['percentNewUsers'] }}<sup style="font-size: 20px">%</sup></h3>

                                        <p>Новых</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <div class="small-box bg-green">
                                    <div class="inner">
                                        <h3>{{ $last12month['percentBounces'] }}<sup style="font-size: 20px">%</sup></h3>

                                        <p>Отказов</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <div class="small-box bg-green">
                                    <div class="inner">
                                        <h3>{{ $last12month['pageViewsPerSession'] }}</h3>

                                        <p>Страниц в среднем</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        var visitsLast12MonthsData = {
                            labels:  {!! '[' . implode(',', $last12month['month']) . ']' !!},
                            datasets: [
                                {
                                    label: "Сессий",
                                    fillColor: "rgba(60,141,188,0.9)",
                                    strokeColor: "rgba(60,141,188,0.8)",
                                    pointColor: "#3b8bba",
                                    pointStrokeColor: "rgba(60,141,188,1)",
                                    pointHighlightFill: "#fff",
                                    pointHighlightStroke: "rgba(60,141,188,1)",
                                    data: {{ '[' . implode(',', $last12month['sessions']) . ']' }}
                                },
                                {
                                    label: "Пользователей",
                                    fillColor: "#00a65a",
                                    strokeColor: "#018e4a",
                                    pointColor: "#018e4a",
                                    pointStrokeColor: "#018e4a",
                                    pointHighlightFill: "#fff",
                                    pointHighlightStroke: "#018e4a",
                                    data: {{ '[' . implode(',', $last12month['visitors']) . ']' }}
                                }
                            ]
                        };
                    </script>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning" role="alert">Обратитесь к разработчикам для настройки корректного отображения статистики Google Analytics</div>
    @endif
@endsection
@section('javascripts')
    @parent
    <script src="{{ URL::asset('js/admin/dashboard.js') }}"></script>
@endsection