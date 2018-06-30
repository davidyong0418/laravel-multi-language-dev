<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class InsertDefaultAdministratorAndRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $superuserPermission = \Spatie\Permission\Models\Permission::where('name', '*')->first();

        $adminRole = \Spatie\Permission\Models\Role::create([
            'name'        => 'administrators',
            'human_name'  => 'Администраторы',
            'description' => '',
        ]);

        $adminRole->permissions()->attach($superuserPermission->id);

        $user = config('auth.providers.users.model')::create([
            'name'     => 'Nutnet-support',
            'email'    => 'support@nutnet.ru',
            'password' => bcrypt('zharov_admin'),
        ]);

        $user->roles()->attach($adminRole->id);

        $editorRole = \Spatie\Permission\Models\Role::create([
            'name'        => 'editors',
            'human_name'  => 'Редакторы',
            'description' => '',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
