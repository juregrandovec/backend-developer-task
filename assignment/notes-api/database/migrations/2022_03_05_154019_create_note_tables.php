<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('note_types', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('title', 100);
            $table->string('description', 255);
            $table->string('type', 100);
        });

        Schema::create('note_folders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('title', 100);
            $table->string('description', 255);

            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('title', 100);
            $table->text('body');
            $table->boolean('is_public');

            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->foreignId('note_type_id');
            $table->foreign('note_type_id')->references('id')->on('note_types');
        });

        Schema::create('notes_note_folders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('note_id');
            $table->foreign('note_id')->references('id')->on('notes')->cascadeOnDelete();

            $table->foreignId('note_folder_id');
            $table->foreign('note_folder_id')->references('id')->on('note_folders')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes_note_folders');
        Schema::dropIfExists('notes');
        Schema::dropIfExists('note_folders');
        Schema::dropIfExists('note_types');
    }
};
