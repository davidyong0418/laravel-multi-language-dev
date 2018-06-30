<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class InsertDefaultPublicationsPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Spatie\Permission\Models\Permission::create([
            'name'        => 'view publications',
            'group'       => 'Публикации',
            'human_name'  => 'Просмотр публикаций',
            'description' => '',
        ]);

        \Spatie\Permission\Models\Permission::create([
            'name'        => 'create publications',
            'group'       => 'Публикации',
            'human_name'  => 'Создание публикации',
            'description' => '',
        ]);

        \Spatie\Permission\Models\Permission::create([
            'name'        => 'edit publications',
            'group'       => 'Публикации',
            'human_name'  => 'Редактирование публикации',
            'description' => '',
        ]);

        \Spatie\Permission\Models\Permission::create([
            'name'        => 'delete publications',
            'group'       => 'Публикации',
            'human_name'  => 'Удаление публикации',
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
