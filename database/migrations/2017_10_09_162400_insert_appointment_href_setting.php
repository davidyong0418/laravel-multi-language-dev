<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

use Nutnet\Artifico2\App\Models\Setting;

class InsertAppointmentHrefSetting extends Migration
{

    public function up()
    {
        \Illuminate\Support\Facades\DB::statement("
            INSERT INTO settings(`key`, `name`, `group`)
            VALUES ('cms.appointmenthref', 'Ссылка для записи на прием', 'CMS')
");


        \Illuminate\Support\Facades\DB::statement("
            INSERT INTO settings_trans(`setting_key`, `value`, `locale`)
            VALUES ('cms.appointmenthref','http://azh.ru/ru/kontakty/zapisatsya-na-priem/', 'ru')
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
            DELETE from `settings_trans` where `setting_key` = (SELECT `key` from `settings` where `key` = 'cms.appointmenthref')

        ");
        \Illuminate\Support\Facades\DB::statement("
            DELETE from `settings` where `key` = 'cms.appointmenthref'

        ");
    }
}