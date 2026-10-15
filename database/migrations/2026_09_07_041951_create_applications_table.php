<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('nim_nisn');
            $table->string('institusi');
            $table->string('jurusan');
            $table->integer('total_interns');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('recommendation_letter');
            $table->string('proposal')->nullable();
            $table->string('surat_selesai')->nullable();
            $table->string('registration_token')->nullable()->unique();
            $table->integer('token_quota')->default(0);
            $table->integer('token_used')->default(0);
            $table->text('notes')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'revision'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
