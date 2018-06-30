<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

use Nutnet\Artifico2\App\Models\Setting;

class DeleteReceiverEmail extends Migration
{

    public function up()
    {
        \Illuminate\Support\Facades\DB::statement("
            DELETE from `settings_trans` WHERE `setting_key` = (SELECT `key` from `settings` WHERE `key` = 'cms.email')

        ");
        \Illuminate\Support\Facades\DB::statement("
            DELETE from `settings` WHERE `key` = 'cms.email'

        ");

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}