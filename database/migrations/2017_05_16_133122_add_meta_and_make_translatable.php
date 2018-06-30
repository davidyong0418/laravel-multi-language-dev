<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMetaAndMakeTranslatable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('pages')->truncate();

        Schema::create('pages_trans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('page_id');
            $table->string('name');
            $table->text('content');
            $table
                ->string('meta_name')
                ->nullable();
            $table
                ->text('meta_description')
                ->nullable();
            $table
                ->text('meta_keywords')
                ->nullable();
            $table
                ->text('meta_other')
                ->nullable();
            $table
                ->string('locale')
                ->index();

            $table->unique(['page_id','locale']);
            $table
                ->foreign('page_id')
                ->references('id')
                ->on('pages')
                ->onDelete('cascade');
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['name', 'content']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages_trans');

        Schema::table('pages', function (Blueprint $table) {
            $table->string('name');
            $table->text('content');
        });
    }
}
