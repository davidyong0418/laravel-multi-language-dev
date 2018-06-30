<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

use Nutnet\Artifico2\App\Models\Setting;

class InsertDefaultSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement("
            INSERT INTO settings(`key`, `name`, `group`, `value`)
            VALUES ('cms.sitename', 'Название системы управления', 'CMS', 'Zharov.info')
        ");

        \Illuminate\Support\Facades\DB::statement("
            INSERT INTO settings(`key`, `name`, `group`, `value`) 
            VALUES ('cms.shortsitename', 'Короткое название системы управления', 'CMS', 'ZH')
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}