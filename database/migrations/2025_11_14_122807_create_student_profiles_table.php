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
        Schema::create('student_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('phone')->default('0993 032 4916');
            $table->string('address')->default('Singapore korea');
            $table->string('profile_picture')->default('images/default-pfp.jpg');
            $table->decimal('balance', 15, 2)->default(0);
            $table->text('bio')->default('This is my bio, 676767677676776767767676776');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_profiles');
    }
};
