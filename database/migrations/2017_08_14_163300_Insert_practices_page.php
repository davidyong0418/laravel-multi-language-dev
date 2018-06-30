<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;



Class InsertPracticesPage extends migration
{
    public function up()
    {


        \Illuminate\Support\Facades\DB::statement("
            INSERT INTO pages (`alias`, `active`)
            VALUES ('practices', '1')
        ");


        \Illuminate\Support\Facades\DB::statement("
            INSERT INTO pages_trans (`name`, `content`, `page_id`,`locale`,`meta_name`,`meta_description`)
            VALUES ('Практики', '<main class=\"content\">
      <div class=\"content__wrapper\">
        <h1 class=\"content__title\">Практики</h1>
        <div class=\"content__block content__block--practice\">
          <h2 class=\"content__block-title\">Брачно-семейная</h2>
          <ul class=\"content__list\">
            <li class=\"content__text content__text--practice\">Расторжение брака</li>
            <li class=\"content__text content__text--practice\">Раздел имущества</li>
            <li class=\"content__text content__text--practice\">Трансграничные семейные споры</li>
            <li class=\"content__text content__text--practice\">Наследственные споры и&nbsp;защита имущества</li>
          </ul>
        </div>
        <div class=\"content__block content__block--practice\">
          <h2 class=\"content__block-title\">Защита прав несовершеннолетних</h2>
          <ul class=\"content__list\">
            <li class=\"content__text content__text--practice\">Место жительста ребёнка с&nbsp;одним из&nbsp;родителей</li>
            <li class=\"content__text content__text--practice\">Порядок общения ребёнка с&nbsp;отдельно проживающим родителем</li>
            <li class=\"content__text content__text--practice\">Возврат ребёнка из-за границы</li>
            <li class=\"content__text content__text--practice\">Лишение родительских прав</li>
            <li class=\"content__text content__text--practice\">Защита личных неимушественных прав ребёнка (на&nbsp;имя, фамилию и&nbsp;пр.)</li>
            <li class=\"content__text content__text--practice\">Международная защита прав детей</li>
            <li class=\"content__text content__text--practice\">Алименты на&nbsp;детей</li>
          </ul>
        </div>
        <div class=\"content__block content__block--practice\">
          <h2 class=\"content__block-title\">Ювенально-уголовная</h2>
          <ul class=\"content__list\">
            <li class=\"content__text content__text--practice\">Защита несовершеннолетних правонарушителей</li>
            <li class=\"content__text content__text--practice\">Представительство интресов несовершеннолетних потерпевших</li>
            <li class=\"content__text content__text--practice\">Защита прав несовершеннолетних в&nbsp;комиссиях по&nbsp;делам несовершеннолетних</li>
          </ul>
        </div>
        <div class=\"content__block content__block--practice\">
          <h2 class=\"content__block-title\">Опека и&nbsp;попечительство</h2>
          <ul class=\"content__list\">
            <li class=\"content__text content__text--practice\">Усыновление</li>
            <li class=\"content__text content__text--practice\">Опека и&nbsp;попечительство над детьми</li>
            <li class=\"content__text content__text--practice\">Установление недееспособности</li>
            <li class=\"content__text content__text--practice\">Опека над недееспособными</li>
          </ul>
        </div>
        <div class=\"content__link-wrapper\"><a href=\"http://azh.ru/ru/kontakty/zapisatsya-na-priem/\" target=\"_blank\" class=\"content__link content__link--record\">Записаться на&nbsp;прием</a></div>
      </div>
    </main>',(SELECT id from pages where alias = 'practices'),'ru','Жаров Антон Алексеевич - адвокат по детскому и семейному праву','Урегулирую семейные споры (в том числе — трансграничные), включая вопросы раздела имущества, лишения родительских прав, незаконного перемещения ребёнка через границу одним из супругов, места жительства ребёнка и порядка общения с ним.')
      ");

        \Illuminate\Support\Facades\DB::statement("
            INSERT INTO navigation(`type`,`active`,`alias`,`value`,`link_attributes`,`_lft`,`_rgt`,`parent_id`)
            SELECT '2','1','practices',(SELECT id from pages where alias = 'practices'),'[]','4','5',`nav_table`.`id`
            FROM `navigation` as `nav_table`
            WHERE `alias` = 'main_menu'
        ");

        \Illuminate\Support\Facades\DB::statement("
            INSERT INTO navigation_trans (`nav_id`,`name`,`locale`)
            VALUES ((SELECT id from navigation where alias ='practices'),'Практики','ru')
        ");

    }

    public function down()
    {
        \Illuminate\Support\Facades\DB::statement("
            DELETE from navigation_trans where id = (SELECT id from navigation where alias ='practices')

        ");

        \Illuminate\Support\Facades\DB::statement("
            DELETE from navigation where alias = 'practices'

        ");

        \Illuminate\Support\Facades\DB::statement("
            DELETE from pages_trans where id = (SELECT id from pages where alias = 'practices')

        ");

        \Illuminate\Support\Facades\DB::statement("
            DELETE from pages where alias = 'practices'

        ");

    }


}



?>