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
        Schema::create('introduction_letters', function (Blueprint $table) {
            $table->id();

            $table->foreignId('internship_application_id')
                ->constrained('internship_applications')
                ->restrictOnDelete();

            $table->string('letter_number')->unique();

            $table->date('letter_date');

            $table->enum('status', [
                'draft',
                'issued',
                'suspended',
                'cancelled',
            ])->default('draft');

            $table->text('withdrawal_reason')->nullable();

            $table->timestamp('withdrawn_at')->nullable();

            $table->foreignId('withdrawn_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('file_path')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('introduction_letters');
    }
};
