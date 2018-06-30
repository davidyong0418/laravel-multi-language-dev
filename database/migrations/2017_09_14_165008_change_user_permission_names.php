<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ChangeUserPermissionNames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('permissions')->where('name', '=', 'view administrators')->update([
            'human_name' => 'Просмотр пользователей'
        ]);
        DB::table('permissions')->where('name', '=', 'create administrator')->update([
            'human_name' => 'Создание пользователей'
        ]);
        DB::table('permissions')->where('name', '=', 'edit administrator')->update([
            'human_name' => 'Редактирование пользователей'
        ]);
        DB::table('permissions')->where('name', '=', 'delete administrator')->update([
            'human_name' => 'Удаление пользователей'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('permissions')->where('name', '=', 'view administrators')->update([
            'human_name' => 'Просмотр администраторов'
        ]);
        DB::table('permissions')->where('name', '=', 'create administrator')->update([
            'human_name' => 'Создание администраторов'
        ]);
        DB::table('permissions')->where('name', '=', 'edit administrator')->update([
            'human_name' => 'Редактирование администраторов'
        ]);
        DB::table('permissions')->where('name', '=', 'delete administrator')->update([
            'human_name' => 'Удаление администраторов'
        ]);
    }
}
