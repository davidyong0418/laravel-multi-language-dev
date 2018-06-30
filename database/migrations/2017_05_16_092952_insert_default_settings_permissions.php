<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class InsertDefaultSettingsPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Spatie\Permission\Models\Permission::create([
            'name'        => 'view settings',
            'group'       => 'Настройки',
            'human_name'  => 'Просмотр настроек',
            'description' => '',
        ]);

        \Spatie\Permission\Models\Permission::create([
            'name'        => 'create setting',
            'group'       => 'Настройки',
            'human_name'  => 'Создание настройки',
            'description' => '',
        ]);

        \Spatie\Permission\Models\Permission::create([
            'name'        => 'edit setting',
            'group'       => 'Настройки',
            'human_name'  => 'Редактирование настройки',
            'description' => '',
        ]);

        \Spatie\Permission\Models\Permission::create([
            'name'        => 'delete setting',
            'group'       => 'Настройки',
            'human_name'  => 'Удаление настройки',
            'description' => '',
        ]);
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
