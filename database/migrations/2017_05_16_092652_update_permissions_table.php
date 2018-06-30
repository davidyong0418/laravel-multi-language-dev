<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class UpdatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $config = config('laravel-permission.table_names');
        Schema::table($config['permissions'], function ($table) {
            $table->string('group')->after('name');
            $table->string('human_name')->unique()->after('group');
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
        Schema::table($config['permissions'], function ($table) {
            $table->dropColumn('group');
            $table->dropColumn('human_name');
            $table->dropColumn('description');
        });
    }
}
