<?php

namespace Database\Seeders;

use App\Enums\NoteEnum;
use App\Models\NoteType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NoteTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (!NoteType::exists()) {
            $noteTypeInsertData = [
                ['id' => 1, 'title' => 'Text', 'description' => 'Text note type', 'type' => NoteEnum::NOTE_TYPE_TEXT],
                ['id' => 2, 'title' => 'List', 'description' => 'List note type', 'type' => NoteEnum::NOTE_TYPE_LIST]
            ];

            DB::table(NoteType::getTable())->insert($noteTypeInsertData);
        }

    }
}
