<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \Nutnet\Artifico2\App\Models\Menu;

class InsertNavigationMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $system = Menu::create([
            'title'  => 'Навигация',
            'icon'   => 'fa fa-sitemap',
            'href'   => 'admin.navigation.index',
            'params' => '',
        ]);
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
