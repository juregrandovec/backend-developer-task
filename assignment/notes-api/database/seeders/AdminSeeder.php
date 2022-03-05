<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userTableName = (new \App\Models\User)->getTable();

//        $admin = DB::table($userTableName)
//            ->where('email', '=', "test@test.test")
//            ->where('name', '=', "admin")
//            ->first();

        $admin = User::where('email', 'test@test.test')->first();

        if(!$admin){
            DB::table($userTableName)->insert([
                'name' => 'admin',
                'email' => 'test@test.test',
                'password' => Hash::make('password'),
                'remember_token' => Hash::make('token'),
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
