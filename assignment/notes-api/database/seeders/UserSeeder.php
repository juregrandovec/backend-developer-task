<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!User::exists()) {
            $userInsertData = [
                [
                    'name' => 'user 1',
                    'email' => 'user1@test.test',
                    'password' => Hash::make('password'),
                    'created_at' => Carbon::now(),
                ],
                [
                    'name' => 'user 2',
                    'email' => 'user2@test.test',
                    'password' => Hash::make('password'),
                    'created_at' => Carbon::now(),
                ],
            ];

            DB::table((new User())->getTable())->insert($userInsertData);
        }
    }
}
