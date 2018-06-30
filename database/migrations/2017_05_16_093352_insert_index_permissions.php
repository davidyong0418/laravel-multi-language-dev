<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class InsertIndexPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $indexPermission = \Spatie\Permission\Models\Permission::create([
            'name'        => 'view index',
            'group'       => 'CMS',
            'human_name'  => 'Посещение главной страницы',
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
