<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class MakeSettingsTranslatable
 */
class MakeSettingsTranslatable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings_trans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('setting_key', 150);
            $table->text('value');
            $table
                ->string('locale')
                ->index();

            $table->unique(['setting_key','locale']);
            $table
                ->foreign('setting_key')
                ->references('key')
                ->on('settings')
                ->onDelete('cascade');
        });

        \Illuminate\Support\Facades\DB::statement(
            "INSERT INTO settings_trans(setting_key, `value`, locale) SELECT `key`, `value`, 'ru' FROM settings ON DUPLICATE KEY UPDATE value=settings.value"
        );

        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings_trans');
        Schema::table('settings', function (Blueprint $table) {
            $table->text('value');
        });
    }
}
