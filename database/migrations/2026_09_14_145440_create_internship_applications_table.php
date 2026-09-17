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
        Schema::create('internship_applications', function (Blueprint $table) {
            $table->id();

            $table->string('application_code')->unique();

            $table->foreignId('leader_student_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->foreignId('company_id')
                ->constrained('companies')
                ->restrictOnDelete();

            $table->date('application_date');
            $table->date('internship_start_date');
            $table->date('internship_end_date');

            $table->enum('status', [
                'submitted',
                'approved',
                'rejected',
            ])->default('submitted');

            $table->string('response_letter_file')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internship_applications');
    }
};
