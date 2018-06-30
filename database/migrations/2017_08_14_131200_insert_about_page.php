<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;



Class InsertAboutPage extends migration
{
    public function up()
    {


        \Illuminate\Support\Facades\DB::statement("
            INSERT INTO pages (`alias`, `active`)
            VALUES ('about', '1')
        ");


        \Illuminate\Support\Facades\DB::statement("
            INSERT INTO pages_trans (`name`, `content`, `page_id`,`locale`,`meta_name`,`meta_description`)
            VALUES ('О Жарове', '<main class=\"content\">
      <div class=\"content__wrapper\">
        <h1 class=\"content__title\">О Жарове</h1>
        <div class=\"content__block\">
          <h2 class=\"content__block-title\">Специализация</h2>
          <p class=\"content__text\">С&nbsp;2007-го&nbsp;&mdash; специализируется исключительно на&nbsp;семейном и&nbsp;ювенальном праве, защите прав детей, в&nbsp;том числе&nbsp;&mdash; оставшихся без попечения родителей.</p>
          <p class=\"content__text\">Урегулирует семейные споры (в&nbsp;том числе&nbsp;&mdash; трансграничные), включая вопросы раздела имущества, лишения родительских прав, незаконного перемещения ребёнка через границу одним из&nbsp;супругов, места жительства ребёнка и&nbsp;порядка общения с&nbsp;ним.</p>
          <p class=\"content__sub-text\">Ведёт дела об&nbsp;усыновлении (в&nbsp;том числе и&nbsp;международном), об&nbsp;опеке и&nbsp;попечительстве над несовершеннолетними</p>
        </div>
        <div class=\"content__block\">
          <h2 class=\"content__block-title\">Деятельность</h2>
          <p class=\"content__text\">В&nbsp;2007-2010 годах&nbsp;&mdash; эксперт рабочих групп обеих палат Федерального Собрания Российской Федерации, а&nbsp;также министерств и&nbsp;ведомств&nbsp;РФ при создании законодательства о&nbsp;защите прав детей, опеке, семейного законодательства.</p>
          <p class=\"content__text\">Адвокат палаты города Москвы, руководитель &laquo;Команды адвоката Жарова&raquo;.</p>
          <p class=\"content__sub-text\">Практикует в&nbsp;российских судах с&nbsp;2000 года</p>
        </div>
        <div class=\"content__block\">
          <h2 class=\"content__block-title\">Достижения</h2>
          <p class=\"content__text\">Основатель и&nbsp;глава &laquo;Команды адвоката Жарова&raquo;&nbsp;&mdash; единственной в&nbsp;России специализированной юридической фирмы, практикующей в&nbsp;сфере семейного и&nbsp;ювенального (детского) права, в&nbsp;том числе&nbsp;&mdash; занимающейся трансграничными спорами родителей и&nbsp;международным усыновлением.</p>
          <p class=\"content__text\">Является одним из&nbsp;разработчиков закона &laquo;Об&nbsp;опеке и&nbsp;попечительстве&raquo;, ряда изменений в&nbsp;Семейный кодекс&nbsp;РФ, постановлений Правительства РФ&nbsp;по&nbsp;вопросам установления опеки над несовершеннолетними, усыновления.</p>
          <p class=\"content__sub-text\">Участвовал в&nbsp;создании программы подготовки будущих усыновителей в&nbsp;РФ</p>
          <p class=\"content__text\">Выступал в&nbsp;качестве неправительственного эксперта при разработке нормативных актов по&nbsp;вопросам подготовки усыновителей и&nbsp;опеки над детьми в&nbsp;Литовской Республике.</p>
          <p class=\"content__text\">В 2016 году создал и возглавил (в качестве научного директора) <a href=\"http://isppp.site/\" title=\"ИСППП\" target=\"_blank\">Институт семейных просветительских и правовых программ</a> (ИСППП), цель которого — разработка, популяризация&nbsp и внедрение современных методов защиты прав семьи и детей.</p>
          <p class=\"content__text\">Автор более 20&nbsp;научных и&nbsp;научно-популярных работ по&nbsp;вопросам лишения родительских прав и&nbsp;сложным случаям усыновления, а&nbsp;также свыше 200 статей по&nbsp;проблемам семейного и&nbsp;ювенального права.</p>
          <p class=\"content__text\">Работает над кандидатской диссертацией.</p>
        </div>
        <div class=\"content__link-wrapper\"><a href=\"/practices\" class=\"content__link\">Подробнее об практиках</a></div>
      </div>
    </main>',(SELECT id from pages where alias = 'about'),'ru','Жаров Антон Алексеевич - адвокат по детскому и семейному праву','Урегулирую семейные споры (в том числе — трансграничные), включая вопросы раздела имущества, лишения родительских прав, незаконного перемещения ребёнка через границу одним из супругов, места жительства ребёнка и порядка общения с ним.')
      ");

        \Illuminate\Support\Facades\DB::statement("
            INSERT INTO navigation(`type`,`active`,`alias`,`value`,`link_attributes`,`_lft`,`_rgt`,`parent_id`)
            SELECT '2','1','about',(SELECT id from pages where alias = 'about'),'[]','2','3',`nav_table`.`id`
            FROM `navigation` as `nav_table`
            WHERE `alias` = 'main_menu'
        ");

        \Illuminate\Support\Facades\DB::statement("
            INSERT INTO navigation_trans (`nav_id`,`name`,`locale`)
            VALUES ((SELECT id from navigation where alias ='about'),'Об адвокате','ru')
        ");

    }
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement("
            DELETE from navigation_trans where id = (SELECT id from navigation where alias ='about')

        ");
        \Illuminate\Support\Facades\DB::statement("
            DELETE from navigation where alias = 'about'

        ");
        \Illuminate\Support\Facades\DB::statement("
            DELETE from pages_trans where id = (SELECT id from pages where alias = 'about')

        ");
        \Illuminate\Support\Facades\DB::statement("
            DELETE from pages where alias = 'about'

        ");

    }


}



?>