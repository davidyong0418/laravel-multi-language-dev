<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

use Nutnet\Artifico2\App\Models\Setting;

class InsertZharovPhone extends Migration
{

    public function up()
    {


                \Illuminate\Support\Facades\DB::statement("
        INSERT INTO settings(`key`, `name`, `group`)
        VALUES ('cms.phone', 'Телефон для связи', 'CMS')
        ");


                \Illuminate\Support\Facades\DB::statement("
        INSERT INTO settings_trans(`setting_key`, `value`, `locale`)
        VALUES ('cms.phone', '+7 (495) 227-01-21', 'ru')
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
            DELETE from `settings_trans` where `setting_key` = (SELECT `key` from `settings` where `key` = 'cms.phone')

        ");
        \Illuminate\Support\Facades\DB::statement("
            DELETE from `settings` where `key` = 'cms.phone'

        ");
    }
}