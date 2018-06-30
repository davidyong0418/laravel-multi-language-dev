<header class="page-header">
    <div class="page-header__wrapper">
        <div class="page-header__burger-wrapper"><span class="page-header__burger"></span></div><a href="{{route('index')}}" class="page-header__name page-header__name--content">Адвокат Жаров</a>
    </div>
    <section class="page-header__menu-block">
        <div class="page-header__menu-header"><span class="page-header__cross"></span>
        </div>
        <div class="page-header__contacts-block">
            <nav class="page-header__nav-menu">
                {!!Navigation::menu(
                    'main_menu',
                    [
                        'menu'=>[
                            'element' => 'ul',
                            'html_options' => [
                                'class' => "page-header__menu-list",
                            ],
                        ],
                        'menu_item' => [
                            'element' => 'li',
                            "active_class"  => '',
                            'html_options' =>[
                                'class' => "page-header__menu-item",
                            ],
                            'link_options' => [
                                'class' => "page-header__menu-link",
                                'active_class'  =>  ' page-header__menu-link--active',
                        ],
                    ],
                    ],
                    4
                )!!}
            </nav>
            <div class="page-header__phone-block">
                <a class="page-header__phone" href="tel:{!! AppSettings::get('cms.phone','+7 (495) 227-01-21') !!}">{!! AppSettings::get('cms.phone','+7 (495) 227-01-21') !!}</a><a href="{!! AppSettings::get('cms.appointmenthref','http://azh.ru/ru/kontakty/zapisatsya-na-priem/') !!}" target="_blank" class="btn btn--record">Записаться на&nbsp;прием</a>
            </div>
        </div>
        <div class="page-header__info-block">
            <div class="page-header__logo-block"><span class="page-header__logo"></span><a href="http://azh.ru/" target="_blank" class="page-header__owner">Команда<br> Адвоката Жарова</a></div>
            <p class="page-header__regnumber">Регистрационный номер в реестре адвокатов города Москвы — 77/9327.</p>
        </div>
    </section>
</header>
