<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExtraFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_fields', function(Blueprint $table) {
            $table->increments('id');
            $table->string('identifier', 40);
            $table->string('origin_identifier', 40);
            $table->string('entity');
            $table->unsignedInteger('entity_id');
            $table->text('value');

            $table->unique(['identifier', 'entity', 'entity_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extra_fields');
    }
}
