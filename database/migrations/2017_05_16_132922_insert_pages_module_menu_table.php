<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Nutnet\Artifico2\App\Models\Menu;

class InsertPagesModuleMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $system = Menu::create([
            'title'  => 'Страницы',
            'icon'   => 'fa fa-newspaper-o',
            'href'   => 'admin.pages.index',
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
