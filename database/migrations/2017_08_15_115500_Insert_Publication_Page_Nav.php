<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;



Class InsertPublicationPageNav extends migration
{
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement("
            INSERT INTO navigation(`type`,`active`,`alias`,`value`,`link_attributes`,`_lft`,`_rgt`,`parent_id`)
            SELECT '1','1','publications','publications','[]','6','7',`nav_table`.`id`
            FROM `navigation` as `nav_table`
            WHERE `alias` = 'main_menu'
        ");
        \Illuminate\Support\Facades\DB::statement("
            INSERT INTO navigation_trans (`nav_id`,`name`,`locale`)
            VALUES ((SELECT id from navigation where alias ='publications'),'Публикации','ru')
        ");
    }
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement("
            DELETE from navigation_trans where id = (SELECT id from navigation where alias ='publications')

        ");
        \Illuminate\Support\Facades\DB::statement("
            DELETE from navigation where alias = 'publications'

        ");
    }
}