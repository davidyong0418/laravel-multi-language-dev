<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class MakeNavigationTranslatable
 */
class MakeNavigationTranslatable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigation_trans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('nav_id');
            $table->string('name');
            $table
                ->string('locale')
                ->index();

            $table->unique(['nav_id','locale']);
            $table
                ->foreign('nav_id')
                ->references('id')
                ->on('navigation')
                ->onDelete('cascade');
        });

        \Illuminate\Support\Facades\DB::statement(
            "INSERT INTO navigation_trans(nav_id, name, locale) SELECT id, name, 'ru' FROM navigation ON DUPLICATE KEY UPDATE name=navigation.name"
        );

        Schema::table('navigation', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('navigation_trans');
        Schema::table('navigation', function (Blueprint $table) {
            $table->string('name');
        });
    }
}
