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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('table_name');
            $table->string('table_id');
            $table->string('file_name');
            $table->string('file_name_origin');
            $table->string('file_ext');
            $table->string('file_size');
            $table->string('file_path');
            $table->string('user_id');
            $table->string('delete_at',1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
