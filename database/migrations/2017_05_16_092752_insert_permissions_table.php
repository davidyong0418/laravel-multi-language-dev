<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class InsertPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Spatie\Permission\Models\Permission::create([
            'name'        => '*',
            'group'       => 'CMS',
            'human_name'  => 'Суперпользователь',
            'description' => '',
        ]);

        \Spatie\Permission\Models\Permission::create([
            'name'        => 'visit backend',
            'group'       => 'CMS',
            'human_name'  => 'Посещение панели управления',
            'description' => '',
        ]);

        \Spatie\Permission\Models\Permission::create([
            'name'        => 'view administrators',
            'group'       => 'Пользователи',
            'human_name'  => 'Просмотр администраторов',
            'description' => '',
        ]);

        \Spatie\Permission\Models\Permission::create([
            'name'        => 'create administrator',
            'group'       => 'Пользователи',
            'human_name'  => 'Создание администратора',
            'description' => '',
        ]);

        \Spatie\Permission\Models\Permission::create([
            'name'        => 'edit administrator',
            'group'       => 'Пользователи',
            'human_name'  => 'Редактирование администратора',
            'description' => '',
        ]);

        \Spatie\Permission\Models\Permission::create([
            'name'        => 'delete administrator',
            'group'       => 'Пользователи',
            'human_name'  => 'Удаление администратора',
            'description' => '',
        ]);

        \Spatie\Permission\Models\Permission::create([
            'name'        => 'view roles',
            'group'       => 'Группы',
            'human_name'  => 'Просмотр ролей',
            'description' => '',
        ]);

        \Spatie\Permission\Models\Permission::create([
            'name'        => 'create role',
            'group'       => 'Группы',
            'human_name'  => 'Создание роли',
            'description' => '',
        ]);

        \Spatie\Permission\Models\Permission::create([
            'name'        => 'edit role',
            'group'       => 'Группы',
            'human_name'  => 'Редактирование роли',
            'description' => '',
        ]);

        \Spatie\Permission\Models\Permission::create([
            'name'        => 'delete role',
            'group'       => 'Группы',
            'human_name'  => 'Удаление роли',
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
