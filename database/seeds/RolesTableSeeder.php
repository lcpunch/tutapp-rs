<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Tutor']);
        Role::create(['name' => 'Student']);

        $roles = Role::all();

        User::all()->each(function ($user) use ($roles) {
            $user->roles()->attach(
                $roles->random(1)->pluck('id')->toArray()
            );
        });
    }
}
