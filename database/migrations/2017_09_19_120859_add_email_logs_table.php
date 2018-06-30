<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class AddEmailLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 100)->default('no_type');
            $table->string('recipient')->nullable();
            $table->string('subject')->nullable();
            $table->text('content');
            $table->string('source')->nullable();
            $table->timestamps();

            $table->index('type', 'type_index');
            $table->index('recipient', 'recipient_index');
        });

        $parent = DB::table('menus')->where('title', '=', 'Система')->first();

        DB::table('menus')->insert([
            'title' => 'Заявки на прием',
            'icon' => 'fa fa-circle-o',
            'href' => 'admin.email_logs',
            'parent_id' => $parent->id
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $parent = DB::table('menus')->where('title', '=', 'Система')->first();

        DB::table('menus')
            ->where('parent_id', '=', $parent->id)
            ->where('href', '=', 'admin.email_logs')
            ->delete();

        Schema::dropIfExists('email_logs');
    }
}
