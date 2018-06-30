<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;



Class InsertIndexPage extends migration
{
    public function up()
    {


        \Illuminate\Support\Facades\DB::statement("
            INSERT INTO pages (`alias`, `active`)
            VALUES ('index', '1')
        ");


        \Illuminate\Support\Facades\DB::statement("
            INSERT INTO pages_trans (`name`, `content`, `page_id`,`locale`,`meta_name`,`meta_description`)
            VALUES ('Главная страница', '<main class=\"index-content\">
    <div class=\"index-content__wrapper\">
        <div class=\"index-content__descr\">
            <h1 class=\"index-content__name\">Адвокат Жаров</h1>
            <p class=\"index-content__work\">Семейное и детское право</p>
            <p class=\"index-content__work-descr\">Занимаюсь сложными случаями усыновления. Лично веду каждое дело — от начала до конца. Использую правовые нюансы, которые не замечают другие.</p>
            <div class=\"index-content__more-info-block\"><a href=\"/about\" class=\"index-content__more-info\">Подробнее</a></div>
        </div>
        <a href=\"/about\" class=\"index-content__photo-block\"><img src=\"images/zharov-photo@1x.png\" rel=\"preload\" srcset=\"images/zharov-photo@2x.png 2x\" alt=\"Адвокат Жаров\" class=\"index-content__image\"></a>
    </div>
</main>
',(SELECT id from pages where alias = 'index'),'ru','Жаров Антон Алексеевич - адвокат по детскому и семейному праву','Урегулирую семейные споры (в том числе — трансграничные), включая вопросы раздела имущества, лишения родительских прав, незаконного перемещения ребёнка через границу одним из супругов, места жительства ребёнка и порядка общения с ним.')
      ");

        \Illuminate\Support\Facades\DB::statement("
            INSERT INTO navigation(`type`,`active`,`alias`,`value`,`link_attributes`,`_lft`,`_rgt`,`parent_id`)
            SELECT '2','1','index',(SELECT id from pages where alias = 'index'),'[]','9','10',`nav_table`.`id`
            FROM `navigation` as `nav_table`
            WHERE `alias` = 'main_menu'
        ");

        \Illuminate\Support\Facades\DB::statement("
            INSERT INTO navigation_trans (`nav_id`,`name`,`locale`)
            VALUES ((SELECT id from navigation where alias ='index'),'','ru')
        ");

    }
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement("
            DELETE from navigation_trans where id = (SELECT id from navigation where alias ='index')

        ");
        \Illuminate\Support\Facades\DB::statement("
            DELETE from navigation where alias = 'index'

        ");
        \Illuminate\Support\Facades\DB::statement("
            DELETE from pages_trans where id = (SELECT id from pages where alias = 'index')

        ");
        \Illuminate\Support\Facades\DB::statement("
            DELETE from pages where alias = 'index'

        ");

    }


}



?>