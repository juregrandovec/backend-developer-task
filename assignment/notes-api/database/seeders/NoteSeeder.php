<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\NoteFolder;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Note::exists()) {
            Note::factory()->count(10)->create(['user_id' => 1]);
            Note::factory()->count(10)->create(['user_id' => 2]);

            $this->fillNotesNoteFoldersPivotTable(1);
            $this->fillNotesNoteFoldersPivotTable(2);
        }


    }

    /**
     * @return void
     */
    public function fillNotesNoteFoldersPivotTable($user_id): void
    {
        $notes = Note::where('user_id', $user_id)->get();

        if ($notes) {
            $noteFoldersOfTheSameUser = NoteFolder::where('user_id', $user_id)->get();
            foreach ($notes as $note) {
                $note->folders()->sync([$noteFoldersOfTheSameUser->random()->id]);
            }
        }
    }
}
