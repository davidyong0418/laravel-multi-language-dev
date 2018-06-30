<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Nutnet\Artifico2\App\Models\Menu;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('icon');
            $table->string('href');
            $table->string('params')->nullable();;
            $table->integer('parent_id')->unsigned()->nullable();
            $table->timestamps();
        });

        $system = Menu::create([
            'title'  => 'Система',
            'icon'   => 'fa ion-android-settings',
            'href'   => '#',
            'params' => '',
        ]);

        $system->children()->saveMany([
            new Menu(['title' => 'Настройки', 'icon' => 'fa fa-circle-o', 'href' => 'admin.settings.index', 'params' => '']),
            new Menu(['title' => 'Пользователи', 'icon' => 'fa fa-circle-o', 'href' => 'admin.administrators.index', 'params' => '']),
            new Menu(['title' => 'Права', 'icon' => 'fa fa-circle-o', 'href' => 'admin.usergroups.index', 'params' => '']),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
