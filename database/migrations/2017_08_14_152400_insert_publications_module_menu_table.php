<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Nutnet\Artifico2\App\Models\Menu;

class InsertPublicationsModuleMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $system = Menu::create([
            'title'  => 'Публикации',
            'icon'   => 'fa fa-sticky-note',
            'href'   => 'admin.publications.index',
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
