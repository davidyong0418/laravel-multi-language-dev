<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;



Class InsertContactsPage extends migration
{
    public function up()
    {


        \Illuminate\Support\Facades\DB::statement("
            INSERT INTO pages (`alias`, `active`)
            VALUES ('contacts', '1')
        ");


        \Illuminate\Support\Facades\DB::statement("
            INSERT INTO pages_trans (`name`, `content`, `page_id`,`locale`,`meta_name`,`meta_description`)
            VALUES ('Контакты',' <main class=\"contacts\">
      <div class=\"contacts__wrapper\">
        <h1 class=\"contacts__title\">Контакты</h1>
        <div class=\"contacts__block\">
          <p class=\"contacts__block-title\">Телефон</p><a href=\"tel:+74952270121\" class=\"contacts__information contacts__information--phone\">+7 (495) 227-01-21</a><a href=\"http://azh.ru/ru/kontakty/adres-ofisa/kontakty-dlya-zvonkov-iz-za-rubezha-i-iz-drugix-gorodov-rossii/\" target=\"_blank\" class=\"contacts__more-info\">В других городах</a>
        </div>
        <div class=\"contacts__block\">
          <p class=\"contacts__block-title\">Почта</p><a href=\"mailto:anton@zharov.info\" target=\"_blank\" class=\"contacts__information contacts__information--email\">anton@zharov.info</a>
        </div>
        <div class=\"contacts__block\">
          <p class=\"contacts__block-title\">Адрес</p><a href=\"https://yandex.ru/maps/213/moscow/?ll=37.613655%2C55.766770&z=16&mode=search&text=%D0%9F%D0%B5%D1%82%D1%80%D0%BE%D0%B2%D1%81%D0%BA%D0%B8%D0%B9%20%D0%BF%D0%B5%D1%80%D0%B5%D1%83%D0%BB%D0%BE%D0%BA%2C%20%D0%B4.5%2C%20%D1%81%D1%82%D1%80.%205%2C%20%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0%2C%20107031&sll=53.211463%2C56.854468&sspn=0.256462%2C0.064047&ol=biz&oid=1244445164\" class=\"contacts__information contacts__information--address\">Петровский переулок, д.&nbsp;5, стр.&nbsp;5, Москва, 10703</a>
        </div>
      </div>
    </main>',(SELECT id from pages where alias = 'contacts'),'ru','Жаров Антон Алексеевич - адвокат по детскому и семейному праву','Урегулирую семейные споры (в том числе — трансграничные), включая вопросы раздела имущества, лишения родительских прав, незаконного перемещения ребёнка через границу одним из супругов, места жительства ребёнка и порядка общения с ним.')
      ");

        \Illuminate\Support\Facades\DB::statement("
            INSERT INTO navigation(`type`,`active`,`alias`,`value`,`link_attributes`,`_lft`,`_rgt`,`parent_id`)
            SELECT '2','1','contacts',(SELECT id from pages where alias = 'contacts'),'[]','7','8',`nav_table`.`id`
            FROM `navigation` as `nav_table`
            WHERE `alias` = 'main_menu'
        ");


        \Illuminate\Support\Facades\DB::statement("
            INSERT INTO navigation_trans (`nav_id`,`name`,`locale`)
            VALUES ((SELECT id from navigation where alias ='contacts'),'Контакты','ru')
        ");

    }
    public function down()
    {

        \Illuminate\Support\Facades\DB::statement("
            DELETE from navigation_trans where id = (SELECT id from navigation where alias ='contacts')

        ");

        \Illuminate\Support\Facades\DB::statement("
            DELETE from navigation where alias = 'contacts'

        ");

        \Illuminate\Support\Facades\DB::statement("
            DELETE from pages_trans where id = (SELECT id from pages where alias = 'contacts')

        ");

        \Illuminate\Support\Facades\DB::statement("
            DELETE from pages where alias = 'contacts'

        ");

    }


}



?>