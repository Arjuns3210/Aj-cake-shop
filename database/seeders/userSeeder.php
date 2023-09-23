<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user_name'=>'Arjun Singh',
            'email'=>'Singharjun93124@gmail.com',
            'mobile_no'=>'7718933641',
            'password'=>md5('singharjun93124@gmail.com123456'),
            'address'=>'Marol Andheri East',

        ]);
    }
}
