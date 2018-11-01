<?php

use App\Course;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::table('course_tutors')->truncate();
        DB::table('course_user')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $password = Hash::make('1111');

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@test.com',
            'role' => 1,
            'password' => $password,
            'remember_token' => str_random(10),
            'registration_number' => '1',            
        ]);

        // $courses = Course::all();

        // factory(User::class, 200)->create();

        // $users = User::all();

        // $users->each(function ($user) use ($courses) {
        //     $user->courses()->attach(
        //       $courses->random(rand(5,10))->pluck('id')->toArray()
        //     );
        // });

        // Course::all()->each(function ($course) use ($users) {
        //     DB::table('course_tutor')->insert([
        //        'user_id' => User::all()
        //            ->random(1)
        //            ->pluck('id')
        //            ->get(0),
        //        'course_id' => Course::all()
        //            ->random(1)
        //            ->pluck('id')
        //            ->get(0)
        //     ]);
        // });
    }
}
