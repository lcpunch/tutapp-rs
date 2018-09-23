<?php

use App\Course;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->delete();

        $password = Hash::make('1111');

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@test.com',
            'password' => $password,
            'remember_token' => str_random(10),
        ]);

        $courses = Course::all();

        // And now let's generate a few dozen users for our app:
        factory(User::class, 200)->create();

        User::all()->each(function ($user) use ($courses) {
            $user->courses()->attach(
              $courses->random(rand(5,10))->pluck('id')->toArray()
            );
        });
    }
}
