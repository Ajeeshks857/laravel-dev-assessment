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
        Schema::create('job_details', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('company_name');
            $table->string('company_logo');
            $table->text('description');
            $table->string('location');
            $table->string('experience');
            $table->string('salary');
            $table->json('extra_info');
            $table->timestamps();

            $table->index('title');
            $table->index('company_name');
            $table->index('location');
            $table->index('experience');
            $table->index('salary');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
