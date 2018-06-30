<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class UpdateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $config = config('laravel-permission.table_names');
        Schema::table($config['roles'], function ($table) {
            $table->string('human_name')->unique()->after('name');
            $table->string('description')->after('human_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $config = config('laravel-permission.table_names');
        Schema::table($config['roles'], function ($table) {
            $table->dropColumn('human_name');
            $table->dropColumn('description');
        });
    }
}
