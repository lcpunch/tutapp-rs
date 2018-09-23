<?php

use App\Program;
use Illuminate\Database\Seeder;

class ProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Program::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        factory(Program::class, 40)->create();
    }
}
