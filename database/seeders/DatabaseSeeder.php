<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        RoleUser::truncate();
        Role::truncate();
        User::truncate();

        Schema::enableForeignKeyConstraints();

        $roles = Role::ROLES;

        foreach ($roles as $role)  {
            Role::create([
               'name' => $role
            ]);
        }

        \App\Models\User::factory(20)->create();

        $users = User::all();

        foreach ($users as $user)
        {
            RoleUser::create([
                'user_id' => $user->id,
                'role_id' => Role::USER_ROLE,
            ]);
        }
    }
}
