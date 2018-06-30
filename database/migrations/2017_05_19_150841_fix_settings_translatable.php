<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class FixSettingsTranslatable
 */
class FixSettingsTranslatable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings_trans', function (Blueprint $table) {
            $table->dropForeign('settings_trans_setting_key_foreign');
            $table
                ->foreign('setting_key')
                ->references('key')
                ->on('settings')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings_trans', function (Blueprint $table) {
            $table->dropForeign('settings_trans_setting_key_foreign');
            $table->foreign('setting_key')
                ->references('key')
                ->on('settings')
                ->onDelete('cascade');
        });
    }
}
