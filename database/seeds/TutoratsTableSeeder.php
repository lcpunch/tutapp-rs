<?php

use App\Tutorat;
use App\User;
use Illuminate\Database\Seeder;

class TutoratsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Tutorat::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $roles = Role::all();

        User::all()->each(function ($user) use ($roles) {
            $user->roles()->attach(
                $roles->random(1)->pluck('id')->toArray()
            );
        });
    }
}
