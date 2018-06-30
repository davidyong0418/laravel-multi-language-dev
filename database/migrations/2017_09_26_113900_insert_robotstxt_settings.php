<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

use Nutnet\Artifico2\App\Models\Setting;

class InsertRobotsTxtSettings extends Migration
{

    public function up()
    {
        \Illuminate\Support\Facades\DB::statement("
            INSERT INTO settings(`key`, `name`, `group`)
            VALUES ('cms.robots', 'Файл robots.txt', 'CMS')
");


        \Illuminate\Support\Facades\DB::statement("
            INSERT INTO settings_trans(`setting_key`, `value`, `locale`)
            VALUES ('cms.robots', 'User-agent: *
Disallow: /', 'ru')
");


    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement("
            DELETE from `settings_trans` where `setting_key` = (SELECT `key` from `settings` where `key` = 'cms.robots')

        ");
        \Illuminate\Support\Facades\DB::statement("
            DELETE from `settings` where `key` = 'cms.robots'

        ");
    }
}