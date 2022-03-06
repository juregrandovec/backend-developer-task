<?php

namespace Database\Seeders;

use App\Models\NoteFolder;
use Illuminate\Database\Seeder;

class NoteFolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!NoteFolder::exists()) {
            NoteFolder::factory()->count(3)->create(['user_id' => 1]);
            NoteFolder::factory()->count(3)->create(['user_id' => 2]);
        }
    }
}
