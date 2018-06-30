<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class DeleteEmailLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $parent = DB::table('menus')->where('title', '=', 'Система')->first();

        DB::table('menus')
            ->where('parent_id', '=', $parent->id)
            ->where('href', '=', 'admin.email_logs')
            ->delete();

        Schema::dropIfExists('email_logs');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
