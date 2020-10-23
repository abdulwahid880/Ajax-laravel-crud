<?php

namespace Database\Seeders;
use DB;

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('users')->insert([
            [
         'name'=>'name',
         'email'=>'emailtest',
         'password'=>bcrypt('asdfdsfdsfds'),
            ],
            [
                'name'=>'asdsada',
                'email'=>'sdsadsadsad',
                'password'=>bcrypt('asdfdsfdsfds'),
            ],
            [
                'name'=>'sikandar',
                'email'=>'sdsadjdkjfldkjsadsad',
                'password'=>bcrypt('afdsfdsfds'),
            ],
        ]);
    }
}
