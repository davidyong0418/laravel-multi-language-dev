<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;



Class CreateMainNavParent extends migration
{
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement("
INSERT INTO navigation (`type`,`active`,`alias`,`value`,`link_attributes`,`_lft`,`_rgt`)
VALUES ('1','1','main_menu','main_menu','[]','1','11')
");

        \Illuminate\Support\Facades\DB::statement("
INSERT INTO navigation_trans (`nav_id`,`name`,`locale`)
VALUES ((SELECT id from navigation where alias ='main_menu'),'Главное меню','ru')
");

    }

    public function down()
    {
        \Illuminate\Support\Facades\DB::statement("
            DELETE from navigation_trans where id = (SELECT id from navigation where alias ='main_menu')

        ");

        \Illuminate\Support\Facades\DB::statement("
            DELETE from navigation where alias = 'main_menu'

        ");

    }
}