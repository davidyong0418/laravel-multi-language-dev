<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

use Nutnet\Artifico2\App\Models\Setting;

class InsertEmailText extends Migration
{

    public function up()
    {
        \Illuminate\Support\Facades\DB::statement("
            INSERT INTO settings(`key`, `name`, `group`)
            VALUES ('cms.emailtext', 'Текст письма', 'CMS')
        ");


        \Illuminate\Support\Facades\DB::statement("
            INSERT INTO settings_trans(`setting_key`, `value`, `locale`)
            VALUES ('cms.emailtext', '<h4>Заявка с сайта <b>{!! AppSettings::get(cms.sitename,\"Zharov.info\") !!}</b></h4>
            <p>Поступила новая заявка «Запись на прием».</p>
            <p>Имя: {{\$name}}</p>
            <p>Телефон: {{\$phone}}</p>
            --
            <p>Если вы не можете связаться с клиентом в течение 15 минут перепоручите это другому менеджеру.</p>
            <p>Сообщение сгенерировано автоматически, отвечать на него не нужно.</p>', 'ru')
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
            DELETE from `settings_trans` where `setting_key` = (SELECT `key` from `settings` where `key` = 'cms.emailtext')

        ");
        \Illuminate\Support\Facades\DB::statement("
            DELETE from `settings` where `key` = 'cms.emailtext'

        ");
    }
}