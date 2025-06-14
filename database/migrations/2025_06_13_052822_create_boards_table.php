<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 생성
     */
    public function up(): void
    {
        Schema::create('boards', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->text('contents');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * 삭제
     */
    public function down(): void
    {
        Schema::dropIfExists('boards');
    }
};
