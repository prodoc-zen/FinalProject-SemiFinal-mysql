<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        DB::table('subjects')->insert([
        ['id' => 1, 'name' => 'Mathematics', 'description' => 'Mathematics subject description.', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 2, 'name' => 'Physics', 'description' => 'Physics subject description.', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 3, 'name' => 'English Literature', 'description' => 'English Literature subject description.', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 4, 'name' => 'Computer Science', 'description' => 'Computer Science subject description.', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 5, 'name' => 'Chemistry', 'description' => 'Chemistry subject description.', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 6, 'name' => 'History', 'description' => 'History subject description.', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
