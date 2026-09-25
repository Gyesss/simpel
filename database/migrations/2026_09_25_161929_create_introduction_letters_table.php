<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('introduction_letters', function (Blueprint $table) {
            $table->id();

            $table->foreignId('internship_application_id')
                ->unique()
                ->constrained('internship_applications')
                ->cascadeOnDelete();

            $table->string('letter_number')->unique();

            $table->date('letter_date');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('introduction_letters');
    }
};
