<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class InsertDefaultPagesPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Spatie\Permission\Models\Permission::create([
            'name'        => 'view pages',
            'group'       => 'Страницы',
            'human_name'  => 'Просмотр страниц',
            'description' => '',
        ]);

        \Spatie\Permission\Models\Permission::create([
            'name'        => 'create page',
            'group'       => 'Страницы',
            'human_name'  => 'Создание страницы',
            'description' => '',
        ]);

        \Spatie\Permission\Models\Permission::create([
            'name'        => 'edit page',
            'group'       => 'Страницы',
            'human_name'  => 'Редактирование страницы',
            'description' => '',
        ]);

        \Spatie\Permission\Models\Permission::create([
            'name'        => 'delete page',
            'group'       => 'Страницы',
            'human_name'  => 'Удаление страницы',
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
