<?php

 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
                'name'=>'leseryn',
                'display_name'=>'leseryn',
                'email'=>'leseryn@haha.com',
                'password'=>Hash::make('123456')
            ]);
        DB::table('users')->insert([
                'name'=>'ramen',
                'display_name'=>'ramen',
                'email'=>'ramen@haha.com',
                'password'=>Hash::make('123456')
            ]);
        
        $loginpass = Hash::make('login');
        $loginpass = Hash::make($loginpass);
        $slothpass = Hash::make($loginpass);
        $blogpass = Hash::make($slothpass);
        $userpass = Hash::make($blogpass);

        DB::table('users')->insert([
                'name'=>'login',
                'display_name'=>'login',
                'email'=>'login@haha.com',
                'password'=>Hash::make($loginpass)
            ]);
        DB::table('users')->insert([
                'name'=>'sloth',
                'display_name'=>'sloth',
                'email'=>'sloth@haha.com',
                'password'=>Hash::make($slothpass)
            ]);
        DB::table('users')->insert([
                'name'=>'blog',
                'display_name'=>'blog',
                'email'=>'blog@haha.com',
                'password'=>Hash::make($blogpass)
            ]);
        DB::table('users')->insert([
                'name'=>'user',
                'display_name'=>'user',
                'email'=>'user@haha.com',
                'password'=>Hash::make($userpass)
            ]);

    }
}
