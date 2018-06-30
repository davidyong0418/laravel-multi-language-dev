<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class InsertDefaultNavigationPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Spatie\Permission\Models\Permission::create([
            'name'        => 'view navitems',
            'group'       => 'Навигация',
            'human_name'  => 'Просмотр структуры',
            'description' => '',
        ]);

        \Spatie\Permission\Models\Permission::create([
            'name'        => 'create navitem',
            'group'       => 'Навигация',
            'human_name'  => 'Создание пункта',
            'description' => '',
        ]);

        \Spatie\Permission\Models\Permission::create([
            'name'        => 'edit navitem',
            'group'       => 'Навигация',
            'human_name'  => 'Редактирование пункта',
            'description' => '',
        ]);

        \Spatie\Permission\Models\Permission::create([
            'name'        => 'delete navitem',
            'group'       => 'Навигация',
            'human_name'  => 'Удаление пункта',
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
