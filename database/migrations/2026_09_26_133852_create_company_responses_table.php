<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_responses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('internship_application_id')
                ->unique()
                ->constrained('internship_applications')
                ->cascadeOnDelete();

            $table->enum('status', [
                'pending',
                'accepted',
                'rejected',
                'withdrawn',
            ])->default('pending');

            $table->timestamp('responded_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_responses');
    }
};
