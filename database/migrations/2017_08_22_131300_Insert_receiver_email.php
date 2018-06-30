<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

use Nutnet\Artifico2\App\Models\Setting;

class InsertReceiverEmail extends Migration
{

public function up()
{


    \Illuminate\Support\Facades\DB::statement("
INSERT INTO settings(`key`, `name`, `group`)
VALUES ('cms.email', 'Почта для получения заявок', 'CMS')
");


    \Illuminate\Support\Facades\DB::statement("
INSERT INTO settings_trans(`setting_key`, `value`, `locale`)
VALUES ('cms.email', 'test-6d71ac@inbox.mailtrap.io', 'ru')
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
            DELETE from `settings_trans` where `id` = (SELECT `id` from `settings` where `key` = 'cms.email')

        ");
        \Illuminate\Support\Facades\DB::statement("
            DELETE from `settings` where `key` = 'cms.email'

        ");
    }
}