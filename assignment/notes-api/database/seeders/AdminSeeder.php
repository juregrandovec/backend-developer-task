<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
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
        $userTableName = (new User)->getTable();

        $admin = User::where('email', 'test@test.test')->first();

        if (!$admin) {
            DB::table($userTableName)->insert([
                'name' => 'admin',
                'email' => 'test@test.test',
                'password' => Hash::make('password'),
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
